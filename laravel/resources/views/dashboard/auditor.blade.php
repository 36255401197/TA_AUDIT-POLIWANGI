@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">📅 Jadwal Audit (Auditee)</h4>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Daftar Jadwal Audit</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Unit / Auditee</th>
                        <th>Auditor</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwalAudit as $index => $jadwal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $jadwal->nama_kegiatan }}</td>
                            <td>{{ $jadwal->auditee }}</td>
                            <td>{{ $jadwal->auditor }}</td>
                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada jadwal audit.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
