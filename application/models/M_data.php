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

   function get_index($table, $condition)
   {
      return $this->db->order_by($condition, 'desc')->get($table);
   }

   function insert_data($data, $table)
   {
      $this->db->insert($table, $data);
   }

   function edit_data($where, $table)
   {
      return $this->db->get_where($table, $where);
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
