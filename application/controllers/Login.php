<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();

      date_default_timezone_set('Asia/Jakarta');
   }

   public function index()
   {
      $session = $this->session->userdata('status');
      if ($session == '') {
         $this->load->view('v_login');
      } else {
         redirect('dashboard');
      }
   }

   public function proses()
   {
      $user = $this->input->post('username');
      $pass = $this->input->post('password');

      $where = array(
         'username' => trim($user),
      );

      $cek = $this->m_data->cek_login('users', $where);

      if ($cek->num_rows() > 0) {
         $hasil = $cek->row();
         if (password_verify($pass, $hasil->password)) {
            $this->session->set_userdata('id', $hasil->id_user);
            $this->session->set_userdata('name', $hasil->name);
            $this->session->set_userdata('username', $hasil->username);
            $this->session->set_userdata('image', $hasil->image);
            $this->session->set_userdata('status', 'iot_log');

            if (mdate('%H:%i') >= '00:01' && mdate('%H:%i') <= '10:00') :
               $logg = 'Good morning ' . $this->session->userdata('name') . '!';
            elseif (mdate('%H:%i') >= '10:01' && mdate('%H:%i') <= '18:00') :
               $logg = 'Good afternoon ' . $this->session->userdata('name') . '!';
            elseif (mdate('%H:%i') >= '18:01' && mdate('%H:%i') <= '23:59') :
               $logg = 'Good evening ' . $this->session->userdata('name') . '!';
            endif;

            $this->session->set_flashdata('loginok', $logg);
            redirect(base_url() . 'dashboard');
         } else {
            redirect(base_url() . 'login?alert=gagal');
         }
      } else {
         redirect(base_url() . 'login?alert=belum_login');
      }
   }


   public function notfound()
   {
      $data['title'] = '404 Page Not Found';
      $this->load->view('v_404', $data);
   }
}
