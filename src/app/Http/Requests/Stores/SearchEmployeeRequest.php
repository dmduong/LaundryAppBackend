<?php

namespace App\Http\Requests\Stores;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchEmployeeRequest extends FormRequest
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
            'db_employee_name' => ['nullable', 'string', 'max:255'],
            'order_by' => ['nullable', 'array', Rule::in(['id', 'db_store_id', 'db_employee_number'])],
            'sort' => ['nullable', 'string', Rule::in(['desc', 'asc'])],
            'limit' => ['nullable', 'integer'],
            'page' => ['nullable', 'integer'],
        ];
    }
}