@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Form Buat Audit Baru</h3>
    <form action="{{ route('audit.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_audit" class="form-label">Nama Audit</label>
            <input type="text" class="form-control" name="nama_audit" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
