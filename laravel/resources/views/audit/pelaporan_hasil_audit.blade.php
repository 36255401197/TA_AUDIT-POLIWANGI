@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container py-4 px-4">
    <h4 class="mb-4 fw-bold text-primary">
        <i class="bi bi-file-earmark-text"></i> Pelaporan Hasil Audit
    </h4>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Upload Laporan --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            Upload Laporan Audit
        </div>
        <div class="card-body">
            <form action="{{ route('pelaporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_auditee">Nama Auditee</label>
                        <input type="text" class="form-control" name="nama_auditee" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control" name="unit" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_audit">Tanggal Audit</label>
                        <input type="date" class="form-control" name="tanggal_audit" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status</label>
                       <select name="status" class="form-control" required>
                      <option value="Belum Dibaca">Belum Dibaca</option>
                      <option value="Ditindaklanjuti">Ditindaklanjuti</option>
                      <option value="Selesai">Selesai</option>
                    </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="catatan">Catatan (opsional)</label>
                        <textarea class="form-control" name="catatan" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="file">Unggah File</label>
                        <input type="file" class="form-control" name="file">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
            </form>
        </div>
    </div>

    {{-- Daftar Laporan --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Daftar Laporan Hasil Audit
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Auditee</th>
                        <th>Unit</th>
                        <th>Tanggal Audit</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $index => $laporan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $laporan->nama_auditee }}</td>
                            <td>{{ $laporan->unit }}</td>
                            <td>{{ \Carbon\Carbon::parse($laporan->tanggal_audit)->format('d-m-Y') }}</td>
                            <td>{{ $laporan->status }}</td>
                            <td>{{ $laporan->catatan ?? '-' }}</td>
                            <td>
                                @if($laporan->file)
                                    <a href="{{ asset('storage/' . $laporan->file) }}" class="btn btn-sm btn-success" target="_blank">Lihat File</a>
                                @else
                                    <span class="text-muted">Tidak ada file</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('pelaporan.destroy', $laporan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada laporan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
