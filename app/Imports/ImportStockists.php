<?php
namespace App\Imports;
use App\Models\Stockist;
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
            'stockist' => 'unique:stockists,stockist'
        ];
    }
    public function customValidationMessages()
    {
        return [
            'stockist.unique' => 'Stockists Already Exist',
        ];
    }
    public function model(array $row)
    {
        return new Stockist([
            'stockist' => $row['stockist'],
            'employee_id_1' => $row['employee_id_1'],
            'employee_id_2' => $row['employee_id_2'],
            'employee_id_3' => $row['employee_id_3'],
        ]);

    }
}
