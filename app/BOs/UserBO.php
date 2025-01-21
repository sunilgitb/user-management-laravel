<?php
namespace App\BOs;

use App\DAOs\UserDAO;

class UserBO
{
    protected $userDAO;

    public function __construct(UserDAO $userDAO)
    {
        $this->userDAO = $userDAO;
    }

    public function createUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userDAO->create($data);
    }

    public function updateUser(int $id, array $data)
    {
        $user = $this->userDAO->find($id);

        if (!$user) {
            return null; // Handle user not found
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $this->userDAO->update($user, $data);
    }

    public function getAllUsers()
    {
        return $this->userDAO->all();
    }

    public function getUserById(int $id)
    {
        return $this->userDAO->find($id);
    }
    public function deleteUser(int $id){
        return $this->userDAO->delete($id);
    }
}
