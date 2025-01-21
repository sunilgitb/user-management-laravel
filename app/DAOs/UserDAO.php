<?php
namespace App\DAOs;

use App\Models\User;

class UserDAO
{
    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(User $user, array $data)
    {
        return $user->update($data);
    }

    public function find(int $id)
    {
        return User::find($id);
    }

    public function all()
    {
        return User::all();
    }
    
    public function delete(User $user){
        return $user->delete();
    }
}
