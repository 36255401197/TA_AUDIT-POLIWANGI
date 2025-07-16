@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container py-4">
    <h4 class="text-primary">👤 Dashboard Auditee</h4>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <p>Anda login sebagai: <strong>{{ Auth::user()->role }}</strong></p>
    <!-- Tabel Jadwal Audit -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            Jadwal Audit Anda
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
                        <th>Waktu</th>
                        <th>Lokasi</th>
                        <th>Status</th>
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
                            <td>{{ $jadwal->waktu }}</td>
                            <td>{{ $jadwal->lokasi }}</td>
                            <td>{{ $jadwal->status }}</td>
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

    <!-- Catatan Penting -->
    <!-- <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h -->
