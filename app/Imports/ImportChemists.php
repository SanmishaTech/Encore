<?php
namespace App\Imports;
use App\Models\Chemist;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class ImportChemists implements ToModel,WithHeadingRow,WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function rules(): array
    {
        return [
            'chemist' => 'unique:chemists,chemist',
            'address' => 'unique:chemists,address',
            'contact_no_1' => 'unique:chemists,contact_no_1',
            'email' => 'unique:chemists,email'
        ];
    }
    public function customValidationMessages()
    {
        return [
            'chemist.unique' => 'Chemists Already Exist',
            'address.unique' => 'Address Already Exist',
            'contact_no_1.unique' => 'Contact no Already Exist',
            'email.unique' => 'Email Already Exist',
        ];
    }
    public function model(array $row)
    {
        $employee = DB::table('employees')->where('name', $row['employee_name'])->first();
        return new Chemist([
            'chemist' => $row['chemist'],
            'address' => $row['address'],
            'contact_person' => $row['contact_person'],
            'contact_no_1' => $row['contact_no_1'],
            'contact_no_2' => $row['contact_no_2'],
            'email' => $row['email'],
            'employee_id' => isset($employee->id) ? $employee->id : NULL,
            'territory_id' => $row['territory_id'],
        ]);

    }
}
