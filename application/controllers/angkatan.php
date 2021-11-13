<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Angkatan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('angkatanModel');
    }
    
    public function index(){
        $data['judul'] = 'Halaman angkatan'; 
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('angkatan/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('tahun_angkatan', 'Tahun angkatan', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun ajaran', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $data['judul'] = 'Halaman spp';  
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar');
            $this->load->view('angkatan/tambah', $data);
            $this->load->view('template/footer');
        }else{
            $data = [
                'tahun_angkatan' => $this->input->post('tahun_angkatan', true),
                'tahun_ajaran' => $this->input->post('tahun_ajaran', true)
            ];
            if($this->angkatanModel->insert($data)){
                $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Data angkatan berhasil ditambah']);
            }else{
                $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Data angkatan gagal ditambah']);
            }
            redirect(base_url('angkatan'));
        }
    }

    public function edit(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('tahun_angkatan', 'Tahun angkatan', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun ajaran', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $id = $this->input->get('id', true);
            $data['angkatan'] = $this->angkatanModel->get_by_id(['id_angkatan'=>$id]);
            $data['judul'] = 'Halaman angkatan'; 
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('angkatan/edit',$data);
                $this->load->view('template/footer');
        }else{
           $data = [
               'tahun_angkatan' => $this->input->post('tahun_angkatan', true),
               'tahun_ajaran' => $this->input->post('tahun_ajaran', true)
           ];
           if($this->angkatanModel->update($this->input->get('id', true), $data)){
                $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data angkatan berhasil dirubah']);
           }else{
                $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data angkatan gagal dirubah']);
           }
           redirect(base_url('angkatan'));
        }

    }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->angkatanModel->delete($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data angkatan berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data angkatan gagal dihapus']);
        }
        redirect(base_url('angkatan'));
    }

    public function get_data_angkatan(){
        $list = $this->angkatanModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->tahun_angkatan;
            $row[] = $field->tahun_ajaran;
            $row[] = " <a href='".base_url('angkatan/edit?id=')."".$field->id_angkatan."'><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#hapus-angkatan'>Edit</button></a> |
            <a href='".base_url('angkatan/hapus?id=')."".$field->id_angkatan."' onclick='return confirm(\"Anda yakin ingin menghapus data ini? \")'><button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#hapus-angkatan'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->angkatanModel->count_all(),
            "recordsFiltered" => $this->angkatanModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

}
?>