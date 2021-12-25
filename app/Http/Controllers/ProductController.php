<?php

namespace App\Http\Controllers;

use Exception;
use App\Traits\Base64;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Base64;
    public function __construct()
    {
        $this->middleware("auth:api")->only("store", "update");
    }

    /**
     *  GET api/products
     *  to get all products
     */
    public function index()
    {
        try {
            $products = product::all();
            return response()->json([
                "success" => true,
                "data" => $products,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  POST api/products
     *  to create a new product
     */
    public function store(Request $request)
    {
        try {
            $image = $this->uploadBase64($request->image, "add", null);

            $product = new Product();
            $product->name = $request->name;
            $product->image = $image;
            $product->save();
            return response()->json([
                "success" => true,
                "data" => $product,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  GET api/products/{product}
     *  to show a product
     */
    public function show(Product $product, Request $request)
    {
        try {
            return response()->json([
                "success" => true,
                "data" => $product,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  PUT/PATCH api/products/{product}
     *  to update a product
     */
    public function update(Request $request, Product $product)
    {
        try {
            $exitedImage = Product::findOrFail($request->id)->image;
            if ($exitedImage) {
                $image = $this->uploadBase64(
                    $request->image,
                    "update",
                    $exitedImage
                );
                $product->image = $image;
            }

            $product->name = $request->name;
            $product->update();
            return response()->json([
                "success" => true,
                "data" => $product,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * DELETE api/products/{product}
     * to delete a product
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json([
                "success" => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
