<?php

namespace App\Services;

use App\BOs\UserBO;

class UserService
{
    protected $userBO;

    public function __construct(UserBO $userBO)
    {
        $this->userBO = $userBO;
    }

    public function createUser(array $data)
    {
        return $this->userBO->createUser($data);
    }

    // public function updateUser(int $id, array $data)
    // {
    //     return $this->userBO->updateUser($id, $data);
    // }

    public function getAllUsers()
    {
        return $this->userBO->getAllUsers();
    }

//     public function getUserById(int $id)
//     {
//         return $this->userBO->getUserById($id);
//     }
// }

public function getUserById(int $id)
{
    return cache()->remember("user_{$id}", 60, function () use ($id) {
        return $this->userBO->getUserById($id);
    });
}

public function updateUser(int $id, array $data)
{
    $updatedUser = $this->userBO->updateUser($id, $data);

    if ($updatedUser) {
        cache()->forget("user_{$id}");
    }

    return $updatedUser;
}

public function deleteUser(int $id){
    $deleted = $this->userBO->deleteUser($id);
    cache()->forget("user_{$id}");
    return $deleted;
}
}