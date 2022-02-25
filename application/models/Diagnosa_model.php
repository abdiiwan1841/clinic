<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save_rm(){
        $data = [
            'ICD_Code' => $this->input->post("ICD_Code"),
            'ICD_Desc' => $this->input->post("ICD_Desc")
        ];
        return $this->db->insert("icd_10", $data);
    }

    public function update_rm($ICD_Code){
        $data = [
            'ICD_Desc' => $this->input->post("ICD_Desc")
        ];
        $this->db->where('ICD_Code', $ICD_Code);
        $this->db->update('icd_10', $data);
    }

    public function getAllicd()
    {
        return $this->db->order_by('ICD_Code', 'DESC')->get('icd_10');
    }

    public function delete_rm($id){
        $query = $this->db
                    ->where("ICD_Code",$id)
                    ->delete("icd_10");
        return $query;
    }

    public function getCurrenticd($ICD_Code)
    {
        return $this->db->get_where('icd_10', ['ICD_Code' => $ICD_Code])->row_array();
    }

    public function getActiveicd()
    {
        return $this->db->get_where('icd_10', ['is_active' => '1'])->result_array();
    }

    public function getOneData($ICD_Code)
    {
        $query = $this->db->get_where('icd_10', array('ICD_Code' => $ICD_Code));
        $dataTobeReturn =  $query->row_array();
        return $dataTobeReturn;
    }


    //server side
    var $table = 'icd_10'; //nama tabel dari database
    var $column_order = array(null, 'ICD_Code','ICD_Desc'); //field yang ada di table user
    var $column_search = array('ICD_Code','ICD_Desc'); //field yang diizin untuk pencarian 
    var $order = array('ICD_Code' => 'asc'); // default order 
    
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

    public function data_icd(){
		$like = $this->input->post_get('like');
		if(!empty($like)){
			$this->db->like('ICD_Code',$like);
			$this->db->or_like('ICD_Desc',$like);
		}
		$this->db->limit(10);
		return $this->db->get('icd_10')->result_array();
	}
}
