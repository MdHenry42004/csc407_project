<!--Added the html I had previously created and along with the design of the layout app and asked Gemini to add a nice design with CSS. It once again grabbed the cdn.tailwindcss.com-->
<!--Submitted some screenshots to Gemini to help assist in fixing bugs-->
<!--Prompted Gemini with my html and the schema layout and asked it to help me create a better version of my code-->
@extends('layouts.app')

@section('title', $contact->First_Name . ' ' . $contact->Last_Name)

@section('content')
<div class="mb-4">
    <a href="{{ route('contacts.index') }}" class="text-indigo-600 hover:underline">&larr; Back to People</a>
</div>

<div class="bg-white shadow rounded-lg p-6 mb-6">
    <h2 class="text-2xl font-bold mb-4">{{ $contact->First_Name }} {{ $contact->Last_Name }}</h2>
    <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
        <div><strong>DOB:</strong> {{ $contact->Date_of_Birth ? $contact->Date_of_Birth->format('F j, Y') : 'N/A' }}</div>
        <div><strong>Gender:</strong> {{ $contact->Gender ?? 'N/A' }}</div>
        <div><strong>Marital Status:</strong> {{ $contact->Marital_Status ?? 'N/A' }}</div>
        <div><strong>Status:</strong> {{ $contact->Contact_Status }}</div>
        <div><strong>Email:</strong> {{ $contact->Email_address ?? 'N/A' }}</div>
        <div><strong>Mobile Phone:</strong> {{ $contact->Mobile_Phone ?? 'N/A' }}</div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-3">Event Participation History</h3>
        <ul class="divide-y divide-gray-200">
            @forelse($contact->events as $event)
                <li class="py-2">
                    <span class="font-medium">{{ $event->Event_Title }}</span>
                    <span class="text-xs text-gray-500 block">{{ $event->Event_Start_Date->format('M d, Y h:i A') }}</span>
                </li>
            @empty
                <p class="text-sm text-gray-500">No registered events.</p>
            @endforelse
        </ul>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-3">Donation History</h3>
        <ul class="divide-y divide-gray-200">
            @forelse($contact->donations as $donation)
                <li class="py-2 flex justify-between items-center">
                    <span class="font-medium text-green-600">${{ number_format($donation->Donation_Amount, 2) }}</span>
                    <span class="text-xs text-gray-500">{{ $donation->Donation_Date->format('M d, Y') }}</span>
                </li>
            @empty
                <p class="text-sm text-gray-500">No donations recorded.</p>
            @endforelse
        </ul>
    </div>
</div>
@endsection
