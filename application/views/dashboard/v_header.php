<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Internet Of Things | <?= $title ?></title>
	<link rel='icon' href="<?= base_url('assets/img/unpamm.png') ?>" type="image/gif">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body class="hold-transition layout-top-nav">
	<div class="wrapper">

		<nav class="main-header navbar navbar-expand-md navbar-light navbar-white shadow-sm">
			<div class="container">
				<a href="#" class="navbar-brand">
					<img src="<?= base_url('assets/img/unpam.png') ?>" alt="Indomaret" class="brand-image " style="opacity: .8">
					<span class="brand-text font-weight-light">Universitas Pamulang</span>
				</a>

				<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse order-3" id="navbarCollapse">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="<?= base_url('dashboard'); ?>" <?= $this->uri->uri_string() == 'dashboard'	? 'class="nav-link active"' : 'class="nav-link"' ?>>
								<i class="fas fa-home"></i> Dashboard</a>
						</li>
						<li class="nav-item">
							<a <?= $this->uri->uri_string() == 'dashboard/user' ? 'class="nav-link active"' : 'class="nav-link"' ?> href="<?= base_url('dashboard/user'); ?>">
								<i class="fas fa-users"></i>
								Users
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('event/report'); ?>" <?= $this->uri->uri_string() == 'event/report' || $this->uri->uri_string() == 'event/reports' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
								<i class="fas fa-file-invoice"></i>
								Report
							</a>
						</li>
					</ul>
				</div>

				<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
					<li class="nav-item">
						<span class="nav-link" id='hclock'><?php mdate('%Y-%m-%d %H:%i:%s') ?></span>
						</a>
					</li>
					<li class="nav-item dropdown user-menu <?= $this->uri->uri_string() == 'dashboard/profile'	? 'active' : '' ?>">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
							<img src="<?= base_url('assets/img/') . $this->session->userdata('image'); ?>" class="user-image img-circle elevation-2" alt="User Image">
							<span class="d-none d-md-inline"><?= ucwords($this->session->userdata('username')) ?>&nbsp;<i class="fas fa-angle-down right"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<li class="user-header">
								<img src="<?= base_url('assets/img/') . $this->session->userdata('image'); ?>" class="img-circle elevation-2" alt="User Image">
								<p class="text-muted">
									<?= ucwords($this->session->userdata('name'))  ?>
								</p>
							</li>
							<li class="user-footer">
								<a href="<?= base_url('dashboard/profile') ?>" class="btn btn-default border-0" title="Profile"><i class="fas fa-user-tie"></i> Profile</a>
								<a data-toggle="modal" data-target="#modal-logout" class="btn btn-default float-right border-0" title="Sign out"><i class="fas fa-sign-out-alt"></i> Logout</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>