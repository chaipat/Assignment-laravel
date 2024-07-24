<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::all();
        // return response()->json($categories);
        $categories = Category::whereNull('parent_id')->orWhere('parent_id', 0)->get();
        // $categories = Category::with('subCategories')->whereNull('parent_id')->orWhere('parent_id', 0)->get();

        // Format the response
        $response = $categories->map(function ($category) {
            return [
                'category_id' => $category->category_id,
                'category_name' => $category->category_name,
                'sub_category' => $category->subCategories->map(function ($subCategory) {
                    return [
                        'category_id' => $subCategory->category_id,
                        'category_name' => $subCategory->category_name,
                        'parent_id' => $subCategory->parent_id,
                    ];
                }),
            ];
        });

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'required|string',
            'parent_id' => 'nullable|integer',
        ]);

        $category = category::insert($validateData);
        $data = category::orderBy('category_id', 'desc')->limit(1)->get();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // DB::enableQueryLog();

        $categories = Category::where('category_id', $id)->get();

        return response()->json($categories);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoryId)
    {
        $deletedRows = Category::where('category_id', $categoryId)->delete();

        if ($deletedRows) {
            return response()->json(['message' => 'Category deleted successfully.']);
        } else {
            return response()->json(['message' => 'Category not found.'], 404);
        }
    }
}
