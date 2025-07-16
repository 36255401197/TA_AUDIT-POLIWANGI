<div class="sidebar bg-primary text-white" style="width: 250px; height: 100vh; position: fixed; display: flex; flex-direction: column;">

    {{-- Bagian logo dan user info --}}
    <div class="text-center p-3" style="flex-shrink: 0;">
        <img src="{{ asset('assets/img/logo_poliwangi.png') }}" alt="Logo Poliwangi"
             style="max-width: 120px; height: auto; object-fit: contain;" class="mb-3">
        <h5 class="mb-1">Audit System</h5>
        <small>{{ Auth::user()->name }}</small><br>
        <span class="badge bg-light text-dark mt-1">{{ Auth::user()->role }}</span>
    </div>

    <hr class="bg-light my-0">

    {{-- Bagian menu yang bisa scroll --}}
    <div class="sidebar-wrapper p-3" style="overflow-y: auto; flex-grow: 1;">
        <ul class="nav flex-column">
            <li class="nav-item mb-3">
                <a href="/dashboard" class="nav-link text-white d-flex align-items-center">
                    <i class="la la-home mr-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="/audit/jadwalaudit" class="nav-link text-white d-flex align-items-center">
                    <i class="la la-calendar mr-2"></i> Jadwal Audit
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="/audit/pra_audit" class="nav-link text-white d-flex align-items-center">
                    <i class="la la-tasks mr-2"></i> Pra Audit
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="/audit/pelaksanaan_audit" class="nav-link text-white d-flex align-items-center">
                    <i class="la la-check-circle mr-2"></i> Pelaksanaan Audit
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="/audit/pelaporan_hasil_audit" class="nav-link text-white d-flex align-items-center">
                    <i class="la la-file-text mr-2"></i> Pelaporan Hasil
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="/users" class="nav-link text-white d-flex align-items-center">
                    <i class="la la-users mr-2"></i> Kelola User
                </a>
            </li>
        </ul>
    </div>
</div>
