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
            @if(in_array(Auth::user()->role, ['lead_auditor', 'auditor']))
            <div class="mb-3 text-start">
                <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Indikator
                </button>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Indikator</th>
                            <th>Kode</th>

                            @if(Auth::user()->role == 'auditee')
                                <th>Dokumen</th>
                                <th>Upload</th>
                            @else
                                <th>Checklist</th>
                                @if(in_array(Auth::user()->role, ['lead_auditor', 'auditor']))
                                    <th>Aksi</th>
                                @endif
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($indikatorList as $key => $indikator)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $indikator->kategori }}</td>
                            <td>{{ $indikator->indikator }}</td>
                            <td class="text-center">{{ $indikator->kode }}</td>

                            @if(Auth::user()->role == 'auditee')
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
                            @else
                                <td class="text-center">
                                    @if($indikator->checklist)
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    @else
                                        <i class="bi bi-x-circle-fill text-danger"></i>
                                    @endif
                                </td>
                                @if(in_array(Auth::user()->role, ['lead_auditor', 'auditor']))
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $indikator->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $indikator->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="form-delete-{{ $indikator->id }}" action="{{ route('pra_audit.destroy', $indikator->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                                @endif
                            @endif
                        </tr>

                        <!-- Modal Edit -->
                        @if(in_array(Auth::user()->role, ['lead_auditor', 'auditor']))
                        <div class="modal fade" id="modalEdit{{ $indikator->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('pra_audit.update', $indikator->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning text-dark">
                                            <h5 class="modal-title">Edit Indikator</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input name="kategori" class="form-control mb-2" value="{{ $indikator->kategori }}" required>
                                            <input name="indikator" class="form-control mb-2" value="{{ $indikator->indikator }}" required>
                                            <input name="kode" class="form-control mb-2" value="{{ $indikator->kode }}" required>
                                            <div class="form-check mt-2">
                                                <input type="checkbox" name="checklist" class="form-check-input" {{ $indikator->checklist ? 'checked' : '' }}>
                                                <label class="form-check-label">Checklist sekarang</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif

                        <!-- Modal Upload Dokumen -->
                        @if(Auth::user()->role == 'auditee')
                        <div class="modal fade" id="modalUpload{{ $indikator->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('auditee.upload_dokumen', $indikator->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Upload Dokumen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="file" name="dokumen" class="form-control" required>
                                        </div>
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Upload</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data indikator.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if(in_array(Auth::user()->role, ['lead_auditor', 'auditor']))
<!-- Modal Tambah Indikator -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('pra_audit.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Indikator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input name="kategori" class="form-control mb-2" placeholder="Kategori" required>
                    <input name="indikator" class="form-control mb-2" placeholder="Indikator" required>
                    <input name="kode" class="form-control mb-2" placeholder="Kode" required>
                    <div class="form-check mt-2">
                        <input type="checkbox" name="checklist" class="form-check-input">
                        <label class="form-check-label">Checklist sekarang</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
@endsection

<!-- Konfirmasi Delete -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-delete-' + id).submit();
        }
    });
}
</script>
