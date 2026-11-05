<!--Added the html I had previously created and along with the design of the layout app and asked Gemini to add a nice design with CSS. It once again grabbed the cdn.tailwindcss.com-->
<!--Prompted Gemini with my html and the schema layout and asked it to help me create a better version of my code-->
<!--Because of my time restraint I prompted Gemini to create an input for the donations-->
<!--Submitted some screenshots to Gemini to help assist in fixing bugs-->
@extends('layouts.app')

@section('title', 'Church Members & People')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">People Directory</h2>
    
    <form method="GET" action="{{ route('contacts.index') }}" class="flex items-center space-x-2">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search people..." 
               class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Search</button>
    </form>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DOB</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Info</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($contacts as $contact)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('contacts.show', $contact->Contact_ID) }}" class="text-indigo-600 hover:underline font-medium">
                            {{ $contact->First_Name }} {{ $contact->Last_Name }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $contact->Date_of_Birth ? \Carbon\Carbon::parse($contact->Date_of_Birth)->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $contact->Contact_Status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $contact->Email_address ?? 'No email' }} <br>
                        <span class="text-xs text-gray-400">{{ $contact->Mobile_Phone }}</span>
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                    <div class="flex flex-col xl:flex-row items-end xl:items-center justify-end gap-2">
                        <form action="{{ route('contacts.register-event', $contact->Contact_ID) }}" method="POST" class="inline-block">
                            @csrf
                            <select name="Event_ID" required class="text-xs border rounded p-1">
                                <option value="">Select Event</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->Event_ID }}">{{ $event->Event_Title }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600">Register</button>
                        </form>

                        <form action="{{ route('contacts.donate', $contact->Contact_ID) }}" method="POST" class="inline-block mt-1">
                            @csrf
                            <input type="number" step="0.01" name="Donation_Amount" placeholder="$ Amount" required class="text-xs border rounded p-1 w-20">
                            <input type="date" name="Donation_Date" value="{{ date('Y-m-d') }}" required class="text-xs border rounded p-1">
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600">Donate</button>
                        </form>
                    </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $contacts->links() }}
</div>
@endsection
