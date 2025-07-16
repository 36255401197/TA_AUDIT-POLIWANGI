@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Buat Audit Baru</h4>
    <form action="{{ route('audit.store') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label>Nama Audit</label>
            <input type="text" name="nama_audit" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Unit</label>
            <input type="text" name="unit" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="Belum Mulai">Belum Mulai</option>
                <option value="Dalam Proses">Dalam Proses</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>
        <div class="mb-2">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('audit.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
