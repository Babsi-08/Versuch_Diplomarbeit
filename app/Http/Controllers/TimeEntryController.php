<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TimeEntry;
use Illuminate\Http\Request;

class TimeEntryController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        $latestEntries = TimeEntry::with('employee')
            ->latest()
            ->take(5)
            ->get();

        return view('stempeln', compact('employees', 'latestEntries'));
    }

    public function kommen(Request $request)
    {
        TimeEntry::create([
            'employee_id' => $request->employee_id,
            'kommen' => now(),
        ]);

        return redirect('/')->with('status', 'Eingestempelt!')->with('typ', 'kommen');
    }

    public function gehen(Request $request)
    {
        $entry = TimeEntry::where('employee_id', $request->employee_id)
            ->whereNull('gehen')
            ->latest()
            ->first();

        if ($entry) {
            $entry->update(['gehen' => now()]);
        }

        return redirect('/')->with('status', 'Ausgestempelt!')->with('typ', 'gehen');
    }

    public function uebersicht()
    {
        $entries = TimeEntry::with('employee')->latest()->get();
        return view('uebersicht', compact('entries'));
    }
}