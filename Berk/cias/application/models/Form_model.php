<?php

class Form_model extends CI_Model
{
    protected $table      = 'forms';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ad', 'soyad', 'email', 'telefon', 'mesaj'];

    public function insert($data)
    {
        $this->db->trans_start();
        $this->db->insert('forms', $data);
        $this->db->trans_complete();
    }

    public function list()
    {
        $query = $this->db->get('forms'); // 'forms' tablosundaki tüm verileri getir

        if ($query->num_rows() > 0) {
            return $query->result_array(); // Veri varsa sonuç dizisini döndür
        } else {
            return array(); // Veri yoksa boş bir dizi döndür
        }
    }
}
