<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', today())
            ->first();

        return view('attendance.index', compact('attendance'));
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'photo' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $user = Auth::user();

        // 🚫 Cegah double check-in
        $existing = Attendance::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->first();

        if ($existing) {
            return back()->with('error', 'Kamu sudah check-in hari ini!');
        }

        $office = $user->office;

        if (!$office) {
            return back()->with('error', 'User belum terdaftar di kantor!');
        }

        // 📍 Hitung jarak
        $distance = $this->calculateDistance(
            $request->latitude,
            $request->longitude,
            $office->latitude,
            $office->longitude
        );

        if ($distance > $office->radius) {
            return back()->with('error', 'Kamu berada di luar radius kantor!');
        }

        // 🖼 Simpan foto
        $image = str_replace('data:image/png;base64,', '', $request->photo);
        $image = str_replace(' ', '+', $image);
        $imageName = 'attendance_' . time() . '.png';

        Storage::disk('public')->put(
            'attendance/' . $imageName,
            base64_decode($image)
        );

        Attendance::create([
            'user_id'   => $user->id,
            'office_id' => $office->id,
            'check_in'  => now(),
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
            'photo'     => $imageName,
        ]);

        return back()->with('success', 'Check-in berhasil!');
    }

    public function checkOut()
    {
        $user = Auth::user();

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->first();

        if (!$attendance) {
            return back()->with('error', 'Belum check-in!');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'Kamu sudah check-out!');
        }

        $attendance->update([
            'check_out' => now()
        ]);

        return back()->with('success', 'Check-out berhasil!');
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    public function history(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();
    
    $query = Attendance::with('user', 'office')
        ->orderBy('created_at', 'desc');

    // Hanya super-admin & admin yang bisa lihat semua
    if (!$user->hasAnyRole(['super-admin', 'admin'])) {
        $query->where('user_id', $user->id);
    }

    if ($request->date) {
        $query->whereDate('created_at', $request->date);
    }

    $attendances = $query->paginate(10);

    return view('attendance.history', compact('attendances'));
}

}
