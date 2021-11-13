<?php

class TagihanSpp extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tagihanSppModel');
    }

    public function index(){
        $data['judul'] = 'Halaman tagihan spp';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('tagihan_spp/index');
        $this->load->view('template/footer');
    }

    public function tambah(){

        $data['judul'] = 'Halaman tagihan spp';
        $data['kelas'] = $this->tagihanSppModel->get_kelas();
        $data['jurusan'] = $this->tagihanSppModel->get_jurusan();
        $data['angkatan'] = $this->tagihanSppModel->get_angkatan();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('tagihan_spp/tambah', $data);
        $this->load->view('template/footer');
    }

    public function proses_tambah(){
        $siswa = $this->input->post('siswa', true);
        $angkatan = $this->tagihanSppModel->get_spp($this->input->post('angkatan', true));
        $kelas = $this->input->post('kelas', true);
        foreach ($siswa as $a) {
            $cek = $this->tagihanSppModel->get_transaksi_spp($a['nisn'], $kelas);
            if($cek > 0){
                $this->session->set_flashdata(['type'=>'alert-warning','pesan'=>'Tagihan spp sudah ditambah']);
                redirect(base_url('tagihanspp'));
            }else{
                $max = 12;
                for ($i=0; $i <$max ; $i++) { 
                    $date = mktime(0,0,0, date('m')+$i, date('10'), date('Y'));
                    $tahun = date('Y', $date);
                    $bulan = date('m', $date);
                    $data [] = [
                        'id_transaksi_spp'=>'TRSKSPP'.mt_rand(100, 1000).''.mt_rand(1000, 10000),
                        'nisn_siswa'=>$a['nisn'],
                        'id_kelas'=>$kelas,
                        'id_spp'=>$angkatan->id_spp,
                        'bulan_spp'=> $bulan,
                        'tahun_spp'=> $tahun,
                        'jumlah_bayar'=>null,
                        'tanggal_bayar'=>null,
                        'id_petugas'=>null
                    ];    
                }
            }
        }
        if($this->tagihanSppModel->insert_batch_spp($data)){
            $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Tagihan spp berhasil ditambah']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Tagihan spp gagal ditambah']);
        }
        redirect(base_url('tagihanspp'));
    }

    public function get_data_siswa(){
        $siswa = $this->tagihanSppModel->get_siswa($this->input->post('kelas', true), $this->input->post('jurusan', true), $this->input->post('angkatan', true));
        if($siswa){
            $data = $siswa;
        }else{
            $data = null;
        }
        echo json_encode($data);
    }

    public function hapus(){
        $id = $this->input->get('id', true);
        $data = [
            'jumlah_bayar'=>null,
            'tanggal_bayar'=>null,
            'id_petugas'=>null
        ];
        if($this->tagihanSppModel->delete_transaksi($id, $data)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data transaksi spp berhasil dirubah']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data transaksi spp gagal dirubah']);
        }
        redirect(base_url('tagihanspp'));
    }

    public function get_data_tagihan_spp(){
        $list = $this->tagihanSppModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->id_transaksi_spp;
            $row[] = $field->nama_siswa;
            $row[] = $field->nama_kelas;
            $row[] = $field->nominal_spp;
            $row[] = $field->bulan_spp."/".$field->tahun_spp;
            $row[] = $field->jumlah_bayar;
            $row[] = $field->tanggal_bayar;
            $row[] = $field->id_petugas;
            $row[] = "  <a href='".base_url('tagihanspp/edit?id=')."".$field->id_transaksi_spp."'><button type='button' class='btn btn-primary btn-sm'>Edit</button></a> |
            <a href='".base_url('tagihanspp/hapus?id=')."".$field->id_transaksi_spp."' onclick='return confirm(\"Anda yakin ingin menghapus tagihan spp ini ?\")'><button type='button' class='btn btn-danger btn-sm'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tagihanSppModel->count_all(),
            "recordsFiltered" => $this->tagihanSppModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
?>