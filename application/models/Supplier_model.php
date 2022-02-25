<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save_rm(){
        $data = [
            'Cust_Code' => $this->input->post('Cust_Code'),
            'Cust_Name' => $this->input->post('Cust_Name'),
            'Cust_Address1' => $this->input->post('Cust_Address1'),
            'Cust_Address2' => $this->input->post('Cust_Address2'),
            'Cust_Country' => $this->input->post('Cust_Country'),
            'Cust_Prov' => $this->input->post('Cust_Prov'),
            'Cust_City' => $this->input->post('Cust_City'),
            'Cust_Postal' => $this->input->post('Cust_Postal'),
            'Cust_Phone' => $this->input->post('Cust_Phone'),
            'Cust_Fax' => $this->input->post('Cust_Fax'),
            'Cust_Mobile' => $this->input->post('Cust_Mobile'),
            'Cust_email' => $this->input->post('Cust_email'),
            'NPWP_No' => $this->input->post('NPWP_No'),
            'Cust_Jenis' => $this->input->post('Cust_Jenis'),
            'Cust_Type' => $this->input->post('Cust_Type'),
            'Status' => $this->input->post('Status'),
            'created_by' => $this->input->post('created_by'),
            'date_created' => $this->input->post('date_created')
        ];
        return $this->db->insert("supplier", $data);
    }

    public function update_rm($Cust_Code){
        $data = [
            'Cust_Name' => $this->input->post('Cust_Name'),
            'Cust_Address1' => $this->input->post('Cust_Address1'),
            'Cust_Address2' => $this->input->post('Cust_Address2'),
            'Cust_Country' => $this->input->post('Cust_Country'),
            'Cust_Prov' => $this->input->post('Cust_Prov'),
            'Cust_City' => $this->input->post('Cust_City'),
            'Cust_Postal' => $this->input->post('Cust_Postal'),
            'Cust_Phone' => $this->input->post('Cust_Phone'),
            'Cust_Fax' => $this->input->post('Cust_Fax'),
            'Cust_Mobile' => $this->input->post('Cust_Mobile'),
            'Cust_email' => $this->input->post('Cust_email'),
            'NPWP_No' => $this->input->post('NPWP_No'),
            'Cust_Jenis' => $this->input->post('Cust_Jenis'),
            'Cust_Type' => $this->input->post('Cust_Type'),
            'Status' => $this->input->post('Status'),
            'modified_by' => $this->input->post('modified_by'),
            'date_modified' => $this->input->post('date_modified')
        ];
        $this->db->where('Cust_Code', $Cust_Code);
        $this->db->update('supplier', $data);
    }

    public function getAllicd()
    {
        return $this->db->order_by('Cust_Code', 'DESC')->get('supplier');
    }

    public function delete_rm($id){
        $query = $this->db
                    ->where("Cust_Code",$id)
                    ->delete("supplier");
        return $query;
    }

    public function getCurrenticd($Cust_Code)
    {
        return $this->db->get_where('supplier', ['Cust_Code' => $Cust_Code])->row_array();
    }

    public function getActiveicd()
    {
        return $this->db->get_where('supplier', ['is_active' => '1'])->result_array();
    }

    public function getOneData($Cust_Code)
    {
        $query = $this->db->get_where('supplier', array('Cust_Code' => $Cust_Code));
        $dataTobeReturn =  $query->row_array();
        return $dataTobeReturn;
    }

    //server side
    var $table = 'supplier'; //nama tabel dari database
    var $column_order = array(null, 'Cust_Code','Cust_Company'); //field yang ada di table user
    var $column_search = array('Cust_Code','Cust_Company','Cust_Name','Cust_Jenis','Status'); //field yang diizin untuk pencarian 
    var $order = array('Cust_Code' => 'desc'); // default order 
    
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
