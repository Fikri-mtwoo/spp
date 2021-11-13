<?php

class Petugas extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('petugasModel');
    }

    public function index(){
        $data['judul'] = 'Halaman petugas';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('petugas/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('nama_petugas', 'Nama petugas', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $data['judul'] = 'Halaman petugas'; 
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar');
            $this->load->view('petugas/tambah');
            $this->load->view('template/footer');
        }else{
            $data = [
                'nama_petugas' => $this->input->post('nama_petugas', true),
                'username' => $this->input->post('username', true),
                'password' => md5($this->input->post('password', true)),
                'profile' => 'avatar.jpg'
            ];
            if($this->petugasModel->insert($data)){
                $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Data petugas berhasil ditambah']);
            }else{
                $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Data petugas gagal ditambah']);
            }
            redirect(base_url('petugas'));
        }
    }

    public function edit(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('nama_petugas', 'Nama petugas', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        
        $id = $this->input->get('id', true);
        $data['petugas'] = $this->petugasModel->get_by_id(['id_petugas'=>$id]);
        $data['judul'] = 'Halaman petugas';
        $data['error'] = null; 

        if($this->form_validation->run() == FALSE){
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('petugas/edit',$data);
                $this->load->view('template/footer');
        }else{
            $waktu = new DateTime();
            $config['upload_path']          = 'assets/images/';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 2024;
            $config['file_name']            = mt_rand(100, 1000).''. $waktu->format('Ymd');

            $this->load->library('upload', $config);
            
            if($_FILES['profile']['name'] !== '' && $this->input->post('password_baru') == ''){

                if ($this->upload->do_upload('profile'))
                {
                    $gambar = $this->upload->data();
                    $data = [
                        'nama_petugas'=> $this->input->post('nama_petugas', true),
                        'username'=> $this->input->post('username', true),
                        'password'=> $this->input->post('password_lama', true),
                        'profile'=> $gambar['file_name']
                    ];
                    unlink('assets/images/'.$this->input->post('profile_lama', true));
                    if($this->petugasModel->update($this->input->get('id', true), $data)){
                        $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Profile petugas berhasil dirubah']);
                    }else{
                        $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Profile petugas gagal dirubah']);
                    }
                    redirect(base_url('petugas'));
                }
                else{
                        $data['error'] = $this->upload->display_errors();
                } 
                
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('petugas/edit',$data);
                $this->load->view('template/footer');

            }else if($_FILES['profile']['name'] == '' && $this->input->post('password_baru') !== ''){
                $data = [
                    'nama_petugas'=> $this->input->post('nama_petugas', true),
                    'username'=> $this->input->post('username', true),
                    'password'=> md5($this->input->post('password_baru', true)),
                    'profile'=> $this->input->post('profile_lama', true)
                ];
                if($this->petugasModel->update($this->input->get('id', true), $data)){
                    $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Password petugas berhasil dirubah']);
                }else{
                     $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Password petugas gagal dirubah']);
                }
                redirect(base_url('petugas'));
            }else if($_FILES['profile']['name'] !== '' && $this->input->post('password_baru') !== ''){

                if ($this->upload->do_upload('profile'))
                {
                    $gambar = $this->upload->data();
                    $data = [
                        'nama_petugas'=> $this->input->post('nama_petugas', true),
                        'username'=> $this->input->post('username', true),
                        'password'=> md5($this->input->post('password_baru', true)),
                        'profile'=> $gambar['file_name']
                    ];
                    unlink('assets/images/'.$this->input->post('profile_lama', true));
                    if($this->petugasModel->update($this->input->get('id', true), $data)){
                        $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data petugas berhasil dirubah']);
                    }else{
                        $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data petugas gagal dirubah']);
                    }
                    redirect(base_url('petugas'));
                }
                else
                {
                    $data['error'] = $this->upload->display_errors();
                }

                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('petugas/edit',$data);
                $this->load->view('template/footer');

            }else if($_FILES['profile']['name'] == '' && $this->input->post('password_baru') == ''){
                redirect(base_url('petugas'));
            }
        }

    }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->petugasModel->delete($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data petugas berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data petugas gagal dihapus']);
        }
        redirect(base_url('petugas'));
    }

    public function get_data_petugas(){
        $list = $this->petugasModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_petugas;
            $row[] = $field->username;
            $row[] = $field->password;
            $row[] = "<img src='".base_url('assets/images/')."".$field->profile."' width='50%' height='50%'>";
            $row[] = "  <a href='".base_url('petugas/edit?id=')."".$field->id_petugas."'><button type='button' class='btn btn-primary'>Edit</button></a> |
            <a href='".base_url('petugas/hapus?id=')."".$field->id_petugas."' onclick='return confirm(\"Anda yakin ingin menghapus petugas ? ".$field->nama_petugas."\")'><button type='button' class='btn btn-danger'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->petugasModel->count_all(),
            "recordsFiltered" => $this->petugasModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}