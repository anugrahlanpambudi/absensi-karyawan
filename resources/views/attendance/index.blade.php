@extends('layouts.app')

@section('content')

<div class="card p-4">
    <h5>Absensi Hari Ini</h5>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($attendance && $attendance->check_in)

        <div class="alert alert-success">
            ✅ Kamu sudah check-in hari ini
        </div>

        <div class="text-center mb-3">
            <img src="{{ asset('storage/attendance/'.$attendance->photo) }}" 
                 width="200" 
                 class="rounded">
        </div>

    @else

        <form action="{{ route('attendance.checkin') }}" method="POST" onsubmit="return validateForm()">
            @csrf

            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <input type="hidden" name="photo" id="photoInput">

            <div class="text-center mb-3">
                <video id="video" width="320" height="240" autoplay class="border rounded"></video>
            </div>

            <div class="text-center mb-3">
                <button type="button" id="snap" class="btn btn-primary">
                    Ambil Foto
                </button>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">
                    Check-in
                </button>
            </div>
        </form>

    @endif

    @if($attendance && $attendance->check_in && !$attendance->check_out)
        <form action="{{ route('attendance.checkout') }}" method="POST" class="mt-3 text-center">
            @csrf
            <button class="btn btn-danger">Check-out</button>
        </form>
    @endif

</div>

@if(!$attendance || !$attendance->check_in)
<script>

let stream;

// CAMERA
navigator.mediaDevices.getUserMedia({ video: true })
.then(function(s) {
    stream = s;
    document.getElementById('video').srcObject = stream;
})
.catch(function() {
    alert("Kamera tidak bisa diakses!");
});

// SNAP
document.getElementById('snap').addEventListener('click', function() {

    const video = document.getElementById('video');
    const canvas = document.createElement('canvas');
    canvas.width = 320;
    canvas.height = 240;

    const ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, 320, 240);

    const imageData = canvas.toDataURL('image/png');
    document.getElementById('photoInput').value = imageData;

    if (stream) {
        stream.getTracks().forEach(track => track.stop());
    }

    video.style.display = "none";
    this.style.display = "none";

    const preview = document.createElement('img');
    preview.src = imageData;
    preview.width = 200;
    preview.className = "rounded mt-3";
    video.parentNode.appendChild(preview);
});

// LOCATION
navigator.geolocation.getCurrentPosition(function(position) {
    document.getElementById('latitude').value = position.coords.latitude;
    document.getElementById('longitude').value = position.coords.longitude;
}, function() {
    alert("Lokasi tidak bisa diakses!");
});

// VALIDASI SEBELUM SUBMIT
function validateForm() {

    if (!document.getElementById('photoInput').value) {
        alert("Ambil foto dulu sebelum check-in!");
        return false;
    }

    if (!document.getElementById('latitude').value) {
        alert("Lokasi belum terdeteksi!");
        return false;
    }

    return true;
}

</script>
@endif

@endsection
