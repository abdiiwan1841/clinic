<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan_obat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createNewsatuan_obat($data)
    {
        $this->db->insert('satuan_obat', $data);
    }

    public function getAllsatuan_obat()
    {
        return $this->db->order_by('kode_satuan_obat', 'DESC')->get('satuan_obat');
    }

    public function getCurrentsatuan_obat($kode_satuan_obat)
    {
        return $this->db->get_where('satuan_obat', ['kode_satuan_obat' => $kode_satuan_obat])->row_array();
    }

    public function getActivesatuan_obat()
    {
        return $this->db->get_where('satuan_obat', ['is_active' => '1'])->result_array();
    }

    public function getOneData($kode_satuan_obat)
    {
        $query = $this->db->get_where('satuan_obat', array('kode_satuan_obat' => $kode_satuan_obat));
        $dataTobeReturn =  $query->row_array();
        return $dataTobeReturn;
    }
    
    public function updatesatuan_obat($data, $kode_satuan_obat)
    {
        $this->db->where('kode_satuan_obat', $kode_satuan_obat);
        $this->db->update('satuan_obat', $data);
    }
}
