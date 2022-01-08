<?php

namespace App\Http\Controllers;

use App\Http\Resources\SitecontactResource;
use Exception;
use App\Models\Sitecontact;
use Illuminate\Http\Request;

class SitecontactController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api")->only("update");
    }

    /**
     *  GET api/sitecontacts
     *  to get all sitecontacts
     */
    public function index()
    {
        try {
            $sitecontacts = Sitecontact::all();
            return response()->json([
                "success" => true,
                "data" => SitecontactResource::collection($sitecontacts),
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  PUT/PATCH api/sitecontacts/{sitecontact}
     *  to update a sitecontact
     */
    public function update(Request $request, Sitecontact $sitecontact)
    {
        try {
            $sitecontact->email = $request->email;
            $sitecontact->phone = $request->phone;
            $sitecontact->address = $request->address;
            $sitecontact->open_time = $request->open_time;
            $sitecontact->update();
            return response()->json([
                "success" => true,
                "data" => $sitecontact,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
