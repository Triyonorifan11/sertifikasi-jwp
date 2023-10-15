<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
class UpdateProductRequest extends FormRequest
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
            //
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|numeric',
            'product_code' => 'required|unique:products,product_code,' . Hashids::decode($this->product->id)[0],
        ];
    }
}
