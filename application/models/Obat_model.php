<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createNewobat($data)
    {
        $this->db->insert('obat', $data);
    }

    public function getAllobat()
    {
        $this->db->select('obat.*, kategori_obat.kode_kategori_obat, kategori_obat.nama_kategori_obat, satuan_obat.kode_satuan_obat, satuan_obat.nama_satuan_obat');
        $this->db->from('obat');
        $this->db->join('kategori_obat',' kategori_obat.kode_kategori_obat = obat.kategori_obat');
        $this->db->join('satuan_obat',' satuan_obat.kode_satuan_obat = obat.satuan');
        $dataTobeReturn = $this->db->get();
        return $dataTobeReturn;
    }

    public function getCurrentobat($kode_obat)
    {
        return $this->db->get_where('obat', ['kode_obat' => $kode_obat])->row_array();
    }

    public function getActiveobat()
    {
        return $this->db->get_where('obat', ['is_active' => '1'])->result_array();
    }

    public function getOneData($kode_obat)
    {
        $query = $this->db->get_where('obat', array('kode_obat' => $kode_obat));
        $dataTobeReturn =  $query->row_array();
        return $dataTobeReturn;
    }
    
    public function updateobat($data, $kode_obat)
    {
        $this->db->where('kode_obat', $kode_obat);
        $this->db->update('obat', $data);
    }
}
