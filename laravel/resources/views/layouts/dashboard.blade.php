@extends('layouts.DashboardAudit.dashboard')
@section('content')
<div class="container py-4 px-4">
    
    <h4>Dashboard Lead Auditor</h4>

    <!-- Daftar Audit -->
    <div class="card">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Daftar Audit</h5>
        <button class="btn btn-primary btn-sm">+ Buat Audit Baru</button>
      </div>

      <div class="row mb-3">
        <div class="col-md-3">
          <select class="form-select">
            <option>Status</option>
            <option>Selesai</option>
            <option>Dalam Proses</option>
            <option>Belum Mulai</option>
          </select>
        </div>
        <div class="col-md-3">
          <input type="date" class="form-control">
        </div>
        <div class="col-md-3 ms-auto">
          <input type="text" class="form-control" placeholder="Cari...">
        </div>
      </div>

      <table class="table table-bordered align-middle text-center">
        <thead>
          <tr>
            <th>NO</th>
            <th>NAMA AUDIT</th>
            <th>UNIT</th>
            <th>STATUS</th>
            <th>TANGGAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td class="text-start">Audit Keuangan 2023</td>
            <td>Finance</td>
            <td><span class="badge badge-selesai">Selesai</span></td>
            <td>01/01/2023</td>
          </tr>
          <tr>
            <td>2</td>
            <td class="text-start">Audit Operasional 2023</td>
            <td>Operations</td>
            <td><span class="badge badge-proses">Dalam Proses</span></td>
            <td>15/02/2023</td>
          </tr>
          <tr>
            <td>3</td>
            <td class="text-start">Audit IT 2023</td>
            <td>IT</td>
            <td><span class="badge badge-belum">Belum Mulai</span></td>
            <td>01/03/2023</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Daftar Auditee -->
    <div class="card">
      <h5>Daftar Auditee</h5>
      <table class="table table-bordered align-middle text-center">
        <thead>
          <tr>
            <th>NO</th>
            <th>NAMA AUDITEE</th>
            <th>UNIT</th>
            <th>STATUS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td class="text-start">hairudin</td>
            <td>Finance</td>
            <td><span class="badge badge-selesai">Selesai</span></td>
          </tr>
          <tr>
            <td>2</td>
            <td class="text-start">samsi</td>
            <td>Operations</td>
            <td><span class="badge badge-proses">Dalam Proses</span></td>
          </tr>
          <tr>
            <td>3</td>
            <td class="text-start">kamirudin</td>
            <td>IT</td>
            <td><span class="badge badge-belum">Belum Mulai</span></td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
@endsection