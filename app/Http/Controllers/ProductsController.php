<?php
namespace App\Http\Controllers;
use Excel;
use App\Imports\ImportProducts;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(12);
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request) 
    {
        $input = $request->all();      
        $product = Product::create($input); 
        $request->session()->flash('success', 'Product saved successfully!');
        return redirect()->route('products.index'); 
    }
  
    public function show(Product $product)
    {
        return $product->nrv;
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, ProductRequest $request) 
    {
        $product->update($request->all());
        $request->session()->flash('success', 'Product updated successfully!');
        return redirect()->route('products.index');
    }
  
    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        $request->session()->flash('success', 'Product deleted successfully!');
        return redirect()->route('products.index');
    }

    public function import()
    {
        return view('products.import');
    }

    public function importProductExcel(Request $request)
    {      
        try {
            Excel::import(new ImportProducts, $request->file);
            $request->session()->flash('success', 'Excel imported successfully!');
            return redirect()->route('products.index');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    } 

    public function search(Request $request){
        $data = $request->input('search');
        $products = Product::where('name', 'like', "%$data%")->paginate(12);
        // $employees = Employee::with(['users'])->orderBy('id', 'desc')->paginate(12);

        return view('products.index', ['products'=>$products]);
    }

}
