<?php
namespace App\Imports;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class ImportProducts implements ToModel,WithHeadingRow,WithValidation
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
            // 'name' => 'unique:products,name',
            // 'nrv' => 'unique:products,nrv|numeric',
        ];
    }
    public function customValidationMessages()
    {
        return [
            // 'name.unique' => 'Products Already Exist',
            // 'nrv.unique' => 'Nrv Already Exist',
        ];
    }
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'nrv' => $row['nrv'],
        ]);
    }
}
