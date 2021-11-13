<?php

class Jurusan extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('jurusanModel');
    }

    public function index(){
        $data['judul'] = 'Halaman jurusan';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('jurusan/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('nama_jurusan', 'Nama jurusan', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $data['judul'] = 'Halaman jurusan'; 
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar');
            $this->load->view('jurusan/tambah');
            $this->load->view('template/footer');
        }else{
            $data = [
                'nama_jurusan' => $this->input->post('nama_jurusan', true)
            ];
            if($this->jurusanModel->insert($data)){
                $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Data jurusan berhasil ditambah']);
            }else{
                $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Data jurusan gagal ditambah']);
            }
            redirect(base_url('jurusan'));
        }
    }

    public function edit(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('nama_jurusan', 'Nama jurusan', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $id = $this->input->get('id', true);
            $data['jurusan'] = $this->jurusanModel->get_by_id(['id_jurusan'=>$id]);
            $data['judul'] = 'Halaman jurusan'; 
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('jurusan/edit',$data);
                $this->load->view('template/footer');
        }else{
           $data = [
               'nama_jurusan' => $this->input->post('nama_jurusan', true)
           ];
           if($this->jurusanModel->update($this->input->get('id', true), $data)){
                $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data jurusan berhasil dirubah']);
           }else{
                $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data jurusan gagal dirubah']);
           }
           redirect(base_url('jurusan'));
        }

    }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->jurusanModel->delete($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data jurusan berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data jurusan gagal dihapus']);
        }
        redirect(base_url('jurusan'));
    }

    public function get_data_jurusan(){
        $list = $this->jurusanModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_jurusan;
            $row[] = "  <a href='".base_url('jurusan/edit?id=')."".$field->id_jurusan."'><button type='button' class='btn btn-primary'>Edit</button></a> |
            <a href='".base_url('jurusan/hapus?id=')."".$field->id_jurusan."' onclick='return confirm(\"Anda yakin ingin menghapus data ini? ".$field->nama_jurusan."\")'><button type='button' class='btn btn-danger'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->jurusanModel->count_all(),
            "recordsFiltered" => $this->jurusanModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
?>