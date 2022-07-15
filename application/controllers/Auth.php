<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Auth extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('email', 'Alamat Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/index');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->db->get_where('mst_user', array('email' => $email))->row_array();
            if ($user) {
                if ($user['is_active'] == 1) {
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'id_user' => $user['id_user'],
                            'nama' => $user['nama'],
                            'email' => $user['email'],
                            'level' => $user['level']
                        ];
                        $this->session->set_userdata($data);
                        if ($user['level'] == 'Admin') {
                            redirect('admin');
                        } elseif ($user['level'] == 'User') {
                            redirect('user');
                        } else {
                            redirect('customer');
                        }
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password salah</div>');
                        redirect('auth/index');
                    }
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">User Tidak aktif</div>');
                    redirect('auth/index');
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Email dan Password tidak sama</div>');
                redirect('auth/index');
            }
        }
    }

    public function signup()
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
            $this->load->view('auth/signup');
        } else {
            $data = array(
                'nama' => $this->input->post('nama', true),
                'email' => $this->input->post('email', true),
                'level' => 'Customer',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'date_created' => date('Y/m/d'),
                'image' => 'default.png',
                'is_active' => 1,
                'register' => 1
            );
            $this->db->insert('mst_user', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center" role="alert">Pendaftaran Sukses.. Silahkan login..</div>');
            redirect('auth/index');
        }
    }


    public function blocked()
    {
        $data['title'] = 'Access Forbidden';
        $data['user'] = $this->db->get_where('mst_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $this->load->view('auth/blocked', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('email');
        $this->session->set_flashdata('message', 'Logout');
        redirect('auth/index');
    }
}
