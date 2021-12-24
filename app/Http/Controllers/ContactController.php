<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     *  GET api/contacts
     *  to get all contacts
     */
    public function index()
    {
        try {
            $contacts = Contact::all();
            return response()->json([
                "success" => true,
                "data" => $contacts,
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

    /**
     *  GET api/contacts/{contact}
     *  to show a contact
     */
    public function show(Contact $contact, Request $request)
    {
        try {
            return response()->json([
                "success" => true,
                "data" => $contact,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
