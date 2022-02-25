<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spesialis_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createNewSpesialis($data)
    {
        $this->db->insert('spesialis', $data);
    }

    public function getAllSpesialis()
    {
        return $this->db->order_by('kode_spesialis', 'DESC')->get('spesialis');
    }

    public function getCurrentSpesialis($kode_spesialis)
    {
        return $this->db->get_where('spesialis', ['kode_spesialis' => $kode_spesialis])->row_array();
    }

    public function getActiveSpesialis()
    {
        return $this->db->get_where('spesialis', ['is_active' => '1'])->result_array();
    }

    public function getOneData($kode_spesialis)
    {
        $query = $this->db->get_where('spesialis', array('kode_spesialis' => $kode_spesialis));
        $dataTobeReturn =  $query->row_array();
        return $dataTobeReturn;
    }
    
    public function updateSpesialis($data, $kode_spesialis)
    {
        $this->db->where('kode_spesialis', $kode_spesialis);
        $this->db->update('spesialis', $data);
    }
}
