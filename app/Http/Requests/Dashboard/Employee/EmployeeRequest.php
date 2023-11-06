<?php

namespace App\Http\Requests\Dashboard\Employee;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class EmployeeRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {

        $rules = [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:employees,email',
            'phone' => 'required|numeric|unique:employees,phone',
            'password' => ['required', 'confirmed','regex:/^(?=.*[A-Za-z])(?=.*\d)/' ,Password::min(4)],
            'active' => 'nullable',
            'role' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'department_id' => 'required|exists:departments,id',
            'salary' => 'required|numeric',


        ];
        if (str_contains(url()->current(), request()->route('id'))) {

            $rules['first_name'] = 'required|string|max:100';
            $rules['last_name'] = 'required|string|max:100';
            $rules['password'] = ['nullable', 'confirmed','regex:/^(?=.*[A-Za-z])(?=.*\d)/', Password::min(4)];
            $rules['email'] = 'required|email|max:255|unique:employees,email,' . request()->route('employee');
            $rules['phone'] = 'required|numeric|unique:employees,phone,' . request()->route('employee');

        }
        return $rules;
    }
}
