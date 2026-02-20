@extends('layouts.app')

@section('title', 'Data Kantor')

@section('content')

<div class="card card-modern p-4">

    <div class="d-flex justify-content-between mb-3">
        <h5>Data Kantor</h5>
        <a href="{{ route('offices.create') }}" class="btn btn-primary btn-sm">
            + Tambah Kantor
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Radius</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offices as $office)
                <tr>
                    <td>{{ $office->name }}</td>
                    <td>{{ $office->address }}</td>
                    <td>{{ $office->radius }} m</td>
                    <td>
                        <a href="{{ route('offices.edit',$office) }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('offices.destroy',$office) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus kantor?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $offices->links() }}

</div>

@endsection
