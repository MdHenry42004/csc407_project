<?php
/**
 * Asked Gemini to create this controller with the schema
 */
namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $donations = Donation::with('donor')
            ->when($search, function ($query, $search) {
                $query->where('Donation_Amount', 'like', "%{$search}%")
                      ->orWhereHas('donor', function ($q) use ($search) {
                          $q->where('First_Name', 'like', "%{$search}%")
                            ->orWhere('Last_Name', 'like', "%{$search}%");
                      });
            })
            ->paginate(10)
            ->withQueryString();

        return view('donations.index', compact('donations', 'search'));
    }
}
