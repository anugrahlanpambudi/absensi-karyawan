@extends('layouts.app')

@section('title', 'Data User')

@section('content')

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between">
        <h5>Data User</h5>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            + Tambah User
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Kantor</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->first() }}</td>
                    <td>{{ $user->office->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
