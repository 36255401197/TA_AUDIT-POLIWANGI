@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container mt-4">
  <h5 class="mb-3"> Daftar Pelaksanaan Audit</h5>

  <!-- Tombol Tambah Modal -->
  <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
    + Tambah Pelaksanaan Audit
  </button>

  <!-- Tabel Data -->
  <table class="table table-bordered table-hover align-middle">
    <thead class="table-light text-center">
      <tr>
        <th>No</th>
        <th>Standar</th>
        <th>Indikator</th>
        <th>Kode</th>
        <th>Kepatuhan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $key => $item)
      <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $item->standar }}</td>
        <td>{{ $item->indikator }}</td>
        <td>{{ $item->kode }}</td>
        <td>{{ $item->kepatuhan }}</td>
        <td class="text-center">
          <!-- Tombol Edit -->
          <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</button>

          <!-- Tombol Hapus -->
          <form action="{{ route('pelaksanaan.destroy', $item->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
          </form>
        </td>
      </tr>

      <!-- Modal Edit -->
      <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <form action="{{ route('pelaksanaan.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
              <div class="modal-header bg-warning">
                <h5 class="modal-title">Edit Data Audit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body row g-3">
                <div class="col-md-6">
                  <label>Standar</label>
                  <input type="text" name="standar" class="form-control" value="{{ $item->standar }}" required>
                </div>
                <div class="col-md-6">
                  <label>Kode</label>
                  <input type="text" name="kode" class="form-control" value="{{ $item->kode }}" required>
                </div>
                <div class="col-12">
                  <label>Indikator</label>
                  <textarea name="indikator" rows="2" class="form-control" required>{{ $item->indikator }}</textarea>
                </div>
                <div class="col-12">
                  <label>Temuan</label>
                  <textarea name="temuan" rows="2" class="form-control">{{ $item->temuan }}</textarea>
                </div>
                <div class="col-md-6">
                  <label>Kepatuhan</label>
                  <select name="kepatuhan" class="form-select" required>
                    <option value="SESUAI" {{ $item->kepatuhan == 'SESUAI' ? 'selected' : '' }}>SESUAI</option>
                    <option value="TIDAK SESUAI" {{ $item->kepatuhan == 'TIDAK SESUAI' ? 'selected' : '' }}>TIDAK SESUAI</option>
                  </select>
                </div>
                <div class="col-12">
                  <label>Tanggapan Auditi</label>
                  <textarea name="tanggapan_auditi" rows="2" class="form-control">{{ $item->tanggapan_auditi }}</textarea>
                </div>
                <div class="col-12">
                  <label>Akar Masalah</label>
                  <textarea name="akar_masalah" rows="2" class="form-control">{{ $item->akar_masalah }}</textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary">Simpan Perubahan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('pelaksanaan.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Tambah Pelaksanaan Audit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label>Standar</label>
            <input type="text" name="standar" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Kode</label>
            <input type="text" name="kode" class="form-control" required>
          </div>
          <div class="col-12">
            <label>Indikator</label>
            <textarea name="indikator" rows="2" class="form-control" required></textarea>
          </div>
          <div class="col-12">
            <label>Temuan</label>
            <textarea name="temuan" rows="2" class="form-control"></textarea>
          </div>
          <div class="col-md-6">
            <label>Kepatuhan</label>
            <select name="kepatuhan" class="form-select" required>
              <option value="SESUAI">SESUAI</option>
              <option value="TIDAK SESUAI">TIDAK SESUAI</option>
            </select>
          </div>
          <div class="col-12">
            <label>Tanggapan Auditi</label>
            <textarea name="tanggapan_auditi" rows="2" class="form-control"></textarea>
          </div>
          <div class="col-12">
            <label>Akar Masalah</label>
            <textarea name="akar_masalah" rows="2" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
