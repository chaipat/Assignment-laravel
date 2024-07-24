<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParentCategory;
use App\Models\category;
use Illuminate\Http\Request;

class ParentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show($parentid)
    {

        $subcategories = Category::where('parent_id', $parentid)->get();

        return response()->json($subcategories);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParentCategory $parentCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParentCategory $parentCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParentCategory $parentCategory)
    {
        //
    }
}
