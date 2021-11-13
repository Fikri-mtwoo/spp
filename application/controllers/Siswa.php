<?php 

class Siswa extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('siswaModel');
    }

    public function index(){
        $data['judul'] = 'Halaman siswa';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('siswa/index');
        $this->load->view('template/footer');
    }

    public function tambah(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('nisn', 'NISN Siswa', 'required|trim|max_length[10]|min_length[10]', ['required'=>'%s tidak boleh kosong','max_length'=>'%s tidak boleh melebihi dari 10', 'min_length'=>'%s tidak boleh kurang dari 10']);
        $this->form_validation->set_rules('nis', 'NIS Siswa', 'required|trim|max_length[10]', ['required'=>'%s tidak boleh kosong', 'max_length'=>'%s tidak boleh melebihi dari 10']);
        $this->form_validation->set_rules('nama', 'Nama Siswa', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('alamat', 'Alamat Siswa', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('tlp', 'Nomor Telepon/Hp', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('angkatan', 'Tahun Angkatan', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('kelas', 'Kelas Siswa', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('jurusan', 'Jurusan Siswa', 'required|trim', ['required'=>'%s tidak boleh kosong']);

        $data['angkatan'] = $this->siswaModel->get_angkatan();
        $data['kelas'] = $this->siswaModel->get_kelas();
        $data['jurusan'] = $this->siswaModel->get_jurusan();

        if($this->form_validation->run() == FALSE){
            $data['judul'] = 'Halaman siswa'; 
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar');
            $this->load->view('siswa/tambah',$data);
            $this->load->view('template/footer');
        }else{
            $spp = $this->siswaModel->get_spp($this->input->post('angkatan', true));
            $data = [
                'nisn_siswa' => $this->input->post('nisn', true),
                'nis_siswa' => $this->input->post('nis', true),
                'nama_siswa' => $this->input->post('nama', true),
                'id_kelas' => $this->input->post('kelas', true),
                'id_jurusan' => $this->input->post('jurusan', true),
                'jenis_kelamin' => $this->input->post('jk', true),
                'alamat' => $this->input->post('alamat', true),
                'no_telp' => $this->input->post('tlp', true),
                'id_angkatan' => $this->input->post('angkatan', true),
                'profile' => null,
                'status' => 'aktif',
            ];
            $data_gedung = [
                'id_tagihan_gedung'=> 'TGNGD'.mt_rand(100, 1000),
                'nisn_siswa'=> $this->input->post('nisn', true),
                'id_spp'=> $spp->id_spp
            ];
            $data_pendaftaran = [
                'id_transaksi_pendaftaran'=> 'TRSKPDF'.mt_rand(100, 1000),
                'nisn_siswa'=> $this->input->post('nisn', true),
                'id_spp'=> $spp->id_spp,
                'jumlah_bayar'=> null,
                'tanggal_bayar'=> null,
                'keterangan'=> null,
                'id_petugas'=> null
            ];
            if($this->siswaModel->insert($data)){
                $this->siswaModel->insert_transaksi_gedung($data_gedung);
                $this->siswaModel->insert_transaksi_pendaftaran($data_pendaftaran);
                $this->session->set_flashdata(['type'=>'alert-success','pesan'=>'Data siswa berhasil ditambah']);
            }else{
                $this->session->set_flashdata(['type'=>'alert-danger','pesan'=>'Data siswa gagal ditambah']);
            }
            redirect(base_url('siswa'));
        }
    }

    public function edit(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('nisn', 'NISN Siswa', 'required|trim|max_length[10]|min_length[10]', ['required'=>'%s tidak boleh kosong','max_length'=>'%s tidak boleh melebihi dari 10', 'min_length'=>'%s tidak boleh kurang dari 10']);
        $this->form_validation->set_rules('nis', 'NIS Siswa', 'required|trim|max_length[10]', ['required'=>'%s tidak boleh kosong', 'max_length'=>'%s tidak boleh melebihi dari 10']);
        $this->form_validation->set_rules('nama', 'Nama Siswa', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('alamat', 'Alamat Siswa', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('tlp', 'Nomor Telepon/Hp', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('kelas', 'Kelas Siswa', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        $this->form_validation->set_rules('jurusan', 'Jurusan Siswa', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        
        $id = $this->input->get('id', true);
        $data['siswa'] = $this->siswaModel->get_by_id(['nisn_siswa'=>$id]);
        $data['kelas'] = $this->siswaModel->get_kelas();
        $data['jurusan'] = $this->siswaModel->get_jurusan();
        $data['judul'] = 'Halaman siswa'; 

        if($this->form_validation->run() == FALSE){
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('siswa/edit',$data);
                $this->load->view('template/footer');
        }else{
            $data = [
                'nis_siswa' => $this->input->post('nis', true),
                'nama_siswa' => $this->input->post('nama', true),
                'id_kelas' => $this->input->post('kelas', true),
                'id_jurusan' => $this->input->post('jurusan', true),
                'jenis_kelamin' => $this->input->post('jk', true),
                'alamat' => $this->input->post('alamat', true),
                'no_telp' => $this->input->post('tlp', true),
                'status' => $this->input->post('status', true)
            ];
            if($this->siswaModel->update($this->input->post('nisn', true), $data)){
                $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data siswa berhasil dirubah']);
            }else{
                $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data siswa gagal dirubah']);
            }
            redirect(base_url('siswa'));
        }

    }

    public function akun(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');

        $this->form_validation->set_rules('nisn', 'NISN Siswa', 'required|trim|max_length[10]|min_length[10]', ['required'=>'%s tidak boleh kosong','max_length'=>'%s tidak boleh melebihi dari 10', 'min_length'=>'%s tidak boleh kurang dari 10']);
        $this->form_validation->set_rules('nis', 'NIS Siswa', 'required|trim|max_length[10]', ['required'=>'%s tidak boleh kosong', 'max_length'=>'%s tidak boleh melebihi dari 10']);
        $this->form_validation->set_rules('nama', 'Nama Siswa', 'required|trim', ['required'=>'%s tidak boleh kosong']);
        
        $id = $this->input->get('id', true);
        $data['siswa'] = $this->siswaModel->get_by_id(['nisn_siswa'=>$id]);
        $data['judul'] = 'Halaman siswa';
        $data['error'] = null; 

        if($this->form_validation->run() == FALSE){
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('siswa/akun',$data);
                $this->load->view('template/footer');
        }else{
            $waktu = new DateTime();
            $config['upload_path']          = 'assets/images/';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 2024;
            $config['file_name']            = mt_rand(100, 1000).''. $waktu->format('Ymd');

            $this->load->library('upload', $config);
            
            if($_FILES['profile']['name'] !== ''){

                if ($this->upload->do_upload('profile'))
                {
                    $gambar = $this->upload->data();
                    $data = [
                        'nis_siswa'=> $this->input->post('nis', true),
                        'nama_siswa'=> $this->input->post('nama', true),
                        'profile'=> $gambar['file_name']
                    ];
                    unlink('assets/images/'.$this->input->post('profile_lama', true));
                    if($this->siswaModel->update($this->input->get('id', true), $data)){
                        $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Profile siswa berhasil dirubah']);
                    }else{
                        $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Profile siswa gagal dirubah']);
                    }
                    redirect(base_url('siswa'));
                }
                else{
                        $data['error'] = $this->upload->display_errors();
                } 
                
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('siswa/akun',$data);
                $this->load->view('template/footer');

            }else if($_FILES['profile']['name'] == ''){
                redirect(base_url('siswa'));
            }
        }

    }

    public function hapus(){
        $id = $this->input->get('id', true);
        if($this->siswaModel->delete($id)){
            $this->session->set_flashdata(['type'=>'alert-success', 'pesan'=>'Data siswa berhasil dihapus']);
        }else{
            $this->session->set_flashdata(['type'=>'alert-danger', 'pesan'=>'Data siswa gagal dihapus']);
        }
        redirect(base_url('siswa'));
    }

    public function get_data_siswa(){
        $list = $this->siswaModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nisn_siswa;
            $row[] = $field->nis_siswa;
            $row[] = $field->nama_siswa;
            $row[] = $field->jenis_kelamin;
            $row[] = $field->alamat;
            $row[] = $field->no_telp;
            $row[] = $field->nama_kelas."/".$field->nama_jurusan;
            $row[] = $field->tahun_angkatan;
            $row[] = $field->status;
            if($field->profile == null){
                $row[] = "<img src='".base_url('assets/images/avatar.jpg')."' width='50%' height='50%'>";
            }else{
                $row[] = "<img src='".base_url('assets/images/')."".$field->profile."' width='50%' height='50%'>";
            }
            $row[] = "  <a href='".base_url('siswa/edit?id=')."".$field->nisn_siswa."'><button type='button' class='btn btn-primary'>Edit</button></a> | <a href='".base_url('siswa/akun?id=')."".$field->nisn_siswa."'><button type='button' class='btn btn-info'>Edit Profile</button></a> |
            <a href='".base_url('siswa/hapus?id=')."".$field->nisn_siswa."' onclick='return confirm(\"Anda yakin ingin menghapus siswa ? ".$field->nama_siswa."\")'><button type='button' class='btn btn-danger'>Hapus</button></a>";

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->siswaModel->count_all(),
            "recordsFiltered" => $this->siswaModel->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
?>