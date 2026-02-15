<?php
namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    // Table properties
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'order_id', 
        'product_id', 
        'quantity', 
        'price',
        'size',
        'milk_type',
        'sweetness',
        'special_instructions'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    /**
     * Get all items for a single order.
     * Includes product details such as name, image, and description.
     */
    public function getOrderItems($orderId)
    {
        return $this->select('order_items.*, products.name, products.image, products.description')
                    ->join('products', 'products.id = order_items.product_id')
                    ->where('order_id', $orderId)
                    ->orderBy('order_items.created_at', 'ASC')
                    ->findAll();
    }

    /**
     * Get order items for multiple orders.
     * Useful for order history views.
     */
    public function getItemsForOrders($orderIds)
    {
        return $this->select('order_items.*, products.name, products.image')
                    ->join('products', 'products.id = order_items.product_id')
                    ->whereIn('order_id', $orderIds)
                    ->orderBy('order_id', 'DESC')   
                    ->orderBy('created_at', 'ASC')  
                    ->findAll();
    }
}
