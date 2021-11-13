<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sppModel extends CI_Model {
    var $table = 'tabel_spp';
    var $kolom_order = array(null, 'tahun_angkatan');
    var $kolom_cari = array('tahun_angkatan');
    var $order = array('tahun_angkatan'=>'asc');

    private function get_datatables_query(){
        $this->db->from($this->table);
        $this->db->join('tabel_angkatan', 'tabel_angkatan.id_angkatan=tabel_spp.id_angkatan');
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
        return $this->db->insert('tabel_spp', $data);
    }

    public function get_by_id($data){
        $this->db->select('*');
        $this->db->from('tabel_spp');
        $this->db->where($data);
        return $this->db->get()->row();
    }

    public function get_angkatan(){
        $this->db->select('*');
        $this->db->from('tabel_angkatan');
        return $this->db->get()->result_array();
    }

    public function update($id, $data){
        $this->db->where('id_spp', $id);
        return $this->db->update('tabel_spp', $data);
    }

    public function delete($id){
        $this->db->where('id_spp', $id);
        return $this->db->delete('tabel_spp');
    }
}