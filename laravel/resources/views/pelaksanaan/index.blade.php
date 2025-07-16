@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h5>Kertas Kerja Auditor Lapangan</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Data
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Standar</th>
                            <th>Indikator</th>
                            <th>Kode</th>
                            <th>Temuan</th>
                            <th>Kepatuhan</th>
                            <th>Tanggapan Auditi</th>
                            <th>Akar Masalah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->standar }}</td>
                            <td class="text-start">{{ $item->indikator }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->temuan ?? '-' }}</td>
                            <td>{{ $item->kepatuhan }}</td>
                            <td>{{ $item->tanggapan_auditi ?? '-' }}</td>
                            <td>{{ $item->akar_masalah ?? '-' }}</td>
                            <td class="d-flex justify-content-center px-3">
                                <button class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i> 
                                </button>
                                <form action="{{ route('pelaksanaan.destroy', $item->id) }}" method="POST" class="d-inline form-hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-confirm-hapus" data-nama="{{ $item->indikator }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('pelaksanaan.update', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input name="standar" class="form-control mb-2" value="{{ $item->standar }}" required>
                                            <textarea name="indikator" class="form-control mb-2" required>{{ $item->indikator }}</textarea>
                                            <input name="kode" class="form-control mb-2" value="{{ $item->kode }}" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @empty
                        <tr><td colspan="9">Data belum ada.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('pelaksanaan.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input name="standar" class="form-control mb-2" placeholder="Standar" required>
                    <textarea name="indikator" class="form-control mb-2" rows="2" placeholder="Indikator" required></textarea>
                    <input name="kode" class="form-control mb-2" placeholder="Kode" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.btn-confirm-hapus');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const nama = this.getAttribute('data-nama');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data indikator \"" + nama + "\" akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
