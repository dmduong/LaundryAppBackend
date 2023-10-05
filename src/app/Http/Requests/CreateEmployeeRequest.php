<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
            'db_employee_name' => 'required|max:50',
            'db_employee_gender' => 'nullable|integer',
            'db_employee_birthday' => 'nullable|date_format:' . config("custom.dateFormat"),
            'db_employee_phone' => 'required|unique:employees|max:12',
            'db_employee_image' => 'nullable',
            'db_employee_email' => 'nullable|unique:employees',
            'db_employee_address' => 'required',
            'db_account_name' => 'required|unique:accounts|max:50',
            'db_account_password' => ['required', 'min:6', 'max:10', 'regex:/^[A-Za-z0-9$.\-_]+$/'],
        ];
    }
}