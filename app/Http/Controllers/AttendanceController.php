<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('attendance.index', compact('user'));
    }

    public function checkIn(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'required|image|max:2048',
        ]);

        // Validasi jarak kantor
        $office = $user->office;
        $distance = $this->haversine($office->latitude, $office->longitude, $request->latitude, $request->longitude);

        if ($distance > $office->radius) {
            return back()->with('error', 'Anda berada di luar radius kantor!');
        }

        // Upload foto
        $photoPath = $request->file('photo')->store('attendance_photos', 'public');

        Attendance::create([
            'user_id' => $user->id,
            'office_id' => $office->id,
            'check_in' => now(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'photo' => $photoPath,
        ]);

        return back()->with('success', 'Check-in berhasil!');
    }

    // fungsi check-out mirip check-in
    public function checkOut(Request $request)
    {
        $user = Auth::user();

        $attendance = Attendance::where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$attendance) return back()->with('error', 'Belum check-in!');

        $attendance->update([
            'check_out' => now()
        ]);

        return back()->with('success', 'Check-out berhasil!');
    }

    // Hitung jarak (meter)
    private function haversine($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meter
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadius * $c;
    }
}
