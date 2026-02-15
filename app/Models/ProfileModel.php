<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'profile_picture', 'role', 'updated_at'];
    protected $useTimestamps = false; 

    /**
     * Get user by ID
     */
    public function getUserById($id)
    {
        return $this->select('id, username, email, profile_picture, role, created_at, updated_at')
                    ->where('id', $id)
                    ->first();
    }

    /**
     * Update user's profile picture
     */
    public function updateProfilePicture($userId, $filename)
    {
        return $this->update($userId, [
            'profile_picture' => $filename,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Update username
     */
    public function updateUsername($userId, $username)
    {
        return $this->update($userId, [
            'username' => $username,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Check if username is unique 
     */
    public function isUsernameUnique($username, $excludeUserId = null)
    {
        $builder = $this->where('username', $username);
        if ($excludeUserId) {
            $builder->where('id !=', $excludeUserId);
        }

        return $builder->countAllResults() === 0;
    }

    /**
     * Get user profile 
     */
    public function getUserProfile($userId)
    {
        return $this->select('id, username, email, profile_picture, role, created_at, updated_at')
                    ->where('id', $userId)
                    ->first();
    }
}
