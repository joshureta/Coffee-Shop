<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\CartModel;

class Profile extends BaseController
{
    protected $profileModel;
    protected $cartModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        // Initialize required models used throughout the Profile controller
        $this->profileModel = new ProfileModel();
        $this->cartModel = new CartModel();
    }

    /**
     * Display the user's profile page
     */
    public function index()
    {
        // Verify that the user is authenticated before accessing the profile page
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Retrieve the logged-in user’s data from the database
        $userId = session()->get('id');
        $user = $this->profileModel->getUserById($userId);

        // Redirect to login if no valid user record is found
        if (!$user) {
            return redirect()->to('/login');
        }

        // Refresh session data with the updated user information
        $this->updateUserSession($user);

        // Prepare necessary data for displaying the profile page
        $data = [
            'title' => 'My Profile',
            'user' => $user,
            'cart_count' => $this->cartModel->getCartCount($userId) 
        ];

        return view('profile', $data);
    }

    /**
     * Display the edit profile page
     */
    public function edit()
    {
        // Ensure the user is logged in before accessing the edit page
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Retrieve existing user information
        $userId = session()->get('id');
        $user = $this->profileModel->getUserById($userId);

        // If user no longer exists, force logout
        if (!$user) {
            return redirect()->to('/login');
        }

        // Update session to ensure data consistency
        $this->updateUserSession($user);

        // Prepare data for the edit profile view
        $data = [
            'title' => 'Edit Profile',
            'user' => $user,
            'cart_count' => $this->cartModel->getCartCount($userId)
        ];

        return view('profile', $data);
    }

    /**
     * Update profile picture
     */
    public function update()
    {
        // Restrict method access to authenticated users only
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');

        // Validate the uploaded image file according to defined rules
        $validation = $this->validate([
            'profile_picture' => [
                'rules' => 'uploaded[profile_picture]|max_size[profile_picture,2048]|is_image[profile_picture]|mime_in[profile_picture,image/jpg,image/jpeg,image/png,image/gif,image/webp]',
                'errors' => [
                    'uploaded' => 'Please select an image file',
                    'max_size' => 'File size must be less than 2MB',
                    'is_image' => 'Please select a valid image file',
                    'mime_in' => 'Only JPG, PNG, GIF, and WEBP files are allowed'
                ]
            ]
        ]);

        // Return with error messages if validation fails
        if (!$validation) {
            return redirect()->back()->with('error', $this->validator->listErrors());
        }

        $file = $this->request->getFile('profile_picture');

        // If file is valid, process upload and update database
        if ($file->isValid() && !$file->hasMoved()) {

            // Remove old profile picture file to avoid unnecessary storage
            $oldPicture = $this->profileModel->getUserById($userId)['profile_picture'];
            if ($oldPicture && file_exists(ROOTPATH . 'public/uploads/profile_pics/' . $oldPicture)) {
                unlink(ROOTPATH . 'public/uploads/profile_pics/' . $oldPicture);
            }

            // Generate a unique filename for the uploaded image
            $newName = $file->getRandomName();

            // Move the file into the designated upload folder
            $file->move(ROOTPATH . 'public/uploads/profile_pics', $newName);

            // Apply image resizing and optimization
            $this->processProfileImage($newName);

            // Save new filename into the database and update the session
            if ($this->profileModel->updateProfilePicture($userId, $newName)) {
                $updatedUser = $this->profileModel->getUserById($userId);
                $this->updateUserSession($updatedUser);
                
                return redirect()->to('/profile/edit')->with('success', 'Profile picture updated successfully!');
            } else {
                return redirect()->to('/profile/edit')->with('error', 'Failed to update profile picture.');
            }
        }

        return redirect()->to('/profile/edit')->with('error', 'File upload failed.');
    }

    /**
     * Process profile image for resizing and optimization
     */
    private function processProfileImage($filename)
    {
        // Define file location path for image manipulation
        $imagePath = ROOTPATH . 'public/uploads/profile_pics/' . $filename;
        
        try {
            // Utilize CodeIgniter's image service to standardize image size and quality
            $image = service('image');
            $image->withFile($imagePath)
                  ->fit(200, 200, 'center')
                  ->save($imagePath, 80);
        } catch (\CodeIgniter\Images\Exceptions\ImageException $e) {
            // Log image processing errors without interrupting the upload flow
            log_message('error', 'Profile image processing failed: ' . $e->getMessage());
        }
    }

    /**
     * Update username
     */
    public function updateUsername()
    {
        // Ensure only authenticated users can modify their username
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');

        // Validate the new username with appropriate constraints
        $validation = $this->validate([
            'username' => [
                'rules' => 'required|min_length[3]|max_length[30]|is_unique[users.username,id,' . $userId . ']',
                'errors' => [
                    'required' => 'Username is required',
                    'min_length' => 'Username must be at least 3 characters long',
                    'max_length' => 'Username cannot exceed 30 characters',
                    'is_unique' => 'This username is already taken'
                ]
            ]
        ]);

        // Return validation errors if any
        if (!$validation) {
            return redirect()->back()->with('error', $this->validator->listErrors());
        }

        $username = $this->request->getPost('username');

        // Attempt to update username through the model
        if ($this->profileModel->updateUsername($userId, $username)) {

            // Update session to reflect username changes immediately
            session()->set('username', $username);

            // Refresh full user data stored in session
            $updatedUser = $this->profileModel->getUserById($userId);
            $this->updateUserSession($updatedUser);
            
            return redirect()->to('/profile/edit')->with('success', 'Username updated successfully!');
        } else {
            return redirect()->to('/profile/edit')->with('error', 'Failed to update username.');
        }
    }

    /**
     * Delete profile picture
     */
    public function deleteProfilePicture()
    {
        // Restrict method usage to authenticated users only
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');
        $user = $this->profileModel->getUserById($userId);

        // Remove stored profile picture file if it exists
        if ($user['profile_picture'] && file_exists(ROOTPATH . 'public/uploads/profile_pics/' . $user['profile_picture'])) {
            unlink(ROOTPATH . 'public/uploads/profile_pics/' . $user['profile_picture']);
        }

        // Clear profile picture data from database and update session
        if ($this->profileModel->updateProfilePicture($userId, null)) {
            $updatedUser = $this->profileModel->getUserById($userId);
            $this->updateUserSession($updatedUser);
            
            return redirect()->to('/profile/edit')->with('success', 'Profile picture removed successfully!');
        } else {
            return redirect()->to('/profile/edit')->with('error', 'Failed to remove profile picture.');
        }
    }

    /**
     * Update user data stored in session
     */
    private function updateUserSession($user)
    {
        // Refresh all relevant session data to reflect latest user information
        $sessionData = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'profile_picture' => $user['profile_picture'] ?? null,
            'role' => $user['role'] ?? 'customer',
            'isLoggedIn' => true
        ];
        
        session()->set($sessionData);
    }
}
