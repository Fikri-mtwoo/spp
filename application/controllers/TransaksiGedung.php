<?php

class TransaksiGedung extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksiGedungModel');
    }

    public function index(){
        $data['judul'] = "Halaman transaksi gedung";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_gedung/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $data['judul'] = "Halaman transaksi gedung";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_gedung/tambah');
        $this->load->view('template/footer');
    }

    public function get_data_siswa(){
        $id = $this->input->post('id', true);
        $siswa = $this->transaksiGedungModel->get_siswa($id);
        $tagihan = $this->transaksiGedungModel->get_tagihan_gedung($id);
        $transaksi = $this->transaksiGedungModel->get_transaksi_gedung($id);
        if($siswa){
            $data = (object) array_merge((array) $siswa, (array) $transaksi, (array) $tagihan);
        }else{
            $data = null;
        }
        echo json_encode($data);
    }

    public function get_data_histori(){
        $id = $this->input->post('id', true);
        $histori = $this->transaksiGedungModel->get_transaksi_gedung_all($id);
        if($histori){
            $data = $histori;
        }else{
            $data = null;
        }
        echo json_encode($data);
    }
    
    public function proses_tambah(){
        $id = $this->input->post('id', true);
        $keterangan = $this->input->post('keterangan', true);
        $jumlah_bayar = $this->input->post('jumlah_bayar', true);
        $nisn = $this->input->post('nisn', true);
        $waktu = new DateTime();
        $data = [
            'id_transaksi_gedung'=>'TRSKGD'.mt_rand(100, 1000).''.mt_rand(1000, 10000),
            'id_tagihan_gedung'=> $id,
            'nisn_siswa'=>$nisn,
            'jumlah_bayar'=>$jumlah_bayar,
            'tanggal_bayar'=>$waktu->format('Y-m-d'),
            'keterangan'=>$keterangan,
            'id_petugas'=>1
        ];
        if($this->transaksiGedungModel->insert($data)){
            $data = true;
        }else{
            $data = false;
        }
        echo json_encode($data);
    }

    public function edit(){
        $id = $this->input->get('id', true);

        $data['judul'] = "Halaman transaksi gedung";
        $data['transaksi'] = $this->transaksiGedungModel->get_where_transaksi_gedung($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_gedung/edit', $data);
        $this->load->view('template/footer');
    }

    public function proses_edit(){
        $id = $this->input->post('id',true);
        $waktu = new DateTime();
        $data = [
            'jumlah_bayar'=> $this->input->post('jumlah_bayar',true),
            'tanggal_bayar' => $waktu->format('Y-m-d'),
            'keterangan' => $this->input->post('keterangan',true)
        ];
        if($this->transaksiGedungModel->update($id, $data)){
            $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Transaksi gedung berhasil dirubah']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Transaksi gedung gagal dirubah']);
        }
        redirect(base_url('transaksigedung'));
    }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->transaksiGedungModel->delete($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Transaksi gedung berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Transaksi gedung gagal dihapus']);
        }
        redirect(base_url('transaksigedung'));
    }

    public function get_data_transaksi_gedung(){
        $list = $this->transaksiGedungModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->id_transaksi_gedung;
            $row[] = $field->nominal_gedung;
            $row[] = $field->nama_siswa;
            $row[] = $field->jumlah_bayar;
            $row[] = $field->tanggal_bayar;
            $row[] = $field->keterangan;
            $row[] = $field->nama_petugas;
            $row[] = "  <a href='".base_url('transaksigedung/edit?id=')."".$field->id_transaksi_gedung."'><button type='button' class='btn btn-primary'>Edit</button></a> |
            <a href='".base_url('transaksigedung/hapus?id=')."".$field->id_transaksi_gedung."' onclick='return confirm(\"Anda yakin ingin menghapus transaksi ini ?\")'><button type='button' class='btn btn-danger'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->transaksiGedungModel->count_all(),
            "recordsFiltered" => $this->transaksiGedungModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function export(){
        $this->load->library('pdf');
        $siswa = $this->transaksiGedungModel->get_export_siswa($this->input->post('nisn', true));
        $gedung = $this->transaksiGedungModel->get_export_tagihan($this->input->post('nisn', true));
        $transaksi_gedung = $this->transaksiGedungModel->get_export_transaksi($this->input->post('nisn', true));
        $no = 1;

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('');
        $pdf->Write(0, 'Transaksi Buku', '', 0, 'C', true, 0, false, false, 0);
        $pdf->Ln();
        $pdf->SetFont('');
 
        $biodata = '
        <table border="1" align="left" style="width:100%">
              <tr>
                    <th rowspan="6" align="cneter" valign="middle">
                        <img src="'.base_url('assets/images/avatar.jpg').'" width="75">
                    </th>
                    <th style="width:10%" align="left"> NISN : </th>
                    <th style="width:30%"> '.$siswa->nisn_siswa.' </th>
                    <th style="width:10%" align="left"> NIS : </th>
                    <th style="width:30%"> '.$siswa->nis_siswa.' </th>
              </tr>
              <tr>
                    <th colspan="2" style="width:25%" align="left"> Nama Siswa : </th>
                    <th colspan="2" style="width:55%"> '.$siswa->nama_siswa.' </th>
              </tr>
              <tr>
                    <th colspan="2" align="left"> Jenis Kelamin :</th>
                    <th colspan="2"> '.$siswa->jenis_kelamin.' </th>
              </tr>
              <tr>
                    <th colspan="2" align="left"> Kelas / Jurusan :</th>
                    <th colspan="2"> '.$siswa->nama_kelas.' / '.$siswa->nama_jurusan.'</th>
              </tr>
              <tr>
                    <th colspan="2" align="left"> No Telepon/HP :</th>
                    <th colspan="2"> '.$siswa->no_telp.'</th>
              </tr>
              <tr>
                    <th colspan="2" align="left"> Alamat :</th>
                    <th colspan="2"> '.$siswa->alamat.' </th>
              </tr>
              ';
                $biodata .= '</table>';
                $pdf->writeHTML($biodata);
                $pdf->Ln();
                
                $tagihan = '<table border="1" align="center">
                    <tr>
                        <td style="width:10%"> No</td>
                        <td style="width:50%" align="left"> Nama Tagihan</td>
                        <td style="width:40%"> Total Tagihan</td>
                    </tr>';
                foreach ($gedung as $gdn) {
                $tagihan .='<tr>
                                <td>'.$no++.'</td>
                                <td align="left"> Gedung </td>
                                <td>Rp. '.number_format($gdn->nominal_gedung).'</td>
                            </tr>';
                }
                
                $tagihan .= '</table>';
                $pdf->writeHTML($tagihan);
                $pdf->Ln();
                $transaksi = '<table border="1" align="center">
                    <tr>
                        <td style="width:5%">No</td>
                        <td style="width:30%">Keterangan</td>
                        <td style="width:20%">Tanggal Bayar</td>
                        <td style="width:20%">Jumlah Bayar</td>
                        <td style="width:25%">Nama Petugas</td>
                    </tr>';
                $no=1;
                foreach ($transaksi_gedung as $trsk) {
                    $transaksi .= '<tr>
                            <td>'.$no++.'</td>
                            <td>'.$trsk->keterangan.'</td>
                            <td>'.$trsk->tanggal_bayar.'</td>
                            <td>RP. '.$trsk->jumlah_bayar.'</td>
                            <td>'.$trsk->nama_petugas.'</td>
                        </tr>';
                }
                $transaksi .= '</table>';
                $pdf->writeHTML($transaksi);
                $pdf->Output('transaksi-gedung.pdf', 'I');
    }
}
?>