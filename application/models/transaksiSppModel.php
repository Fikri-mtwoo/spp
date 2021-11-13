<?php

class transaksiSppModel extends CI_Model{
    var $table = 'tabel_transaksi_spp';
    var $kolom_order = array(null,null,null, 'nama_siswa');
    var $kolom_cari = array('nama_siswa');
    var $order = array('nama_siswa'=>'asc');

    private function get_datatables_query(){
        $this->db->select('tabel_transaksi_spp.*, tabel_siswa.nama_siswa, tabel_spp.nominal_spp, tabel_kelas.nama_kelas, nama_petugas');
        $this->db->from($this->table);
        $this->db->join('tabel_siswa', 'tabel_siswa.nisn_siswa = tabel_transaksi_spp.nisn_siswa','inner');
        $this->db->join('tabel_spp', 'tabel_spp.id_spp = tabel_transaksi_spp.id_spp', 'inner');
        $this->db->join('tabel_kelas', 'tabel_kelas.id_kelas = tabel_transaksi_spp.id_kelas', 'inner');
        $this->db->join('tabel_petugas', 'tabel_petugas.id_petugas=tabel_transaksi_spp.id_petugas', 'left');
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

    public function get_siswa($nisn, $kelas){
        $this->db->select('tabel_siswa.nisn_siswa, nama_siswa, jenis_kelamin, alamat, no_telp, profile');
        $this->db->from('tabel_transaksi_spp');
        $this->db->join('tabel_siswa', 'tabel_siswa.nisn_siswa=tabel_transaksi_spp.nisn_siswa');
        $this->db->where(['tabel_siswa.nisn_siswa'=>$nisn, 'tabel_transaksi_spp.id_kelas'=>$kelas,'status'=>'aktif']);
        return $this->db->get()->row();
    }

    public function get_kelas(){
        $this->db->select('*');
        $this->db->from('tabel_kelas');
        return $this->db->get()->result_array();
    }

    public function get_transaksi($nisn, $kelas){
        $this->db->select('tabel_transaksi_spp.*, tabel_spp.nominal_spp');
        $this->db->from('tabel_transaksi_spp');
        $this->db->join('tabel_spp', 'tabel_spp.id_spp=tabel_transaksi_spp.id_spp');
        $this->db->where(['nisn_siswa'=> $nisn, 'id_kelas'=> $kelas, 'jumlah_bayar'=> null]);
        $this->db->order_by('bulan_spp', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_transaksi_spp_all($nisn, $kelas){
        $this->db->select('*');
        $this->db->from('tabel_transaksi_spp');
        $this->db->join('tabel_petugas', 'tabel_petugas.id_petugas=tabel_transaksi_spp.id_petugas');
        $this->db->where(['nisn_siswa'=>$nisn, 'id_kelas'=>$kelas, 'keterangan'=>'LUNAS']);
        return $this->db->get()->result_array();
    }

    public function insert($id, $nisn, $data){
        $this->db->where(['id_transaksi_spp'=>$id, 'nisn_siswa'=>$nisn]);
        return $this->db->update('tabel_transaksi_spp', $data);
    }

    public function update($id, $data){
        $this->db->where('id_transaksi_spp', $id);
        return $this->db->update('tabel_transaksi_spp', $data);
    }

    public function delete($id){
        $this->db->where('id_transaksi_spp', $id);
        return $this->db->delete('tabel_transaksi_spp');
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
        $this->db->select('tabel_transaksi_spp.*, nominal_spp');
        $this->db->from('tabel_transaksi_spp');
        $this->db->join('tabel_spp', 'tabel_spp.id_spp=tabel_transaksi_spp.id_spp');
        $this->db->where(['nisn_siswa'=>$nisn, 'id_kelas'=>$kelas]);
        $this->db->order_by('tahun_spp', 'asc');
        $this->db->order_by('bulan_spp', 'asc');
        return $this->db->get()->result();
    }

    public function get_export_transaksi($nisn, $kelas){
        $this->db->select('tabel_transaksi_spp.*, nama_petugas');
        $this->db->from('tabel_transaksi_spp');
        $this->db->join('tabel_petugas', 'tabel_petugas.id_petugas=tabel_transaksi_spp.id_petugas');
        $this->db->where(['nisn_siswa'=>$nisn, 'id_kelas'=>$kelas]);
        return $this->db->get()->result();
    }

}
?>