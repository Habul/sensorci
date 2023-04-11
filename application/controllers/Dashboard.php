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
      $data['title'] = 'Users';
      $data['users'] = $this->m_data->get_index('users', 'asc', 'created_at')->result();
      $this->load->view('dashboard/v_header', $data);
      $this->load->view('dashboard/v_user', $data);
      $this->load->view('dashboard/v_footer', $data);
   }

   public function add_user()
   {
      $this->form_validation->set_rules('name', 'Nama', 'required|trim|is_unique[users.name]');
      $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if ($this->form_validation->run() != false) {
         $name     = $this->input->post('name');
         $username = $this->input->post('username');
         $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
         $foto     = $this->input->post('foto');

         if (!empty($_FILES['foto']['name'])) {
         $config['upload_path']   = './assets/img/';
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
         $config['overwrite']     = true;
         $config['max_size']      = 1024;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('foto')) {
            $gambar = $this->upload->data();
            $file   = $gambar['file_name'];
            }
         }
           
            if ($foto == ' ')
            {
               $data =
               [
                  'name'       => $name,
                  'username'   => $username,
                  'password'   => $password,
                  'status'     => '1',
                  'created_at' => date('Y-m-d H:i:s')
               ];
            }
            else
            {
               $data =
               [
                  'name'       => $name,
                  'username'   => $username,
                  'password'   => $password,
                  'image'      => $file,
                  'status'     => '1',
                  'created_at' => date('Y-m-d H:i:s'),
               ];
            }
         
         $this->m_data->insert_data($data, 'users');
         $this->session->set_flashdata('berhasil', 'Successfully added user ' . ucwords($name) . ' !');
         redirect(base_url('dashboard/user'));
      } else {
         $this->session->set_flashdata('gagal', 'Failed to add data !');
         redirect(base_url('dashboard/user'));
      }
   }

   public function edit_user()
   {
      $this->form_validation->set_rules('name', 'Name', 'required|trim');
      $this->form_validation->set_rules('username', 'Username', 'required|trim');

      if ($this->form_validation->run() != false) {
         $name     = $this->input->post('name');
         $username = $this->input->post('username');
         $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
         $foto     = $this->input->post('foto');
         $id       = $this->input->post('id');

         if (!empty($_FILES['foto']['name'])) {
            $config['upload_path']   = './assets/img/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite']     = true;
            $config['max_size']      = 1024;
   
            $this->load->library('upload', $config);
   
            if ($this->upload->do_upload('foto')) {
               $gambar = $this->upload->data();
   
               $id = $this->input->post('id');
               $file = $gambar['file_name'];
               }
            }

         if ($password == ' ' && $foto == ' ') {
            $data =
               [
                  'name'       => $name,
                  'username'   => $username,
                  'updated_at' => date('Y-m-d H:i:s')
               ];
         } elseif ($password != ' ' && $foto == ' ') {
            $data =
               [
                  'name'       => $name,
                  'username'   => $username,
                  'password'   => $password,         
                  'updated_at' => date('Y-m-d H:i:s')
               ];
         } elseif ($password == ' ' && $foto != ' ') {
            $data =
               [
                  'name'       => $name,
                  'username'   => $username,
                  'image'      => $file,
                  'updated_at' => date('Y-m-d H:i:s')
               ];
         } else {
            $data =
               [
                  'name'       => $name,
                  'username'   => $username,
                  'password'   => $password,
                  'image'      => $file,
                  'updated_at' => date('Y-m-d H:i:s')
               ];
            }

         $this->m_data->update_data(['id' => $id], $data, 'users');
         $this->session->set_flashdata('berhasil', 'Successfully update user ' . ucwords($name) . ' !');
         redirect(base_url('dashboard/user'));
      } else {
         $this->session->set_flashdata('gagal', 'Failed update data !');
         redirect(base_url('dashboard/user'));
      }
   }

   public function del_user()
   {
      $id = $this->input->post('id');
      $name = $this->input->post('name');
      $foto = $this->input->post('foto');

      $this->m_data->delete_data(['id' => $id], 'users');
      delete_files('./assets/img/', $foto);
      $this->session->set_flashdata('berhasil', 'Successfully delete user ' . ucwords($name) . ' !');
      redirect(base_url('dashboard/user'));
   }

   public function profile()
   {
      $id = $this->session->userdata('id');
      $data['title'] = 'Profile';
      $data['profile'] = $this->m_data->edit_data(['id' => $id], 'users')->result();
      $this->load->view('dashboard/v_header', $data);
      $this->load->view('dashboard/v_profile', $data);
      $this->load->view('dashboard/v_footer');
   }

   public function profile_update()
   {
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('username', 'Username', 'required');

      if ($this->form_validation->run() != false) {
         $name     = $this->input->post('name');
         $username = $this->input->post('username');
         $images   = $this->input->post('images');
         $id       = $this->session->userdata('id');

         if (!empty($_FILES['images']['name'])) {
            $config['upload_path']   = './assets/img/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite']     = true;
            $config['max_size']      = 1024;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('images')) {
               $gambar = $this->upload->data();
               $file = $gambar['file_name'];
            }
         }

         if ($images == ' ') {
            $data =
            [
               'name'       => $name,
               'username'   => $username,
               'updated_at' => date('Y-m-d H:i:s')
            ];
         } else {
            $data =
            [
               'name'       => $name,
               'username'   => $username,
               'image'     => $file,
               'updated_at' => date('Y-m-d H:i:s')
            ];
         }

         $this->m_data->update_data(['id' => $id], $data, 'users');
         $this->session->set_flashdata('berhasil', 'Update Profile ' . $name . ' successfully !');
         redirect(base_url('dashboard/profile'));
      } else {
         $id = $this->session->userdata('id');
         $data['title']   = 'Profile';
         $data['profile'] = $this->m_data->edit_data(['id' => $id], 'users')->result();
         $this->session->set_flashdata('ulang', 'Profile failed to update, Please repeat !');
         $this->load->view('dashboard/v_header', $data);
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
         $id = $this->session->userdata('id');
         
         $cek = $this->m_data->cek_login('users', ['id' => $id]);

         if ($cek->num_rows() > 0) {
            $hasil = $cek->row();
            if (password_verify($password_lama, $hasil->password)) {              
               $id = $this->session->userdata('id');
               $data = 
               [
                  'password' => password_hash($password_baru, PASSWORD_DEFAULT)
               ];
               $this->m_data->update_data(['id' => $id], $data, 'users');
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

   public function report()
   {
      $data['title'] = 'Report';
      $this->load->view('dashboard/v_header', $data);
      $this->load->view('dashboard/v_report');
      $this->load->view('dashboard/v_footer');
   }
}
