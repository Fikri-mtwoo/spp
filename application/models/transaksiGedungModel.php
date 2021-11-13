<?php

class transaksiGedungModel extends CI_Model{
    var $table = 'tabel_transaksi_gedung';
    var $kolom_order = array(null,null,null, 'nama_siswa');
    var $kolom_cari = array('nama_siswa');
    var $order = array('nama_siswa'=>'asc');

    private function get_datatables_query(){
        $this->db->select('tabel_transaksi_gedung.*, tabel_siswa.nama_siswa, tabel_spp.nominal_gedung, nama_petugas');
        $this->db->from($this->table);
        $this->db->join('tabel_siswa', 'tabel_siswa.nisn_siswa = tabel_transaksi_gedung.nisn_siswa','inner');
        $this->db->join('tabel_tagihan_gedung', 'tabel_tagihan_gedung.id_tagihan_gedung = tabel_transaksi_gedung.id_tagihan_gedung', 'inner');
        $this->db->join('tabel_spp', 'tabel_spp.id_spp = tabel_tagihan_gedung.id_spp', 'inner');
        $this->db->join('tabel_petugas', 'tabel_petugas.id_petugas=tabel_transaksi_gedung.id_petugas');
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
        $this->db->select('nisn_siswa, nama_siswa, jenis_kelamin, alamat, no_telp, profile');
        $this->db->from('tabel_siswa');
        $this->db->where(['nisn_siswa'=>$nisn, 'status'=>'aktif']);
        return $this->db->get()->row();
    }


    public function get_tagihan_gedung($nisn){
        $this->db->select('id_tagihan_gedung, nominal_gedung');
        $this->db->from('tabel_tagihan_gedung');
        $this->db->join('tabel_spp', 'tabel_spp.id_spp=tabel_tagihan_gedung.id_spp');
        $this->db->where('nisn_siswa', $nisn);
        return $this->db->get()->row();
    }

    public function get_transaksi_gedung($nisn){
        $this->db->select_sum('jumlah_bayar');
        $this->db->from('tabel_transaksi_gedung');
        $this->db->where('nisn_siswa', $nisn);
        return $this->db->get()->row();
    }

    public function get_transaksi_gedung_all($nisn){
        $this->db->select('*');
        $this->db->from('tabel_transaksi_gedung');
        $this->db->join('tabel_petugas', 'tabel_petugas.id_petugas=tabel_transaksi_gedung.id_petugas');
        $this->db->where('nisn_siswa', $nisn);
        return $this->db->get()->result_array();
    }

    public function get_where_transaksi_gedung($id){
        $this->db->select('tabel_transaksi_gedung.*, nama_siswa, jenis_kelamin, alamat, no_telp, profile');
        $this->db->from('tabel_transaksi_gedung');
        $this->db->join('tabel_siswa', 'tabel_siswa.nisn_siswa=tabel_transaksi_gedung.nisn_siswa');
        $this->db->where('id_transaksi_gedung', $id);
        return $this->db->get()->row();
    }

    public function insert($data){
        return $this->db->insert('tabel_transaksi_gedung', $data);
    }

    public function update($id, $data){
        $this->db->where('id_transaksi_gedung', $id);
        return $this->db->update('tabel_transaksi_gedung', $data);
    }

    public function delete($id){
        $this->db->where('id_transaksi_gedung', $id);
        return $this->db->delete('tabel_transaksi_gedung');
    }

    public function get_export_siswa($nisn){
        $this->db->select('tabel_siswa.nisn_siswa, nis_siswa, nama_siswa, jenis_kelamin, alamat, no_telp, profile, nama_kelas, nama_jurusan');
        $this->db->from('tabel_siswa');
        $this->db->join('tabel_kelas', 'tabel_kelas.id_kelas=tabel_siswa.id_kelas');
        $this->db->join('tabel_jurusan', 'tabel_jurusan.id_jurusan=tabel_siswa.id_jurusan');
        $this->db->where(['nisn_siswa'=>$nisn, 'status'=>'aktif']);
        return $this->db->get()->row();
    }

    public function get_export_tagihan($nisn){
        $this->db->select('tabel_tagihan_gedung.*, nominal_gedung');
        $this->db->from('tabel_tagihan_gedung');
        $this->db->join('tabel_spp', 'tabel_spp.id_spp=tabel_tagihan_gedung.id_spp');
        $this->db->where('nisn_siswa', $nisn);
        return $this->db->get()->result();
    }

    public function get_export_transaksi($nisn){
        $this->db->select('tabel_transaksi_gedung.*, nama_petugas');
        $this->db->from('tabel_transaksi_gedung');
        $this->db->join('tabel_petugas', 'tabel_petugas.id_petugas=tabel_transaksi_gedung.id_petugas');
        $this->db->where('nisn_siswa', $nisn);
        return $this->db->get()->result();
    }
}
?>