@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container py-4 px-4">
    <h4 class="mb-3 mt-2">📋 Data Indikator Audit</h4>

    <div class="card shadow-sm border-0 rounded">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Indikator</th>
                            <th>Kode</th>
                            <th>Checklist</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($indikatorList as $key => $indikator)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $indikator->kategori }}</td>
                            <td>{{ $indikator->indikator }}</td>
                            <td class="text-center">{{ $indikator->kode }}</td>
                            <td class="text-center">{{ $indikator->checklist ? '✔️' : '❌' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data indikator.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
