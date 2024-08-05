<?php
namespace App\Imports;
use App\Models\Chemist;
use App\Models\Employee;
use App\Models\Territory;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportChemists implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
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
            // 'chemist' => 'unique:chemists,chemist',
        ];
    }
    public function customValidationMessages()
    {
        return [
            // 'chemist.unique' => 'Chemists Already Exist',
        ];
    }

    public function model(array $row)
    {
        // $employee = DB::table('employees')->where('name', $row['employee_name'])->first();
        $employee = DB::table('employees')->where('employee_code', $row['employee_code'])->first();
        $territory = DB::table('territories')->where('name', $row['territory'])->first();

        if(!$territory){
            $territory = new Territory();
            $territory->name = $row['territory'];
            $territory->save();
        }

        if(!$employee || !$territory) {
            echo "<pre>";
            echo "Employee <br />"; print_r($employee); echo "<hr/>";
             echo "Territory <br />"; print_r($territory); echo "<hr/>";
            // echo "Data <br />"; print_r($row);
            echo "</pre>";
            // exit;
        } else {
            return new Chemist([
                'chemist' => $row['chemist'],
                'address' => $row['address'],
                'contact_person' => $row['contact_person'],
                'contact_no_1' => $row['contact_no_1'],
                'contact_no_2' => $row['contact_no_2'],
                'email' => $row['email'],
                'employee_id' => isset($employee->id) ? $employee->id : NULL,
                'territory_id' => isset($territory->id) ? $territory->id : NULL,
                'class' => $row['class'],
            ]);
        }
    }

    public function batchSize(): int
    {
        return 500;
    }    

    public function chunkSize(): int
    {
        return 500;
    }  
}
