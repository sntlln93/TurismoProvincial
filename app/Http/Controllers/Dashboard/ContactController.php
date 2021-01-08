<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Contact;

class ContactController extends Controller
{
    public function create($type, $id)
    {
        return view('dashboard.contacts.create')
            ->with('type', $type)
            ->with('id', $id);
    }

    public function store(Request $request, $type, $id)
    {
        if ($type == "services") {
            $contactable = "App\\Service";
        } elseif ($type == "locations") {
            $contactable = "App\\Location";
        } elseif ($type == "districts") {
            $contactable = "App\\District";
        }

        $contact_data = $this->validateContact($request);

        Contact::create([
            'type' => $contact_data['type'],
            'contact' => $contact_data['contact'],
            'contactable_id' => $id,
            'contactable_type' => $contactable
        ]);

        return redirect('panel-de-administracion/'.$type.'/'.$id);
    }

    public function edit(Contact $contact)
    {
        return view('dashboard.contacts.edit')->with('contact', $contact);
    }

    public function update(Request $request, Contact $contact)
    {
        $contact_data = $this->validateContact($request);

        $contact->update($contact_data);

        return redirect('panel-de-administracion/'.$type.'/');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->back();
    }

    private function validateContact($request)
    {
        return $request->validate([
            'contact' => 'required',
            'type' => 'required',
        ]);
    }
}