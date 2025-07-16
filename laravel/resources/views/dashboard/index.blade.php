<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ready Bootstrap Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="../assets/css/ready.css">
	<link rel="stylesheet" href="../assets/css/demo.css">
	<link rel="stylesheet" href="../assets/css/ready.css">
    <link rel="stylesheet" href="../assets/css/demo.css">
    <!-- Tambahkan di bawah ini -->
	 <style>
        .border-left-primary {
            border-left: 4px solid #007bff !important;
        }
        .border-left-success {
            border-left: 4px solid #28a745 !important;
        }
        .border-left-warning {
            border-left: 4px solid #ffc107 !important;
        }
        .border-left-info {
            border-left: 4px solid #17a2b8 !important;
        }
    </style>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			
			<div class="logo-header">

				<a href="index.html" class="logo">
					 Audit System
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<!-- navbar -->
             @include('layouts.navbar')
			</div>
			<!-- sidebar -->
             @include('layouts.sidebar')
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Dashboard Lead Auditor</h4>
						
						<div class="row">
    <!-- Audit Berlangsung -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-left-primary">
            <div class="card-body d-flex align-items-center">
                <div class="icon-big text-primary mr-3">
                    <i class="la la-users fa-2x"></i>
                </div>
                <div>
                    <a href="/audit/pra_audit/index" class="text-decoration-none text-dark">
                        <p class="mb-1">Audit Berlangsung</p>
                        <h4 class="font-weight-bold text-primary">3</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Audit Total -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-left-success">
            <div class="card-body d-flex align-items-center">
                <div class="icon-big text-success mr-3">
                    <i class="la la-bar-chart fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1">Total Audit</p>
                    <h4 class="font-weight-bold text-success">5</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Ruangan -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-left-warning">
            <div class="card-body d-flex align-items-center">
                <div class="icon-big text-warning mr-3">
                    <i class="la la-newspaper-o fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1">Ruangan</p>
                    <h4 class="font-weight-bold text-warning">B5</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Audit Selesai -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-left-info">
            <div class="card-body d-flex align-items-center">
                <div class="icon-big text-info mr-3">
                    <i class="la la-check-circle fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1">Audit Selesai</p>
                    <h4 class="font-weight-bold text-info">2</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Audit Terbaru -->
<div class="card mt-5 shadow-sm border-0">
    <div class="card-header bg-primary text-white">
        <h6 class="mb-0">📊 Audit Terbaru</h6>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Auditee</th>
                    <th>Jenis Audit</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($audits->sortByDesc('tanggal')->take(5) as $audit)
                    <tr>
                        <td>{{ $audit->auditee }}</td>
                        <td>{{ ucfirst($audit->jenis_audit) }}</td>
                        <td>{{ \Carbon\Carbon::parse($audit->tanggal)->format('d M Y') }}</td>
                        <td>
                            <span class="badge badge-{{ $audit->status == 'selesai' ? 'success' : 'primary' }}">
                                {{ ucfirst($audit->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada data audit.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Catatan Penting -->
<div class="card mt-4 border-0 shadow-sm">
    <div class="card-header bg-warning text-dark">
        <h6 class="mb-0">📌 Catatan Penting</h6>
    </div>
    <div class="card-body">
        <p class="mb-0">
            Pastikan semua auditee sudah mengisi tanggapan untuk audit yang sedang berjalan.  
            Periksa status dan tanggal pada tabel di atas sebelum tanggal audit berakhir.
        </p>
    </div>
</div>


</body>
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugin/chartist/chartist.min.js"></script>
<script src="../assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="../assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/js/ready.min.js"></script>
<script src="../assets/js/demo.js"></script>
</html>