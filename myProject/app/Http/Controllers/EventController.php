<?php
/**
 * Asked Gemini to create this controller with the schema
 */
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $events = Event::when($search, function ($query, $search) {
                $query->where('Event_Title', 'like', "%{$search}%")
                      ->orWhere('Event_Description', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString();

        return view('events.index', compact('events', 'search'));
    }
}
