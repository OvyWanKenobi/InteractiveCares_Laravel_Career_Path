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
            'password' => ['required', 'max:15', 'min:6', 'regex:/^\S*$/'],
            'bio' => ['max:250'],
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'The Password must not contain spaces.',
            'password.required' => 'Enter Current Password or Set a New one',
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
            'password' => 'Password',
            'bio' => 'Biography',
        ];
    }
}
