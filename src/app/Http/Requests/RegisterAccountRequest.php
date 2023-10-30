<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAccountRequest extends FormRequest
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
            'db_store_name' => 'required|max:500',
            'db_store_address' => 'required|max:500',
            'db_employee_name' => 'required|max:50',
            'db_employee_phone' => 'required|max:11|unique:employees|regex:' . config('custom.phoneFormat'),
            'db_employee_email' => 'required|unique:employees',
            'db_employee_gender' => 'required|integer',
            'db_employee_birthday' => 'required|date_format:' . config('custom.dateFormat'),
            'db_account_name' => 'required|max:15|unique:accounts',
            'db_account_password' => ['required', 'min:6', 'max:10', 'regex:' . config('custom.passwordFormat')],
        ];
    }
}