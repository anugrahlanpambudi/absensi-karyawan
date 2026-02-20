@extends('layouts.app')

@section('title', 'Absensi')

@section('content')

<div class="card p-4">
    <h5>Absensi Hari Ini</h5>

    <form action="{{ route('attendance.checkin') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        <div class="mb-3">
            <label>Foto Selfie</label>
            <input type="file" name="photo" class="form-control" accept="image/*" capture="user" required>
        </div>

        <button class="btn btn-success">Check-in</button>
    </form>

    <form action="{{ route('attendance.checkout') }}" method="POST" class="mt-2">
        @csrf
        <button class="btn btn-danger">Check-out</button>
    </form>
</div>

<script>
navigator.geolocation.getCurrentPosition(function(position) {
    document.getElementById('latitude').value = position.coords.latitude;
    document.getElementById('longitude').value = position.coords.longitude;
}, function(err){
    alert('Gagal mendapatkan lokasi: ' + err.message);
});
</script>

@endsection
