<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserService
{
    public function registerUser(array $data)
    {


        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $registerUser = $user->save();
            if ($registerUser) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            throw new \Exception('Internal Server Error: Failed to register user ');
        }
    }


}
