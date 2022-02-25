<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poli_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createNewpoli($data)
    {
        $this->db->insert('poli', $data);
    }

    public function getAllpoli()
    {
        return $this->db->order_by('kode_poli', 'DESC')->get('poli');
    }

    public function getCurrentpoli($kode_poli)
    {
        return $this->db->get_where('poli', ['kode_poli' => $kode_poli])->row_array();
    }

    public function getActivepoli()
    {
        return $this->db->get_where('poli', ['status' => 'Aktif'])->result_array();
    }

    public function getOneData($kode_poli)
    {
        $query = $this->db->get_where('poli', array('kode_poli' => $kode_poli));
        $dataTobeReturn =  $query->row_array();
        return $dataTobeReturn;
    }
    
    public function updatepoli($data, $kode_poli)
    {

        $this->db->where('kode_poli', $kode_poli);
        $this->db->update('poli', $data);
    }
}
