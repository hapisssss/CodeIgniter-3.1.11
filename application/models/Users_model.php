<?php

class Users_model extends CI_Model
{


    public function getUsers($email){
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row_array();

    }

    public function createUsers($data) {
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }

   
}