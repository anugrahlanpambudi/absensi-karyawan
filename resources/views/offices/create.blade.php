@extends('layouts.app')

@section('title', 'Tambah Kantor')

@section('content')

<div class="card card-modern p-4">

    <form action="{{ route('offices.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Kantor</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Radius (meter)</label>
            <input type="number" name="radius" class="form-control" value="100">
        </div>

        <div class="mb-3">
            <label>Jam Masuk</label>
            <input type="time" name="start_time" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jam Pulang</label>
            <input type="time" name="end_time" class="form-control">
        </div>

        <div class="mb-3">
            <label>Latitude</label>
            <input type="text" name="latitude" id="latitude" class="form-control">
        </div>

        <div class="mb-3">
            <label>Longitude</label>
            <input type="text" name="longitude" id="longitude" class="form-control">
        </div>

        <div class="mb-3">
            <label>Pilih Lokasi di Map</label>
            <div id="map" style="height: 400px; border-radius: 15px;"></div>
        </div>


        <button class="btn btn-success">Simpan</button>

    </form>

</div>
@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var map = L.map('map').setView([-6.200000, 106.816666], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker;
        var circle;

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            if (marker) map.removeLayer(marker);
            if (circle) map.removeLayer(circle);

            marker = L.marker([lat, lng]).addTo(map);

            var radius = document.querySelector('[name="radius"]').value;
            circle = L.circle([lat, lng], { radius: radius, color: 'blue', fillOpacity: 0.2 }).addTo(map);
        });

        document.querySelector('[name="radius"]').addEventListener('input', function() {
            if (circle) circle.setRadius(this.value);
        });
    });
</script>
@endsection



@endsection