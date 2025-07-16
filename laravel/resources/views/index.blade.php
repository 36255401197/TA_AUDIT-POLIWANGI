@extends('layouts.app') {{-- layout kamu --}}
@section('content')
<div class="container">
    <h4>Dashboard Lead Auditor</h4>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#auditModal">+ Buat Audit Baru</button>

    @include('dashboard.partials.modal') {{-- Modal Tambah/Edit Audit --}}

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Auditee</th>
                <th>Status</th>
                <th>Jenis Audit</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
            <tr>
                <td>{{ $audit->auditee }}</td>
                <td>{{ $audit->status }}</td>
                <td>{{ $audit->jenis_audit }}</td>
                <td>{{ $audit->tanggal }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('dashboard.destroy', $audit->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
