@extends('layouts.app')

@section('title', 'Tambah Kantor')

@section('content')

<div class="card card-modern p-4">

<input type="text" name="name" class="form-control" value="{{ $office->name }}">


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

<button class="btn btn-success">Simpan</button>



</div>

@endsection
