<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = auth()->id();
        return [
            'first-name' => ['required', 'max:20', 'regex:/^[\pL\s]+$/u'],
            'last-name' => ['required', 'max:10', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'email', 'unique:users,email,' . $userId],
            'new-password' => ['nullable', 'max:15', 'min:6', 'regex:/^\S*$/'],
            'current-password' => ['required'],
            'bio' => ['nullable', 'max:250'],
        ];
    }

    public function messages()
    {
        return [
            'new-password.regex' => 'The Password must not contain spaces.',
            'current-password.required' => 'Current Password Required To Update Profile',
            'email.required' => 'Enter Current Email or Set a New one',
            'first-name.regex' => 'First Name can only have letters and space',
            'last-name.regex' => 'Last Name can only have letters and space',
        ];
    }

    public function attributes()
    {
        return [
            'first-name' => 'First Name',
            'last-name' => 'Last Name',
            'email' => 'Email Address',
            'current-password' => 'Current Password',
            'new-password' => 'New Password',
            'bio' => 'Biography',
        ];
    }
}
