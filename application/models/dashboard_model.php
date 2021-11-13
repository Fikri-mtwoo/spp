<?php 

class dashboard_model extends CI_Model{

        public function get_siswa(){
            $this->db->select('');
            $this->db->from('tabel_siswa');
            return $this->db->count_all_results();
        }

        public function get_siswa_aktif(){
            $this->db->select('');
            $this->db->from('tabel_siswa');
            $this->db->where('status', 'aktif');
            return $this->db->count_all_results();
        }

        public function get_pengeluaran($bulan){
            $this->db->select_sum('saldo');
            $this->db->from('tabel_jurnal');
            $this->db->where(['jenis_saldo'=> 'keluar', 'month(tgl_transaksi)'=> $bulan]);
            return $this->db->get()->row();
        }

        public function get_pemasukan($bulan){
            $this->db->select_sum('saldo');
            $this->db->from('tabel_jurnal');
            $this->db->where(['jenis_saldo'=> 'masuk', 'month(tgl_transaksi)'=> $bulan]);
            return $this->db->get()->row();
        }

        public function get_buku($bulan){
            $this->db->select_sum('jumlah_bayar');
            $this->db->from('tabel_transaksi_buku');
            $this->db->where('month(tanggal_bayar)', $bulan);
            return $this->db->get()->row();
        }

        public function get_gedung($bulan){
            $this->db->select_sum('jumlah_bayar');
            $this->db->from('tabel_transaksi_gedung');
            $this->db->where('month(tanggal_bayar)', $bulan);
            return $this->db->get()->row();
        }

        public function get_pendaftaran($bulan){
            $this->db->select_sum('jumlah_bayar');
            $this->db->from('tabel_transaksi_pendaftaran');
            $this->db->where('month(tanggal_bayar)', $bulan);
            return $this->db->get()->row();
        }

        public function get_spp($bulan){
            $this->db->select_sum('jumlah_bayar');
            $this->db->from('tabel_transaksi_spp');
            $this->db->where('month(tanggal_bayar)', $bulan);
            return $this->db->get()->row();
        }
}
?>