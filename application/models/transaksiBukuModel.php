<?php

class transaksiBukuModel extends CI_Model{
    var $table = 'tabel_transaksi_buku';
    var $kolom_order = array(null,null,null, 'nama_siswa');
    var $kolom_cari = array('nama_siswa');
    var $order = array('nama_siswa'=>'asc');

    private function get_datatables_query(){
        $this->db->select('tabel_transaksi_buku.*, tabel_siswa.nama_siswa, tabel_tagihan_buku.total_nominal_buku, tabel_kelas.nama_kelas, nama_petugas');
        $this->db->from($this->table);
        $this->db->join('tabel_siswa', 'tabel_siswa.nisn_siswa = tabel_transaksi_buku.nisn_siswa','inner');
        $this->db->join('tabel_tagihan_buku', 'tabel_tagihan_buku.id_tagihan_buku = tabel_transaksi_buku.id_tagihan_buku', 'inner');
        $this->db->join('tabel_kelas', 'tabel_kelas.id_kelas = tabel_tagihan_buku.id_kelas', 'inner');
        $this->db->join('tabel_petugas', 'tabel_petugas.id_petugas=tabel_transaksi_buku.id_petugas');
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

    public function get_siswa($nisn){
        $this->db->select('tabel_siswa.nisn_siswa, nama_siswa, jenis_kelamin, alamat, no_telp, profile');
        $this->db->from('tabel_siswa');
        $this->db->where(['nisn_siswa'=>$nisn, 'status'=>'aktif']);
        return $this->db->get()->row();
    }

    public function get_kelas(){
        $this->db->select('*');
        $this->db->from('tabel_kelas');
        return $this->db->get()->result_array();
    }

    public function get_max_kelas($nisn){
        $this->db->select_max('id_kelas');
        $this->db->from('tabel_siswa');
        $this->db->where('nisn_siswa', $nisn);
        return $this->db->get()->row();
    }

    public function get_tagihan_buku($nisn, $kelas){
        $this->db->select('tabel_tagihan_buku.*, tabel_kelas.nama_kelas');
        $this->db->from('tabel_tagihan_buku');
        $this->db->join('tabel_kelas', 'tabel_kelas.id_kelas=tabel_tagihan_buku.id_kelas');
        $this->db->where(['nisn_siswa'=>$nisn, 'tabel_tagihan_buku.id_kelas'=> $kelas]);
        return $this->db->get()->row();
    }

    public function get_transaksi_buku($id, $nisn){
        $this->db->select_sum('jumlah_bayar');
        $this->db->from('tabel_transaksi_buku');
        $this->db->where(['id_tagihan_buku'=>$id ,'nisn_siswa'=>$nisn]);
        return $this->db->get()->row();
    }

    public function get_transaksi_buku_all($id, $nisn){
        $this->db->select('*');
        $this->db->from('tabel_transaksi_buku');
        $this->db->join('tabel_petugas', 'tabel_petugas.id_petugas=tabel_transaksi_buku.id_petugas');
        $this->db->where(['id_tagihan_buku'=>$id, 'nisn_siswa'=>$nisn]);
        return $this->db->get()->result_array();
    }

    public function get_where_transaksi_buku($id){
        $this->db->select('tabel_transaksi_buku.*, nama_siswa, jenis_kelamin, alamat, no_telp, profile, nama_kelas');
        $this->db->from('tabel_transaksi_buku');
        $this->db->join('tabel_siswa', 'tabel_siswa.nisn_siswa=tabel_transaksi_buku.nisn_siswa');
        $this->db->join('tabel_tagihan_buku', 'tabel_tagihan_buku.id_tagihan_buku=tabel_transaksi_buku.id_tagihan_buku');
        $this->db->join('tabel_kelas', 'tabel_kelas.id_kelas=tabel_tagihan_buku.id_kelas');
        $this->db->where('id_transaksi_buku', $id);
        return $this->db->get()->row();
    }

    public function insert($data){
        return $this->db->insert('tabel_transaksi_buku', $data);
    }

    public function update($id, $data){
        $this->db->where('id_transaksi_buku', $id);
        return $this->db->update('tabel_transaksi_buku', $data);
    }

    public function delete($id){
        $this->db->where('id_transaksi_buku', $id);
        return $this->db->delete('tabel_transaksi_buku');
    }

    public function get_export_siswa($nisn){
        $this->db->select('tabel_siswa.nisn_siswa, nis_siswa, nama_siswa, jenis_kelamin, alamat, no_telp, profile, nama_kelas, nama_jurusan');
        $this->db->from('tabel_siswa');
        $this->db->join('tabel_kelas', 'tabel_kelas.id_kelas=tabel_siswa.id_kelas');
        $this->db->join('tabel_jurusan', 'tabel_jurusan.id_jurusan=tabel_siswa.id_jurusan');
        $this->db->where(['nisn_siswa'=>$nisn, 'status'=>'aktif']);
        return $this->db->get()->row();
    }
    public function get_export_tagihan($nisn, $kelas){
        $this->db->select('tabel_tagihan_buku.*, nama_buku, harga_buku');
        $this->db->from('tabel_tagihan_buku');
        $this->db->join('tabel_detail_tagihan_buku', 'tabel_detail_tagihan_buku.id_tagihan=tabel_tagihan_buku.id_tagihan_buku');
        $this->db->join('tabel_buku', 'tabel_buku.id_buku=tabel_detail_tagihan_buku.id_buku');
        $this->db->where(['nisn_siswa'=> $nisn, 'id_kelas'=> $kelas]);
        return $this->db->get()->result();
    }
    public function get_export_transaksi($nisn, $id){
        $this->db->select('tabel_transaksi_buku.*, nama_petugas');
        $this->db->from('tabel_transaksi_buku');
        $this->db->join('tabel_petugas', 'tabel_petugas.id_petugas=tabel_transaksi_buku.id_petugas');
        $this->db->where(['nisn_siswa'=> $nisn, 'id_tagihan_buku'=> $id]);
        return $this->db->get()->result();
    }

}
?>