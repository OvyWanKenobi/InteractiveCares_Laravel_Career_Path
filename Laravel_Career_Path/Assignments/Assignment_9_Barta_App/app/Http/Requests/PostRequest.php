<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'barta-post'
            => ['required'],
            'postimage' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:1024'],
        ];
    }


    public function messages()
    {
        return [

            'barta-post.required' => 'Post can not be empty',

        ];
    }

    public function attributes()
    {
        return [
            'barta-post' => 'Post',
            'postimage' => 'Post Image'
        ];
    }
}
