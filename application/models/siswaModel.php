<?php

class siswaModel extends CI_Model{
    var $table = 'tabel_siswa';
    var $kolom_order = array(null,null,null,'nama_siswa');
    var $kolom_cari = array('nama_siswa');
    var $order = array('nama_siswa'=>'asc');

    private function get_datatables_query(){
        $this->db->select('tabel_siswa.nisn_siswa, tabel_siswa.nis_siswa, tabel_siswa.nama_siswa, tabel_siswa.id_kelas, tabel_siswa.id_jurusan, tabel_siswa.jenis_kelamin, tabel_siswa.alamat, tabel_siswa.no_telp, tabel_siswa.id_angkatan, tabel_siswa.profile, tabel_siswa.status, tabel_kelas.nama_kelas,  tabel_jurusan.nama_jurusan, tabel_angkatan.tahun_angkatan');
        $this->db->from($this->table);
        $this->db->join('tabel_kelas', 'tabel_kelas.id_kelas = tabel_siswa.id_kelas', 'inner');
        $this->db->join('tabel_jurusan', 'tabel_jurusan.id_jurusan = tabel_siswa.id_jurusan','inner');
        $this->db->join('tabel_angkatan', 'tabel_angkatan.id_angkatan = tabel_siswa.id_angkatan','inner');
        $i=0;
        foreach ($this->kolom_cari as $item) {
            if($_POST['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->kolom_cari) -1 == $i){
                    $this->db->group_end();
                }
            }
            $i++;
            if(isset($_POST['order'])){
                $this->db->order_by($this->kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }else if(isset($this->order)){
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    }
    public function get_datatables()
    {
        $this->get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    public function count_filtered()
    {
        $this->get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function insert($data){
        return $this->db->insert('tabel_siswa', $data);
    }

    public function insert_transaksi_gedung($data){
        return $this->db->insert('tabel_tagihan_gedung', $data);
    }

    public function insert_transaksi_pendaftaran($data){
        return $this->db->insert('tabel_transaksi_pendaftaran', $data);
    }

    public function get_by_id($data){
        $this->db->select('*');
        $this->db->from('tabel_siswa');
        $this->db->where($data);
        return $this->db->get()->row();
    }

    public function update($id, $data){
        $this->db->where('nisn_siswa', $id);
        return $this->db->update('tabel_siswa', $data);
    }

    public function delete($id){
        $this->db->where('nisn_siswa', $id);
        return $this->db->delete('tabel_siswa');
    }

    public function get_angkatan(){
        $this->db->select('*');
        $this->db->from('tabel_angkatan');
        return $this->db->get()->result_array();
    }

    public function get_kelas(){
        $this->db->select('id_kelas, nama_kelas');
        $this->db->from('tabel_kelas');
        return $this->db->get()->result_array();
    }

    public function get_jurusan(){
        $this->db->select('id_jurusan, nama_jurusan');
        $this->db->from('tabel_jurusan');
        return $this->db->get()->result_array();
    }

    public function get_spp($id){
        $this->db->select_max('id_spp', 'id_spp');
        $this->db->from('tabel_spp');
        $this->db->where('id_angkatan', $id);
        return $this->db->get()->row();
    }
}
?>