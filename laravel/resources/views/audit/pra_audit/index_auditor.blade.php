@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container py-4 px-4">
    <h4 class="mb-4 fw-bold text-primary">
        <i class="bi bi-list-check"></i> Indikator Audit
    </h4>

    <div class="card shadow-sm border-0 rounded-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Indikator</th>
                            <th>Kode</th>
                            <th>Checklist</th>
                            <!-- @if(Auth::user()->role === 'auditee' || Auth::user()->role === 'auditor')
                                <th>Dokumen</th>
                                <th>Upload</th>
                            @endif -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($indikatorList as $key => $indikator)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $indikator->kategori }}</td>
                            <td>{{ $indikator->indikator }}</td>
                            <td class="text-center">{{ $indikator->kode }}</td>
                            <td class="text-center">
                                @if($indikator->checklist)
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                @else
                                    <i class="bi bi-x-circle-fill text-danger"></i>
                                @endif
                            </td>
                            
                            <!-- @if(Auth::user()->role === 'auditee')
                                <td class="text-center">
                                    @if($indikator->dokumen)
                                        <a href="{{ asset('storage/dokumen/'.$indikator->dokumen) }}" target="_blank" class="btn btn-sm btn-primary">Lihat File</a>
                                    @else
                                        <span class="text-muted">Belum ada</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpload{{ $indikator->id }}">
                                        Upload
                                    </button>
                                </td>
                            @endif -->
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data indikator.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
