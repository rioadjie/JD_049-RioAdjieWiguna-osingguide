<?php

namespace App\Http\Controllers;

use App\Models\GuideAvailability;
use Illuminate\Http\Request;

class GuideAvailabilityController extends Controller
{
    public function index()
    {
        $month = request('month', now()->month);
        $year = request('year', now()->year);

        $startOfMonth = \Carbon\Carbon::create($year, $month, 1);
        $daysInMonth = $startOfMonth->daysInMonth;
        $firstDayOfWeek = $startOfMonth->dayOfWeek; // 0 = Minggu, 6 = Sabtu

        $availabilities = GuideAvailability::where('guide_id', auth()->id())
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->date->format('Y-m-d') => $item->status];
            });

        return view('guide.availability.index', compact(
            'availabilities',
            'month',
            'year',
            'daysInMonth',
            'firstDayOfWeek'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:guide_availabilities,date,NULL,id,guide_id,' . auth()->id(),
            'status' => 'required|in:available,unavailable',
        ]);

        GuideAvailability::create([
            'guide_id' => auth()->id(),
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function storeBulk(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:available,unavailable',
        ]);

        $start = \Carbon\Carbon::parse($request->start_date);
        $end = \Carbon\Carbon::parse($request->end_date);

        $guideId = auth()->id();

        // Cegah input lebih dari 90 hari
        if ($start->diffInDays($end) > 90) {
            return back()->withErrors(['end_date' => 'Maksimal rentang 90 hari.']);
        }

        $dates = [];
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $dates[] = [
                'guide_id' => $guideId,
                'date' => $date->format('Y-m-d'),
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Hapus dulu data lama di rentang ini (opsional: jika ingin overwrite)
        GuideAvailability::where('guide_id', $guideId)
            ->whereBetween('date', [$start->format('Y-m-d'), $end->format('Y-m-d')])
            ->delete();

        // Simpan semua
        GuideAvailability::insert($dates);

        return back()->with('success', "Ketersediaan berhasil diatur untuk " . count($dates) . " hari.");
    }

    public function destroy($id)
    {
        $availability = GuideAvailability::where('id', $id)
            ->where('guide_id', auth()->id())
            ->firstOrFail();

        $availability->delete();

        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
