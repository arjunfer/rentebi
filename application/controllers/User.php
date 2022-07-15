<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_user();
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->user->getActivity($this->session->userdata('id_user'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_user', $data);
        $this->load->view('user/index', $data);
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
        redirect('user/index');
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
            redirect('user/index');
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
        redirect('user/index');
    }

    public function stok()
    {
        $data['title'] = 'Stok Sepeda';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->user->getActivity($this->session->userdata('id_user'));
        $data['list_sepeda'] = $this->db->get('mst_sepeda')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_user', $data);
        $this->load->view('user/stok', $data);
        $this->load->view('templates/footer');
    }

    public function info_sepeda($id_sepeda)
    {
        $data['title'] = 'Detail Sepeda';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['detail'] = $this->db->get_where('mst_sepeda', ['id_sepeda' => $id_sepeda])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_user', $data);
        $this->load->view('user/info_sepeda', $data);
        $this->load->view('templates/footer');
    }

    public function input()
    {
        $this->form_validation->set_rules('no_nota', 'No Nota', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Input Data';
            $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
            $data['list_nota'] = $this->db->get_where('tb_nota', ['status_nota' => 1])->result_array();
            $data['no_nota'] = $this->user->getNoNota();
            $data['list_sepeda'] = $this->db->get_where('mst_sepeda', ['status_sepeda' => 1])->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('user/input', $data);
            $this->load->view('templates/footer');
        } else {
            $durasi_sewa = $this->input->post('durasi_sewa', true);
            $uang = $this->input->post('harga_sewa', true);
            $total = $durasi_sewa * $uang;
            $data = array(
                'tgl_nota' => $this->input->post('tgl_nota', true),
                'no_nota' => $this->input->post('no_nota', true),
                'nama_pelanggan' => $this->input->post('nama_pelanggan', true),
                'no_telp' => $this->input->post('no_telp', true),
                'jaminan' => $this->input->post('jaminan', true),
                'durasi_sewa' => $this->input->post('durasi_sewa', true),
                'durasi_sewa1' => $this->input->post('durasi_sewa1', true),
                'durasi_sewa2' => $this->input->post('durasi_sewa2', true),
                'sepeda_id' => $this->input->post('sepeda_id', true),
                'status_nota' => 1,
                'tot_bayar' => $total
            );
            $this->db->insert('tb_nota', $data);

            $id_sepeda = $this->input->post('sepeda_id', true);
            $data['sepeda'] = $this->db->get_where('mst_sepeda', ['id_sepeda' => $id_sepeda])->row_array();
            $jumlah = $data['sepeda']['jml_sepeda'];
            $sisa = $jumlah - 1;
            if ($sisa == 0) {
                $this->db->set('status_sepeda', 0);
                $this->db->set('jml_sepeda', $sisa);
                $this->db->where('id_sepeda', $id_sepeda);
                $this->db->update('mst_sepeda');
            } else {
                $this->db->set('jml_sepeda', $sisa);
                $this->db->where('id_sepeda', $id_sepeda);
                $this->db->update('mst_sepeda');
            }
            $data2 = [
                'user_activity' => $this->session->userdata('id_user'),
                'date_activity' => date('Y/m/d'),
                'time_activity' => date('H:i:s'),
                'activity' => 'Membuat Nota dengan No Nota ' . $this->input->post('no_nota', true),
            ];
            $this->db->insert('activity', $data2);
            $this->session->set_flashdata('message', 'Tambah Data');
            redirect('user/input');
        }
    }

    public function detail($id_nota)
    {
        $data['title'] = 'Detail';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->user->getActivity($this->session->userdata('id_user'));
        $data['nota'] = $this->user->getDetailNota($id_nota);
        $data['list_biaya'] = $this->db->get_where('mst_biaya', ['status_biaya' => 1])->result_array();
        $data['detail_biaya'] = $this->user->getDetailBiaya($id_nota);
        $data['tot_detail'] = $this->user->getTotalDetail($id_nota);
        $data['grand_total'] = $this->db->get_where('tb_nota_Selesai', ['nota_id_sewa' => $id_nota])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_user', $data);
        $this->load->view('user/detail', $data);
        $this->load->view('templates/footer');
    }

    public function detail_nota()
    {
        $tot = $this->input->post('harga_biaya');
        $jml = $this->input->post('qty');
        $sub = $tot * $jml;
        $data = [
            'nota_id' => $this->input->post('nota_id', true),
            'biaya_id' => $this->input->post('biaya_id', true),
            'harga_biaya' => $this->input->post('harga_biaya', true),
            'qty' => $this->input->post('qty', true),
            'sub_total' => $sub
        ];
        $this->db->insert('detail_nota', $data);
        $data2 = [
            'user_activity' => $this->session->userdata('id_user'),
            'date_activity' => date('Y/m/d'),
            'time_activity' => date('H:i:s'),
            'activity' => 'menginputkan detail nota',
        ];
        $this->db->insert('activity', $data2);
        $this->session->set_flashdata('message', 'Tambah Data');
        redirect('user/detail/' . $this->input->post('nota_id', true));
    }

    public function hapus_detail($id_detail)
    {
        $this->db->where('id_detail', $id_detail);
        $this->db->delete('detail_nota');
        $data2 = [
            'user_activity' => $this->session->userdata('id_user'),
            'date_activity' => date('Y/m/d'),
            'time_activity' => date('H:i:s'),
            'activity' => 'Menghapus detail nota dengan No Nota',
        ];
        $this->db->insert('activity', $data2);
        $this->session->set_flashdata('message', 'Hapus Data');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function selesai_nota()
    {
        $sewa = $this->input->post('tot_bayar_sewa');
        $add = $this->input->post('tot_bayar_tambahan');
        $grand = $sewa + $add;
        $data = [
            'nota_id_sewa' => $this->input->post('nota_id', true),
            'nota_no_sewa' => $this->input->post('nota_no', true),
            'tot_bayar_sewa' => $this->input->post('tot_bayar_sewa', true),
            'tot_bayar_tambahan' => $this->input->post('tot_bayar_tambahan', true),
            'grand_total' => $grand
        ];
        $this->db->insert('tb_nota_selesai', $data);

        $id_nota = $this->input->post('nota_id', true);
        $this->db->set('status_nota', 0);
        $this->db->where('id_nota', $id_nota);
        $this->db->update('tb_nota');

        $id_mobil = $this->input->post('sepeda_id_sewa', true);
        $jml_mobil = $this->input->post('jml_sepeda_sewa', true);
        $tot_mobil = $jml_mobil + 1;
        $this->db->set('jml_sepeda', $tot_mobil);
        $this->db->set('status_sepeda', 1);
        $this->db->where('id_sepeda', $id_mobil);
        $this->db->update('mst_sepeda');
        $data2 = [
            'user_activity' => $this->session->userdata('id_user'),
            'date_activity' => date('Y/m/d'),
            'time_activity' => date('H:i:s'),
            'activity' => 'Meyelesaikan Nota dengan No Nota ' . $this->input->post('nota_no', true),
        ];
        $this->db->insert('activity', $data2);
        $this->session->set_flashdata('message', 'Simpan Data');
        redirect('user/detail/' . $this->input->post('nota_id', true));
    }

    public function cetak($id_nota)
    {
        $data['title'] = 'Detail';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->user->getActivity($this->session->userdata('id_user'));
        $data['nota'] = $this->user->getDetailNota($id_nota);
        $data['detail'] = $this->user->getDetailBiaya($id_nota);
        $data['grand_total'] = $this->db->get_where('tb_nota_Selesai', ['nota_id_sewa' => $id_nota])->row_array();

        $this->load->view('user/cetak', $data);
    }

    public function list_selesai()
    {
        $data['title'] = 'Selesai';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->user->getActivity($this->session->userdata('id_user'));
        $data['list_nota'] = $this->db->get_where('tb_nota', ['status_nota' => 0])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_user', $data);
        $this->load->view('user/list_selesai', $data);
        $this->load->view('templates/footer');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->user->getActivity($this->session->userdata('id_user'));
        $data['list_nota'] = $this->user->getLaporan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_user', $data);
        $this->load->view('user/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function filter_laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['activity'] = $this->user->getActivity($this->session->userdata('id_user'));
        $tanggal1 = $this->input->post('tanggal_awal');
        $tanggal2 = $this->input->post('tanggal_akhir');
        $data['list_nota'] = $this->user->getFilterLaporan($tanggal1, $tanggal2);
        $data['title'] = 'Laporan Periode : ' . format_indo($tanggal1) . ' s/d ' . format_indo($tanggal2);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_user', $data);
        $this->load->view('user/filter_laporan', $data);
        $this->load->view('templates/footer');
    }
}
