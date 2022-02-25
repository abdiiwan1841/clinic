<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rujukan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(){
        $data = [
            'kode_rujukan' => $this->input->post('kode_rujukan'),
            'nama_rujukan' => $this->input->post('nama_rujukan'),
            'alamat' => $this->input->post('alamat'),
            'kota' => $this->input->post('kota'),
            'provinsi' => $this->input->post('provinsi'),
            'negara' => $this->input->post('negara'),
            'no_telp' => $this->input->post('no_telp'),
            'no_hp' => $this->input->post('no_hp'),
            'no_fax' => $this->input->post('no_fax'),
            'email' => $this->input->post('email'),
            'jenis_rujukan' => $this->input->post('jenis_rujukan'),
            'status' => $this->input->post('status'),
            'created_by' => $this->input->post('created_by'),
        ];
        return $this->db->insert("rujukan", $data);
    }

    public function update($kode_rujukan){
        $data = [
            'nama_rujukan' => $this->input->post('nama_rujukan'),
            'alamat' => $this->input->post('alamat'),
            'kota' => $this->input->post('kota'),
            'provinsi' => $this->input->post('provinsi'),
            'negara' => $this->input->post('negara'),
            'no_telp' => $this->input->post('no_telp'),
            'no_hp' => $this->input->post('no_hp'),
            'no_fax' => $this->input->post('no_fax'),
            'email' => $this->input->post('email'),
            'jenis_rujukan' => $this->input->post('jenis_rujukan'),
            'modified_by' => $this->input->post('modified_by'),
            'status' => $this->input->post('status'),
        ];
        $this->db->where('kode_rujukan', $kode_rujukan);
        $this->db->update('rujukan', $data);
    }

    public function getAll()
    {
        return $this->db->order_by('kode_rujukan', 'DESC')->get('rujukan');
    }

    public function delete($id){
        $query = $this->db
                    ->where("kode_rujukan",$id)
                    ->delete("rujukan");
        return $query;
    }

    public function getCurrenticd($kode_rujukan)
    {
        return $this->db->get_where('rujukan', ['kode_rujukan' => $kode_rujukan])->row_array();
    }

    public function getOneData($kode_rujukan)
    {
        $query = $this->db->get_where('rujukan', array('kode_rujukan' => $kode_rujukan));
        $dataTobeReturn =  $query->row_array();
        return $dataTobeReturn;
    }

    //server side
    var $table = 'rujukan'; //nama tabel dari database
    var $column_order = array(null, 'kode_rujukan','nama_rujukan'); //field yang ada di table user
    var $column_search = array('kode_rujukan','nama_rujukan'); //field yang diizin untuk pencarian 
    var $order = array('kode_rujukan' => 'desc'); // default order 
    
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
}
