<?php

namespace App\Imports;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class ImportUsers implements ToModel,WithHeadingRow,WithValidation
{
    use Importable;
    
    public function rules(): array
    {
        return [
            // 'name' => 'unique:employees,name',
        ];
    }
    public function customValidationMessages()
    {
        return [
            // 'name.unique' => 'Employees Already Exist',
        ];
    }
    public function model(array $row)
    {
        $user = new User([
            'name' => $row['name'],
            'password' => 'abcd123',
            'active' => '1',
            'email' => $row['email'],
        ]);

        return [$user,$user->syncRoles($row['designation'])];
    }
}
