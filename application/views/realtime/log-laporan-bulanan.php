<?php
// Suhu max harian
$this->db->select_max('suhu');
$this->db->from("tb_log");
$this->db->where('month(tanggal)', date('m'));
$query = $this->db->get();
$rowSuhuMax = $query->row();
// Suhu min harian
$this->db->select_min('suhu');
$this->db->from("tb_log");
$this->db->where('month(tanggal)', date('m'));
$query = $this->db->get();
$rowSuhuMin = $query->row();
// Kelembaban max harian
$this->db->select_max('kelembaban');
$this->db->from("tb_log");
$this->db->where('month(tanggal)', date('m'));
$query = $this->db->get();
$rowKelMax = $query->row();
// Kelembaban min harian
$this->db->select_min('kelembaban');
$this->db->from("tb_log");
$this->db->where('month(tanggal)', date('m'));
$query = $this->db->get();
$rowKelMin = $query->row();

$suhu_max =  $rowSuhuMax->suhu;
$suhu_min =  $rowSuhuMin->suhu;
$kel_max =  $rowKelMax->kelembaban;
$kel_min =  $rowKelMin->kelembaban;
?>

<p><b>SUHU <br> </b>Max: <strong><?=$suhu_max?>°C</strong>, Min: <strong><?=$suhu_min?>°C</strong><br>
<b>KELEMBABAN <br> </b>Max: <strong><?=$kel_max?>%</strong>, Min: <strong><?=$kel_min?>%</strong></p> <br>[<?=date('F Y')?>]