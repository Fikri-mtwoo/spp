<?php

class TransaksiBuku extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksiBukuModel');
    }

    public function index(){
        $data['judul'] = "Halaman transaksi buku";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_buku/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $data['judul'] = "Halaman transaksi buku";
        $data['kelas'] = $this->transaksiBukuModel->get_kelas();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_buku/tambah');
        $this->load->view('template/footer');
    }

    public function edit(){
        $id = $this->input->get('id', true);

        $data['judul'] = "Halaman transaksi buku";
        $data['transaksi'] = $this->transaksiBukuModel->get_where_transaksi_buku($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_buku/edit', $data);
        $this->load->view('template/footer');
    }

    public function get_data_siswa(){
        $id = $this->input->post('id', true);
        $kelas = $this->input->post('kelas', true);
        $siswa = $this->transaksiBukuModel->get_siswa($id);
        $tagihan = $this->transaksiBukuModel->get_tagihan_buku($id, $kelas);
        if($tagihan){
            $transaksi = $this->transaksiBukuModel->get_transaksi_buku($tagihan->id_tagihan_buku ,$id);
            $data = (object) array_merge((array) $siswa, (array) $tagihan, (array) $transaksi);
        }else{
            $data = null;
        }
        echo json_encode($data);
    }

    public function get_data_histori(){
        $id = $this->input->post('id', true);
        $kelas = $this->input->post('kelas', true);
        $tagihan = $this->transaksiBukuModel->get_tagihan_buku($id, $kelas);
        $histori = $this->transaksiBukuModel->get_transaksi_buku_all($tagihan->id_tagihan_buku, $id);
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
            'id_transaksi_buku'=>'TRSKGD'.mt_rand(100, 1000).''.mt_rand(1000, 10000),
            'nisn_siswa'=>$nisn,
            'id_tagihan_buku'=> $id,
            'jumlah_bayar'=>$jumlah_bayar,
            'tanggal_bayar'=>$waktu->format('Y-m-d'),
            'keterangan'=>$keterangan,
            'id_petugas'=>1
        ];
        if($this->transaksiBukuModel->insert($data)){
            $data = true;
        }else{
            $data = false;
        }
        echo json_encode($data);
    }

    public function proses_edit(){
        $id = $this->input->post('id',true);
        $waktu = new DateTime();
        $data = [
            'jumlah_bayar'=> $this->input->post('jumlah_bayar',true),
            'tanggal_bayar' => $waktu->format('Y-m-d'),
            'keterangan' => $this->input->post('keterangan',true)
        ];
        if($this->transaksiBukuModel->update($id, $data)){
            $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Transaksi buku berhasil dirubah']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Transaksi buku gagal dirubah']);
        }
        redirect(base_url('transaksibuku'));
    }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->transaksiBukuModel->delete($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Transaksi buku berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Transaksi buku gagal dihapus']);
        }
        redirect(base_url('transaksibuku'));
    }

    public function get_data_transaksi_buku(){
        $list = $this->transaksiBukuModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->id_transaksi_buku;
            $row[] = $field->total_nominal_buku;
            $row[] = $field->nama_siswa;
            $row[] = $field->nama_kelas;
            $row[] = $field->jumlah_bayar;
            $row[] = $field->tanggal_bayar;
            $row[] = $field->keterangan;
            $row[] = $field->nama_petugas;
            $row[] = "  <a href='".base_url('transaksibuku/edit?id=')."".$field->id_transaksi_buku."'><button type='button' class='btn btn-primary'>Edit</button></a> |
            <a href='".base_url('transaksibuku/hapus?id=')."".$field->id_transaksi_buku."' onclick='return confirm(\"Anda yakin ingin menghapus transaksi ini ?\")'><button type='button' class='btn btn-danger'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->transaksiBukuModel->count_all(),
            "recordsFiltered" => $this->transaksiBukuModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function export(){
        $this->load->library('pdf');
        $siswa = $this->transaksiBukuModel->get_export_siswa($this->input->post('nisn', true));
        $buku = $this->transaksiBukuModel->get_export_tagihan($this->input->post('nisn', true), $this->input->post('kelas', true));
        $transaksi_buku = $this->transaksiBukuModel->get_export_transaksi($this->input->post('nisn', true), $buku[0]->id_tagihan_buku);
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
                        <td style="width:10%">No</td>
                        <td style="width:50%" align="left"> Nama Buku</td>
                        <td style="width:40%">Harga Buku</td>
                    </tr>';
                foreach ($buku as $bku) {
                $tagihan .='<tr>
                                <td>'.$no++.'</td>
                                <td align="left"> '.$bku->nama_buku.'</td>
                                <td>Rp. '.number_format($bku->harga_buku).'</td>
                            </tr>';
                }
                
                $tagihan .= '<tr>
                        <td colspan ="2">Total </td>
                        <td>RP. '.number_format($bku->total_nominal_buku).'</td>
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
                foreach ($transaksi_buku as $trsk) {
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
                $pdf->Output('transaksi-buku.pdf', 'I');
    }
}
?>