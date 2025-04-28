<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\View\View;
use App\Http\Controllers\Controller;


class ContactFieldController extends Controller
{
    public function show(Contact $contact): View
    {
        return view('contacts.fields.show', [
            'contact' => $contact,
            'fields' => $contact->fields,
        ]);
    }
}
