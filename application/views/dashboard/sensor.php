<?php
defined('BASEPATH') or exit('No direct script access allowed');

$this->db->select('kipas, dehumidifier');
$this->db->from("tb_sensor");
$query = $this->db->get();
$row = $query->row();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Sensor Realtime - IoT</title>

  <script type="text/javascript" src="jquery/jquery.min.js"></script>
  <!-- load otomatis / realtime -->

</head>

<body>
  <div class="container" style="text-align: center; margin-top: 30px">
    <img src="<?php echo base_url(); ?>assets/unpam.png" style="width: 100px">
    <h2>
      Menampilkan Nilai Sensor Secara Realtime<br>
      Pada <b style="color: red">Lab Kalibrasi</b>
    </h2>
    <a href="<?= base_url('laporan') ?>" class="btn btn-warning" type="button"><b>Laporan</b></a>

    <div class="row" style="display: flex; justify-content: center;">
      <div class="col-md-6">
        <div class="card text-center" style="margin-top: 20px;">
          <div class="card-header" style="background-color: red; color: white">
            <h2 style="font-weight: bold">Suhu</h2>
          </div>
          <div class="card-body">
            <h1><span id="ceksuhu">-</span></h1>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card text-center" style="margin-top: 20px;">
          <div class="card-header" style="background-color: red; color: white">
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
          <div class="card-header" style="background-color: red; color: white">
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
          <div class="card-header" style="background-color: red; color: white">
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
          <div class="card-header" style="background-color: red; color: white">
            <h2 style="font-weight: bold">Dehumidifier</h2>
          </div>
          <div class="card-body">
            <h1><span id="cekdehumidifier">-</span></h1>
            <span id="switchDehumidifier"></span>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
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
</body>

</html>