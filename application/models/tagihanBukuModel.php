<?php

class tagihanBukuModel extends CI_Model{
    var $table = 'tabel_tagihan_buku';
    var $kolom_order = array(null,null, 'nama_siswa');
    var $kolom_cari = array('nama_siswa');
    var $order = array('nama_siswa'=>'asc');

    private function get_datatables_query(){
        $this->db->select('tabel_tagihan_buku.*, tabel_siswa.nama_siswa, tabel_kelas.nama_kelas');
        $this->db->from($this->table);
        $this->db->join('tabel_siswa', 'tabel_siswa.nisn_siswa = tabel_tagihan_buku.nisn_siswa','inner');
        $this->db->join('tabel_kelas', 'tabel_kelas.id_kelas = tabel_tagihan_buku.id_kelas', 'inner');
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

    public function get_buku(){
        $this->db->select('*');
        $this->db->from('tabel_buku');
        return $this->db->get()->result_array();
    }

    public function get_siswa($kelas, $jurusan, $angktan){
        $this->db->select('*');
        $this->db->from('tabel_siswa');
        $this->db->where(['id_kelas'=>$kelas, 'id_jurusan'=>$jurusan, 'id_angkatan'=>$angktan, 'status'=>'aktif']);
        return $this->db->get()->result_array();
    }

    public function insert_batch_tagihan_buku($data){
        return $this->db->insert_batch('tabel_tagihan_buku', $data);
    }

    public function insert_batch_detail_tagihan_buku($data){
        return $this->db->insert_batch('tabel_detail_tagihan_buku', $data);
    }

    public function get_tagihan_buku($nisn, $kelas){
        $this->db->select('*');
        $this->db->from('tabel_tagihan_buku');
        $this->db->where(['nisn_siswa'=>$nisn, 'id_kelas'=>$kelas]);
        return $this->db->count_all_results();
    }

    public function get_tagihan_buku_by_nisn($id){
        $this->db->select('tabel_tagihan_buku.*, tabel_siswa.nama_siswa, tabel_kelas.nama_kelas, tabel_jurusan.nama_jurusan');
        $this->db->from('tabel_tagihan_buku');
        $this->db->join('tabel_siswa', 'tabel_siswa.nisn_siswa=tabel_tagihan_buku.nisn_siswa');
        $this->db->join('tabel_kelas', 'tabel_kelas.id_kelas=tabel_siswa.id_kelas');
        $this->db->join('tabel_jurusan', 'tabel_jurusan.id_jurusan=tabel_siswa.id_jurusan');
        $this->db->where('id_tagihan_buku', $id);
        return $this->db->get()->row();
    }

    public function get_detail_tagihan_buku($id){
        $this->db->select('*');
        $this->db->from('tabel_detail_tagihan_buku');
        $this->db->where('id_tagihan', $id);
        return $this->db->get()->result_array();
    }

    public function update($id, $data){
        $this->db->where('id_tagihan_buku', $id);
        return $this->db->update('tabel_tagihan_buku', $data);
    }

    public function delete_detail_tagihan($id){
        $this->db->where('id_tagihan', $id);
        return $this->db->delete('tabel_detail_tagihan_buku');
    }

    public function delete($id){
        $this->db->where('id_tagihan_buku', $id);
        return $this->db->delete('tabel_tagihan_buku');
    }
}
?>