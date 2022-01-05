<?php

namespace App\Http\Controllers;

use App\Models\DynamicName;
use Exception;
use Illuminate\Http\Request;

class DynamicNameController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:api")->only("store", "update");
    }

    /**
     *  GET api/dynamicnames
     *  to get all dynamicnames
     */
    public function index(Request $request)
    {
        try {
            $data = DynamicName::where('type', $request->name)->get();
            return response()->json([
                "success" => true,
                "data" => $data,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  POST api/dynamicnames
     *  to create a new dynamicname
     */
    public function store(Request $request)
    {
        try {
            // $image = $this->uploadBase64($request->image, "add", null);

            $dynamicname = new Dynamicname();
            $dynamicname->name = $request->name;
            $dynamicname->type = $request->type;
            $dynamicname->save();
            return response()->json([
                "success" => true,
                "data" => $dynamicname,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  GET api/dynamicnames/{dynamicname}
     *  to show a dynamicname
     */
    public function show(Dynamicname $dynamicname, Request $request)
    {
        try {
            return response()->json([
                "success" => true,
                "data" => $dynamicname,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  PUT/PATCH api/dynamicnames/{dynamicname}
     *  to update a dynamicname
     */
    public function update(Request $request, Dynamicname $dynamicname)
    {
        try {

            $dynamicname->name = $request->name;
            $dynamicname->type = $request->type;
            $dynamicname->update();
            return response()->json([
                "success" => true,
                "data" => $dynamicname,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * DELETE api/dynamicnames/{dynamicname}
     * to delete a dynamicname
     */
    public function destroy(Dynamicname $dynamicname)
    {
        try {
            $dynamicname->delete();
            return response()->json([
                "success" => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
