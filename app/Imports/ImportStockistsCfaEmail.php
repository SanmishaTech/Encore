<?php
namespace App\Imports;
use App\Models\Stockist;
use App\Models\Employee;
// use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportStockistsCfaEmail implements ToModel,WithHeadingRow,WithValidation, WithBatchInserts, WithChunkReading
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
        // $rbm = DB::table('employees')->where('employee_code', $row['zbm_employee_code'])->first();
        // $abm = DB::table('employees')->where('employee_code', $row['abm_employee_code'])->first();
        // $me = DB::table('employees')->where('employee_code', $row['mehq_employee_code'])->first();
        // print_r($me);exit;

        $stockists= Stockist::where('stockist', $row['stockist'])->get();
       
        
        if(!$stockists)
        {
            echo "<pre>";
                echo "No stockist found for: " . $row['stockist'] . "<hr/>";
                echo "</pre>";
                exit;
        }else{
            foreach($stockists as $stockist){
                $stockist->cfa_email = $row['cfa_email'];
                $stockist->save();
            }
        }
       
        // if(!$rbm || !$abm || !$me) {
        //     echo "<pre>";
        //     echo "RBM <br />"; print_r($rbm); echo "<hr/>";
        //     echo "ABM <br />"; print_r($abm); echo "<hr/>";
        //     echo "ME <br />"; print_r($me); echo "<hr/>";
        //     // echo "Data <br />"; print_r($row);
        //     echo "</pre>";
        //     // exit;
        // }else{
        //     return new Stockist([
        //         'stockist' => $row['stockist'],
        //         'employee_id_1' => $rbm->id ?? null,
        //         'employee_id_2' => $abm->id ?? null,
        //         'employee_id_3' => $me->id ?? null,
        //     ]);
        // }
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
