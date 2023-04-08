<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Sensor extends CI_Model
{
	public function getDataSensor()
	{
		$this->db->select('*');
		$this->db->from('tb_sensor');
		$query = $this->db->get();
		return $query->row();
	}

	public function getDataSensorLast()
	{
		$this->db->select('*');
		$this->db->from('tb_sensor');
		$query = $this->db->get();
		return $query->row();
	}

	public function getDataSensoroto($field)
	{
		$this->db->select($field);
		$this->db->from('tb_sensor');
		$query = $this->db->get();
		return $query->row();
	}

	function get_data($table)
	{
		return $this->db->get($table);
	}

	public function EditDataSensor($data)
	{
		$this->db->update('tb_sensor', $data);
	}

	public function InsertDataSensorLog($data)
	{
		$this->db->insert('tb_log', $data);
	}
}
