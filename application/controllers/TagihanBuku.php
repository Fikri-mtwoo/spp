<?php

class TagihanBuku extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tagihanBukuModel');
    }

    public function index(){
        $data['judul'] = 'Halaman tagihan buku';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('tagihan_buku/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $data['judul'] = 'Halaman tagihan buku';
        $data['kelas'] = $this->tagihanBukuModel->get_kelas();
        $data['jurusan'] = $this->tagihanBukuModel->get_jurusan();
        $data['angkatan'] = $this->tagihanBukuModel->get_angkatan();
        $data['buku'] = $this->tagihanBukuModel->get_buku();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('tagihan_buku/tambah', $data);
        $this->load->view('template/footer');
    }

    public function get_data_siswa(){
        $siswa = $this->tagihanBukuModel->get_siswa($this->input->post('kelas', true), $this->input->post('jurusan', true), $this->input->post('angkatan', true));
        if($siswa){
            $data = $siswa;
        }else{
            $data = null;
        }
        echo json_encode($data);
    }

    public function get_data_buku(){
        $buku = $this->tagihanBukuModel->get_buku();
        if($buku){
            $data = $buku;
        }else{
            $data = null;
        }
        echo json_encode($data);
    }   

    public function proses_tambah(){
        $siswa = $this->input->post('siswa', true);
        $buku = $this->input->post('buku', true);
        $kelas = $this->input->post('kelas', true);
        $total_nominal_buku = 0;

        foreach ($buku as $bk) {
            $kotak[] = explode('/', $bk['nama'] );
        }
        foreach ($kotak as $kt) {
            $total_nominal_buku += $kt[1];
        }
        foreach ($siswa as $sw) {
            $id_tagihan_buku = 'TGNBK'.mt_rand(100, 1000).''.mt_rand(1000, 10000);
            $cek = $this->tagihanBukuModel->get_tagihan_buku($sw['nisn'], $kelas);
            if($cek > 0){
                $this->session->set_flashdata(['type'=>'alert-warning','pesan'=>'Tagihan buku sudah ditambah']);
                redirect(base_url('tagihanbuku'));
            }else{
                foreach ($kotak as $kt) {
                    $data_detail[] = [
                        'id_tagihan' => $id_tagihan_buku,
                        'id_buku' => $kt[0]
                    ];
                }
                $data[] = [
                    'id_tagihan_buku'=> $id_tagihan_buku,
                    'nisn_siswa' => $sw['nisn'],
                    'id_kelas' => $kelas,
                    'total_buku' => count($buku),
                    'total_nominal_buku' => $total_nominal_buku
                ];
            }
        }
        if($this->tagihanBukuModel->insert_batch_tagihan_buku($data) && $this->tagihanBukuModel->insert_batch_detail_tagihan_buku($data_detail)){
            $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Tagihan buku berhasil ditambah']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Tagihan buku gagal ditambah']);
        }
        redirect(base_url('tagihanbuku'));
    }

    public function edit(){
        $id =  $this->input->get('id', true);

        $data['judul'] = 'Halaman tagihan buku';
        $data['tagihan_buku'] = $this->tagihanBukuModel->get_tagihan_buku_by_nisn($id);
        $data['buku'] = $this->tagihanBukuModel->get_buku();
        $data['detail_buku'] = $this->tagihanBukuModel->get_detail_tagihan_buku($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('tagihan_buku/edit', $data);
        $this->load->view('template/footer');
    }

    public function proses_edit(){
        $id = $this->input->post('id', true);
        $buku = $this->input->post('buku', true);
        $total_nominal_buku = 0;
        
        foreach ($buku as $bk) {
            $kotak[] = explode('/', $bk['nama'] );
        }

        $this->tagihanBukuModel->update($id, ['total_buku'=>0, 'total_nominal_buku'=> 0]);
        $this->tagihanBukuModel->delete_detail_tagihan($id);
        foreach ($kotak as $k) {
            $total_nominal_buku += $k[1];
            $data [] = [
                'id_tagihan'=>$id,
                'id_buku'=>$k[0]
            ];
        }
        if($this->tagihanBukuModel->insert_batch_detail_tagihan_buku($data)){
            $this->tagihanBukuModel->update($id, ['total_buku'=>count($buku), 'total_nominal_buku'=>$total_nominal_buku]);
            $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Tagihan buku berhasil dirubah']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Tagihan buku gagal dirubah']);
        }
        redirect(base_url('tagihanbuku'));

        
    }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->tagihanBukuModel->delete($id) && $this->tagihanBukuModel->delete_detail_tagihan($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Tagihan buku berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Tagihan buku gagal dihapus']);
        }
        redirect(base_url('tagihanbuku'));
    }

    public function get_data_tagihan_buku(){
        $list = $this->tagihanBukuModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->id_tagihan_buku;
            $row[] = $field->nama_siswa;
            $row[] = $field->nama_kelas;
            $row[] = $field->total_buku;
            $row[] = $field->total_nominal_buku;
            $row[] = "  <a href='".base_url('tagihanbuku/edit?id=')."".$field->id_tagihan_buku."'><button type='button' class='btn btn-primary'>Edit</button></a> |
            <a href='".base_url('tagihanbuku/hapus?id=')."".$field->id_tagihan_buku."' onclick='return confirm(\"Anda yakin ingin menghapus tagihan buku ini ?\")'><button type='button' class='btn btn-danger'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tagihanBukuModel->count_all(),
            "recordsFiltered" => $this->tagihanBukuModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
?>