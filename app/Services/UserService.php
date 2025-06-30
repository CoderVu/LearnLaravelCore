<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all users for display in table
     */
    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    /**
     * Create a new user with encrypted password
     */
    public function createUser(array $data)
    {
        // Encrypt password before saving
        if (isset($data['password'])) {
            $data['password'] = $this->encodePassword($data['password']);
        }

        return $this->userRepository->create($data);
    }

    /**
     * Update user with encrypted password if provided
     */
    public function updateUser($id, array $data)
    {
        // Only encrypt password if it's provided in the update
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = $this->encodePassword($data['password']);
        } else {
            // Remove password from data if it's empty
            unset($data['password']);
        }

        return $this->userRepository->update($id, $data);
    }

    /**
     * Delete a user
     */
    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }

    /**
     * Find a user by ID
     */
    public function findUser($id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * Encode/Hash password
     */
    public function encodePassword($password)
    {
        return Hash::make($password);
    }

    /**
     * Verify password
     */
    public function verifyPassword($password, $hashedPassword)
    {
        return Hash::check($password, $hashedPassword);
    }

    

    /**
     * Get users with formatted data for table display
     */
    public function getUsersForTable()
    {
        $users = $this->getAllUsers();
        
        // Format data for better table display
        return $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A',
                'password_set' => !empty($user->password) ? 'Yes' : 'No',
                'original' => $user // Keep original object for actions
            ];
        });
    }
}
