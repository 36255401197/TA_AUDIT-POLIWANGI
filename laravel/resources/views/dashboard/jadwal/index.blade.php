@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container py-4 px-4">
    <h4 class="mb-3 mt-2">Jadwal Audit</h4>

    <div class="card shadow-sm border-0 rounded">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card-body">
            <div class="mb-3 text-start">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalCreate">
                    Tambah Jadwal
                </button>
            </div>

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
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwals as $index => $jadwal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $jadwal->nama_kegiatan }}</td>
                            <td>{{ $jadwal->auditee }}</td>
                            <td>{{ $jadwal->auditor }}</td>
                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_audit)->format('d-m-Y') }}</td>
                            <td>{{ $jadwal->waktu }}</td> 
                            <td>{{ $jadwal->lokasi }}</td> 
                            <td>{{ $jadwal->status }}</td> 
                            <td>
                                <a href="javascript:void(0)" 
                                   class="btn btn-sm btn-warning" 
                                   onclick="showEditModal({{ $jadwal->id }}, '{{ $jadwal->nama_kegiatan }}', '{{ $jadwal->auditee }}', '{{ $jadwal->auditor }}', '{{ $jadwal->tanggal_audit }}', '{{ $jadwal->waktu }}', 
                                       '{{ $jadwal->lokasi }}', 
                                       '{{ $jadwal->status }}')">
                                   Edit
                                </a>

                                <form id="form-delete-{{ $jadwal->id }}" action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $jadwal->id }})" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                   
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCreateLabel">Tambah Jadwal Audit</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="auditee">Auditee</label>
                        <input type="text" name="auditee" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="auditor">Auditor</label>
                        <input type="text" name="auditor" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_audit">Tanggal Audit</label>
                        <input type="date" name="tanggal_audit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="waktu">Waktu Audit</label>
                        <input type="time" name="waktu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi Audit</label>
                        <input type="text" name="lokasi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Belum">Belum</option>
                            <option value="Berlangsung">Berlangsung</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="editModalLabel">Edit Jadwal Audit</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit-id" name="id">
          <div class="mb-3">
            <label for="edit-nama_kegiatan">Nama Kegiatan</label>
            <input type="text" class="form-control" id="edit-nama_kegiatan" name="nama_kegiatan" required>
          </div>
          <div class="mb-3">
            <label for="edit-auditee">Auditee</label>
            <input type="text" class="form-control" id="edit-auditee" name="auditee" required>
          </div>
          <div class="mb-3">
            <label for="edit-auditor">Auditor</label>
            <input type="text" class="form-control" id="edit-auditor" name="auditor" required>
          </div>
          <div class="mb-3">
            <label for="edit-tanggal_audit">Tanggal</label>
            <input type="date" class="form-control" id="edit-tanggal_audit" name="tanggal_audit" required>
          </div>
          <div class="mb-3">
            <label for="edit-waktu">Waktu</label>
            <input type="time" class="form-control" id="edit-waktu" name="waktu" required>
          </div>
          <div class="mb-3">
            <label for="edit-lokasi">Lokasi</label>
            <input type="text" class="form-control" id="edit-lokasi" name="lokasi" required>
          </div>
          <div class="mb-3">
            <label for="edit-status">Status</label>
            <select class="form-control" id="edit-status" name="status" required>
              <option value="Belum">Belum</option>
              <option value="Berlangsung">Berlangsung</option>
              <option value="Selesai">Selesai</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

<!-- Script SweetAlert & showEditModal -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(id) {
    Swal.fire({
      title: 'Yakin ingin menghapus?',
      text: "Data jadwal ini akan dihapus permanen!",
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

  function showEditModal(id, nama_kegiatan, auditee, auditor, tanggal_audit, waktu, lokasi, status) {
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-nama_kegiatan').value = nama_kegiatan;
    document.getElementById('edit-auditee').value = auditee;
    document.getElementById('edit-auditor').value = auditor;
    document.getElementById('edit-tanggal_audit').value = tanggal_audit;
    document.getElementById('edit-waktu').value = waktu;
    document.getElementById('edit-lokasi').value = lokasi;
    document.getElementById('edit-status').value = status;

    document.getElementById('editForm').action = '/jadwal/' + id;

    var modal = new bootstrap.Modal(document.getElementById('editModal'));
    modal.show();
  }
</script>