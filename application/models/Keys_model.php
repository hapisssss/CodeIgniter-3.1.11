<?php

class Keys_model extends CI_Model
{

    public function createKeys($data) {
        $this->db->insert('keys', $data);
        return $this->db->affected_rows();
    }

    
    public function is_user_id_exists($user_id) {
        // Menggunakan query builder untuk memeriksa apakah user_id sudah ada dalam database
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('keys'); // Gantilah 'nama_tabel' dengan nama tabel yang sesuai
        // Mengembalikan true jika ada hasil (user_id sudah ada), false jika tidak ada
        return $query->num_rows() > 0;
    }


    public function get_keys($key) {
        // Menggunakan query builder untuk memeriksa apakah user_id sudah ada dalam database
        $this->db->where('key', $key);
        $query = $this->db->get('keys'); // Gantilah 'nama_tabel' dengan nama tabel yang sesuai
        // Mengembalikan true jika ada hasil (user_id sudah ada), false jika tidak ada
        return $query->num_rows() > 0;
    }

    
}
