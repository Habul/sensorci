<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();

      date_default_timezone_set('Asia/Jakarta');
      if ($this->session->userdata('status') != "iot_log") {
         redirect(base_url() . 'login?alert=belum_login');
      }
   }

   public function index()
   {
      $data['title'] = 'Dasboard';
      $data['user'] = $this->m_data->get_data('users')->num_rows();
      $this->load->view('dashboard/v_header', $data);
      $this->load->view('dashboard/v_index', $data);
      $this->load->view('dashboard/v_footer', $data);
   }

   public function logout()
   {
      $this->session->sess_destroy();
      redirect('login?alert=logout');
   }

   public function user()
   {
      $data['title'] = 'Master User';
      $data['users'] = $this->m_data->users()->result();
      $data['level'] = $this->m_data->get_data('user_level')->result();
      $this->load->view('dashboard/v_header', $data);
      $this->load->view('dashboard/v_user', $data);
      $this->load->view('dashboard/v_footer', $data);
   }

   public function add_user()
   {
      $this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[users.nama]');
      $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
      $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim');
      $this->form_validation->set_rules('password', 'Password', 'required');
      $this->form_validation->set_rules('level', 'Level', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');

      if ($this->form_validation->run() != false) {
         $nama = $this->input->post('nama');
         $username = $this->input->post('username');
         $no_hp = $this->input->post('no_hp');
         $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
         $level = $this->input->post('level');
         $alamat = $this->input->post('alamat');

         if (strlen($nama) > 4) {
            $initial = str_split($nama);
            $split = $initial[0] . $initial[2] . $initial[4];
         } else {
            $initial = str_split($nama);
            $split = $initial[0] . $initial[2] . $initial[3];
         }

         $data =
            [
               'nama' => $nama,
               'username' => $username,
               'password' => $password,
               'no_hp' => $no_hp,
               'alamat' => $alamat,
               'id_level' => $level,
               'created_at' => date('Y-m-d H:i:s')
            ];

         if ($level == '3') {
            $this->m_data->insert_data(['nama_mgr' => $split, 'id_level' => $level], 'mgr');
         } elseif ($level == '2') {
            $this->m_data->insert_data(['nama_spv' => $split, 'id_level' => $level], 'spv');
         }

         $this->m_data->insert_data($data, 'users');
         $this->session->set_flashdata('berhasil', 'Berhasil tambahkan user ' . ucwords($nama) . ' !');
         redirect(base_url('dashboard/user'));
      } else {
         $this->session->set_flashdata('gagal', 'Gagal tambahkan data !');
         redirect(base_url('dashboard/user'));
      }
   }

   public function edit_user()
   {
      $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
      $this->form_validation->set_rules('username', 'Username', 'required|trim');
      $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim');
      $this->form_validation->set_rules('level', 'Level', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');

      if ($this->form_validation->run() != false) {
         $nama = $this->input->post('nama');
         $username = $this->input->post('username');
         $no_hp = $this->input->post('no_hp');
         $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
         $level = $this->input->post('level');
         $alamat = $this->input->post('alamat');
         $id = $this->input->post('id');

         if ($this->input->post('password') == "") {
            $data =
               [
                  'nama' => $nama,
                  'username' => $username,
                  'no_hp' => $no_hp,
                  'alamat' => $alamat,
                  'id_level' => $level,
                  'updated_at' => date('Y-m-d H:i:s')
               ];
         } else {
            $data =
               [
                  'nama' => $nama,
                  'username' => $username,
                  'password' => $password,
                  'no_hp' => $no_hp,
                  'alamat' => $alamat,
                  'id_level' => $level,
                  'updated_at' => date('Y-m-d H:i:s')
               ];
         }

         $this->m_data->update_data(['id_user' => $id], $data, 'users');
         $this->session->set_flashdata('berhasil', 'Berhasil update user ' . ucwords($nama) . ' !');
         redirect(base_url('dashboard/user'));
      } else {
         $this->session->set_flashdata('gagal', 'Gagal update data !');
         redirect(base_url('dashboard/user'));
      }
   }

   public function del_user()
   {
      $id = $this->input->post('id');
      $nama = $this->input->post('nama');

      $this->m_data->delete_data(['id_user' => $id], 'users');
      $this->session->set_flashdata('berhasil', 'Berhasil hapus user ' . ucwords($nama) . ' !');
      redirect(base_url('dashboard/user'));
   }
}
