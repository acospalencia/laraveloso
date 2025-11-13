<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json(
            ['data' => $products,
            'message' => 'Products retrieved successfully.',
            'status' => 200
        ], 200 );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json(
            ['data' => $product,
                'message' => 'Product created succesfully',
                'status' => 201
            ], 201 );
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $Id)
    {
        try {
            
            $product = Product::findOrFail($Id);

            $product->update($request->all());
            return response()->json([
                'data' => $product,
                'message' => 'Product updated successfully',
                'status' => 200 
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating product',
                'error' => $e->getMessage(),
                'status' => 500 
            ]. 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
