<div class="modal fade" id="auditModal" tabindex="-1" aria-labelledby="auditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('dashboard.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Audit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="auditee" class="form-control mb-2" placeholder="Auditee" required>
                <select name="status" class="form-control mb-2" required>
                    <option value="">Pilih Status</option>
                    <option>Belum Ditindaklanjuti</option>
                    <option>Dalam Proses</option>
                    <option>Selesai</option>
                </select>
                <select name="jenis_audit" class="form-control mb-2" required>
                    <option value="">Pilih Jenis</option>
                    <option>Internal</option>
                    <option>Eksternal</option>
                </select>
                <input type="date" name="tanggal" class="form-control mb-2" required>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </form>
  </div>
</div>
