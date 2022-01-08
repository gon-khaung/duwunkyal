<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use Exception;
use App\Traits\Base64;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\FeaturedCategoryResource;

class CategoryController extends Controller
{
    use Base64;
    public function __construct()
    {
        // $this->middleware("auth:api")->only("store", "update");
    }

    /**
     *  GET api/categories
     *  to get all categories
     */
    public function index(Request $request)
    {
        try {
            if ($request->is_featured) {
                $categories = FeaturedCategoryResource::collection(
                    Category::where("is_featured", true)
                        ->with("products")
                        ->get()
                );
            } else {
                $categories = CategoryResource::collection(Category::all());
            }
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
            $image = $this->uploadBase64($request->image, "add", null);

            $category = new Category();
            $category->name = $request->name;
            $category->image = $image;
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
            $exitedImage = Category::findOrFail($request->id)->image;
            if ($exitedImage) {
                $image = $this->uploadBase64(
                    $request->image,
                    "update",
                    $exitedImage
                );
                $category->image = $image;
            }

            $category->name = $request->name;
            $category->is_featured = $request->is_featured;
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
