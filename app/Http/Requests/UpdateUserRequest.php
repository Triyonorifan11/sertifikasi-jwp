<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Vinkla\Hashids\Facades\Hashids;
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
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
            // 'username' => 'required|string|max:30|unique:users,username,' . Hashids::decode($this->user->id)[0],
            // 'email' => 'required|string|max:30|unique:users,email,' . Hashids::decode($this->user->id)[0],
            'username' => 'required|string|max:30|unique:users,username,' . $this->user->id,
            'email' => 'required|string|max:30|unique:users,email,' . $this->user->id,

            'password' => 'nullable|string|max:30',
            'active' => 'required|string',
            'role_id' => 'required'
        ];
    }
}
