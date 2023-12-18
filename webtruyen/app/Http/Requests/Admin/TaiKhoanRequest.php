<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TaiKhoanRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name' => 'required',
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'sdt' => 'required',
                        'password' => 'required'
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required',
                        'email' => ['required', 'string', 'email', 'max:255'], // chưa bỏ qua email hiện tại từ request
                        'sdt' => 'required',
                    ];
                }
        }
    }
}
