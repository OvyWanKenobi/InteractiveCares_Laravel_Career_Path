<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserService
{
    public function registerUser(array $data)
    {
        [$firstname, $lastname, $username, $email, $password] = array_values($data);

        try {

            $user = new User();
            $user->lastname = $lastname;
            $user->firstname = $firstname;
            $user->username = $username;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->created_at = now();
            $registerUser = $user->save();

            if ($registerUser) {

                $url = "https://ui-avatars.com/api/?background=random&name=" . urlencode($user->fullname);
                $contents = Http::get($url)->body();
                $filename = $user->username . '.png';
                Storage::disk('local')->put('profile-picture/' . $filename, $contents);
                $user->profilepicture = $filename;
                $user->save();

                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            throw new \Exception('Internal Server Error ');
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

        // dd($data);
        try {

            $user = User::find(auth()->user()->id);

            $user->firstname = $data['first-name'];
            $user->lastname = $data['last-name'];
            $user->email = $data['email'];
            $user->bio = $data['bio'];



            if (!empty($data['new-password'])) {
                $user->password = Hash::make($data['new-password']);
            }

            if (isset($data['avatar']) && !empty($data['avatar'])) {


                Storage::disk('local')->put('profile-picture/' . $user->username . '.png', file_get_contents($data['avatar']));
            }

            $affected = $user->save();

            return ($affected > 0);
        } catch (\Exception $e) {
            return false;
        }
    }
}
