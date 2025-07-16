@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container py-4 px-4">
    <h4 class="mb-3 mt-2">Jadwal Audit</h4>

    <div class="card shadow-sm border-0 rounded">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>NO</th>
                            <th>NAMA KEGIATAN</th>
                            <th>UNIT / AUDITEE</th>
                            <th>AUDITOR</th>
                            <th>TANGGAL</th>
                            <th>WAKTU</th>
                            <th>LOKASI</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwals as $index => $jadwal)
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
