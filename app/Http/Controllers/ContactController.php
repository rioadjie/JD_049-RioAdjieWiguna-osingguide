<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first(); // hanya 1 data
        return view('admin.contact.index', compact('contact'));
    }

    public function edit()
    {
        $contact = Contact::first();
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'country_code' => 'required|string',
            'phone_number' => 'required|numeric|regex:/^[1-9][0-9]{6,14}$/',
            'email'   => 'required|email',
            'address' => 'required|string',
        ]);

        $request->merge([
            'no_telp' => $request->country_code . $request->phone_number
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect()->route('admin.contact.index')->with('success', 'Contact updated successfully!');
    }
}

