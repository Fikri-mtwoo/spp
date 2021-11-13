<?php

class TransaksiSpp extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksiSppModel');
    }

    public function index(){
        $data['judul'] = "Halaman transaksi spp";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_spp/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $data['judul'] = "Halaman transaksi spp";
        $data['kelas'] = $this->transaksiSppModel->get_kelas();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_spp/tambah', $data);
        $this->load->view('template/footer');
    }

    public function get_data_siswa(){
        $id = $this->input->post('id', true);
        $kelas = $this->input->post('kelas', true);
        $siswa = $this->transaksiSppModel->get_siswa($id, $kelas);
        if($siswa){
            $data = (object) array_merge((array) $siswa);
        }else{
            $data = null;
        }
        echo json_encode($data);
    }

    public function get_data_transaksi(){
        $id = $this->input->post('id', true);
        $kelas = $this->input->post('kelas', true);
        $transaksi = $this->transaksiSppModel->get_transaksi($id, $kelas);
        if($transaksi){
            $data = $transaksi;
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
        if($this->transaksiSppModel->insert($id, $nisn, $data)){
            $data = true;
        }else{
            $data = false;
        }
        echo json_encode($data);
    }

    public function get_data_histori(){
        $id = $this->input->post('id', true);
        $kelas = $this->input->post('kelas', true);
        $histori = $this->transaksiSppModel->get_transaksi_spp_all($id, $kelas);
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
        if($this->transaksiSppModel->update($id, $data)){
            $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Transaksi spp berhasil dirubah']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Transaksi spp gagal dirubah']);
        }
        redirect(base_url('transaksispp'));
    }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->transaksiSppModel->delete($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Transaksi spp berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Transaksi spp gagal dihapus']);
        }
        redirect(base_url('transaksispp'));
    }

    public function get_data_transaksi_spp(){
        $list = $this->transaksiSppModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->id_transaksi_spp;
            $row[] = $field->nominal_spp;
            $row[] = $field->nama_siswa;
            $row[] = $field->nama_kelas;
            $row[] = $field->bulan_spp.'/'.$field->tahun_spp;
            $row[] = $field->jumlah_bayar;
            $row[] = $field->tanggal_bayar;
            $row[] = $field->nama_petugas;
            $row[] = "  <a href='".base_url('transaksispp/edit?id=')."".$field->id_transaksi_spp."'><button type='button' class='btn btn-primary'>Edit</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->transaksiSppModel->count_all(),
            "recordsFiltered" => $this->transaksiSppModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function export(){
        $this->load->library('pdf');
        $siswa = $this->transaksiSppModel->get_export_siswa($this->input->post('nisn', true));
        $spp = $this->transaksiSppModel->get_export_tagihan($this->input->post('nisn', true), $this->input->post('kelas', true));
        $transaksi_spp = $this->transaksiSppModel->get_export_transaksi($this->input->post('nisn', true), $this->input->post('kelas', true));
        $no = 1;
        $total = 0;

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
                        <td style="width:10%">No</td>
                        <td style="width:30%" align="left"> Bulan / Tahun</td>
                        <td style="width:30%">Tagihan perbulan</td>
                        <td style="width:30%">Keterangan</td>
                    </tr>';
                foreach ($spp as $s) {
                    if($s->keterangan !== null){
                        $tagihan .='<tr>
                                        <td>'.$no++.'</td>
                                        <td align="left"> '.$s->bulan_spp.' / '.$s->tahun_spp.'</td>
                                        <td>Rp. '.number_format($s->nominal_spp).'</td>
                                        <td>'.$s->keterangan.'</td>
                                    </tr>';
                    }else{
                        $tagihan .='<tr>
                                        <td>'.$no++.'</td>
                                        <td align="left"> '.$s->bulan_spp.' / '.$s->tahun_spp.'</td>
                                        <td>Rp. '.number_format($s->nominal_spp).'</td>
                                        <td> Belum dibayar </td>
                                    </tr>';
                    }
                $total += $s->nominal_spp;
                }
                
                $tagihan .= '<tr>
                        <td colspan ="3">Total </td>
                        <td>RP. '.number_format($total).'</td>
                    </tr>
                </table>';

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
                foreach ($transaksi_spp as $trsk) {
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
                $pdf->Output('transaksi-spp.pdf', 'I');
    }
}
?>