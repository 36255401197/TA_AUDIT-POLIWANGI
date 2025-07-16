@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Tambah Jadwal Audit</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan') }}">
        </div>

        <div class="mb-3">
            <label>Tanggal Audit</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
        </div>

        <div class="mb-3">
            <label>Auditor</label>
            <input type="text" name="auditor" class="form-control" value="{{ old('auditor') }}">
        </div>

        <div class="mb-3">
            <label>Auditee</label>
            <input type="text" name="auditee" class="form-control" value="{{ old('auditee') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

@endsection
