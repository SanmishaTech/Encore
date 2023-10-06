<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChemistRequest extends FormRequest
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
            'chemist' => 'required|unique:chemists,chemist,'. ($this->chemist ? $this->chemist->id : ''),
           
        ];
    }
    
    public function messages(): array
    {
        return [
            'chemist.required' => 'Chemist name is required',
            'chemist.unique' => 'The Chemist name has already been taken.',
        ];
    }
}
