<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

helper('email');

class Dashboard extends BaseController
{
    protected $userModel;
    protected $productModel;
    protected $cartModel;

    public function __construct()
    {
        // Initialize necessary models for handling users, products, and cart operations
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->cartModel = new CartModel();
    }

    public function index()
    {
        // Restrict access if user is not logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data = [];

        // Redirect admin users to admin dashboard
        if (session()->get('role') === 'admin') {
            return redirect()->to('/admin/users');
        } else {
            // Display customer dashboard with available and featured products
            $data['products'] = $this->productModel->getProductsForDashboard();
            $data['featured_products'] = $this->productModel->getFeaturedForDashboard();
            $data['cart_count'] = $this->cartModel->getCartCount(session()->get('id'));
            
            return view('dashboard', $data);
        }
    }

    public function profile()
    {
        // Ensure user is logged in before accessing profile page
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');
        
        // Fetch user information
        $user = $this->userModel->find($userId);
        
        if (!$user) {
            return redirect()->to('/login');
        }

        // Update session details to match latest database values
        $this->updateUserSession($user);

        $data['user'] = $user;
        $data['cart_count'] = $this->cartModel->getCartCount($userId);

        return view('profile', $data);
    }

    private function updateUserSession($user)
    {
        // Refresh session data to maintain updated user profile information
        $sessionData = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'profile_picture' => $user['profile_picture'] ?? null,
            'role' => $user['role'],
            'isLoggedIn' => true
        ];
        
