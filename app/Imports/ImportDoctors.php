<?php
namespace App\Imports;
use App\Models\Doctor;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Territory;
use App\Models\Qualification;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportDoctors implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
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
        // print_r($row); exit;
        $employee = DB::table('employees')->where('employee_code', $row['mehq_employee_code'])->first();
        $territory = DB::table('territories')->where('name', $row['territory_id'])->first();
        $category = DB::table('categories')->where('name', $row['category_id'])->first();
        $qualification = DB::table('qualifications')->where('name', $row['qualification_id'])->first();

        if(!$territory){
            $territory = new Territory();
            $territory->name = $row['territory_id'];
            $territory->save();
        }

        if(!$category){
            $category = new Category();
            $category->name = $row['category_id'];
            $category->save();
        }


        if(!$qualification){
            $qualification = new Qualification();
            $qualification->name = $row['qualification_id'];
            $qualification->save();
        }

        if(!$employee || !$territory || !$category || !$qualification) {
            echo "<pre>";
            echo "Employee <br />"; print_r($row['mehq_employee_code']); echo "<hr/>";
            echo "Territory <br />"; print_r($row['territory_id']); echo "<hr/>";
            echo "Category <br />"; print_r($row['category_id']); echo "<hr/>";
            echo "Qualification <br />"; print_r($row['qualification_id']); echo "<hr/>";
            // echo "Data <br />"; print_r($row);
            echo "</pre>";
            exit;
        }else{
            return new Doctor([
                'doctor_name' => $row['doctor_name'],
                'doctor_address' => $row['doctor_address'],
                'hospital_name' => $row['hospital_name'],
                'hospital_address' => substr($row['hospital_address'], 0, 250),
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
                'reporting_office_1' => $employee->reporting_office_1 ?? null,
                'reporting_office_2' => $employee->reporting_office_2 ?? null,
                'reporting_office_3' => $employee->id,
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