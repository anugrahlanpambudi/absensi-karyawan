@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h5>Tambah User</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Kantor</label>
                <select name="office_id" class="form-control">
                    <option value="">-- Pilih Kantor --</option>
                    @foreach($offices as $office)
                        <option value="{{ $office->id }}">
                            {{ $office->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>

@endsection
