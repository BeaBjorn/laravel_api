<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required', 
            'units' => 'required',
            'image' => 'required'
        ]);

        return Product::create($request->all());
    }

    
    public function addProduct(Request $request, $id){
        $category = Category::find($id);

        if($category == null){
            return response()->json([
                'Category not found!'
            ], 404);
        }

        /*
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required', 
            'units' => 'required',
            'image' => 'required'
        ]);
        */

        $product = new Product();
        $product->product = $request->product;
        $category->products()->save($product);

        return response()->json([
            'Product added to category'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if($product != null){
            return $product;
        }else{
            return response()->json([
                'Product not found!'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($product != null){
            $product->update($request->all());
            return $product;
        }else{
            return response()->json([
                'Product not found!'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product != null){
            $product->delete();
            return response()->json([
                'Product deleted!'
            ]);
        }else{
            return response()->json([
                'Product not found!'
            ], 404);
        }
    }

    public function searchProduct($name){
        return Product::where('name', 'like', '%' . $name . '%')->get();
    }
}
