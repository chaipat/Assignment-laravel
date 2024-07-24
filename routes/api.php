<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\Api\ParentCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('/category', CategoryController::class);
Route::apiResource('/parentcategory', ParentCategoryController::class);

