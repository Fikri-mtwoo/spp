<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spp extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sppModel');
    }
    
    public function index(){
        $data['judul'] = 'Halaman spp'; 
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('spp/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('tahun_angkatan', 'Tahun angkatan', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('pendaftaran', 'Nominal Pendfatran', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('gedung', 'Nominal Gedung', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('spp', 'Nominal SPP', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $data['judul'] = 'Halaman spp'; 
            $data['angkatan'] = $this->sppModel->get_angkatan(); 
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar');
            $this->load->view('spp/tambah', $data);
            $this->load->view('template/footer');
        }else{
            $data = [
                'id_angkatan' => $this->input->post('tahun_angkatan', true),
                'nominal_spp' => $this->input->post('spp', true),
                'nominal_gedung' => $this->input->post('gedung', true),
                'nominal_pendaftaran' => $this->input->post('pendaftaran', true)
            ];
            if($this->sppModel->insert($data)){
                $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Data spp berhasil ditambah']);
            }else{
                $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Data spp gagal ditambah']);
            }
            redirect(base_url('spp'));
        }
    }

    // public function edit(){
    //     $this->load->library('form_validation');
        
    //     $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

    //     $this->form_validation->set_rules('tahun_angkatan', 'Tahun angkatan', 'required|trim', ['required'=>'%s tidak boleh kosong']);
    //     $this->form_validation->set_rules('pendaftaran', 'Nominal Pendfatran', 'required|trim', ['required'=>'%s tidak boleh kosong']);
    //     $this->form_validation->set_rules('gedung', 'Nominal Gedung', 'required|trim', ['required'=>'%s tidak boleh kosong']);
    //     $this->form_validation->set_rules('spp', 'Nominal SPP', 'required|trim', ['required'=>'%s tidak boleh kosong']);
    //     if($this->form_validation->run() == FALSE){
    //         $id = $this->input->get('id', true);
    //         $data['angkatan'] = $this->sppModel->get_by_id(['id_spp'=>$id]);
    //         $data['judul'] = 'Halaman spp'; 
    //             $this->load->view('template/header',$data);
    //             $this->load->view('template/sidebar');
    //             $this->load->view('spp/edit',$data);
    //             $this->load->view('template/footer');
    //     }else{
    //        $data = [
    //            'tahun_angkatan' => $this->input->post('tahun_angkatan', true),
    //            'nominal_spp' => $this->input->post('spp', true),
    //            'nominal_gedung' => $this->input->post('gedung', true),
    //            'nominal_pendaftaran' => $this->input->post('pendaftaran', true),
    //        ];
    //        if($this->sppModel->update($this->input->get('id', true), $data)){
    //             $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data spp berhasil dirubah']);
    //        }else{
    //             $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data spp gagal dirubah']);
    //        }
    //        redirect(base_url('spp'));
    //     }

    // }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->sppModel->delete($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data spp berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data spp gagal dihapus']);
        }
        redirect(base_url('spp'));
    }

    public function get_data_spp(){
        $list = $this->sppModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->tahun_angkatan;
            $row[] = $field->nominal_spp;
            $row[] = $field->nominal_gedung;
            $row[] = $field->nominal_pendaftaran;
            $row[] = "
            <a href='".base_url('spp/hapus?id=')."".$field->id_spp."' onclick='return confirm(\"Anda yakin ingin menghapus data ini? \")'><button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#hapus-angkatan'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sppModel->count_all(),
            "recordsFiltered" => $this->sppModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

}
?>