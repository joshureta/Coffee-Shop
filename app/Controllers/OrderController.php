<?php
namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\CartModel;
use App\Models\OrderItemModel;

class OrderController extends BaseController
{
    public function placeOrder()
    {
        // -------------------------------------------------------------
        // Ensure the user is logged in before placing an order
        // -------------------------------------------------------------
        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Please login to place order');
        }

        // -------------------------------------------------------------
        // Validate checkout form fields (address, phone, payment method)
        // -------------------------------------------------------------
        $validation = \Config\Services::validation();
        $validation->setRules([
            'shipping_address' => 'required|min_length[10]',
            'phone' => 'required|min_length[10]',
            'payment_method' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // -------------------------------------------------------------
        // Load necessary models and retrieve the current user's cart
        // -------------------------------------------------------------
        $userId = session()->get('user_id');
        $cartModel = new CartModel();
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        // Retrieve cart items along with customization details
        $cartItems = $cartModel->getCartItems($userId);

        // Check if cart is empty before placing order
        if (empty($cartItems)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty');
        }

        // -------------------------------------------------------------
        // Start a database transaction for the entire order process
        // -------------------------------------------------------------
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // ---------------------------------------------------------
            // Calculate total order amount based on cart items
            // ---------------------------------------------------------
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }

            // ---------------------------------------------------------
            // Prepare order data for insertion in the database
            // ---------------------------------------------------------
            $orderData = [
                'user_id' => $userId,
                'total_amount' => $totalAmount,
                'shipping_address' => $this->request->getPost('shipping_address'),
                'phone' => $this->request->getPost('phone'),
                'payment_method' => $this->request->getPost('payment_method'),
                'status' => 'pending',
                'order_date' => date('Y-m-d H:i:s')
            ];

            // Insert order record and retrieve its generated ID
            $orderId = $orderModel->insert($orderData);

            if (!$orderId) {
                throw new \Exception('Failed to create order');
            }

            // ---------------------------------------------------------
            // Insert all related order items with full customization info
            // ---------------------------------------------------------
            foreach ($cartItems as $item) {
                $orderItemData = [
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'size' => $item['size'],
                    'milk_type' => $item['milk_type'],
                    'sweetness' => $item['sweetness'],
                    'special_instructions' => $item['special_instructions']
                ];

                if (!$orderItemModel->insert($orderItemData)) {
                    throw new \Exception('Failed to create order items');
                }
            }

            // ---------------------------------------------------------
            // Clear the user's cart after successful order placement
            // ---------------------------------------------------------
            $cartModel->where('user_id', $userId)->delete();

            // Complete database transaction
            $db->transComplete();

            // Check if the transaction failed
            if ($db->transStatus() === FALSE) {
                throw new \Exception('Transaction failed');
            }

            // Redirect to confirmation page
            return redirect()->to('/order-confirmation/' . $orderId)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            // ---------------------------------------------------------
            // Rollback transaction and log any encountered errors
            // ---------------------------------------------------------
            $db->transRollback();
            log_message('error', 'Order placement failed: ' . $e->getMessage());
            return redirect()->to('/cart')->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }

    public function orderSuccess($orderId)
    {
        // -------------------------------------------------------------
        // Verify that the user is logged in before viewing confirmation
        // -------------------------------------------------------------
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        // -------------------------------------------------------------
        // Retrieve the specific order and verify user ownership
        // -------------------------------------------------------------
        $order = $orderModel->find($orderId);
        if (!$order || $order['user_id'] != session()->get('user_id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Retrieve all items linked to this order
        $orderItems = $orderItemModel->getOrderItems($orderId);

        $cartModel = new CartModel();

        // -------------------------------------------------------------
        // Prepare data for order success view
        // -------------------------------------------------------------
        $data = [
            'title' => 'Order Confirmation',
            'order' => $order,
            'orderItems' => $orderItems,
            'cart_count' => $cartModel->where('user_id', session()->get('user_id'))->countAllResults()
        ];

        return view('order_success', $data);
    }

    public function orderHistory()
    {
        // -------------------------------------------------------------
        // Restrict access to logged-in customers only
        // -------------------------------------------------------------
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $cartModel = new CartModel();

        // -------------------------------------------------------------
        // Retrieve all orders for the current user
        // -------------------------------------------------------------
        $orders = $orderModel->where('user_id', $userId)
                             ->orderBy('order_date', 'DESC')
                             ->findAll();

        // Get all order items belonging to these orders
        $orderIds = array_column($orders, 'id');
        $orderItems = [];
        if (!empty($orderIds)) {
            $orderItems = $orderItemModel->getItemsForOrders($orderIds);
        }

        // -------------------------------------------------------------
        // Prepare data for the order history page
        // -------------------------------------------------------------
        $data = [
            'title' => 'Order History',
            'orders' => $orders,
            'orderItems' => $orderItems,
            'cart_count' => $cartModel->where('user_id', $userId)->countAllResults()
        ];

        return view('orders', $data);
    }
}
