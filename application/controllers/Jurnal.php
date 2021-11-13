<?php

class Jurnal extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('jurnalModel');
    }

    public function index(){
        $data['judul'] = "Halaman jurnal";
        $data['bulan'] = $this->_bulan();
        $data['tahun'] = $this->_tahun();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('jurnal/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('keterangan', 'Keterangan transaksi', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('jenis_saldo', 'Jenis transaksi', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('saldo', 'Saldo', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_transaksi', 'Tanggal transaksi', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            $data['judul'] = "Halaman jurnal";
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('jurnal/tambah');
            $this->load->view('template/footer');
        }else{
            $waktu = new DateTime();
            $data = [
                'keterangan_jurnal'=>$this->input->post('keterangan', true),
                'tgl_input'=> $waktu->format('Y-m-d'),
                'tgl_transaksi'=>$this->input->post('tgl_transaksi', true),
                'jenis_saldo'=>$this->input->post('jenis_saldo', true),
                'saldo'=>$this->input->post('saldo', true)
            ];
            if($this->jurnalModel->insert($data)){
                $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Data jurnal berhasil ditambah']);
            }else{
                $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Data jurnal gagal ditambah']);
            }
            redirect(base_url('jurnal'));
        }
    }

    public function edit(){
        $id = $this->input->get('id', true);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('keterangan', 'Keterangan transaksi', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('jenis_saldo', 'Jenis transaksi', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('saldo', 'Saldo', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_transaksi', 'Tanggal transaksi', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        $data['judul'] = "Halaman jurnal";
        $data['jurnal'] = $this->jurnalModel->get_jurnal($id);
        if($this->form_validation->run() == FALSE){
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('jurnal/edit', $data);
            $this->load->view('template/footer');
        }else{
            $waktu = new DateTime();
            $data = [
                'keterangan_jurnal'=>$this->input->post('keterangan', true),
                'tgl_input'=> $waktu->format('Y-m-d'),
                'tgl_transaksi'=>$this->input->post('tgl_transaksi', true),
                'jenis_saldo'=>$this->input->post('jenis_saldo', true),
                'saldo'=>$this->input->post('saldo', true)
            ];
            if($this->jurnalModel->update($id, $data)){
                $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Data jurnal berhasil dirubah']);
            }else{
                $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Data jurnal gagal dirubah']);
            }
            redirect(base_url('jurnal'));
        }
    }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->jurnalModel->delete($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data jurnal berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data jurnal gagal dihapus']);
        }
        redirect(base_url('jurnal'));
    }

    public function get_data_jurnal(){
        $list = $this->jurnalModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $total = 0;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->tgl_transaksi;
            $row[] = $field->keterangan_jurnal;
            if($field->jenis_saldo == 'masuk'){
                $row[] = number_format($field->saldo);
                $row[] = 0;
                $total += $field->saldo;
            }else{
                $row[] = 0;
                $row[] = number_format($field->saldo);
                $total -= $field->saldo;
            }
            $row[] = number_format($total) ;
            $row[] = "  <a href='".base_url('jurnal/edit?id=')."".$field->id_jurnal."'><button type='button' class='btn btn-primary'>Edit</button></a> |
            <a href='".base_url('jurnal/hapus?id=')."".$field->id_jurnal."' onclick='return confirm(\"Anda yakin ingin menghapus transaksi ini ?\")'><button type='button' class='btn btn-danger'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->jurnalModel->count_all(),
            "recordsFiltered" => $this->jurnalModel->count_filtered(),
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
        $list = $this->jurnalModel->get_export();
        $no = 1;
        $total = 0;

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('');
        $pdf->Write(0, 'Jurnal Umum', '', 0, 'C', true, 0, false, false, 0);
        $pdf->SetFont('');
 
        $tabel = '
        <table border="1" align="center">
              <tr>
                    <th style="width: 30px;"> No </th>
                    <th> Tanggal </th>
                    <th style="width: 25%;"> Keterangan </th>
                    <th> Pemasukan </th>
                    <th> Pengeluaran </th>
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
                        <td>0</td>
                        <td>Rp.'.number_format($total).'</td>
                        </tr>';
                    }else{
                        $total -= $field->saldo;
                        $tabel .= '<tr>
                        <td>'.$no.'</td>
                        <td>'.$field->tgl_transaksi.'</td>
                        <td>'.$field->keterangan_jurnal.'</td>
                        <td>0</td>
                        <td>Rp.'.number_format($field->saldo).'</td>
                        <td>Rp.'.number_format($total).'</td>
                        </tr>';
                    }
                    $no++;
                }
                $tabel .= '<tr><td colspan="5">Total </td><td>Rp.'.number_format($total).'</td></tr>';
                $tabel .= '</table>';
                $pdf->writeHTML($tabel);
                $pdf->Output('jurnal-umum.pdf', 'I');
            }
}
?>