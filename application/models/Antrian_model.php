<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Antrian_model extends CI_Model
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
    var $column_search = array('no_visit','nama_pasien','no_antrian','nama_dokter','mr_code'); //field yang diizin untuk pencarian 
    var $order = array('no_antrian' => 'desc'); // default order 
    
    private function _get_datatables_query()
    {
        $tgl = date("Y-m-d");
        $this->db->where('visit_date', $tgl);
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

    public function callAntrian($no_visit)
    {
        $data = [
            'status_antrian' => $this->input->post('status_antrian'),
        ];
        $this->db->where('no_visit', $no_visit);
        $this->db->update('registrasi', $data);
    }
}