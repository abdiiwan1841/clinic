<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluhan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createNewkeluhan($data)
    {
        $this->db->insert('keluhan', $data);
    }

    public function getAllkeluhan()
    {
        return $this->db->order_by('kode_keluhan', 'DESC')->get('keluhan');
    }

    public function getCurrentkeluhan($kode_keluhan)
    {
        return $this->db->get_where('keluhan', ['kode_keluhan' => $kode_keluhan])->row_array();
    }

    public function getActivekeluhan()
    {
        return $this->db->get_where('keluhan', ['is_active' => '1'])->result_array();
    }

    public function getOneData($kode_keluhan)
    {
        $query = $this->db->get_where('keluhan', array('kode_keluhan' => $kode_keluhan));
        $dataTobeReturn =  $query->row_array();
        return $dataTobeReturn;
    }
    
    public function updatekeluhan($data, $kode_keluhan)
    {
        $this->db->where('kode_keluhan', $kode_keluhan);
        $this->db->update('keluhan', $data);
    }
}
