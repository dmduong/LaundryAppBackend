<?php

namespace App\Http\Requests\RolePermission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchPermissionRequest extends FormRequest
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
            'name' => 'nullable|max:100|string',
            'page' => ['nullable', 'integer'],
            'limit' => ['nullable', 'integer'],
            'sort' => ['nullable', 'string', Rule::in(['desc', 'asc'])],
            'order_by' => ['nullable', 'array', Rule::in(['id', 'name', 'created_at'])]
        ];
    }
}