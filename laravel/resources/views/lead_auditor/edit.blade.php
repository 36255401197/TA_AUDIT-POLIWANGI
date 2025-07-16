@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Audit</h4>
    <form action="{{ route('audit.update', $audit->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-2">
            <label>Nama Audit</label>
            <input type="text" name="nama_audit" class="form-control" value="{{ $audit->nama_audit }}" required>
        </div>
        <div class="mb-2">
            <label>Unit</label>
            <input type="text" name="unit" class="form-control" value="{{ $audit->unit }}" required>
        </div>
        <div class="mb-2">
            <label>Status</label>
            <select name="status" class="form-select">
                <option {{ $audit->status == 'Belum Mulai' ? 'selected' : '' }}>Belum Mulai</option>
                <option {{ $audit->status == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                <option {{ $audit->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="mb-2">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $audit->tanggal }}" required>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('audit.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
