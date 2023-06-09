<?php

defined('BASEPATH') or exit('No direct script access allowed');

use FontLib\Table\Type\post;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

            $data =
                [
                    'name'       => $name,
                    'username'   => $username,
                    'password'   => $password,
                    'status'     => '1',
                    'created_at' => date('Y-m-d H:i:s')
                ];

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
            $status   = $this->input->post('status');
            $id       = $this->input->post('id');

            if ($password == ' ') {
                $data =
                    [
                        'name'       => $name,
                        'username'   => $username,
                        'status'     => $status,
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
            } else {
                $data =
                    [
                        'name'       => $name,
                        'username'   => $username,
                        'password'   => $password,
                        'status'     => $status,
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
        $id   = $this->input->post('id');
        $name = $this->input->post('name');
        $foto = $this->input->post('foto');

        $this->m_data->delete_data(['id' => $id], 'users');
        if ($foto != 'user.png') {
            unlink(FCPATH . './assets/img/' . $foto);
        }
        $this->session->set_flashdata('berhasil', 'Successfully delete user ' . ucwords($name) . ' !');
        redirect(base_url('dashboard/user'));
    }

    public function profile()
    {
        $id              = $this->session->userdata('id');
        $data['title']   = 'Profile';
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

            $data =
                [
                    'name'       => $name,
                    'username'   => $username,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

            $this->m_data->update_data(['id' => $id], $data, 'users');

            if (!empty($_FILES['images']['name'])) {
                $config['upload_path']   = './assets/img/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['overwrite']     = true;
                $config['max_size']      = 1024;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('images')) {
                    $gambar = $this->upload->data();
                    $file = $gambar['file_name'];

                    $data =
                        [
                            'image'      => $file,
                        ];
                }
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

    public function search()
    {
        $data['title']              = 'Report';
        $awal                       = htmlentities((trim($this->input->get('period_awal', true))) ? trim($this->input->get('period_awal', true)) : '');
        $akhir                      = htmlentities((trim($this->input->get('period_akhir', true))) ? trim($this->input->get('period_akhir', true)) : '');

        $perPage                    = 10;
        $page                       = 0;

        if ($this->input->get('page')) {
            $page = $this->input->get('page');
        }

        $start_index = 0;
        if ($page != 0) {
            $start_index = $perPage * ($page - 1);
        }

        $jumlah_data                    = $this->m_data->get_count($awal, $akhir, 'tb_log')->num_rows();
        $config['base_url']             = site_url('dashboard/search/');
        $config['total_rows']           = $jumlah_data;
        $config['per_page']             = $perPage;
        $config['enable_query_strings'] = true;
        $config['use_page_numbers']     = true;
        $config['page_query_string']    = true;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string']   = true;
        $config['first_link']           = 'First';
        $config['last_link']            = 'Last';
        $config['next_link']            = 'Next';
        $config['prev_link']            = 'Prev';
        $config['full_tag_open']        = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']       = '</ul></nav></div>';
        $config['num_tag_open']         = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']        = '</span></li>';
        $config['cur_tag_open']         = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']        = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']        = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']      = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']        = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']      = '</span>Next</li>';
        $config['first_tag_open']       = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close']     = '</span></li>';
        $config['last_tag_open']        = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']      = '</span></li>';
        $this->pagination->initialize($config);
        $data['page']                   = $page;
        $data['links']                  = $this->pagination->create_links();
        $data['report']                 = $this->m_data->get_pagination_search($config["per_page"], $start_index, $awal, $akhir, 'tanggal desc, waktu desc', 'tb_log');
        $data['period_awal']            = $awal;
        $data['period_akhir']           = $akhir;
        $data['number']                 = $start_index + 1;
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_search', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function export_excel()
    {
        $awal = $this->input->get('awal');
        $akhir = $this->input->get('akhir');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Suhu');
        $sheet->setCellValue('C1', 'Kelembaban');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Waktu');

        $data = $this->m_data->get_count($awal, $akhir, 'tb_log')->result();
        $x = 2;
        $no = 1;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->suhu);
            $sheet->setCellValue('C' . $x, $row->kelembaban);
            $sheet->setCellValue('D' . $x, $row->tanggal);
            $sheet->setCellValue('E' . $x, $row->waktu);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'Log sensor';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function export_pdf()
    {
        $awal = $this->input->get('awal');
        $akhir = $this->input->get('akhir');
        $this->load->library('pdf');
        $file_pdf    = 'Log sensor';
        $paper       = 'A4';
        $orientation = "potrait";

        $data['report'] = $this->m_data->get_count($awal, $akhir, 'tb_log')->result();
        $html = $this->load->view('dashboard/v_pdf', $data, true);
        $this->pdf->generate($html, $file_pdf, $paper, $orientation);
    }
}
