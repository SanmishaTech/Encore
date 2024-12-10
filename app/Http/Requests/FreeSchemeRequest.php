<?php

namespace App\Http\Requests;
use App\Models\Doctor;
use App\Models\Chemist;
use App\Models\Employee;
use App\Models\Stockist;
use App\Models\FreeScheme;
use App\Models\FreeSchemeDetail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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


      /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        // Store free_scheme_details in the session
        session()->flash('free_scheme_details', $this->input('free_scheme_details', []));
        //  dd(session('free_scheme_details'));
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
    
}