<div class="modal fade" id="modal-logout" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Logout</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<span>Apa kamu yakin ?</span>
			</div>
			<div class="modal-footer justify-content-between">
				<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
				<a class="btn btn-primary" href="<?= base_url('dashboard/logout'); ?>">Yes <i class="fas fa-sign-out-alt"></i></a>
			</div>
		</div>
	</div>
</div>

<footer class="main-footer">
	<div class="float-right d-none d-sm-inline">
		Tugas Akhir - Universitas Pamulang
	</div>
	<strong>Copyright &copy; <?= date('Y') ?> <a href="https://adminlte.io" target="_blank">Seful Sidik</a>.</strong> All rights reserved.
</footer>
</div>
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
<?php $this->load->view('dashboard/v_js') ?>
<script>
	$(document).ready(function() {
		setInterval(function() {
			$("#ceksuhu").load("<?= base_url('check/suhu'); ?>");
			$("#cekkelembaban").load("<?= base_url('check/kelembaban'); ?>");
			$("#cekkipas").load("<?= base_url('check/kipas'); ?>");
			$("#cekkoto").load("<?= base_url('check/otomatis'); ?>");
			$("#cekdehumidifier").load("<?= base_url('check/dehumidifier'); ?>");
			$("#switchKipas").load("<?= base_url('switch/kipas'); ?>");
			$("#switchDehumidifier").load("<?= base_url('switch/dehumidifier'); ?>");
			$("#switchoto").load("<?= base_url('switch/otomatis'); ?>");
		}, 1000);

	});
</script>
<script type="text/javascript">
      $(document).ready(function() {
        setInterval(function() {
          $("#laporan").load("<?= base_url('laporan_log/result'); ?>");
          $("#laporan-harian").load("<?= base_url('laporan_harian/result'); ?>");
          $("#laporan-bulanan").load("<?= base_url('laporan_bulanan/result'); ?>");
        }, 1000);
      });
    </script>
</body>

</html>