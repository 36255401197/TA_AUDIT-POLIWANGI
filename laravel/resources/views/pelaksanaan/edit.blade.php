@extends('layouts.DashboardAudit.dashboard')

@section('content')
<div class="container mt-4">
  <h5>Edit Data Kertas Kerja Auditor</h5>

  <form action="{{ route('pelaksanaan.update', $pelaksanaanAudit->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="standar" class="form-label">Standar</label>
      <input type="text" name="standar" id="standar" class="form-control @error('standar') is-invalid @enderror" value="{{ old('standar', $pelaksanaanAudit->standar) }}">
      @error('standar')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="indikator" class="form-label">Indikator</label>
      <textarea name="indikator" id="indikator" rows="3" class="form-control @error('indikator') is-invalid @enderror">{{ old('indikator', $pelaksanaanAudit->indikator) }}</textarea>
      @error('indikator')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="kode" class="form-label">Kode</label>
      <input type="text" name="kode" id="kode" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode', $pelaksanaanAudit->kode) }}">
      @error('kode')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="temuan" class="form-label">Temuan</label>
      <textarea name="temuan" id="temuan" rows="2" class="form-control">{{ old('temuan', $pelaksanaanAudit->temuan) }}</textarea>
    </div>

    <div class="mb-3">
      <label for="kepatuhan" class="form-label">Kepatuhan</label>
      <select name="kepatuhan" id="kepatuhan" class="form-select @error('kepatuhan') is-invalid @enderror">
        <option value="">-- Pilih --</option>
        <option value="SESUAI" {{ (old('kepatuhan', $pelaksanaanAudit->kepatuhan) == 'SESUAI') ? 'selected' : '' }}>SESUAI</option>
        <option value="TIDAK SESUAI" {{ (old('kepatuhan', $pelaksanaanAudit->kepatuhan) == 'TIDAK SESUAI') ? 'selected' : '' }}>TIDAK SESUAI</option>
      </select>
      @error('kepatuhan')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="tanggapan_auditi" class="form-label">Tanggapan Auditi</label>
      <textarea name="tanggapan_auditi" id="tanggapan_auditi" rows="2" class="form-control">{{ old('tanggapan_auditi', $pelaksanaanAudit->tanggapan_auditi) }}</textarea>
    </div>

    <div class="mb-3">
      <label for="akar_masalah" class="form-label">Akar Masalah</label>
      <textarea name="akar_masalah" id="akar_masalah" rows="2" class="form-control">{{ old('akar_masalah', $pelaksanaanAudit->akar_masalah) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('pelaksanaan.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
