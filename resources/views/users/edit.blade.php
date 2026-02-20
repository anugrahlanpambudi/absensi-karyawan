@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit User</h5>
        <a href="{{ route('users.index') }}" class="btn btn-light btn-sm">
            ← Kembali
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $user->name) }}"
                       required>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $user->email) }}"
                       required>
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Password Baru
                    <small class="text-muted">(Kosongkan jika tidak ingin mengganti)</small>
                </label>
                <input type="password"
                       name="password"
                       class="form-control">
            </div>

            {{-- Role --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Role</label>
                <select name="role" class="form-select" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Kantor --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Kantor</label>
                <select name="office_id" class="form-select">
                    <option value="">-- Pilih Kantor --</option>
                    @foreach($offices as $office)
                        <option value="{{ $office->id }}"
                            {{ $user->office_id == $office->id ? 'selected' : '' }}>
                            {{ $office->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Button --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4">
                    Update
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
