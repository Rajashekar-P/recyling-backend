<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return $contacts;
    }

    public function addContact(Request $request)
    {
        $contact = new Contact();
        $contact->address = $request->address;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->save();

        return response()->json([
            'message' => 'Contact created succussfully',
        ], 200);
    }
}
