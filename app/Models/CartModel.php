<?php
namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    // Define table properties and allowed fields for mass assignment
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'product_id', 'quantity', 'size', 'milk_type', 'sweetness', 'special_instructions', 'price'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Retrieve all cart items for a specific user.
     * Includes product information through a JOIN with the products table.
     */
    public function getCartItems($userId)
    {
        return $this->select('cart.*, products.name, products.image, products.stock, products.description')
                    ->join('products', 'products.id = cart.product_id')
                    ->where('cart.user_id', $userId)
                    ->orderBy('cart.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Retrieve a single cart item based on user, product, and customization options.
     * Used to determine if an identical item already exists in the cart.
     */
    public function getCartItem($userId, $productId, $size, $milkType, $sweetness)
    {
        return $this->where([
            'user_id' => $userId,
            'product_id' => $productId,
            'size' => $size,
            'milk_type' => $milkType,
            'sweetness' => $sweetness
        ])->first();
    }

    /**
     * Calculate the total amount for all items in the user's cart.
     */
    public function getCartTotal($userId)
    {
        $items = $this->getCartItems($userId);
        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * Count the total number of cart entries for a user.
     * Useful for displaying cart badges or indicators.
     */
    public function getCartCount($userId)
    {
        return $this->where('user_id', $userId)->countAllResults();
    }

    /**
     * Remove all items from the user's cart.
     */
    public function clearCart($userId)
    {
        return $this->where('user_id', $userId)->delete();
    }

    /**
     * Update the quantity of a specific item.
     * Removes the item if quantity becomes zero or below.
     */
    public function updateCartItem($itemId, $quantity)
    {
        if ($quantity <= 0) {
            return $this->delete($itemId);
        } else {
            return $this->update($itemId, ['quantity' => $quantity]);
        }
    }

    /**
     * Remove a specific cart item, ensuring it belongs to the correct user.
     */
    public function removeFromCart($itemId, $userId)
    {
        return $this->where('id', $itemId)->where('user_id', $userId)->delete();
    }

    /**
     * Add an item to the cart.
     * If an identical customized product exists, increase its quantity instead of creating a new entry.
     */
    public function addToCart($data)
    {
        $existing = $this->getCartItem(
            $data['user_id'], 
            $data['product_id'], 
            $data['size'], 
            $data['milk_type'], 
            $data['sweetness']
        );

        if ($existing) {
            return $this->update($existing['id'], [
                'quantity' => $existing['quantity'] + $data['quantity']
            ]);
        } else {
            return $this->insert($data);
        }
    }

    /**
     * Check if a product exists in the user's cart, regardless of customization.
     */
    public function isProductInCart($userId, $productId)
    {
        return $this->where([
            'user_id' => $userId,
            'product_id' => $productId
        ])->countAllResults() > 0;
    }

    /**
     * Generate a summary of the cart including number of items,
     * total quantity, and total cost.
     */
    public function getCartSummary($userId)
    {
        $items = $this->getCartItems($userId);
        $summary = [
            'item_count' => count($items),
            'total_quantity' => 0,
            'total_amount' => 0,
            'items' => $items
        ];

        foreach ($items as $item) {
            $summary['total_quantity'] += $item['quantity'];
            $summary['total_amount'] += $item['price'] * $item['quantity'];
        }

        return $summary;
    }

    /**
     * Validate that all cart items have available stock.
     * Returns an array of error messages for any item that exceeds stock.
     */
    public function validateCartStock($userId)
    {
        $items = $this->getCartItems($userId);
        $errors = [];

        foreach ($items as $item) {
            if ($item['quantity'] > $item['stock']) {
                $errors[] = "Insufficient stock for {$item['name']}. Only {$item['stock']} available.";
            }
        }

        return $errors;
    }
}
