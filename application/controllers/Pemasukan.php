<?php

class Pemasukan extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pemasukanModel');
        $this->load->model('jurnalModel');
    }

    public function index(){
        $data['judul'] = "Halaman pemasukan";
        $data['bulan'] = $this->_bulan();
        $data['tahun'] = $this->_tahun();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('jurnal/pemasukan');
        $this->load->view('template/footer');
    }

    public function get_data_pemasukan(){
        $list = $this->pemasukanModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $total = 0;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->tgl_transaksi;
            $row[] = $field->keterangan_jurnal;
            $row[] = number_format($field->saldo);
            $total += $field->saldo;
            $row[] = number_format($total) ;

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pemasukanModel->count_all(),
            "recordsFiltered" => $this->pemasukanModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function _bulan(){
        $data = $this->jurnalModel->get_bulan();
        foreach ($data as $bln) {
            $b = explode('-', $bln['tgl_transaksi']);
            $bulan [] = $b[1];
        }
        return $bulan;
    }

    public function _tahun(){
        $data = $this->jurnalModel->get_tahun();
        foreach ($data as $thn) {
            $t = explode('-', $thn['tgl_transaksi']);
            $thun [] = $t[0];
        }
        return $thun;
    }

    public function export(){
        $this->load->library('pdf');
        $list = $this->pemasukanModel->get_export();
        $no = 1;
        $total = 0;

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('');
        $pdf->Write(0, 'Pemasukan', '', 0, 'C', true, 0, false, false, 0);
        $pdf->SetFont('');
 
        $tabel = '
        <table border="1" align="center">
              <tr>
                    <th style="width: 30px;"> No </th>
                    <th> Tanggal </th>
                    <th style="width: 25%;"> Keterangan </th>
                    <th> Pemasukan </th>
                    <th> Saldo </th>
              </tr>';
            foreach ($list as $field) {
                if($field->jenis_saldo == 'masuk'){
                    $total += $field->saldo;
                    $tabel .= '<tr>
                    <td>'.$no.'</td>
                    <td>'.$field->tgl_transaksi.'</td>
                    <td>'.$field->keterangan_jurnal.'</td>
                        <td>Rp.'.number_format($field->saldo).'</td>
                        <td>Rp.'.number_format($total).'</td>
                        </tr>';
                }
                    $no++;
                }
                $tabel .= '<tr><td colspan="4">Total </td><td>Rp.'.number_format($total).'</td></tr>';
                $tabel .= '</table>';
                $pdf->writeHTML($tabel);
                $pdf->Output('pemasukan.pdf', 'I');
    }
}