<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TheLoaiRequest extends FormRequest
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
        switch($this->method()) {
            case 'POST' : {
                return [
                    'tentheloai' => 'required',
                    'mota' => 'required',
                    'khoa' => 'int',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'tentheloai' => 'required',
                    'mota' => 'required',
                    'khoa' => 'int',
                ];
            }
        }
    }
}
