<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('login');
    }

    public function attemptLogin()
    {
        $session = session();

        // Form validation rules for login
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[1]' 
        ], [
            'email' => [
                'required' => 'Email is required',
                'valid_email' => 'Please enter a valid email address'
            ],
            'password' => [
                'required' => 'Password is required',
                'min_length' => 'Password must be at least 1 character'
            ]
        ]);

        // Validate user inputs
        if (!$validation->withRequest($this->request)->run()) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $this->request->getPost());
            return redirect()->to('/login');
        }

        // Retrieve validated data
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Fetch user record by email
        $user = $this->userModel->getUserByEmail($email);

        // Validate user credentials
        if ($user && password_verify($password, $user['password'])) {
            $sessionData = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'profile_picture' => $user['profile_picture'],
                'role' => $user['role'],
                'isLoggedIn' => true
            ];
            $session->set($sessionData);

            return redirect()->to('/dashboard');
        } else {
            $session->setFlashdata('error', 'Invalid email or password');
            $session->setFlashdata('old', $this->request->getPost());
            return redirect()->to('/login');
        }
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('register');
    }

    public function attemptRegister()
    {
        $session = session();

        // Form validation rules for registration
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[100]|alpha_numeric_space',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|strong_password'
        ], [
            'username' => [
                'required' => 'Username is required',
                'min_length' => 'Username must be at least 3 characters long',
                'max_length' => 'Username cannot exceed 100 characters',
                'alpha_numeric_space' => 'Username can only contain letters, numbers, and spaces'
            ],
            'email' => [
                'required' => 'Email is required',
                'valid_email' => 'Please enter a valid email address',
                'is_unique' => 'This email is already registered'
            ],
            'password' => [
                'required' => 'Password is required',
                'min_length' => 'Password must be at least 8 characters long',
                'strong_password' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character'
            ]
        ]);

        // Custom validation rule for strong passwords
        $validation->setRule('password', 'Password', 'strong_password', [
            'strong_password' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character'
        ]);

        // Validate user inputs
        if (!$validation->withRequest($this->request)->run()) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $this->request->getPost());
            return redirect()->to('/register');
        }

        // Prepare user data for insertion
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'customer'
        ];

        // Save user in the database
        if ($this->userModel->save($data)) {
            $session->setFlashdata('success', 'Registration successful! Please login.');
            return redirect()->to('/login');
        } else {
            $session->setFlashdata('error', 'Registration failed. Please try again.');
            $session->setFlashdata('old', $this->request->getPost());
            return redirect()->to('/register');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}