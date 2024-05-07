<?php
namespace App\Imports;
use App\Models\Stockist;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class ImportStockists implements ToModel,WithHeadingRow,WithValidation
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
            // 'stockist' => 'unique:stockists,stockist'
        ];
    }
    public function customValidationMessages()
    {
        return [
            // 'stockist.unique' => 'Stockists Already Exist',
        ];
    }
    public function model(array $row)
    {
        $rbm = DB::table('employees')->where('name', $row['zbm_employee_code'])->first();
        $abm = DB::table('employees')->where('name', $row['abm_employee_code'])->first();
        $me = DB::table('employees')->where('employee_code', $row['mehq_employee_code'])->first();
        // print_r($me);exit;
        return new Stockist([
            'stockist' => $row['stockist'],
            'employee_id_1' => $rbm->id ?? null,
            'employee_id_2' => $abm->id ?? null,
            'employee_id_3' => $me->id ?? null,
        ]);

    }
}
