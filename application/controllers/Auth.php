<?php

class Auth extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('authModel');
    }

    public function index(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        $data['judul'] = "Halaman login";
        if($this->form_validation->run() == FALSE){
        $this->load->view('auth/login', $data);
        }else{
            
            $login = $this->authModel->get_akun(['username'=>$this->input->post('username', true)]);
            if($login){
                $cek = $this->authModel->get_akun(['username'=>$this->input->post('username', true), 'password'=>md5($this->input->post('password', true))]);
                if($cek){
                    foreach ($cek as $result) {
                        $data = array(
                            'id_petugas' => $result['id_petugas'],
                            'nama_petugas' => $result['nama_petugas'],
                            'status' => 'login'
                        );
                    }
                    $this->session->set_userdata($data);
                    redirect(base_url('dashboard'));
                }else{
                    $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Usernam atau Passsword salah']);
                    redirect(base_url());
                }
            }else{
                $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Akun belum terdaftar']);
                redirect(base_url());
            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
?>