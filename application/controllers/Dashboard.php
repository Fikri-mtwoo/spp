<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
    }

    public function index(){
        $data['judul'] = 'Halaman dashboard'; 
        $data['siswa'] = $this->dashboard_model->get_siswa();
        $data['pengeluaran'] = $this->dashboard_model->get_pengeluaran(date('d'));
        $data['pemasukan'] = $this->dashboard_model->get_pemasukan(date('d'));
        $data['buku'] = $this->dashboard_model->get_buku(date('d'));
        $data['gedung'] = $this->dashboard_model->get_gedung(date('d'));
        $data['pendaftaran'] = $this->dashboard_model->get_pendaftaran(date('d'));
        $data['spp'] = $this->dashboard_model->get_spp(date('d'));
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/index');
        $this->load->view('template/footer');
    }
}
?>