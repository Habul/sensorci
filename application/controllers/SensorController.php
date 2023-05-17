<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SensorController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        // if ($this->session->userdata('status') != "iot_log") {
        // 	redirect(base_url() . 'login?alert=belum_login');
        // }
        $this->load->model('M_Sensor');
    }

    public function index()
    {
        $this->load->view('dashboard/sensor');
    }

    public function laporan()
    {
        $this->load->view('dashboard/laporan');
    }

    public function check_suhu()
    {
        $recordSensor = $this->M_Sensor->getDataSensor();
        $DATA = array('data_sensor' => $recordSensor);

        $this->load->view('realtime/cek_suhu', $DATA);
    }

    public function check_kelembaban()
    {
        $recordSensor = $this->M_Sensor->getDataSensor();
        $DATA = array('data_sensor' => $recordSensor);

        $this->load->view('realtime/cek_kelembaban', $DATA);
    }

    public function check_kipas()
    {
        $recordSensor = $this->M_Sensor->getDataSensor();
        $DATA = array('data_sensor' => $recordSensor);

        $this->load->view('realtime/cek_kipas', $DATA);
    }

    public function switch_kipas()
    {
        $recordSensor = $this->M_Sensor->getDataSensor();
        $DATA = array('data_sensor' => $recordSensor);

        $this->load->view('realtime/switch_kipas', $DATA);
    }

    public function check_otomatis()
    {
        $recordSensor = $this->M_Sensor->getDataSensor();
        $DATA = array('data_sensor' => $recordSensor);

        $this->load->view('realtime/cek_otomatis', $DATA);
    }

    public function switch_otomatis()
    {
        $recordSensor = $this->M_Sensor->getDataSensor();
        $DATA = array('data_sensor' => $recordSensor);

        $this->load->view('realtime/switch_otomatis', $DATA);
    }

    public function kipas_on()
    {
        $DataInsert = array(
            'kipas' => '1'
        );
        $this->M_Sensor->EditDataSensor($DataInsert);
        redirect(base_url('/'));
    }
    public function kipas_off()
    {
        $DataInsert = array(
            'kipas' => '0'
        );
        $this->M_Sensor->EditDataSensor($DataInsert);
        redirect(base_url('/'));
    }

    public function otomatis_on()
    {
        $DataInsert = array(
            'otomatis' => '1'
        );
        $this->M_Sensor->EditDataSensor($DataInsert);
        redirect(base_url('/'));
    }

    public function otomatis_off()
    {
        $DataInsert = array(
            'otomatis' => '0'
        );
        $this->M_Sensor->EditDataSensor($DataInsert);
        redirect(base_url('/'));
    }

    public function check_dehumidifier()
    {
        $recordSensor = $this->M_Sensor->getDataSensor();
        $DATA = array('data_sensor' => $recordSensor);

        $this->load->view('realtime/cek_dehumidifier', $DATA);
    }

    public function switch_dehumidifier()
    {
        $recordSensor = $this->M_Sensor->getDataSensor();
        $DATA = array('data_sensor' => $recordSensor);

        $this->load->view('realtime/switch_dehumidifier', $DATA);
    }

    public function dehumidifier_on()
    {
        $DataInsert = array(
            'dehumidifier' => '1'
        );
        $this->M_Sensor->EditDataSensor($DataInsert);
        redirect(base_url('/'));
    }
    public function dehumidifier_off()
    {
        $DataInsert = array(
            'dehumidifier' => '0'
        );
        $this->M_Sensor->EditDataSensor($DataInsert);
        redirect(base_url('/'));
    }

    public function update()
    {
        $suhu =  floatval($this->uri->segment(2));
        $kelembaban = floatval($this->uri->segment(3));
        $oto = $this->M_Sensor->getDataSensoroto('otomatis');

        if ($oto->otomatis == "1") {
            if ($suhu >= "25") {
                $kipas = "1";
            } else {
                $kipas = "0";
            }

            if ($kelembaban >= "50") {
                $dehumidifier = "1";
            } else {
                $dehumidifier = "0";
            }
        }

        if ($oto->otomatis == "1") {
            $DataInsert =
                [
                    'suhu' => $suhu,
                    'kelembaban' => $kelembaban,
                    'kipas'    => $kipas,
                    'dehumidifier' =>    $dehumidifier
                ];
        } else {
            $DataInsert =
                [
                    'suhu' => $suhu,
                    'kelembaban' => $kelembaban,
                ];
        }
        $this->M_Sensor->EditDataSensor($DataInsert);

        $DataInsert = array(
            'suhu' => $suhu,
            'kelembaban' => $kelembaban,
            'tanggal'    => date('Y-m-d'),
            'waktu'    => date('H:i:s')
        );

        $this->M_Sensor->InsertDataSensorLog($DataInsert);
    }

    public function arduino_kipas()
    {
        $recordSensor = $this->M_Sensor->getDataSensor();
        $DATA = array('data_sensor' => $recordSensor);

        $this->load->view('realtime/arduino_kipas', $DATA);
    }

    public function arduino_dehumidifier()
    {
        $recordSensor = $this->M_Sensor->getDataSensor();
        $DATA = array('data_sensor' => $recordSensor);

        $this->load->view('realtime/arduino_dehumidifier', $DATA);
    }

    // public function laporan_log_result()
    // {
    // 	$this->load->view('realtime/log-laporan');
    // }

    public function laporan_harian_result()
    {
        $this->load->view('realtime/log-laporan-harian');
    }

    public function laporan_bulanan_result()
    {
        $this->load->view('realtime/log-laporan-bulanan');
    }
}
