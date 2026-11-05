<!--Added the html I had previously created and along with the design of the layout app and asked Gemini to add a nice design with CSS. It once again grabbed the cdn.tailwindcss.com-->
@extends('layouts.app')

@section('title', 'Church Donations')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Donations Ledger</h2>
    <form method="GET" action="{{ route('donations.index') }}" class="flex items-center space-x-2">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search donations..." 
               class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Search</button>
    </form>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Donor Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Donation Date</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($donations as $donation)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                        {{ $donation->donor ? $donation->donor->First_Name . ' ' . $donation->donor->Last_Name : 'Anonymous' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-semibold">
                        ${{ number_format($donation->Donation_Amount, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $donation->Donation_Date->format('M d, Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No donations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $donations->links() }}
</div>
@endsection
