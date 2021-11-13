<?php

class Kelas extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('kelasModel');
    }

    public function index(){
        $data['judul'] = 'Halaman kelas';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('kelas/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('nama_kelas', 'Nama kelas', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('romawi', 'Romawi kelas', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $data['judul'] = 'Halaman kelas'; 
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar');
            $this->load->view('kelas/tambah');
            $this->load->view('template/footer');
        }else{
            $data = [
                'nama_kelas' => $this->input->post('nama_kelas', true),
                'romawi_kelas' => $this->input->post('romawi', true)
            ];
            if($this->kelasModel->insert($data)){
                $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Data kelas berhasil ditambah']);
            }else{
                $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Data kelas gagal ditambah']);
            }
            redirect(base_url('kelas'));
        }
    }

    public function edit(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('nama_kelas', 'Nama kelas', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('romawi', 'Romawi kelas', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $id = $this->input->get('id', true);
            $data['kelas'] = $this->kelasModel->get_by_id(['id_kelas'=>$id]);
            $data['judul'] = 'Halaman kelas'; 
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('kelas/edit',$data);
                $this->load->view('template/footer');
        }else{
           $data = [
               'nama_kelas' => $this->input->post('nama_kelas', true),
               'romawi_kelas' => $this->input->post('romawi', true)
           ];
           if($this->kelasModel->update($this->input->get('id', true), $data)){
                $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data kelas berhasil dirubah']);
           }else{
                $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data kelas gagal dirubah']);
           }
           redirect(base_url('kelas'));
        }

    }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->kelasModel->delete($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data kelas berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data kelas gagal dihapus']);
        }
        redirect(base_url('kelas'));
    }

    public function get_data_kelas(){
        $list = $this->kelasModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_kelas;
            $row[] = $field->romawi_kelas;
            $row[] = "  <a href='".base_url('kelas/edit?id=')."".$field->id_kelas."'><button type='button' class='btn btn-primary'>Edit</button></a> |
            <a href='".base_url('kelas/hapus?id=')."".$field->id_kelas."' onclick='return confirm(\"Anda yakin ingin menghapus data ini? kelas ".$field->nama_kelas."\")'><button type='button' class='btn btn-danger'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->kelasModel->count_all(),
            "recordsFiltered" => $this->kelasModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
?>