<?php

namespace App\Http\Controllers;
use Excel;
use App\Models\Employee;
use App\Models\Stockist;
use Illuminate\Http\Request;
use App\Imports\ImportStockists;
use App\Http\Requests\StockistRequest;
use App\Imports\ImportStockistsCfaEmail;
use App\Http\Requests\UpdateStockistRequest;


class StockistsController extends Controller
{
    public function index(Request $request)
    {
        // $search_stockist = $request->input('search');

        // if ($request->input('search')) {
        //     $stockists = Stockist::with(['ZonalManager', 'AreaManager', 'Manager'])
        //                         ->orderBy('id', 'desc')
        //                         ->where('stockist', 'LIKE' , '%'.$search_stockist.'%' )
        //                         ->orWhere('employee_id_1', 'LIKE' , '%'.$search_stockist.'%' )
        //                         ->paginate(12);
        // } else {
            $stockists = Stockist::with(['ZonalManager', 'AreaManager', 'Manager'])
                                ->orderBy('id', 'desc')
                                ->paginate(12);
        // }

        return view('stockists.index', ['stockists' => $stockists]);
    }

    public function create()
    {
        $employees = Employee::select('id','name','designation')->get();
        return view('stockists.create')->with(['employees'=>$employees]);
    }

    public function store(Stockist $stockist, StockistRequest $request)
    {
        $input = $request->all();
        $stockist = Stockist::create($input);
        $request->session()->flash('success', 'Stockist saved successfully!');
        return redirect()->route('stockists.index');
    }

    public function show(Stockist $stockist)
    {
        return $stockist;
    }

    public function edit(Stockist $stockist)
    {
        // dd($stockist);
        $employees = Employee::select('id','name','designation')->get();

        return view('stockists.edit', ['stockist' => $stockist, 'employees'=>$employees]);
    }

    public function update(Stockist $stockist, UpdateStockistRequest $request)
    {
        // dd($request);
        $stockist->update($request->all());
        $request->session()->flash('success', 'Stockist updated successfully!');
        return redirect()->route('stockists.index');
    }

    public function destroy(Request $request, Stockist $stockist)
    {
        $stockist->delete();
        $request->session()->flash('success', 'Stockist deleted successfully!');
        return redirect()->route('stockists.index');
    }

    public function import()
    {
        return view('stockists.import');
    }

    // public function importStockistsExcel(Request $request)
    // {
    //     try {
    //         Excel::import(new ImportStockists, $request->file);
    //         $request->session()->flash('success', 'Excel imported successfully!');
    //         return redirect()->route('stockists.index');
    //     } catch (\Throwable $e) {
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }

    public function importStockistsExcel(Request $request)
    {
        try {
            Excel::import(new ImportStockists, $request->file);
            $request->session()->flash('success', 'Excel imported successfully!');
            return redirect()->route('stockists.index');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function search(Request $request){
        $data = $request->input('search');
        $stockists = Stockist::with(['ZonalManager', 'AreaManager', 'Manager'])->where('stockist', 'like', "%$data%")->paginate(12);
        return view('stockists.index', ['stockists'=>$stockists]);
    }

}
