<?php
namespace App\Imports;
use App\Models\Doctor;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class ImportDoctors implements ToModel,WithHeadingRow,WithValidation
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
            // 'doctor_name' => 'unique:doctors,doctor_name',
            // 'hospital_name' => 'unique:doctors,hospital_name',
            // 'contact_no_1' => 'unique:doctors,contact_no_1',
            // 'email' => 'unique:doctors,email',
        ];
    }
    public function customValidationMessages()
    {
        return [
            // 'doctor_name.unique' => 'Doctor name Already Exist',
            // 'hospital_name.unique' => 'Hospital name Already Exist',
            // 'contact_no_1.unique' => 'Contact No Already Exist',
            // 'email.unique' => 'Email Code Already Exist',
        ];
    }
    public function model(array $row)
    {
        $employee = DB::table('employees')->where('employee_code', $row['reporting_office_1'])->first();
        $territory = DB::table('territories')->where('name', $row['territory_id'])->first();        
        $category = DB::table('categories')->where('name', $row['category_id'])->first();
        
        $qualification = DB::table('qualifications')->where('name', $row['qualification_id'])->first();
        return new Doctor([
            'doctor_name' => $row['doctor_name'],
            'doctor_address' => $row['doctor_address'],
            'hospital_name' => $row['hospital_name'],
            'hospital_address' => $row['hospital_address'],
            'contact_no_1' => $row['contact_no_1'],
            'contact_no_2' => $row['contact_no_2'],
            'email' => $row['email'],
            'state' => $row['state'],
            'city' => $row['city'],
            'speciality' => $row['speciality'],
            'designation' => $row['designation'],
            'hq' => $row['hq'],
            'type' => $row['type'],
            'mpl_no' => $row['mpl_no'],
            'territory_id' => $territory->id ?? null,
            'category_id' => $category->id ?? null,
            'qualification_id' => $qualification->id ?? null,
            'reporting_office_1' => $employee->reporting_office_1,
            'reporting_office_2' => $employee->reporting_office_2,
            'reporting_office_3' => $employee->id,
        ]);

    }
}
