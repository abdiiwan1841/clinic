<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_obat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createNewkategori_obat($data)
    {
        $this->db->insert('kategori_obat', $data);
    }

    public function getAllkategori_obat()
    {
        return $this->db->order_by('kode_kategori_obat', 'DESC')->get('kategori_obat');
    }

    public function getCurrentkategori_obat($kode_kategori_obat)
    {
        return $this->db->get_where('kategori_obat', ['kode_kategori_obat' => $kode_kategori_obat])->row_array();
    }

    public function getActivekategori_obat()
    {
        return $this->db->get_where('kategori_obat', ['is_active' => '1'])->result_array();
    }

    public function getOneData($kode_kategori_obat)
    {
        $query = $this->db->get_where('kategori_obat', array('kode_kategori_obat' => $kode_kategori_obat));
        $dataTobeReturn =  $query->row_array();
        return $dataTobeReturn;
    }
    
    public function updatekategori_obat($data, $kode_kategori_obat)
    {
        $this->db->where('kode_kategori_obat', $kode_kategori_obat);
        $this->db->update('kategori_obat', $data);
    }
}
