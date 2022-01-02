<?php

namespace App\Http\Controllers;

use Exception;
use App\Traits\Base64;
use App\Models\Subproduct;
use Illuminate\Http\Request;

class SubproductController extends Controller
{
    use Base64;
    public function __construct()
    {
        // $this->middleware("auth:api")->only("store", "update");
    }

    /**
     *  GET api/subproducts
     *  to get all subproducts
     */
    public function index()
    {
        try {
            $subproducts = Subproduct::all();
            return response()->json([
                "success" => true,
                "data" => $subproducts,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  POST api/subproducts
     *  to create a new subproduct
     */
    public function store(Request $request)
    {
        try {
            // $image = $this->uploadBase64($request->image, "add", null);

            $subproduct = new Subproduct();
            $subproduct->size_id = $request->size_id;
            $subproduct->color_id = $request->color_id;
            $subproduct->product_id = $request->product_id;
            // $subproduct->image = $image;
            $subproduct->save();
            return response()->json([
                "success" => true,
                "data" => $subproduct,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  GET api/subproducts/{subproduct}
     *  to show a subproduct
     */
    public function show(Subproduct $subproduct, Request $request)
    {
        try {
            return response()->json([
                "success" => true,
                "data" => $subproduct,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  PUT/PATCH api/subproducts/{subproduct}
     *  to update a subproduct
     */
    public function update(Request $request, Subproduct $subproduct)
    {
        try {
            $exitedImage = Subproduct::findOrFail($request->id)->image;
            if ($exitedImage) {
                $image = $this->uploadBase64(
                    $request->image,
                    "update",
                    $exitedImage
                );
                $subproduct->image = $image;
            }

            $subproduct->size_id = $request->size_id;
            $subproduct->color_id = $request->color_id;
            $subproduct->update();
            return response()->json([
                "success" => true,
                "data" => $subproduct,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * DELETE api/subproducts/{subproduct}
     * to delete a subproduct
     */
    public function destroy(Subproduct $subproduct)
    {
        try {
            $subproduct->delete();
            return response()->json([
                "success" => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
