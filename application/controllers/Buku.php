<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('bukuModel');
    }

    public function index(){
        $data['judul'] = 'Halaman buku'; 
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('buku/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('nama_buku', 'Nama buku', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('harga', 'Harga buku', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $data['judul'] = 'Halaman buku'; 
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar');
            $this->load->view('buku/tambah');
            $this->load->view('template/footer');
        }else{
            $data = [
                'id_buku' => 'BK'.mt_rand(100, 1000),
                'nama_buku' => $this->input->post('nama_buku', true),
                'harga_buku' => $this->input->post('harga', true)
            ];
            if($this->bukuModel->insert($data)){
                $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Data buku berhasil ditambah']);
            }else{
                $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Data buku gagal ditambah']);
            }
            redirect(base_url('buku'));
        }
    }

    public function edit(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('nama_buku', 'Nama buku', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('harga', 'Harga buku', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        if($this->form_validation->run() == FALSE){
            $id = $this->input->get('id', true);
            $data['buku'] = $this->bukuModel->get_by_id(['id_buku'=>$id]);
            $data['judul'] = 'Halaman buku'; 
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('buku/edit',$data);
                $this->load->view('template/footer');
        }else{
           $data = [
               'nama_buku' => $this->input->post('nama_buku', true),
               'harga_buku' => $this->input->post('harga', true)
           ];
           if($this->bukuModel->update($this->input->get('id', true), $data)){
                $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data buku berhasil dirubah']);
           }else{
                $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data buku gagal dirubah']);
           }
           redirect(base_url('buku'));
        }

    }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->bukuModel->delete($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data buku berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data buku gagal dihapus']);
        }
        redirect(base_url('buku'));
    }

    public function get_data_buku(){
        $list = $this->bukuModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_buku;
            $row[] = $field->harga_buku;
            $row[] = "  <a href='".base_url('buku/edit?id=')."".$field->id_buku."'><button type='button' class='btn btn-primary'>Edit</button></a> |
            <a href='".base_url('buku/hapus?id=')."".$field->id_buku."' onclick='return confirm(\"Anda yakin ingin menghapus data ini? ".$field->nama_buku."\")'><button type='button' class='btn btn-danger'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->bukuModel->count_all(),
            "recordsFiltered" => $this->bukuModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

}