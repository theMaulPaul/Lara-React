<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews, 200);
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
        $review = new Review();
        $review->product_id = $request->product_id ? $request->product_id : 0;
        $review->name = $request->name ? $request->name : 'Anonymous';
        $request->message = $request->message ? $request->message : '';
        $review->message = $request->message ? $request->message : 'No rating given';
        $review->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::find($id);
        if(!empty($review)) {
            return response()->json($review, 200);
        } else {
            return response()->json(['message' => 'Review not found'], 404);
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
        $review = Review::find($id);
        if(!empty($review)) {
            $review->product_id = $request->product_id ? $request->product_id : 0;
            $review->name = $request->name ? $request->name : 'Anonymous';
            $request->message = $request->message ? $request->message : '';
            $review->message = $request->message ? $request->message : 'No rating given';
            $review->save();
            return response()->json([
                'message' => 'Review updated successfully',
            ], 200);
        } else {
            return response()->json(['message' => 'Review not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Review::where('id', $id)->exists()) {
            Review::where('id', $id)->delete();
            return response()->json([
                'message' => 'Review deleted successfully',
            ], 200);
        } else {
            return response()->json(['message' => 'Review not found'], 404);
        }
    }
}