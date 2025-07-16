

@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 fw-bold">Kelola Pengguna</h4>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Tambah User --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-person-plus-fill me-2"></i> Tambah User Baru
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="lead_auditor">Lead Auditor</option>
                            <option value="auditor">Auditor</option>
                            <option value="auditee">Auditee</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-success w-100">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel User --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-secondary text-white">
            <i class="bi bi-people-fill me-2"></i> Daftar Pengguna
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @php
                                    $roleColors = [
                                        'lead_auditor' => 'primary',
                                        'auditor' => 'warning',
                                        'auditee' => 'info'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $roleColors[$user->role] ?? 'secondary' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $user->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted">Belum ada user terdaftar.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit untuk Tiap User --}}
@foreach($users as $user)
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama</label>
                    <input name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-select" required>
                        <option value="lead_auditor" {{ $user->role == 'lead_auditor' ? 'selected' : '' }}>Lead Auditor</option>
                        <option value="auditor" {{ $user->role == 'auditor' ? 'selected' : '' }}>Auditor</option>
                        <option value="auditee" {{ $user->role == 'auditee' ? 'selected' : '' }}>Auditee</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Password Baru (opsional)</label>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
