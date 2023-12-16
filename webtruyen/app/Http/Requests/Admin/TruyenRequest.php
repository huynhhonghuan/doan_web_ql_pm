<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TruyenRequest extends FormRequest
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
                        'tentruyen' => 'required',
                        'mota' => 'nullable',
                        'theloai_id' => 'required',
                        'tacgia_id' => 'required',
                        'quocgia_id' => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'tentruyen' => 'required',
                        'mota' => 'nullable',
                        'theloai_id' => 'required',
                        'tacgia_id' => 'required',
                        'quocgia_id' => 'required',
                    ];
                }
        }
    }
}
