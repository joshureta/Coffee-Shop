<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'role', 'profile_picture'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email',
        'password' => 'permit_empty|min_length[8]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email is already taken by another user.'
        ]
    ];

    /**
     * Get user by email
     */
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Paginate users, optionally with search
     */
    public function paginateUsers($perPage = 10, $search = null)
    {
        if ($search) {
            $this->groupStart()
                 ->like('username', $search)
                 ->orLike('email', $search)
                 ->orLike('role', $search)
                 ->groupEnd();
        }

        return $this->orderBy('created_at', 'DESC')
                    ->paginate($perPage);
    }

    /**
     * Get user statistics
     */
    public function getUserStats()
    {
        return [
            'total'    => $this->countAll(),
            'admin'    => $this->where('role', 'admin')->countAllResults(),
            'customer' => $this->where('role', 'customer')->countAllResults()
        ];
    }

    /**
     * Check if email is unique (excluding current user)
     */
    public function isEmailUnique($email, $id)
    {
        return $this->where('email', $email)
                    ->where('id !=', $id)
                    ->countAllResults() === 0;
    }
}