        session()->set($sessionData);
    }

    public function cart()
    {
        // Prevent unauthorized access to the cart page
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');

        // Load all cart items and totals for the current user
        $data['cartItems'] = $this->cartModel->getCartItems($userId);
        $data['cartTotal'] = $this->cartModel->getCartTotal($userId);
        $data['cart_count'] = $this->cartModel->getCartCount($userId);
        $data['products'] = $this->productModel->getAvailableProducts();

        return view('cart', $data);
    }

    public function addToCart()
    {
        // Ensure user is authenticated before adding items to cart
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');
        $productId = $this->request->getPost('product_id');

        // Retrieve product data
        $product = $this->productModel->find($productId);
        $quantity = $this->request->getPost('quantity') ?: 1;
        
        // Validate product existence
        if (!$product) {
            return redirect()->to('/cart')->with('error', 'Product not found!');
        }

        // Check stock availability
        if (isset($product['stock']) && $product['stock'] < $quantity) {
            return redirect()->to('/cart')->with('error', 'Insufficient stock! Only ' . $product['stock'] . ' available.');
        }

        // Prepare customizations and price details for cart item
        $basePrice = $this->request->getPost('total_price') ?: $product['price'];
        $size = $this->request->getPost('size') ?: 'medium';
        $milkType = $this->request->getPost('milk_type') ?: 'whole';
        
        $data = [
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'size' => $size,
            'milk_type' => $milkType,
            'sweetness' => $this->request->getPost('sweetness') ?: 'light',
            'special_instructions' => $this->request->getPost('special_instructions') ?: '',
            'price' => $basePrice
        ];

        // Check if similar item already exists for merging quantities
        $existingItem = $this->cartModel->getCartItem(
            $userId, 
            $data['product_id'], 
            $data['size'], 
            $data['milk_type'], 
            $data['sweetness']
        );

        if ($existingItem) {
            // Update quantity if item exists
            $newQuantity = $existingItem['quantity'] + $data['quantity'];
            
            if (isset($product['stock']) && $product['stock'] < $newQuantity) {
                return redirect()->to('/cart')->with('error', 'Insufficient stock! Only ' . $product['stock'] . ' available.');
            }
            
            $this->cartModel->update($existingItem['id'], ['quantity' => $newQuantity]);
            $message = 'Item quantity updated in cart!';
        } else {
            // Insert new cart entry
            $this->cartModel->insert($data);
            $message = 'Item added to cart successfully!';
        }

        return redirect()->to('/cart')->with('success', $message);
    }

    public function updateCart()
    {
        // Validate user session before updating cart items
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');

        // Fetch related cart item and validate stock availability
        $cartItem = $this->cartModel->find($itemId);
        if ($cartItem) {
            $product = $this->productModel->find($cartItem['product_id']);
            
            if ($product && isset($product['stock']) && $quantity > $product['stock']) {
                return redirect()->to('/cart')->with('error', 'Insufficient stock! Only ' . $product['stock'] . ' available.');
            }
        }

        // Handle deletion if quantity becomes zero
        if ($quantity <= 0) {
            $this->cartModel->delete($itemId);
            return redirect()->to('/cart')->with('success', 'Item removed from cart!');
        } else {
            // Update cart item quantity
            $this->cartModel->update($itemId, ['quantity' => $quantity]);
            return redirect()->to('/cart')->with('success', 'Cart updated successfully!');
        }
    }

    public function removeFromCart($itemId)
    {
        // Prevent unauthorized item removal
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $cartItem = $this->cartModel->find($itemId);
        
        // Validate ownership before deletion
        if ($cartItem && $cartItem['user_id'] == session()->get('id')) {
            $this->cartModel->delete($itemId);
            return redirect()->to('/cart')->with('success', 'Item removed from cart!');
        }
        
        return redirect()->to('/cart')->with('error', 'Item not found!');
    }

    public function checkout()
    {
        // Prevent checkout access without authentication
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');
        $data['cartItems'] = $this->cartModel->getCartItems($userId);
        $data['cartTotal'] = $this->cartModel->getCartTotal($userId);
        $data['cart_count'] = $this->cartModel->getCartCount($userId);

        // Restrict checkout for empty carts
        if (empty($data['cartItems'])) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty!');
        }

        $data['title'] = 'Checkout';
        return view('checkout', $data);
    }

    public function processCheckout()
    {
        // Validate login status before order processing
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');
        $userEmail = session()->get('email'); 
        $userName = session()->get('username'); 
        
        $cartItems = $this->cartModel->getCartItems($userId);
        
        // Prevent checkout if cart has no items
        if (empty($cartItems)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty!');
        }

        // Validate required checkout fields
        $shippingAddress = $this->request->getPost('shipping_address');
        $phone = $this->request->getPost('phone');
        $paymentMethod = $this->request->getPost('payment_method');

        if (empty($shippingAddress) || empty($phone) || empty($paymentMethod)) {
            return redirect()->back()->withInput()->with('error', 'Please fill all required fields.');
        }

        // Compute total order amount
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Generate unique order number based on timestamp
        $orderNumber = 'ORD-' . date('YmdHis') . rand(100, 999);

        try {
            // Begin transaction to ensure data integrity
            $db = \Config\Database::connect();
            $db->transStart();

            // Verify stock availability before order placement
            foreach ($cartItems as $item) {
                $product = $this->productModel->find($item['product_id']);
                if (!$product) {
                    throw new \Exception("Product {$item['name']} not found!");
                }
                
                if ($product['stock'] < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$item['name']}. Available: {$product['stock']}, Requested: {$item['quantity']}");
                }
            }

            // Insert order details into database
            $orderData = [
                'user_id' => $userId,
                'total_amount' => $totalAmount,
                'shipping_address' => $shippingAddress,
                'phone' => $phone,
                'payment_method' => $paymentMethod,
                'status' => 'completed',
                'order_number' => $orderNumber,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $db->table('orders')->insert($orderData);
            $orderId = $db->insertID();

            // Insert each cart item as an order item
            foreach ($cartItems as $item) {
                $orderItemData = [
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'size' => $item['size'],
                    'milk_type' => $item['milk_type'],
                    'sweetness' => $item['sweetness'],
                    'special_instructions' => $item['special_instructions'],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $db->table('order_items')->insert($orderItemData);

                // Deduct stock from products table
                $newStock = $product['stock'] - $item['quantity'];
                $db->table('products')
                   ->where('id', $item['product_id'])
                   ->update(['stock' => $newStock, 'updated_at' => date('Y-m-d H:i:s')]);
            }

            // Clear cart after successful order placement
            $this->cartModel->where('user_id', $userId)->delete();

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                throw new \Exception('Transaction failed');
            }

            // Send order receipt via email
            $finalOrderData = $orderData;
            $finalOrderData['id'] = $orderId;

            if (!sendOrderConfirmationEmail($finalOrderData, $cartItems, $userEmail, $userName)) {
                log_message('error', 'Order confirmation email failed to send for order: ' . $orderId);
            } else {
                log_message('info', 'Order receipt email sent successfully to: ' . $userEmail);
            }

            return redirect()->to('/order-confirmation/' . $orderId)->with('success', 'Order placed successfully! Check your email for receipt.');

        } catch (\Exception $e) {
            // Handle unexpected errors gracefully
            log_message('error', 'Checkout failed: ' . $e->getMessage());
            return redirect()->to('/cart')->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }

    public function orderConfirmation($orderId)
    {
        // Ensure user is authenticated
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        
        // Retrieve order details for confirmation screen
        $order = $db->table('orders')->where('id', $orderId)->get()->getRowArray();
        $data['order'] = $order;
        
        // Prevent users from viewing others' orders
        if (!$data['order'] || $data['order']['user_id'] != session()->get('id')) {
            return redirect()->to('/dashboard')->with('error', 'Order not found!');
        }

        // Fetch all items associated with this order
        $orderItems = $db->table('order_items')
            ->select('order_items.*, products.name, products.image, products.description')
            ->join('products', 'products.id = order_items.product_id')
            ->where('order_id', $orderId)
            ->get()
            ->getResultArray();
            
        $data['orderItems'] = $orderItems;

        $data['cart_count'] = $this->cartModel->getCartCount(session()->get('id'));

        return view('order_confirmation', $data);
    }

    public function orders()
    {
        // Allow users to view their order history
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $orderModel = new OrderModel();
        
        $data['orders'] = $orderModel->getUserOrders(session()->get('id'));
        $data['cart_count'] = $this->cartModel->getCartCount(session()->get('id'));

        return view('orders', $data);
    }

    public function debug()
    {
        // Restrict debugging tools to admin users only
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $db = \Config\Database::connect();
        $data = [];

        try {
            // Test database connection and retrieve tables
            $db->query('SELECT 1');
            $data['db_connection'] = '✅ Database connection successful';

            $tables = $db->listTables();
            $data['tables'] = $tables;

            // Fetch product stock information for admin review
            $products = $db->table('products')->select('id, name, stock')->get()->getResultArray();
            $data['products_stock'] = $products;

        } catch (\Exception $e) {
            $data['db_connection'] = '❌ Database connection failed: ' . $e->getMessage();
        }

        return view('debug', $data);
    }

    public function debugProducts()
    {
        // Allow authenticated users to view raw product data for debugging
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $products = $this->productModel->getAllProducts();
        
        // Output all product data in table format for debugging purposes
        echo "<h1>All Products in Database</h1>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Stock</th><th>Status</th><th>Featured</th></tr>";
        foreach ($products as $product) {
            echo "<tr>";
            echo "<td>{$product['id']}</td>";
            echo "<td>{$product['name']}</td>";
            echo "<td>{$product['stock']}</td>";
            echo "<td>{$product['status']}</td>";
            echo "<td>{$product['is_featured']}</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<h2>Products for Dashboard</h2>";
        $dashboardProducts = $this->productModel->getProductsForDashboard();
        echo "Count: " . count($dashboardProducts);
        
        echo "<h2>Featured Products for Dashboard</h2>";
        $featuredProducts = $this->productModel->getFeaturedForDashboard();
        echo "Count: " . count($featuredProducts);
    }

    private function calculatePrice($basePrice, $size)
    {
        // Adjust product price depending on selected size variation
        switch ($size) {
            case 'small':
                return $basePrice - 0.5;
            case 'large':
                return $basePrice + 0.5;
            case 'medium':
            default:
                return $basePrice;
        }
    }
}
