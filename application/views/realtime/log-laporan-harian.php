<?php
// Suhu max harian
$this->db->select_max('suhu');
$this->db->from("tb_log");
$this->db->where('tanggal', date('Y-m-d'));
$query = $this->db->get();
$rowSuhuMax = $query->row();
// Suhu min harian
$this->db->select_min('suhu');
$this->db->from("tb_log");
$this->db->where('tanggal', date('Y-m-d'));
$query = $this->db->get();
$rowSuhuMin = $query->row();
// Kelembaban max harian
$this->db->select_max('kelembaban');
$this->db->from("tb_log");
$this->db->where('tanggal', date('Y-m-d'));
$query = $this->db->get();
$rowKelMax = $query->row();
// Kelembaban min harian
$this->db->select_min('kelembaban');
$this->db->from("tb_log");
$this->db->where('tanggal', date('Y-m-d'));
$query = $this->db->get();
$rowKelMin = $query->row();

$suhu_max =  $rowSuhuMax->suhu;
$suhu_min =  $rowSuhuMin->suhu;
$kel_max =  $rowKelMax->kelembaban;
$kel_min =  $rowKelMin->kelembaban;

if ($suhu_max < 1) {
  $suhu_max = '0';
} else {
  $suhu_max;
}
if ($suhu_min < 1) {
  $suhu_min = '0';
} else {
  $suhu_min;
}
if ($kel_max < 1) {
  $kel_max = '0';
} else {
  $kel_max;
}
if ($kel_min < 1) {
  $kel_min = '0';
} else {
  $kel_min;
}
?>

<p><b>SUHU <br> </b>Max: <strong><?= $suhu_max ?>°C</strong>, Min: <strong><?= $suhu_min ?>°C</strong><br>
  <b>KELEMBABAN <br> </b>Max: <strong><?= $kel_max ?>%</strong>, Min: <strong><?= $kel_min ?>%</strong>
</p> <br>[<?= date('d F Y') ?>]