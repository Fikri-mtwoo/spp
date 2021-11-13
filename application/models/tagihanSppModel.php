<?php

class tagihanSppModel extends CI_Model{
    var $table = 'tabel_transaksi_spp';
    var $kolom_order = array(null,'nama_siswa');
    var $kolom_cari = array('nama_siswa');
    var $order = array('nama_siswa'=>'asc');

    private function get_datatables_query(){
        $this->db->select('tabel_transaksi_spp.*, tabel_siswa.nama_siswa, tabel_kelas.nama_kelas, tabel_spp.nominal_spp');
        $this->db->from($this->table);
        $this->db->join('tabel_siswa', 'tabel_siswa.nisn_siswa = tabel_transaksi_spp.nisn_siswa','inner');
        $this->db->join('tabel_kelas', 'tabel_kelas.id_kelas = tabel_transaksi_spp.id_kelas', 'inner');
        $this->db->join('tabel_spp', 'tabel_spp.id_spp = tabel_transaksi_spp.id_spp','inner');
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

    public function get_kelas(){
        $this->db->select('*');
        $this->db->from('tabel_kelas');
        return $this->db->get()->result_array();
    }

    public function get_jurusan(){
        $this->db->select('*');
        $this->db->from('tabel_jurusan');
        return $this->db->get()->result_array();
    }

    public function get_angkatan(){
        $this->db->select('*');
        $this->db->from('tabel_angkatan');
        return $this->db->get()->result_array();
    }

    public function get_spp($id){
        $this->db->select_max('id_spp', 'id_spp');
        $this->db->from('tabel_spp');
        $this->db->where('id_angkatan', $id);
        return $this->db->get()->row();
    }

    public function get_siswa($kelas, $jurusan, $angktan){
        $this->db->select('*');
        $this->db->from('tabel_siswa');
        $this->db->where(['id_kelas'=>$kelas, 'id_jurusan'=>$jurusan, 'id_angkatan'=>$angktan, 'status'=>'aktif']);
        return $this->db->get()->result_array();
    }

    public function insert_batch_spp($data){
        return $this->db->insert_batch('tabel_transaksi_spp', $data);
    }

    public function get_transaksi_spp($nisn, $kelas){
        $this->db->select('*');
        $this->db->from('tabel_transaksi_spp');
        $this->db->group_by("nisn_siswa");
        $this->db->where('nisn_siswa', $nisn);
        $this->db->where('id_kelas', $kelas);
        // return $this->db->get()->result_array();
        return $this->db->count_all_results();
    }

    public function delete_transaksi($id, $data){
        $this->db->where('id_transaksi_spp', $id);
        return $this->db->update('tabel_transaksi_spp', $data);
    }
}
?>