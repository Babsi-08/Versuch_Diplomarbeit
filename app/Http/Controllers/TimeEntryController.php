<?php

namespace App\Http\Controllers;

use App\Models\TimeEntry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TimeEntryController extends Controller
{
    public function index()
    {
        return Inertia::render('Stempeln');
    }

    public function kommen(Request $request)
    {
        TimeEntry::create([
            'user_id' => $request->user()->id,
            'kommen' => now(),
        ]);

        return redirect()->route('stempeln')->with('status', 'Eingestempelt!')->with('typ', 'kommen');
    }

    public function gehen(Request $request)
    {
        $entry = TimeEntry::where('user_id', $request->user()->id)
            ->whereNull('gehen')
            ->latest()
            ->first();

        if ($entry) {
            $entry->update(['gehen' => now()]);
        }

        return redirect()->route('stempeln')->with('status', 'Ausgestempelt!')->with('typ', 'gehen');
    }

    public function uebersicht()
    {
        $entries = TimeEntry::with('user')->latest()->get()->map(function (TimeEntry $entry): array {
            $minutes = $entry->gehen ? (int) $entry->kommen->diffInMinutes($entry->gehen) : null;

            return [
                'id' => $entry->id,
                'employee' => $entry->user->name,
                'kommen' => $entry->kommen->format('d.m.Y H:i'),
                'gehen' => $entry->gehen?->format('d.m.Y H:i'),
                'dauer' => $minutes !== null ? intdiv($minutes, 60).' Std '.($minutes % 60).' Min' : null,
            ];
        });

        return Inertia::render('Uebersicht', [
            'entries' => $entries,
        ]);
    }
}
