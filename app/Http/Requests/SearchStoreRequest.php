<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchStoreRequest extends FormRequest
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
            'db_store_number' => 'nullable|max:100',
            'db_store_name' => 'nullable',
            'db_store_phone' => 'nullable|max:11',
            'db_store_address' => 'nullable|max:255',
        ];
    }
}