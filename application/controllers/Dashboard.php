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

   public function profile()
   {

      $where =
         [
            'id' => $this->session->userdata('id')
         ];

      $data['title'] = 'Profile';
      $data['profile'] = $this->m_data->edit_data($where, 'users')->result();

      $this->load->view('dashboard/v_header', $data);
      $this->load->view('dashboard/v_profile', $data);
      $this->load->view('dashboard/v_footer');
   }

   public function profile_update()
   {
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('username', 'Username', 'required');

      if ($this->form_validation->run() != false) {

         $id = $this->session->userdata('id');
         $name = $this->input->post('name');
         $username = $this->input->post('username');

         $data =
            [
               'name' => $name,
               'username' => $username
            ];

         $this->m_data->update_data(['id' => $id], $data, 'users');
         $this->session->set_flashdata('berhasil', 'Update Profile ' . $name . ' successfully !');

         if (!empty($_FILES['images']['name'])) {
            $config['upload_path']   = './assets/img/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite']     = true;
            $config['max_size']      = 1024;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('images')) {
               $gambar = $this->upload->data();

               $image = $gambar['file_name'];

               $data =
                  [
                     'image' => $image
                  ];

               $where =
                  [
                     'id' => $this->session->userdata('id')
                  ];

               $this->m_data->update_data($where, $data, 'users');
               $this->session->set_flashdata('berhasil', 'Update Image Profile ' . $name . ' successfully !');
            }
         }
         redirect(base_url('dashboard/profile'));
      } else {

         $where =
            [
               'id' => $this->session->userdata('id')
            ];

         $data['profile'] = $this->m_data->edit_data($where, 'users')->result();
         $this->session->set_flashdata('ulang', 'Profile failed to update, Please repeat !');
         $this->load->view('dashboard/v_header');
         $this->load->view('dashboard/v_profile', $data);
         $this->load->view('dashboard/v_footer');
      }
   }

   public function change_password()
   {
      $this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
      $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[6]', 'required|matches[password_lama]');
      $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password Baru', 'required|matches[password_baru]');

      if ($this->form_validation->run() != false) {

         $password_lama = $this->input->post('password_lama');
         $password_baru = $this->input->post('password_baru');
         $konfirmasi_password = $this->input->post('konfirmasi_password');

         $where = array(
            'id' => $this->session->userdata('id')
         );

         $cek = $this->m_data->cek_login('users', $where);

         if ($cek->num_rows() > 0) {
            $hasil = $cek->row();
            if (password_verify($password_lama, $hasil->password)) {
               $w = array(
                  'id' => $this->session->userdata('id')
               );
               $data = array(
                  'password' => password_hash($password_baru, PASSWORD_DEFAULT)
               );
               $this->m_data->update_data($where, $data, 'users');
               $this->session->set_flashdata('berhasil', 'Update password successfully !');
               redirect('dashboard/profile');
            } else {
               $this->session->set_flashdata('gagal', 'Password does not match !');
               redirect('dashboard/profile');
            }
         }
      } else {
         $this->session->set_flashdata('ulang', 'Password must be 6 digits or password not match!');
         redirect('dashboard/profile');
      }
   }
}
