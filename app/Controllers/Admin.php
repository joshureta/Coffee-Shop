<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;

class Admin extends BaseController
{
    protected $userModel;
    protected $productModel;
    protected $perPage = 10;

    /* ------------------------------------------------------------
     * Constructor: Initializes UserModel and ProductModel instances
     * ------------------------------------------------------------ */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
    }

    /* ------------------------------------------------------------
     * Display Users Page with Search and Pagination
     * This block handles access validation, search filtering,
     * pagination, and retrieval of user statistics.
     * ------------------------------------------------------------ */
    public function users()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $search = $this->request->getGet('search');
        
        if ($search) {
            $this->userModel->groupStart()
                 ->like('username', $search)
                 ->orLike('email', $search)
                 ->orLike('role', $search)
                 ->groupEnd();
        }
        
        $data = [
            'users' => $this->userModel->orderBy('created_at', 'DESC')->paginate($this->perPage),
            'pager' => $this->userModel->pager,
            'stats' => $this->userModel->getUserStats(),
            'search' => $search
        ];
        
        return view('admin/users', $data);
    }

    /* ------------------------------------------------------------
     * Load Edit User Page
     * Retrieves a specific user by ID and validates existence.
     * ------------------------------------------------------------ */
    public function editUser($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);
        
        if (!$data['user']) {
            return redirect()->to('/admin/users')->with('error', 'User not found.');
        }

        return view('admin/edit_user', $data);
    }

    /* ------------------------------------------------------------
     * Update User Information
     * Performs field validation, email uniqueness checks,
     * and updates user data inside the database.
     * ------------------------------------------------------------ */
    public function updateUser($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $userModel = new UserModel();
        $session = session();

        $currentUser = $userModel->find($id);
        if (!$currentUser) {
            $session->setFlashdata('error', 'User not found.');
            return redirect()->to('/admin/users');
        }

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');

        if (empty($username) || empty($email) || empty($role)) {
            $session->setFlashdata('error', 'All fields are required.');
            return redirect()->to('/admin/users/edit/' . $id);
        }

        if ($email !== $currentUser['email']) {
            if (!$userModel->isEmailUnique($email, $id)) {
                $session->setFlashdata('error', 'Email already exists for another user.');
                return redirect()->to('/admin/users/edit/' . $id);
            }
        }

        $data = [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'role' => $role
        ];

        if ($userModel->save($data)) {
            $session->setFlashdata('success', 'User updated successfully!');
        } else {
            $errors = $userModel->errors();
            $session->setFlashdata('error', 'Failed to update user: ' . implode(', ', $errors));
        }

        return redirect()->to('/admin/users');
    }

    /* ------------------------------------------------------------
     * Delete a User Account
     * Ensures user exists and performs deletion from database.
     * ------------------------------------------------------------ */
    public function deleteUser($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $userModel = new UserModel();
        $session = session();

        if ($userModel->delete($id)) {
            $session->setFlashdata('success', 'User deleted successfully!');
        } else {
            $session->setFlashdata('error', 'Failed to delete user.');
        }

        return redirect()->to('/admin/users');
    }

    /* ------------------------------------------------------------
     * Create New User
     * Validates input fields, checks uniqueness,
     * and inserts new user record with hashed password.
     * ------------------------------------------------------------ */
    public function createUser()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $userModel = new UserModel();
        $session = session();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'role' => 'required|in_list[customer,admin]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $session->setFlashdata('error', implode('<br>', $validation->getErrors()));
            return redirect()->to('/admin/users');
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role')
        ];

        if ($userModel->save($data)) {
            $session->setFlashdata('success', 'User created successfully!');
        } else {
            $session->setFlashdata('error', 'Failed to create user.');
        }

        return redirect()->to('/admin/users');
    }

    /* ------------------------------------------------------------
     * Display Products Page with Search and Pagination
     * Filters products based on search input and loads statistics.
     * ------------------------------------------------------------ */
    public function products()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $search = $this->request->getGet('search');
        
        if ($search) {
            $this->productModel->groupStart()
                 ->like('name', $search)
                 ->orLike('description', $search)
                 ->orLike('category', $search)
                 ->groupEnd();
        }
        
        $data = [
            'products' => $this->productModel->orderBy('created_at', 'DESC')->paginate($this->perPage),
            'pager' => $this->productModel->pager,
            'stats' => $this->productModel->getProductStats(),
            'search' => $search
        ];
        
        return view('admin/products', $data);
    }

    /* ------------------------------------------------------------
     * Create New Product with Image Upload
     * Validates input fields, processes image upload,
     * and inserts product record into database.
     * ------------------------------------------------------------ */
    public function createProduct()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $productModel = new ProductModel();
        $session = session();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
            'price' => 'required|decimal',
            'stock' => 'required|integer',
            'category' => 'required',
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $session->setFlashdata('error', implode('<br>', $validation->getErrors()));
            return redirect()->to('/admin/products');
        }

        $image = $this->request->getFile('image');
        $imageName = null;

        if ($image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/products', $imageName);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'category' => $this->request->getPost('category'),
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
            'status' => 'active',
            'image' => $imageName
        ];

        if ($productModel->save($data)) {
            $session->setFlashdata('success', 'Product created successfully!');
        } else {
            $session->setFlashdata('error', 'Failed to create product.');
        }

        return redirect()->to('/admin/products');
    }

    /* ------------------------------------------------------------
     * Load Edit Product Page
     * Retrieves a specific product and validates existence.
     * ------------------------------------------------------------ */
    public function editProduct($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $productModel = new ProductModel();
        $data['product'] = $productModel->find($id);
        
        if (!$data['product']) {
            return redirect()->to('/admin/products')->with('error', 'Product not found.');
        }

        return view('admin/edit_product', $data);
    }

    /* ------------------------------------------------------------
     * Update Product Information
     * Handles text fields, image replacement,
     * and ensures product remains active.
     * ------------------------------------------------------------ */
    public function updateProduct($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $productModel = new ProductModel();
        $session = session();

        $currentProduct = $productModel->find($id);
        if (!$currentProduct) {
            $session->setFlashdata('error', 'Product not found.');
            return redirect()->to('/admin/products');
        }

        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $price = $this->request->getPost('price');
        $stock = $this->request->getPost('stock');
        $category = $this->request->getPost('category');
        $isFeatured = $this->request->getPost('is_featured') ? 1 : 0;

        if (empty($name) || empty($description) || empty($price) || empty($stock) || empty($category)) {
            $session->setFlashdata('error', 'All fields are required.');
            return redirect()->to('/admin/products/edit/' . $id);
        }

        $image = $this->request->getFile('image');
        $imageName = $currentProduct['image'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            if ($imageName && file_exists(ROOTPATH . 'public/uploads/products/' . $imageName)) {
                unlink(ROOTPATH . 'public/uploads/products/' . $imageName);
            }
            
            $imageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/products', $imageName);
        }

        // FIXED: Always set status to active when updating
        $data = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'stock' => $stock,
            'category' => $category,
            'is_featured' => $isFeatured,
            'status' => 'active',
            'image' => $imageName
        ];

        if ($productModel->save($data)) {
            $session->setFlashdata('success', 'Product updated successfully!');
        } else {
            $errors = $productModel->errors();
            $session->setFlashdata('error', 'Failed to update product: ' . implode(', ', $errors));
        }

        return redirect()->to('/admin/products');
    }

    /* ------------------------------------------------------------
     * Delete Product and Remove Image from Storage
     * Ensures product exists, deletes image file,
     * and removes database record.
     * ------------------------------------------------------------ */
    public function deleteProduct($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $productModel = new ProductModel();
        $session = session();

        $product = $productModel->find($id);
        
        if ($product) {
            if ($product['image'] && file_exists(ROOTPATH . 'public/uploads/products/' . $product['image'])) {
                unlink(ROOTPATH . 'public/uploads/products/' . $product['image']);
            }
            
            if ($productModel->delete($id)) {
                $session->setFlashdata('success', 'Product deleted successfully!');
            } else {
                $session->setFlashdata('error', 'Failed to delete product.');
            }
        } else {
            $session->setFlashdata('error', 'Product not found.');
        }

        return redirect()->to('/admin/products');
    }

    /* ------------------------------------------------------------
     * Toggle Product Status (Active / Inactive)
     * Allows administrators to control product visibility.
     * ------------------------------------------------------------ */
    public function toggleProductStatus($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $productModel = new ProductModel();
        $session = session();

        $product = $productModel->find($id);
        
        if ($product) {
            $newStatus = $product['status'] === 'active' ? 'inactive' : 'active';
            $productModel->update($id, ['status' => $newStatus]);
            $session->setFlashdata('success', 'Product status updated successfully!');
        } else {
            $session->setFlashdata('error', 'Product not found.');
        }

        return redirect()->to('/admin/products');
    }
}
