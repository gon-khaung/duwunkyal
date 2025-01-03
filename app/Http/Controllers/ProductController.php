<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminProductResource;
use App\Http\Resources\ProductResource;
use Exception;
use App\Traits\Base64;
use App\Models\Product;
use App\Traits\Query;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Base64;
    use Query;
    public function __construct()
    {
        $this->middleware("auth:api")->only("store", "update");
    }

    /**
     *  GET api/products
     *  to get all products
     */
    public function shopProducts(Request $request)
    {
        try {
            request()->validate([
                "page" => "required",
                "limit" => "required",
            ]);

            if (!$request->category_id) {
                $products = Product::orderBy("price", $request->type);

                $total = count(Product::all());
            } else {
                $products = Product::where(
                    "category_id",
                    $request->category_id
                )->orderBy("price", $request->type);

                $total = count(
                    Product::where("category_id", $request->category_id)->get()
                );
            }

            $offset = (intval($request->page) - 1) * intval($request->limit);

            $products = $products
                ->offset($offset)
                ->limit($request->limit)
                ->get();

            return response()->json([
                "success" => true,
                "data" => $products,
                "total" => $total,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  GET api/products
     *  to get all products
     */
    public function index(Request $request)
    {
        try {
            if ($request->category_id) {
                $products = Product::where("category_id", $request->category_id)
                    ->where("id", "!=", $request->current_product_id)
                    ->limit(5)
                    ->get();
            } elseif ($request->latest) {
                $products = Product::limit(6)
                    ->orderBy("created_at", "desc")
                    ->get();
            } elseif ($request->search) {
                $products = Product::where(
                    "name",
                    "like",
                    "%" . $request->search . "%"
                )->get();
            } else {
                $products = Product::latest();

                $total = count(Product::latest()->get());

                $offset =
                    (intval($request->page) - 1) * intval($request->limit);

                $products = $products
                    ->offset($offset)
                    ->limit($request->limit)
                    ->get();
                return response()->json([
                    "success" => true,
                    "data" => ProductResource::collection($products),
                    "total" => $total,
                ]);
            }

            return response()->json([
                "success" => true,
                "data" => ProductResource::collection($products),
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
            $product->description = $request->description;
            $product->price = $request->price;
            $product->image = $image;
            $product->category_id = $request->category_id;
            $product->is_instock = $request->is_instock;
            $product->is_featured = $request->is_featured;
            $product->wholesale_quantity = $request->wholesale_quantity;
            $product->wholesale_price = $request->wholesale_price;
            $product->sizes = $request->sizes;
            $product->colors = $request->colors;
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
                "data" => new ProductResource($product),
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
            $product->description = $request->description;
            $product->price = $request->price;
            $product->is_instock = $request->is_instock;
            $product->is_featured = $request->is_featured;
            $product->category_id = $request->category_id;
            $product->sizes = $request->sizes;
            $product->colors = $request->colors;
            $product->wholesale_quantity = $request->wholesale_quantity;
            $product->wholesale_price = $request->wholesale_price;
            $product->image = $image;
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
