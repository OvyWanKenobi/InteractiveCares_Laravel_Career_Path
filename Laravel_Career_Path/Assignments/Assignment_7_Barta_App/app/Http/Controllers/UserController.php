<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    public function index()
    {
        return  view('user.index');
    }

    public function profile()
    {

        $user = auth()->user()->only(['fullname', 'bio']);


        return  view('user.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = auth()->user()->only(['firstname', 'lastname', 'bio', 'email',]);
        // dd($user);
        return  view('user.edit-profile', compact('user'));
    }

    public function editProfileSubmit(EditProfileRequest $request)
    {

        $validated = $request->validated();
        // dd($validate);
        [$firstname, $lastname, $email, $password, $bio] = array_values($validated);
        $fullname = $firstname . ' ' . $lastname;
        $password = Hash::make($password);


        try {

            $affected = DB::table('users')
                ->where('id', auth()->id())
                ->update([
                    'fullname' => $fullname,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => $password,
                    'bio' => $bio,
                ]);
            if ($affected === 0) {
                return redirect()->back()->withErrors(['error' => 'Error occured while upadating profile. Please try again.']);
            }

            return redirect('edit-profile')->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Database error: ' . $e->getMessage()]);
        }
    }
}
