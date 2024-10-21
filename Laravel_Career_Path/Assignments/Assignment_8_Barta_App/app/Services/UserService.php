<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function registerUser(array $data)
    {
        [$fullname, $username, $email, $password] = array_values($data);

        $nameParts = explode(' ', $fullname);
        $lastname = array_pop($nameParts);
        $firstname = implode(' ', $nameParts);

        try {
            $user = DB::table('users')->insert([
                'fullname' => $fullname,
                'lastname' => $lastname,
                'firstname' => $firstname,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($password),
                'created_at' => now(),
            ]);

            return $user ? true : false;
        } catch (\Exception $e) {
            throw new \Exception('Database error: ' . $e->getMessage());
        }
    }

    public function loginUser(array $data)
    {
        if (auth()->attempt($data)) {
            return true;
        }

        return false;
    }

    public function updateProfile(array $data)
    {
        $fullname = $data['first-name'] . ' ' . $data['last-name'];


        try {

            $updateData = [
                'fullname' => $fullname,
                'firstname' => $data['first-name'],
                'lastname' => $data['last-name'],
                'email' => $data['email'],
                'bio' => $data['bio'],
            ];

            if (!empty($data['new-password'])) {
                $updateData['password'] = Hash::make($data['new-password']);
            }

            $affected = DB::table('users')
                ->where('id', auth()->user()->id)
                ->update($updateData);

            return ($affected > 0);
        } catch (\Exception $e) {
            return false;
        }
    }
}
