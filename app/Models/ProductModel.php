<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 
        'description', 
        'price', 
        'image', 
        'stock', 
        'category', 
        'is_featured', 
        'status'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'description' => 'required|min_length[10]',
        'price' => 'required|decimal',
        'stock' => 'required|integer',
        'category' => 'required'
    ];

    /**
     * Get only active products with stock > 0
     */
    public function getAvailableProducts()
    {
        return $this->where('status', 'active')
                    ->where('stock >', 0)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get featured products that are active and in stock
     */
    public function getFeaturedProducts()
    {
        return $this->where('status', 'active')
                    ->where('is_featured', 1)
                    ->where('stock >', 0)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Paginate products with optional search by name, description, or category
     */
    public function paginateProducts($perPage = 10, $search = null)
    {
        if ($search) {
            $this->groupStart()
                 ->like('name', $search)
                 ->orLike('description', $search)
                 ->orLike('category', $search)
                 ->groupEnd();
        }
        
        return $this->orderBy('created_at', 'DESC')
                    ->paginate($perPage);
    }

    /**
     * Get statistics about products for dashboard or reports
     */
    public function getProductStats()
    {
        return [
            'total' => $this->countAll(),
            'active' => $this->where('status', 'active')->countAllResults(),
            'inactive' => $this->where('status', 'inactive')->countAllResults(),
            'featured' => $this->where('is_featured', 1)->countAllResults(),
            'low_stock' => $this->where('stock <', 10)->where('stock >', 0)->countAllResults(),
            'out_of_stock' => $this->where('stock', 0)->countAllResults()
        ];
    }

    /**
     * Deduct stock after an order
     */
    public function updateStock($productId, $quantity)
    {
        $product = $this->find($productId);
        if ($product) {
            $newStock = max(0, $product['stock'] - $quantity);
            return $this->update($productId, ['stock' => $newStock]);
        }
        return false;
    }

    /**
     * Dashboard helpers - show all products regardless of stock
     */
    public function getProductsForDashboard()
    {
        return $this->where('status', 'active')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getFeaturedForDashboard()
    {
        return $this->where('status', 'active')
                    ->where('is_featured', 1)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getAllProducts()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }
}
