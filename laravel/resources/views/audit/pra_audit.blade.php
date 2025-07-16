@extends('layouts.DashboardAudit.dashboard')

@section('content')
 <h4 class="page-title">Pengisian Pra Audit</h4>
 <div class="card shadow-sm mt-4">
    <div class="card-body">
        <h4 class="mb-4 text-primary font-weight-bold">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checklist"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" /><path d="M14 19l2 2l4 -4" /><path d="M9 8h4" /><path d="M9 12h2" /></svg>
             Penyusunan Indikator Audit</h4>

        <!-- Pilih Kategori Audit -->
        <div class="form-group">
            <label for="kategoriAudit" class="font-weight-semibold text-dark" style="font-size: 16px;">Pilih Kategori Audit</label>
            <select id="kategoriAudit" class="form-control form-control-lg">
                <option selected disabled>-- Pilih Kategori --</option>
                <option value="akademik">Akademik</option>
                <option value="keuangan">Keuangan</option>
                <option value="sdm">SDM</option>
                <option value="it">Teknologi Informasi</option>
            </select>
        </div>

        <!-- Checklist Indikator -->
        <div class="form-group mt-4">
            <label class="font-weight-semibold text-dark" style="font-size: 16px;">Checklist Indikator Audit</label>

            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="indikator1">
                <label class="form-check-label" for="indikator1" style="font-size: 15px;">
                    ✅ Indikator 1: Kepatuhan terhadap kebijakan
                </label>
            </div>

            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="indikator2">
                <label class="form-check-label" for="indikator2" style="font-size: 15px;">
                    ✅ Indikator 2: Efisiensi penggunaan sumber daya
                </label>
            </div>

            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="indikator3">
                <label class="form-check-label" for="indikator3" style="font-size: 15px;">
                    ✅ Indikator 3: Keamanan data dan informasi
                </label>
            </div>

            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="indikator4">
                <label class="form-check-label" for="indikator4" style="font-size: 15px;">
                    ✅ Indikator 4: Kualitas layanan
                </label>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="text-right mt-4">
            <button class="btn btn-lg btn-primary px-4 shadow-sm">
                💾 Simpan Indikator
            </button>
        </div>
    </div>
</div>


@endsection