<?php
namespace App\Imports;
use App\Models\Activity;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class ImportActivities implements ToModel,WithHeadingRow,WithValidation
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
            'name' => 'unique:activities,name'
        ];
    }
    public function customValidationMessages()
    {
        return [
            'name.unique' => 'Activities Already Exist',
        ];
    }
    public function model(array $row)
    {
        return new Activity([
            'name' => $row['name'],
        ]);
    }
}
