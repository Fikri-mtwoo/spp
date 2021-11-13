<?php

class petugasModel extends CI_Model{
    var $table = 'tabel_petugas';
    var $kolom_order = array(null, 'nama_petugas');
    var $kolom_cari = array('nama_petugas');
    var $order = array('nama_petugas'=>'asc');

    private function get_datatables_query(){
        $this->db->from($this->table);
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
        return $this->db->insert('tabel_petugas', $data);
    }

    public function get_by_id($data){
        $this->db->select('*');
        $this->db->from('tabel_petugas');
        $this->db->where($data);
        return $this->db->get()->row();
    }

    public function update($id, $data){
        $this->db->where('id_petugas', $id);
        return $this->db->update('tabel_petugas', $data);
    }

    public function delete($id){
        $this->db->where('id_petugas', $id);
        return $this->db->delete('tabel_petugas');
    }
}
?>