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

class ImportEmployees implements ToModel,WithHeadingRow,WithValidation
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
            'name' => 'unique:employees,name',
            'email' => 'unique:employees,email',
            'contact_no_1' => 'unique:employees,contact_no_1',
            'employee_code' => 'unique:employees,employee_code',
        ];
    }
    public function customValidationMessages()
    {
        return [
            'name.unique' => 'Employees Already Exist',
            'email.unique' => 'Email Already Exist',
            'contact_no_1.unique' => 'Contact No Already Exist',
            'employee_code.unique' => 'Employee Code Already Exist',
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
        
        $data = DB::table('users')->where('name', $row['name'])->first();

        $employee = new Employee([
            'id' => isset($data->id) ? $data->id : NULL,
            'name' => $row['name'],
            'email' => $row['email'],
            'contact_no_1' => $row['contact_no_1'],
            'contact_no_2' => $row['contact_no_2'],
            'address' => $row['address'],
            'designation' => $row['designation'],
            'state_name' => $row['state_name'],
            'city' => $row['city'],
            'fieldforce_name' => $row['fieldforce_name'],
            'employee_code' => $row['employee_code'],
            'reporting_office_1' => $row['reporting_office_1'],
            'reporting_office_2' => $row['reporting_office_2'],
            'reporting_office_3' => $row['reporting_office_3'],
        ]);

        return [$employee, $user, $user->syncRoles($row['designation'])];
    }
}
