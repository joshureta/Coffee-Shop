<?php
namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;

class CartController extends BaseController
{
    /* -------------------------------------------------------------
     * Add an item to the user's cart.
     * Validates session, retrieves product details, calculates price,
     * and saves the item to the cart table.
     * ------------------------------------------------------------- */
    public function addToCart()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Please login to add items to cart');
        }

        $userId = session()->get('user_id');
        $cartModel = new CartModel();
        $productModel = new ProductModel();

        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity') ?: 1;
        $size = $this->request->getPost('size') ?: 'medium';
        $milkType = $this->request->getPost('milk_type') ?: 'whole';
        $sweetness = $this->request->getPost('sweetness') ?: 'regular';
        $specialInstructions = $this->request->getPost('special_instructions') ?: '';

        $product = $productModel->find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $price = $this->calculatePrice($product['price'], $size);

        $cartData = [
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'size' => $size,
            'milk_type' => $milkType,
            'sweetness' => $sweetness,
            'special_instructions' => $specialInstructions,
            'price' => $price
        ];

        if ($cartModel->addToCart($cartData)) {
            return redirect()->to('/cart')->with('success', 'Item added to cart successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to add item to cart');
        }
    }

    /* -------------------------------------------------------------
     * Display the shopping cart page.
     * Loads all cart items, total cost, and cart count for the user.
     * ------------------------------------------------------------- */
    public function viewCart()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $cartModel = new CartModel();
        
        $data = [
            'title' => 'Shopping Cart',
            'cartItems' => $cartModel->getCartItems($userId),
            'cartTotal' => $cartModel->getCartTotal($userId),
            'cart_count' => $cartModel->getCartCount($userId)
        ];
        
        return view('cart', $data);
    }

    /* -------------------------------------------------------------
     * Update quantity of an item inside the cart.
     * Returns updated cart summary (total items and total cost).
     * ------------------------------------------------------------- */
    public function updateCart()
    {
        if (!session()->has('user_id')) {
            return json_encode(['success' => false, 'message' => 'Not logged in']);
        }

        $userId = session()->get('user_id');
        $cartModel = new CartModel();
        
        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');

        if ($cartModel->updateCartItem($itemId, $quantity)) {
            $summary = $cartModel->getCartSummary($userId);
            return json_encode([
                'success' => true,
                'summary' => $summary
            ]);
        } else {
            return json_encode(['success' => false, 'message' => 'Failed to update cart']);
        }
    }

    /* -------------------------------------------------------------
     * Remove a specific item from the cart.
     * Only allows the owner of the cart to remove items.
     * ------------------------------------------------------------- */
    public function removeFromCart($itemId)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $cartModel = new CartModel();

        if ($cartModel->removeFromCart($itemId, $userId)) {
            return redirect()->to('/cart')->with('success', 'Item removed from cart');
        } else {
            return redirect()->to('/cart')->with('error', 'Failed to remove item from cart');
        }
    }

    /* -------------------------------------------------------------
     * Returns the number of items in the user's cart.
     * Used for dynamically updating cart icon count.
     * ------------------------------------------------------------- */
    public function getCartCount()
    {
        if (!session()->has('user_id')) {
            return json_encode(['count' => 0]);
        }

        $userId = session()->get('user_id');
        $cartModel = new CartModel();
        
        return json_encode([
            'count' => $cartModel->getCartCount($userId)
        ]);
    }

    /* -------------------------------------------------------------
     * Display the checkout page.
     * Shows order summary before finalizing the purchase.
     * ------------------------------------------------------------- */
    public function checkout()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Please login to checkout');
        }

        $userId = session()->get('user_id');
        $cartModel = new CartModel();
        
        $data = [
            'title' => 'Checkout',
            'cartItems' => $cartModel->getCartItems($userId),
            'cartTotal' => $cartModel->getCartTotal($userId),
            'cart_count' => $cartModel->getCartCount($userId)
        ];
        
        return view('checkout', $data);
    }

    /* -------------------------------------------------------------
     * Helper function for calculating price based on drink size.
     * Adjusts base price by a fixed amount depending on size.
     * ------------------------------------------------------------- */
    private function calculatePrice($basePrice, $size)
    {
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
