<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'order_by' => ['nullable', 'array', Rule::in(['id', 'db_store_number', 'db_store_name', 'created_at'])],
            'sort' => ['nullable', 'string', Rule::in(['desc', 'asc'])],
            'page' => ['nullable', 'integer'],
            'limit' => ['nullable', 'integer'],
        ];
    }
}