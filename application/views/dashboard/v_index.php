	<div class="content-wrapper">
		<div class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0"></h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<section class="content">
			<div class="container">
				<h2 class="text-center">
					Menampilkan Nilai Sensor Secara Realtime<br>
					Pada <b style="color: #26b49a;">Lab Kalibrasi</b>
				</h2>
				<!-- <a href="<?= base_url('laporan') ?>" class="btn btn-warning" type="button"><b>Laporan</b></a> -->

				<div class="row" style="display: flex; justify-content: center;">
					<div class="col-md-6">
						<div class="card text-center" style="margin-top: 20px;">
							<div class="card-header" style="background-color: #26b49a; color: white">
								<h2 style="font-weight: bold">Suhu</h2>
							</div>
							<div class="card-body">
								<h1><span id="ceksuhu">-</span></h1>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="card text-center" style="margin-top: 20px;">
							<div class="card-header" style="background-color: #26b49a; color: white">
								<h2 style="font-weight: bold">Kelembaban</h2>
							</div>
							<div class="card-body">
								<h1><span id="cekkelembaban">-</span></h1>
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="display: flex; justify-content: center;">
					<div class="col-md-4">
						<div class="card text-center" style="margin-top: 20px;">
							<div class="card-header" style="background-color: #26b49a; color: white">
								<h2 style="font-weight: bold">Kipas</h2>
							</div>
							<div class="card-body">
								<h1><span id="cekkipas">-</span></h1>
								<span id="switchKipas"></span>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="card text-center" style="margin-top: 20px;">
							<div class="card-header" style="background-color: #26b49a; color: white">
								<h2 style="font-weight: bold">Otomatis</h2>
							</div>
							<div class="card-body">
								<h1><span id="cekkoto">-</span></h1>
								<span id="switchoto"></span>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="card text-center" style="margin-top: 20px; width:">
							<div class="card-header" style="background-color: #26b49a; color: white">
								<h2 style="font-weight: bold">Dehumidifier</h2>
							</div>
							<div class="card-body">
								<h1><span id="cekdehumidifier">-</span></h1>
								<span id="switchDehumidifier"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>