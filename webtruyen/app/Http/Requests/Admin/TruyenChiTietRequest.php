<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TruyenChiTietRequest extends FormRequest
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
        switch($this->method()){
            case 'POST':{
                return [
                    'truyen_id' =>'required',
                    'chuong' =>'required'
                ];
            }
            case 'PUT':
            case 'PATCH':{
                return [
                    'truyen_id' =>'required',
                    'chuong' =>'required'
                ];
            }
        }
    }
}
