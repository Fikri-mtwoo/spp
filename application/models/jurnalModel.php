<?php

class jurnalModel extends CI_Model{
    var $table = 'tabel_jurnal';
    var $kolom_order = array(null, 'tgl_transaksi');
    var $kolom_cari = array('tgl_transaksi');
    var $order = array('tgl_transaksi'=>'asc');

    private function get_datatables_query(){
        $this->db->select('*');
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
            if(!empty($this->input->post('bulan', true))){
                $this->db->where('month(tgl_transaksi)', $this->input->post('bulan', true));
            }
            if(!empty( $this->input->post('tahun', true))){
                $this->db->where('year(tgl_transaksi)', $this->input->post('tahun', true));
            }
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
        return $this->db->insert('tabel_jurnal', $data);
    }

    public function get_jurnal($id){
        $this->db->select('*');
        $this->db->from('tabel_jurnal');
        $this->db->where('id_jurnal', $id);
        return $this->db->get()->row();
    }

    public function update($id, $data){
        $this->db->where('id_jurnal', $id);
        return $this->db->update('tabel_jurnal', $data);
    }

    public function delete($id){
        $this->db->where('id_jurnal', $id);
        return $this->db->delete('tabel_jurnal');
    }

    public function get_bulan(){
        $this->db->select('tgl_transaksi');
        $this->db->from('tabel_jurnal');
        $this->db->group_by('month(tgl_transaksi)');
        $this->db->order_by('tgl_transaksi');
        return $this->db->get()->result_array();
    }

    public function get_tahun(){
        $this->db->select('tgl_transaksi');
        $this->db->from('tabel_jurnal');
        $this->db->group_by('year(tgl_transaksi)');
        $this->db->order_by('tgl_transaksi');
        return $this->db->get()->result_array();
    }

    public function get_export(){
        $this->db->select('*');
        $this->db->from('tabel_jurnal');
        if(!empty($this->input->post('bulan', true))){
            $this->db->where('month(tgl_transaksi)', $this->input->post('bulan', true));
        }
        if(!empty( $this->input->post('tahun', true))){
            $this->db->where('year(tgl_transaksi)', $this->input->post('tahun', true));
        }
        return $this->db->get()->result();
    }
}
?>