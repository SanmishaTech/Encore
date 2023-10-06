<?php

namespace App\Http\Requests;
use App\Models\Stockist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockistRequest extends FormRequest
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
            // 'stockist' => 'required|unique:stockists,stockist'. ($this->stockist ? $this->stockist->id : ''),
            'stockist' => ['required', Rule::unique('stockists')->ignore($this->stockist)],
        ];
    }
    
    public function messages(): array
    {
        return [
            'stockist.required' => 'Stockist name is required',
        ];
    }
}
