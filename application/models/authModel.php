<?php

class authModel extends CI_Model{
    
    public function get_akun($data){
        $this->db->select('*');
        $this->db->from('tabel_petugas');
        $this->db->where($data);
        $query = $this->db->get();
        if($query->num_rows() == 0){
            return FALSE;
        }else{
            return $query->result_array();
        }
    }
}
?>