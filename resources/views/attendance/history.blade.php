@extends('layouts.app')

@section('content')

<div class="card p-4">
    <h5>Riwayat Absensi</h5>

    <form method="GET" class="mb-3">
        <input type="date" name="date" class="form-control w-25 d-inline">
        <button class="btn btn-primary btn-sm">Filter</button>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>User</th>
                    <th>Kantor</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $item)
                <tr>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->office->name ?? '-' }}</td>
                    <td>{{ $item->check_in }}</td>
                    <td>{{ $item->check_out ?? '-' }}</td>
                    <td>
                        <img src="{{ asset('storage/attendance/'.$item->photo) }}" 
                             width="60" 
                             class="rounded">
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $attendances->links() }}

</div>

@endsection
