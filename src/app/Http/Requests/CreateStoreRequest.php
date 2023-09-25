<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'db_store_number' => 'unique:stores',
            'db_store_name' => 'required',
            'db_store_phone' => 'required|unique:stores',
            'db_account_password' => ['required', 'min:6', 'max:10', 'regex:/^[A-Za-z0-9$.\-_]+$/'],
            'db_store_email' => 'required|unique:stores',
            'db_store_address' => 'required',
        ];
    }
}