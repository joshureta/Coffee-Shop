<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Models\OrderItemModel;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 
        'total_amount', 
        'status', 
        'shipping_address', 
        'phone', 
        'payment_method',
        'order_number'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Automatically generate order number before inserting.
     */
    protected function beforeInsert(array $data)
    {
        $data = $this->generateOrderNumber($data);
        return $data;
    }

    /**
     * Generates a unique order number in the format ORD-000001, ORD-000002, etc.
     */
    private function generateOrderNumber(array $data)
    {
        if (!isset($data['data']['order_number'])) {
            $lastOrder = $this->orderBy('id', 'DESC')->first();
            $lastId = $lastOrder ? $lastOrder['id'] : 0;
            $nextId = $lastId + 1;
            $data['data']['order_number'] = 'ORD-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
        }
        return $data;
    }

    /**
     * Get all orders for a specific user.
     */
    public function getUserOrders($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get a single order along with its items.
     */
    public function getOrderWithItems($orderId)
    {
        $order = $this->find($orderId);
        if ($order) {
            $orderItemsModel = new OrderItemModel();
            $order['items'] = $orderItemsModel->getOrderItems($orderId);
        }
        return $order;
    }

    /**
     * Get all orders including associated user data.
     */
    public function getAllOrdersWithUsers()
    {
        return $this->select('orders.*, users.username, users.email')
                    ->join('users', 'users.id = orders.user_id')
                    ->orderBy('orders.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Update order status (only allowed: pending, completed)
     */
    public function updateOrderStatus($orderId, $status)
    {
        $allowedStatuses = ['pending', 'completed'];
        
        if (!in_array($status, $allowedStatuses)) {
            return false;
        }
        
        return $this->update($orderId, ['status' => $status]);
    }

    /**
     * Get all orders filtered by status.
     */
    public function getOrdersByStatus($status)
    {
        return $this->where('status', $status)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }

    /**
     * Get basic order statistics.
     */
    public function getOrderStats()
    {
        $stats = [
            'total_orders' => $this->countAll(),
            'pending_orders' => $this->where('status', 'pending')->countAllResults(),
            'completed_orders' => $this->where('status', 'completed')->countAllResults(),
            'total_revenue' => $this->selectSum('total_amount')
                                     ->where('status', 'completed')
                                     ->get()
                                     ->getRow()
                                     ->total_amount ?? 0
        ];

        return $stats;
    }
}
