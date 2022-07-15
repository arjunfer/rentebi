<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_customer();
        $this->load->model('Customer_model', 'customer');
    }

    public function index()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->customer->getActivity($this->session->userdata('id_user'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_customer', $data);
        $this->load->view('customer/index', $data);
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
        redirect('customer/index');
    }

    public function ubah_password()
    {
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password1');
        if ($current_password == $new_password) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger font-weight-bolder text-center" role="alert">Ubah Password Gagal !! <br> Password baru tidak boleh sama dengan password lama</div>');
            redirect('user/index');
        } else {
            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $this->db->set('password', $password_hash);
            $this->db->where('id_user', $this->session->userdata('id_user'));
            $this->db->update('mst_user');
            $data2 = [
                'user_activity' => $this->session->userdata('id_user'),
                'date_activity' => date('Y/m/d'),
                'time_activity' => date('H:i:s'),
                'activity' => 'Mengubah password akun',
            ];
            $this->db->insert('activity', $data2);
            $this->session->set_flashdata('message', 'Simpan Perubahan');
            redirect('customer/index');
        }
    }

    public function reset($id_user)
    {
        $this->db->where('user_activity', $id_user);
        $this->db->delete('activity');
        $data2 = [
            'user_activity' => $this->session->userdata('id_user'),
            'date_activity' => date('Y/m/d'),
            'time_activity' => date('H:i:s'),
            'activity' => 'Delete Activity',
        ];
        $this->db->insert('activity', $data2);
        $this->session->set_flashdata('message', 'Reset Activity');
        redirect('customer/index');
    }

    public function registrasi()
    {
        $this->form_validation->set_rules('alamat_customer', 'Alamat Lengkap', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
            $data['activity'] = $this->customer->getActivity($this->session->userdata('id_user'));

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_customer', $data);
            $this->load->view('customer/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'user_id_customer' => $this->session->userdata('id_user'),
                'nama_customer' => $this->session->userdata('nama'),
                'alamat_customer' => $this->input->post('alamat_customer'),
                'telp_customer' => $this->input->post('telp_customer'),
            ];
            $this->db->insert('tb_customer', $data);

            $id_user = $this->session->userdata('id_user');
            $register = 0;
            $this->db->set('register', $register);
            $this->db->where('id_user', $id_user);
            $this->db->update('mst_user');
            $this->session->set_flashdata('message', 'Kirim Data');
            redirect('customer/index');
        }
    }

    public function stok()
    {
        $data['title'] = 'Stok Mobil';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->customer->getActivity($this->session->userdata('id_user'));
        $data['list_mobil'] = $this->db->get('mst_mobil')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_customer', $data);
        $this->load->view('customer/stok', $data);
        $this->load->view('templates/footer');
    }

    public function info_mobil($id_mobil)
    {
        $data['title'] = 'Detail Mobil';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['detail'] = $this->db->get_where('mst_mobil', ['id_mobil' => $id_mobil])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_customer', $data);
        $this->load->view('customer/info_mobil', $data);
        $this->load->view('templates/footer');
    }





    public function input()
    {
        $this->form_validation->set_rules('no_nota', 'No Nota', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Input Data';
            $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
            $data['list_nota'] = $this->customer->getListNota($this->session->userdata('id_user'));
            $data['no_nota'] = $this->customer->getNoNota();
            $data['list_mobil'] = $this->db->get_where('mst_mobil', ['status_mobil' => 1])->result_array();
            $data['customer'] = $this->customer->getDataCustomer($this->session->userdata('id_user'));

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_customer', $data);
            $this->load->view('customer/input', $data);
            $this->load->view('templates/footer');
        } else {
            $jml_sewa = $this->input->post('jml_sewa', true);
            $uang = $this->input->post('harga_sewa', true);
            $total = $jml_sewa * $uang;
            $data = array(
                'user_id_nota' => $this->input->post('user_id_nota', true),
                'tgl_nota' => $this->input->post('tgl_nota', true),
                'no_nota' => $this->input->post('no_nota', true),
                'nama_pelanggan' => $this->input->post('nama_pelanggan', true),
                'alamat_pelanggan' => $this->input->post('alamat_pelanggan', true),
                'no_telp' => $this->input->post('no_telp', true),
                'jaminan' => $this->input->post('jaminan', true),
                'jml_sewa' => $this->input->post('jml_sewa', true),
                'tgl_sewa1' => $this->input->post('tgl_sewa1', true),
                'tgl_sewa2' => $this->input->post('tgl_sewa2', true),
                'mobil_id' => $this->input->post('mobil_id', true),
                'status_nota' => 1,
                'tot_bayar' => $total
            );
            $this->db->insert('tb_nota', $data);
            $id_mobil = $this->input->post('mobil_id', true);
            $data['mobil'] = $this->db->get_where('mst_mobil', ['id_mobil' => $id_mobil])->row_array();
            $jumlah = $data['mobil']['jml_mobil'];
            $sisa = $jumlah - 1;
            if ($sisa == 0) {
                $this->db->set('status_mobil', 0);
                $this->db->set('jml_mobil', $sisa);
                $this->db->where('id_mobil', $id_mobil);
                $this->db->update('mst_mobil');
            } else {
                $this->db->set('jml_mobil', $sisa);
                $this->db->where('id_mobil', $id_mobil);
                $this->db->update('mst_mobil');
            }
            $data2 = [
                'user_activity' => $this->session->userdata('id_user'),
                'date_activity' => date('Y/m/d'),
                'time_activity' => date('H:i:s'),
                'activity' => 'Membuat Booking Order dengan No Nota ' . $this->input->post('no_nota', true),
            ];
            $this->db->insert('activity', $data2);
            $this->session->set_flashdata('message', 'Tambah Data');
            redirect('customer/input');
        }
    }

    public function detail($id_nota)
    {
        $data['title'] = 'Detail';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->customer->getActivity($this->session->userdata('id_user'));
        $data['nota'] = $this->customer->getDetailNota($id_nota);
        $data['list_biaya'] = $this->db->get_where('mst_biaya', ['status_biaya' => 1])->result_array();
        $data['detail_biaya'] = $this->customer->getDetailBiaya($id_nota);
        $data['tot_detail'] = $this->customer->getTotalDetail($id_nota);
        $data['grand_total'] = $this->db->get_where('tb_nota_Selesai', ['nota_id_sewa' => $id_nota])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_customer', $data);
        $this->load->view('customer/detail', $data);
        $this->load->view('templates/footer');
    }

    public function list_selesai()
    {
        $data['title'] = 'Selesai';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->customer->getActivity($this->session->userdata('id_user'));
        $data['list_nota'] = $this->customer->getNotaSelesai($this->session->userdata('id_user'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_customer', $data);
        $this->load->view('customer/list_selesai', $data);
        $this->load->view('templates/footer');
    }
}
