<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Closure;
use Illuminate\Support\Str;

class UserRegistrationRequest extends FormRequest
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
        return [
            'firstname' => ['required', 'max:30', 'regex:/^[\pL\s]+$/u'],
            'lastname' => ['required', 'max:20', 'regex:/^[\pL\s]+$/u'],
            'username' => ['required', 'max:15', 'unique:users', 'regex:/^[a-zA-Z][a-zA-Z0-9]*$/'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'max:15', 'min:6', 'regex:/^\S*$/'],

        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'The Password must not contain spaces.',
            'username.regex' => 'The Username can only have letters and numbers, and must start with a letter.',
            'firstname.regex' => 'First Name can only have letters and space',
            'lastname.regex' => 'First Name can only have letters and space',
        ];
    }


    public function attributes(): array
    {
        return [
            'fullname' => 'Full Name',
            'username' => 'Username',
            'email' => 'Email Address',
            'password' => 'Password',
        ];
    }
}
