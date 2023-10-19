<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:30|',
            'username' => 'required|string|max:30|unique:users,username',
            'email' => 'required|string|max:30|unique:users,email',
            'password' => 'required|string|max:30|',
            'active' => 'required|numeric',
            'role_id' => 'required'
        ];
    }
}
