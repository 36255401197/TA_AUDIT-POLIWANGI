@extends('layouts.DashboardAudit.dashboard')

@section('content')
  <h4 class="page-title">Dashboard Lead Auditor</h4>

  <a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-3">Tambah Jadwal</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Jadwal Audit</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Posisi</th>
              <th>Tanggal Audit</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($jadwals as $index => $jadwal)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $jadwal->nama }}</td>
                <td>{{ $jadwal->posisi }}</td>
                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_audit)->translatedFormat('d F Y') }}</td>
                <td>
                  <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                  <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
