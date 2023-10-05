<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockistRequest extends FormRequest
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
            'stockist' => 'required|unique:stockists,stockist',
            'employee_id_1' => 'required',
            'employee_id_2' => 'required',
            'employee_id_3' => 'required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'stockist.required' => 'Stockist name is required',
            'employee_id_1.required' => 'RBM/ZBM  is required',
            'employee_id_2.required' => 'ABM is required',
            'employee_id_3.required' => 'ME HQ is required',
        ];
    }
}
