@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container py-4 px-4">
    <h4 class="mb-3 mt-2">Pelaksanaan Audit</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Standar</th>
                            <th>Indikator</th>
                            <th>Kode</th>
                            <th>Temuan</th>
                            <th>Kepatuhan</th>
                            <th>Tanggapan Auditi</th>
                            <th>Akar Masalah</th>
                            <th>Dokumen</th>
                            @if(Auth::user()->role === 'auditee')
                                <th>Upload</th>
                            @endif
                             @if(Auth::user()->role === 'auditor')
                                <th>Aksi</th>
                            @endif
                                            

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
                            <td class="text-center">
                                @if($item->dokumen)
                                    <a href="{{ asset('storage/dokumen/'.$item->dokumen) }}" target="_blank" class="btn btn-sm btn-success">
                                        Download
                                    </a>
                                @else
                                    <span class="text-muted">Belum ada</span>
                                @endif
                            </td>

                            @if(Auth::user()->role === 'auditee')
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalUpload{{ $item->id }}">
                                    Upload
                                </button>
                            </td>
                            @endif

                             @if(Auth::user()->role === 'auditor')
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdit{{ $item->id }}">
                                    Edit
                                </button>
                            </td>
                            @endif
                        </tr>

                       
                        @if(Auth::user()->role === 'auditee')
                        <div class="modal fade" id="modalUpload{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('auditee.upload_dokumen', $item->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Upload Dokumen</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="file" name="dokumen" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Upload</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif

                        @empty
                        <tr><td colspan="10" class="text-center text-muted">Belum ada data indikator.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                @if(Auth::user()->role === 'auditor')
@foreach($data as $item)
<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('pelaksanaan.update', $item->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Data (Auditor)</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{-- Hanya input yang boleh diedit oleh auditor --}}
                    <textarea name="temuan" class="form-control mb-2" rows="2" placeholder="Temuan">{{ $item->temuan }}</textarea>
                    <select name="kepatuhan" class="form-select mb-2" required>
                        <option value="SESUAI" {{ $item->kepatuhan == 'SESUAI' ? 'selected' : '' }}>SESUAI</option>
                        <option value="TIDAK SESUAI" {{ $item->kepatuhan == 'TIDAK SESUAI' ? 'selected' : '' }}>TIDAK SESUAI</option>
                    </select>
                    <textarea name="tanggapan_auditi" class="form-control mb-2" rows="2" placeholder="Tanggapan Auditi">{{ $item->tanggapan_auditi }}</textarea>
                    <textarea name="akar_masalah" class="form-control mb-2" rows="2" placeholder="Akar Masalah">{{ $item->akar_masalah }}</textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
@endif

            </div>
        </div>
    </div>
</div>
@endsection
