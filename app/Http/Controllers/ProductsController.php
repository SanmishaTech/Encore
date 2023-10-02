<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request) 
    {
        $input = $request->all();      
        $product = Product::create($input); 
        $request->session()->flash('success', 'Product saved successfully!');
        return redirect()->route('products.index'); 
    }
  
    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, UpdateProductRequest $request) 
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
}
