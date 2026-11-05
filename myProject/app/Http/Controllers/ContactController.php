<?php

/**
 * Asked Gemini to create this controller with the schema
 */
namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Event;
use App\Models\Donation;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $contacts = Contact::with('household')
            ->when($search, function ($query, $search) {
                $query->where('First_Name', 'like', "%{$search}%")
                      ->orWhere('Last_Name', 'like', "%{$search}%")
                      ->orWhere('Email_address', 'like', "%{$search}%")
                      ->orWhere('Mobile_Phone', 'like', "%{$search}%")
                      ->orWhere('Contact_Status', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString();

        $events = Event::all();

        return view('contacts.index', compact('contacts', 'events', 'search'));
    }

    public function show($id)
    {
        $contact = Contact::with(['household', 'donations', 'events'])->findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    public function registerEvent(Request $request, $id)
    {
        $request->validate([
            'Event_ID' => 'required|exists:events,Event_ID',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->events()->syncWithoutDetaching([$request->Event_ID]);

        return redirect()->route('contacts.index')->with('success', 'Successfully registered for event.');
    }

    public function storeDonation(Request $request, $id)
{
    $request->validate([
        'Donation_Amount' => 'required|numeric|min:0.01',
        'Donation_Date' => 'required|date',
    ]);

    $contact = \App\Models\Contact::where('Contact_ID', $id)->firstOrFail();

    \App\Models\Donation::create([
        'Donor_ID' => $contact->Donor_ID,
        'Donation_Amount' => $request->Donation_Amount,
        'Donation_Date' => $request->Donation_Date,
    ]);

    return redirect()->back()->with('success', 'Donation added successfully!');
}
}
