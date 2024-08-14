<?php

namespace App\Http\Requests;
use App\Models\Employee;
use App\Models\FreeSchemeDetail;
use App\Models\Doctor;
use App\Models\Stockist;
use App\Models\Chemist;
use App\Models\FreeScheme;
use Illuminate\Foundation\Http\FormRequest;

class FreeSchemeRequest extends FormRequest
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
            'doctor_id' => 'required',   
            'free_scheme_type' => 'required',
            'proposal_date' => 'required',
            'stockist_id' => 'required',
            'chemist_id' => 'required',
            'scheme' => 'required',
        ];
    }
}