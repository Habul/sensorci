<?php

use Svg\Tag\Group;

class M_data extends CI_Model
{

   function cek_login($table, $where)
   {
      return $this->db->get_where($table, $where);
   }

   function get_data($table)
   {
      return $this->db->get($table);
   }

   function get_index($table, $index, $condition)
   {
      return $this->db->order_by($condition, $index)->get($table);
   }

   function get_index2($table, $condition1)
   {
      return $this->db->order_by($condition1)->get($table);
   }

   public function get_count_all($table)
   {
      return $this->db->count_all($table);
   }

   public function get_count($minvalue, $maxvalue, $table)
   {
      $this->db->where("tanggal BETWEEN '$minvalue' AND '$maxvalue'");
      return $this->db->get($table);
   }

   public function get_pagination($limit, $start, $index, $table)
   {
      $this->db->limit($limit, $start);
      $this->db->order_by($index);
      $query = $this->db->get($table);

      return $query->result();
   }

   public function get_pagination_search($limit, $start, $minvalue, $maxvalue, $index, $table)
   {
      $this->db->limit($limit, $start);
      $this->db->where("tanggal BETWEEN '$minvalue' AND '$maxvalue'");
      $this->db->order_by($index);
      $query = $this->db->get($table);

      return $query->result();
   }

   function getpaginationsearch($perPage, $start_index, $minvalue = null, $maxvalue = null,  $is_count = 0)
   {
      if ($perPage != '' && $start_index != '') {
         $this->db->limit($perPage, $start_index);
      }

      if ($minvalue != null && $maxvalue != null) {
         $this->db->where("tanggal BETWEEN '$minvalue' AND '$maxvalue'");
      }

      if ($is_count == 1) {
         $query = $this->db->get('tb_log');
         return $query->num_rows();
      } else {
         $query = $this->db->get('tb_log');
         return $query->result_array();
      }
   }

   public function get_limit($limit, $index, $table)
   {
      $this->db->order_by($index);
      $this->db->limit($limit);
      return $this->db->get($table);
   }

   function insert_data($data, $table)
   {
      $this->db->insert($table, $data);
   }

   function edit_data($where, $table)
   {
      return $this->db->get_where($table, $where);
   }

   function edit_data_row($where, $table, $select)
   {
      $this->db->select($select);
      $this->db->from($table);
      $this->db->where($where);
      return $this->db->get();
   }

   function edit_data_index($where, $table, $condition)
   {
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where($where);
      $this->db->order_by($condition, 'desc');
      return $this->db->get();
   }

   function multiple_edit($where, $where2, $table)
   {
      return $this->db->where($where)->where($where2)->get($table);
   }

   function update_data($where, $data, $table)
   {
      $this->db->where($where);
      $this->db->update($table, $data);
   }

   function update_multi($where, $where2, $where3, $data, $table)
   {
      $this->db->where($where);
      $this->db->where($where2);
      $this->db->where($where3);
      $this->db->update($table, $data);
   }

   function delete_data($where, $table)
   {
      $this->db->delete($table, $where);
   }
}
