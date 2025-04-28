<?php

namespace App\Http\Controllers;


use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index', [
            'contacts' => Contact::all(),
        ]);
    }

    
    public function store(Request $request)
    {
        Log::info('Incoming request data:', [
            'data' => $request->all(),
        ]);

        $data = $request->validate([
            'event' => ['required', 'string'],
            'properties' => ['required', 'array'],
            'user' => ['required', 'array'],
            'user.id' => ['required', 'string'],
            'user.email' => ['required', 'email'],
            'user.region' => ['required', 'string', 'size:2'],
        ]);

        $contact = Contact::updateOrCreate([
            'email' => $data['user']['email'],
            'region' => $data['user']['region'],
        ]);

        foreach ($data['properties'] as $key => $value) {
            $contact->fields()->updateOrCreate(
                ['key' => $key,],
                ['value' => $value]
            );
        }

        return response()->json(['message' => 'Request received successfully'], 200);
    }
}
