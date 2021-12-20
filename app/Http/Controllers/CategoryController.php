<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api")->only("store", "update");
    }

    /**
     *  GET api/categories
     *  to get all categories
     */
    public function index()
    {
        try {
            $categories = Category::all();
            return response()->json([
                "success" => true,
                "data" => $categories,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  POST api/categories
     *  to create a new category
     */
    public function store(Request $request)
    {
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->is_popular = $request->is_popular;
            $category->save();
            return response()->json([
                "success" => true,
                "data" => $category,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  GET api/categories/{category}
     *  to show a category
     */
    public function show(Category $category, Request $request)
    {
        try {
            return response()->json([
                "success" => true,
                "data" => $category,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  PUT/PATCH api/categories/{category}
     *  to update a category
     */
    public function update(Request $request, Category $category)
    {
        try {
            $category->name = $request->name;
            $category->is_popular = $request->is_popular;
            $category->update();
            return response()->json([
                "success" => true,
                "data" => $category,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * DELETE api/categories/{category}
     * to delete a category
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json([
                "success" => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
