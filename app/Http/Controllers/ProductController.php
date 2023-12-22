<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
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
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->country = $request->country;
        $product->year = $request->year;
        $product->type = $request->type;
        $product->description = $request->description;
        $product->characteristics = $request->characteristics;
        $product->price = $request->price;
        $product->img_url = $request->img_url;
        $product->img_url1 = $request->img_url1;
        $product->img_url2 = $request->img_url2;
        $product->availability = $request->availability;
        $product->save();

        return response()->json([
            'message' => 'Product created successfully',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if(!empty($product)) {
            return response()->json($product, 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if(!empty($product)) {
            $product->name = $request->name ? $request->name : "";
            $product->country = $request->country ? $request->country : "";
            $product->year = $request->year ? $request->year : "";
            $product->type = $request->type ? $request->type : "";
            $product->description = $request->description ? $request->description : "";
            $product->characteristics = $request->characteristics ? $request->characteristics : "";
            $product->price = $request->price ? $request->price : "";
            $product->img_url = $request->img_url ? $request->img_url : "";
            $product->img_url1 = $request->img_url1 ? $request->img_url1 : "";
            $product->img_url2 = $request->img_url2 ? $request->img_url2 : "";
            $product->availability = $request->availability ? $request->availability : "";
            $product->save();
            return response()->json([
                'message' => 'Product updated successfully',
            ], 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(!empty($product)) {
            $product->delete();
            return response()->json([
                'message' => 'Product deleted successfully',
            ], 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function getRecommended(Request $request)
    {
        $categoryId = $request->input('category');
        $limit = $request->input('limit', 5);
        $recommendedProducts = DB::table('products')
         ->where('category_id', $categoryId)
         ->limit($limit)
         ->get();

        return response()->json($recommendedProducts, 200);
    }
}