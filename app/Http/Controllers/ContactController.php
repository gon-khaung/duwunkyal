<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use Exception;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api")->only("store");
    }
    /**
     *  GET api/contacts
     *  to get all contacts
     */
    public function index(Request $request)
    {
        try {
            $contacts = Contact::latest();

            $total = count(Contact::latest()->get());

            $offset = (intval($request->page) - 1) * intval($request->limit);

            $contacts = $contacts
                ->offset($offset)
                ->limit($request->limit)
                ->get();
            return response()->json([
                "success" => true,
                "data" => ContactResource::collection($contacts),
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  POST api/contacts
     *  to create a new contact
     */
    public function store(Request $request)
    {
        try {
            $contact = new Contact();
            $contact->user_id = Auth::user()->id;
            $contact->message = $request->message;
            $contact->save();
            return response()->json([
                "success" => true,
                "data" => $contact,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
