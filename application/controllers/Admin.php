<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_admin();
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->admin->getActivity($this->session->userdata('id_user'));
        $data['list_user'] = $this->db->get('mst_user')->result_array();

        $data['user_aktif'] = $this->admin->countUserAktif();
        $data['user_tak_aktif'] = $this->admin->countUserTidakAktif();
        $data['user_bulan'] = $this->admin->countUserBulan();
        $data['total_user'] = $this->admin->countAllUser();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit_profile()
    {
        $upload_image = $_FILES['image']['name'];
        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/dist/img/profile/';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
                $old_image = $data['user']['image'];
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/dist/img/profile/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }
        $nama = $this->input->post('nama');
        $this->db->set('nama', $nama);
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->update('mst_user');
        $data2 = [
            'user_activity' => $this->session->userdata('id_user'),
            'date_activity' => date('Y/m/d'),
            'time_activity' => date('H:i:s'),
            'activity' => 'Mengubah profil akun',
        ];
        $this->db->insert('activity', $data2);
        $this->session->set_flashdata('message', 'Simpan Perubahan');
        redirect('admin/index');
    }

    public function ubah_password()
    {
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password1');
        if ($current_password == $new_password) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger font-weight-bolder text-center" role="alert">Ubah Password Gagal !! <br> Password baru tidak boleh sama dengan password lama</div>');
            redirect('admin/index');
        } else {
            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $this->db->set('password', $password_hash);
            $this->db->where('id_user', $this->session->userdata('id_user'));
            $this->db->update('mst_user');
            $data2 = [
                'user_activity' => $this->session->userdata('id_user'),
                'date_activity' => date('Y/m/d'),
                'time_activity' => date('H:i:s'),
                'activity' => 'Mengubah profil akun',
            ];
            $this->db->insert('activity', $data2);
            $this->session->set_flashdata('message', 'SImpan Perubahan');
            redirect('admin/index');
        }
    }

    public function reset($id_user)
    {
        $this->db->where('user_activity', $id_user);
        $this->db->delete('activity');
        $this->session->set_flashdata('message', 'Reset Activity');
        redirect('admin/index');
    }

    public function man_user()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|is_unique[mst_user.email]', array(
            'is_unique' => 'Alamat Email sudah ada'
        ));
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', array(
            'matches' => 'Password tidak sama',
            'min_length' => 'password min 3 karakter'
        ));
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Management User';
            $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
            $data['list_user'] = $this->db->get('mst_user')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/master/man_user', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama' => $this->input->post('nama', true),
                'email' => $this->input->post('email', true),
                'level' => $this->input->post('level', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'date_created' => date('Y/m/d'),
                'image' => 'default.png',
                'is_active' => 1,
                'register' => 0
            );
            $this->db->insert('mst_user', $data);
            $data2 = [
                'user_activity' => $this->session->userdata('id_user'),
                'date_activity' => date('Y/m/d'),
                'time_activity' => date('H:i:s'),
                'activity' => 'Membuat user baru',
            ];
            $this->db->insert('activity', $data2);
            $this->session->set_flashdata('message', 'Tambah Data');
            redirect('admin/man_user');
        }
    }

    public function get_user()
    {
        $id_user = $this->input->post('id_user');
        echo json_encode($this->db->get_where('mst_user', ['id_user' => $id_user])->row_array());
    }

    public function edit_user()
    {
        $id_user = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $is_active = $this->input->post('is_active');

        $this->db->set('nama', $nama);
        $this->db->set('level', $level);
        $this->db->set('is_active', $is_active);
        $this->db->where('id_user', $id_user);
        $this->db->update('mst_user');
        $data2 = [
            'user_activity' => $this->session->userdata('id_user'),
            'date_activity' => date('Y/m/d'),
            'time_activity' => date('H:i:s'),
            'activity' => 'Mengubah data management user',
        ];
        $this->db->insert('activity', $data2);
        $this->session->set_flashdata('message', 'Simpan Perubahan');
        redirect('admin/man_user');
    }

    public function mst_mobil()
    {
        $this->form_validation->set_rules('nama_mobil', 'Nama Mobil', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Management Kendaraan';
            $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
            $data['list_mobil'] = $this->db->get('mst_mobil')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/master/mst_mobil', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']   = './assets/gambar/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size']      = 10240;
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $file = $this->upload->data('file_name');
            $data = [
                'nama_mobil' => $this->input->post('nama_mobil', true),
                'warna_mobil' => $this->input->post('warna_mobil', true),
                'tahun_mobil' => $this->input->post('tahun_mobil', true),
                'jml_mobil' => $this->input->post('jml_mobil', true),
                'kapasitas_mobil' => $this->input->post('kapasitas_mobil', true),
                'bbm' => $this->input->post('bbm', true),
                'harga_sewa' => $this->input->post('harga_sewa', true),
                'status_mobil' => 1,
                'gambar' => $file
            ];
            $this->db->insert('mst_mobil', $data);
            $data2 = [
                'user_activity' => $this->session->userdata('id_user'),
                'date_activity' => date('Y/m/d'),
                'time_activity' => date('H:i:s'),
                'activity' => 'Menambah data mobil',
            ];
            $this->db->insert('activity', $data2);
            $this->session->set_flashdata('message', 'Tambah Data');
            redirect('admin/mst_mobil');
        }
    }

    public function get_mobil()
    {
        $id_mobil = $this->input->post('id_mobil');
        echo json_encode($this->db->get_where('mst_mobil', ['id_mobil' => $id_mobil])->row_array());
    }

    public function edit_mobil()
    {
        $upload_image = $_FILES['gambar']['name'];
        if ($upload_image) {
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size']     = 10240;
            $config['upload_path'] = './assets/gambar/';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $data['mobil'] = $this->db->get_where('mst_mobil', ['id_mobil' => $this->input->post('id_mobil')])->row_array();
                $old_image = $data['mobil']['gambar'];
                if ($old_image != 'default.png') {
                    unlink(FCPATH . './assets/gambar/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('gambar', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }
        $id_mobil = $this->input->post('id_mobil');
        $nama_mobil = $this->input->post('nama_mobil');
        $warna_mobil = $this->input->post('warna_mobil');
        $tahun_mobil = $this->input->post('tahun_mobil');
        $jml_mobil = $this->input->post('jml_mobil');
        $kapasitas_mobil = $this->input->post('kapasitas_mobil');
        $bbm = $this->input->post('bbm');
        $harga_sewa = $this->input->post('harga_sewa');
        $status_mobil = $this->input->post('status_mobil');

        $this->db->set('nama_mobil', $nama_mobil);
        $this->db->set('warna_mobil', $warna_mobil);
        $this->db->set('tahun_mobil', $tahun_mobil);
        $this->db->set('jml_mobil', $jml_mobil);
        $this->db->set('kapasitas_mobil', $kapasitas_mobil);
        $this->db->set('bbm', $bbm);
        $this->db->set('harga_sewa', $harga_sewa);
        $this->db->set('status_mobil', $status_mobil);
        $this->db->where('id_mobil', $id_mobil);
        $this->db->update('mst_mobil');
        $data2 = [
            'user_activity' => $this->session->userdata('id_user'),
            'date_activity' => date('Y/m/d'),
            'time_activity' => date('H:i:s'),
            'activity' => 'Mengubah data mobil',
        ];
        $this->db->insert('activity', $data2);
        $this->session->set_flashdata('message', 'Simpan Perubahan');
        redirect('admin/mst_mobil');
    }

    public function info_mobil($id_mobil)
    {
        $data['title'] = 'Detail Mobil';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['detail'] = $this->db->get_where('mst_mobil', ['id_mobil' => $id_mobil])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/info_mobil', $data);
        $this->load->view('templates/footer');
    }

    public function mst_biaya()
    {
        $this->form_validation->set_rules('nama_biaya', 'Nama Biaya', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Manajemen Biaya';
            $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
            $data['list_biaya'] = $this->db->get('mst_biaya')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/master/mst_biaya', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'nama_biaya' => $this->input->post('nama_biaya', true),
                'nominal' => $this->input->post('nominal', true),
                'status_biaya' => 1,
            ];
            $this->db->insert('mst_biaya', $data);
            $data2 = [
                'user_activity' => $this->session->userdata('id_user'),
                'date_activity' => date('Y/m/d'),
                'time_activity' => date('H:i:s'),
                'activity' => 'Menambah data biaya',
            ];
            $this->db->insert('activity', $data2);
            $this->session->set_flashdata('message', 'Tambah Data');
            redirect('admin/mst_biaya');
        }
    }

    public function get_biaya()
    {
        $id_biaya = $this->input->post('id_biaya');
        echo json_encode($this->db->get_where('mst_biaya', ['id_biaya' => $id_biaya])->row_array());
    }

    public function edit_biaya()
    {
        $id_biaya = $this->input->post('id_biaya');
        $nama_biaya = $this->input->post('nama_biaya');
        $nominal = $this->input->post('nominal');
        $status_biaya = $this->input->post('status_biaya');

        $this->db->set('nama_biaya', $nama_biaya);
        $this->db->set('nominal', $nominal);
        $this->db->set('status_biaya', $status_biaya);
        $this->db->where('id_biaya', $id_biaya);
        $this->db->update('mst_biaya');
        $data2 = [
            'user_activity' => $this->session->userdata('id_user'),
            'date_activity' => date('Y/m/d'),
            'time_activity' => date('H:i:s'),
            'activity' => 'Mengubah data master biaya',
        ];
        $this->db->insert('activity', $data2);
        $this->session->set_flashdata('message', 'Simpan Perubahan');
        redirect('admin/mst_biaya');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['list_nota'] = $this->admin->getLaporan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function filter_laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->admin->getActivity($this->session->userdata('id_user'));
        $tanggal1 = $this->input->post('tanggal_awal');
        $tanggal2 = $this->input->post('tanggal_akhir');
        $data['list_nota'] = $this->admin->getFilterLaporan($tanggal1, $tanggal2);
        $data['title'] = 'Laporan Periode : ' . format_indo($tanggal1) . ' s/d ' . format_indo($tanggal2);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/filter_laporan', $data);
        $this->load->view('templates/footer');
    }

    public function mst_sepeda()
    {
        $this->form_validation->set_rules('nama_sepeda', 'Nama Sepeda', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Management Kendaraan';
            $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
            $data['list_sepeda'] = $this->db->get('mst_sepeda')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/master/mst_sepeda', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']   = './assets/gambar/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size']      = 10240;
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $file = $this->upload->data('file_name');
            $data = [
                'nama_sepeda' => $this->input->post('nama_sepeda', true),
                'kode_barcode' => $this->input->post('kode_barcode', true),
                'tahun_sepeda' => $this->input->post('tahun_sepeda', true),
                'jml_sepeda' => $this->input->post('jml_sepeda', true),
                'harga_sewa' => $this->input->post('harga_sewa', true),
                'status_sepeda' => 1,
                'gambar' => $file
            ];
            $this->db->insert('mst_sepeda', $data);
            $data2 = [
                'user_activity' => $this->session->userdata('id_user'),
                'date_activity' => date('Y/m/d'),
                'time_activity' => date('H:i:s'),
                'activity' => 'Menambah data sepeda',
            ];
            $this->db->insert('activity', $data2);
            $this->session->set_flashdata('message', 'Tambah Data');
            redirect('admin/mst_sepeda');
        }
    }

    public function get_sepeda()
    {
        $id_sepeda = $this->input->post('id_sepeda');
        echo json_encode($this->db->get_where('mst_sepeda', ['id_sepeda' => $id_sepeda])->row_array());
    }

    public function info_sepeda($id_sepeda)
    {
        $data['title'] = 'Detail Sepeda';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['detail'] = $this->db->get_where('mst_sepeda', ['id_sepeda' => $id_sepeda])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/info_sepeda', $data);
        $this->load->view('templates/footer');
    }


    function barcode_qrcode($id_sepeda)
    {
        $data['title'] = 'Barcode Sepeda';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['kode_barcode'] = $this->db->get_where('mst_sepeda', ['id_sepeda' => $id_sepeda])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/barcode_qrcode', $data);
        $this->load->view('templates/footer');
    }


    public function mst_cabang()
    {
        $this->form_validation->set_rules('nama_cabang', 'Nama Cabang', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Manajemen Cabang';
            $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
            $data['list_cabang'] = $this->db->get('mst_cabang')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/master/mst_cabang', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'nama_cabang' => $this->input->post('nama_cabang', true),
                'alamat_cabang' => $this->input->post('alamat_cabang', true),
            ];
            $this->db->insert('mst_cabang', $data);
            $data2 = [
                'user_activity' => $this->session->userdata('id_user'),
                'date_activity' => date('Y/m/d'),
                'time_activity' => date('H:i:s'),
                'activity' => 'Menambah data cabang',
            ];
            $this->db->insert('activity', $data2);
            $this->session->set_flashdata('message', 'Tambah Data');
            redirect('admin/mst_cabang');
        }
    }

    public function get_cabang()
    {
        $id_cabang = $this->input->post('id_cabang');
        echo json_encode($this->db->get_where('mst_cabang', ['id_cabang' => $id_cabang])->row_array());
    }
}

