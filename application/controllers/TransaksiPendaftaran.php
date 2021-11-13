<?php

class TransaksiPendaftaran extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksiPendaftaranModel');
    }

    public function index(){
        $data['judul'] = "Halaman transaksi pendaftaran";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_pendaftaran/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $data['judul'] = "Halaman transaksi pendaftaran";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_pendaftaran/tambah');
        $this->load->view('template/footer');
    }

    public function get_data_siswa(){
        $id = $this->input->post('id', true);
        $siswa = $this->transaksiPendaftaranModel->get_siswa($id);
        $transaksi = $this->transaksiPendaftaranModel->get_transaksi_pendaftaran($id);
        if($siswa){
            $data = (object) array_merge((array) $siswa, (array) $transaksi);
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
            'jumlah_bayar'=>$jumlah_bayar,
            'tanggal_bayar'=>$waktu->format('Y-m-d'),
            'keterangan'=>$keterangan,
            'id_petugas'=>1
        ];
        if($this->transaksiPendaftaranModel->insert($id, $nisn, $data)){
            $data = true;
        }else{
            $data = false;
        }
        echo json_encode($data);
    }

    public function get_data_histori(){
        $id = $this->input->post('id', true);
        $histori = $this->transaksiPendaftaranModel->get_transaksi_pendaftaran_all($id);
        if($histori){
            $data = $histori;
        }else{
            $data = null;
        }
        echo json_encode($data);
    }

    public function edit(){
        $id = $this->input->get('id',true);
        $data = [
            'jumlah_bayar'=> null,
            'tanggal_bayar' => null,
            'keterangan' => null,
            'id_petugas' => null
        ];
        if($this->transaksiPendaftaranModel->update($id, $data)){
            $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Transaksi pendaftaran berhasil dirubah']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Transaksi pendaftaran gagal dirubah']);
        }
        redirect(base_url('transaksipendaftaran'));
    }

    public function get_data_transaksi_pendaftaran(){
        $list = $this->transaksiPendaftaranModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->id_transaksi_pendaftaran;
            $row[] = $field->nominal_pendaftaran;
            $row[] = $field->nama_siswa;
            $row[] = $field->jumlah_bayar;
            $row[] = $field->tanggal_bayar;
            $row[] = $field->keterangan;
            $row[] = $field->nama_petugas;
            $row[] = "  <a href='".base_url('transaksipendaftaran/edit?id=')."".$field->id_transaksi_pendaftaran."'><button type='button' class='btn btn-primary'>Edit</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->transaksiPendaftaranModel->count_all(),
            "recordsFiltered" => $this->transaksiPendaftaranModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function export(){
        $this->load->library('pdf');
        $siswa = $this->transaksiPendaftaranModel->get_export_siswa($this->input->post('nisn', true));
        $pendaftaran = $this->transaksiPendaftaranModel->get_export_tagihan($this->input->post('nisn', true));
        $transaksi_pendaftaran = $this->transaksiPendaftaranModel->get_export_transaksi($this->input->post('nisn', true));
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
                foreach ($pendaftaran as $pftn) {
                $tagihan .='<tr>
                                <td>'.$no++.'</td>
                                <td align="left"> Gedung </td>
                                <td>Rp. '.number_format($pftn->nominal_pendaftaran).'</td>
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
                foreach ($transaksi_pendaftaran as $trsk) {
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
                $pdf->Output('transaksi-pendaftaran.pdf', 'I');
    }
}
?>