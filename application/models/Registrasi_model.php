<?php
defined('BASEPATH') or exit('No direct script access allowed');

class registrasi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->order_by('no_visit', 'DESC')->get('registrasi');
    }

    public function get_reg_pasien($mr_code)
    {
        $this->db->select('*');
        $this->db->where('mr_code', $mr_code);
        return $this->db->get('registrasi')->result_array();
    }

    //server side
    var $table = 'registrasi'; //nama tabel dari database
    var $column_order = array(null, 'no_visit','nama_pasien'); //field yang ada di table user
    var $column_search = array('no_visit','nama_pasien'); //field yang diizin untuk pencarian 
    var $order = array('no_visit' => 'desc'); // default order 
    
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function save(){
        
        $keluhan = $this->input->post('keluhan');
        if(!empty($keluhan)){
            $keluhan = implode(",",$keluhan);
        }else{
            $keluhan = $this->input->post('keluhan');
        }
        $data = [
            'no_visit' => $this->input->post('no_visit'),
            'visit_date' => $this->input->post('visit_date'),
            'visit_time' => $this->input->post('visit_time'),
            'mr_code' => $this->input->post('mr_code'),
            'nama_pasien' => $this->input->post('nama_pasien'),
            'kode_dokter' => $this->input->post('kode_dokter'),
            'nama_dokter' => $this->input->post('nama_dokter'),
            'ref_kode_dokter' => $this->input->post('ref_kode_dokter'),
            'ref_nama_dokter' => $this->input->post('ref_nama_dokter'),
            'keluhan' => $keluhan,
            'reservasi_kode' => $this->input->post('reservasi_kode'),
            'no_antrian' => $this->input->post('no_antrian'),
            'jam_antrian' => $this->input->post('jam_antrian'),
            'status_antrian' => $this->input->post('status_antrian'),
            'diagnosa_khusus' => $this->input->post('diagnosa_khusus'),
            'icd_code' => $this->input->post('icd_code'),
            'hubungan' => $this->input->post('hubungan'),
            'visit_type' => $this->input->post('visit_type'),
            'rujukan' => $this->input->post('rujukan'),
            'periode' => $this->input->post('periode'),
            'status' => $this->input->post('status'),
            'created_by' => $this->input->post('created_by'),
        ];
        return $this->db->insert("registrasi", $data);
    }

    
}