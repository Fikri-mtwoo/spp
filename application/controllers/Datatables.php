<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatables extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bukuModel', 'bm');
    }

    public function get_data_buku(){
        $list = $this->bm->get_datatables();
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
            "recordsTotal" => $this->bm->count_all(),
            "recordsFiltered" => $this->bm->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}   