<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
  <title>Sensor Realtime - IoT</title>

  <script type="text/javascript" src="jquery/jquery.min.js"></script>
  <!-- load otomatis / realtime -->

</head>

<body>
  <div class="container" style="text-align: center; margin-top: 30px">
    <img src="<?php echo base_url(); ?>assets/unpam.png" style="width: 100px">
    <h2 class="mb-4">
      Menampilkan Log Sensor
    </h2>

    <div class="row" style="display: flex;">
      <div class="col-md-4">
        <div class="card shadow-0 border mb-2">
          <div class="card-body p-4">
            <h4 class="mb-1 sfw-normal"><b>Laporan Harian</b></h4>
            <span id="laporan-harian"></span>
          </div>
        </div>
        <div class="card shadow-0 border mb-2">
          <div class="card-body p-4">
            <h4 class="mb-1 sfw-normal"><b>Laporan Bulanan</b></h4>
            <span id="laporan-bulanan"></span>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Suhu</th>
              <th scope="col">Kelembaban</th>
              <th scope="col">Waktu</th>
            </tr>
          </thead>
          <tbody id="laporan">
          </tbody>
        </table>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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