<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tindakan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save_rm(){
        $data = [
            'item_code' => $this->input->post("item_code"),
            'item_name' => $this->input->post("item_name"),
            'item_type' => $this->input->post("item_type"),
            'item_uom' => $this->input->post("item_uom"),
            'item_price' => $this->input->post("item_price"),
            'status' => $this->input->post("status"),
            'doctor_code' => $this->input->post("doctor_code"),
            'created_by' => $this->input->post("created_by"),
            'date_created' => $this->input->post("date_created")
        ];
        return $this->db->insert("tindakan", $data);
    }

    public function update_rm($item_code){
        $data = [
            'item_name' => $this->input->post("item_name"),
            'item_type' => $this->input->post("item_type"),
            'item_uom' => $this->input->post("item_uom"),
            'item_price' => $this->input->post("item_price"),
            'status' => $this->input->post("status"),
            'doctor_code' => $this->input->post("doctor_code"),
            'modified_by' => $this->input->post("modified_by"),
            'date_modified' => $this->input->post("date_modified")
        ];
        $this->db->where('item_code', $item_code);
        $this->db->update('tindakan', $data);
    }

    public function getAllicd()
    {
        return $this->db->order_by('item_code', 'DESC')->get('tindakan');
    }

    public function delete_rm($id){
        $query = $this->db
                    ->where("item_code",$id)
                    ->delete("tindakan");
        return $query;
    }

    public function getCurrenticd($item_code)
    {
        return $this->db->get_where('tindakan', ['item_code' => $item_code])->row_array();
    }

    public function getActiveicd()
    {
        return $this->db->get_where('tindakan', ['is_active' => '1'])->result_array();
    }

    public function getOneData($item_code)
    {
        $query = $this->db->get_where('tindakan', array('item_code' => $item_code));
        $dataTobeReturn =  $query->row_array();
        return $dataTobeReturn;
    }

    //server side
    var $table = 'tindakan'; //nama tabel dari database
    var $column_order = array(null, 'item_code','item_name'); //field yang ada di table user
    var $column_search = array('item_code','item_name'); //field yang diizin untuk pencarian 
    var $order = array('item_code' => 'asc'); // default order 
    
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
