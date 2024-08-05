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
        $stockists = Stockist::where('stockist', $row['stockist'])->get();

        if($stockists) {
            foreach($stockists as $stockist){
                $stockist->cfa_email = $row['cfa_email'];
                $stockist->save();
            }

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
