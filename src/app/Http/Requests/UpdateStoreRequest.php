<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
            'db_store_name' => 'required|max:255|string',
            'db_store_phone' => 'required|max:11|unique:stores,db_store_phone,' . $this->user()->db_store_id,
            'db_store_address' => 'required|max:255',
            'db_store_email' => 'required|max:255|unique:stores,db_store_email,' . $this->user()->db_store_id,
        ];
    }
}