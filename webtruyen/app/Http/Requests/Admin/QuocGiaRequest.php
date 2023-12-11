<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QuocGiaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
                    'type' => 'required',
                    'location' => 'required',
                    'price' => 'required',
                    'description' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'tenquocgia' => 'required',
                    'mota' => 'required',
                ];
            }
        }
    }
}
