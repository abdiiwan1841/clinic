<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get(){
        return $query =  $this->db->get("pasien")->result_array();
    }

    public function getCurrentPatient($MR_Code)
    {
        return $this->db->get_where('pasien', ['MR_Code' => $MR_Code])->row_array();
    }

    public function save_pasien(){
        $data = [
            'MR_Code' => $this->input->post("MR_Code"),
            'Patient_FName' => $this->input->post("Patient_FName"),
            'Patient_LName' => $this->input->post("Patient_LName"),
            'Patient_IC' => $this->input->post("Patient_IC"),
            'Patient_DOB' => $this->input->post("Patient_DOB"),
            'Patient_Country' => $this->input->post("Patient_Country"),
            'Patient_Prov' => $this->input->post("Patient_Prov"),
            'Patient_City' => $this->input->post("Patient_City"),
            'Patient_kec' => $this->input->post("Patient_kec"),
            'Patient_Address' => $this->input->post("Patient_Address"),
            'Patient_Phone' => $this->input->post("Patient_Phone"),
            'Patient_Mobile' => $this->input->post("Patient_Mobile"),
            'Patient_Sex' => $this->input->post("Patient_Sex"),
            'Patient_desc' => $this->input->post("Patient_desc"),
            'Patient_Email' => $this->input->post("Patient_Email"),
            'Patient_Special' => $this->input->post("Patient_Special"),
            // // 'Patient_Complete' => $this->input->post("Patient_Complete"),
            'Patient_BPJSNo' => $this->input->post("Patient_BPJSNo"),
            'Patient_Status' => $this->input->post("Patient_Status"),
            'Patient_Job' => $this->input->post("Patient_Job"),
            'Patient_Company' => $this->input->post("Patient_Company"),
            'Patient_Education' => $this->input->post("Patient_Education"),
            'date_created' => $this->input->post("date_created"),
            'date_modified' => $this->input->post("date_modified"),
            'created_by' => $this->session->userdata("username")
        ];
        return $this->db->insert("pasien", $data);
    }

    public function edit_pasien($MR_Code){
        $data = [
            'Patient_FName' => $this->input->post("Patient_FName"),
            'Patient_LName' => $this->input->post("Patient_LName"),
            'Patient_IC' => $this->input->post("Patient_IC"),
            'Patient_DOB' => $this->input->post("Patient_DOB"),
            'Patient_Country' => $this->input->post("Patient_Country"),
            'Patient_Prov' => $this->input->post("Patient_Prov"),
            'Patient_City' => $this->input->post("Patient_City"),
            'Patient_kec' => $this->input->post("Patient_kec"),
            'Patient_Address' => $this->input->post("Patient_Address"),
            'Patient_Phone' => $this->input->post("Patient_Phone"),
            'Patient_Mobile' => $this->input->post("Patient_Mobile"),
            'Patient_Sex' => $this->input->post("Patient_Sex"),
            'Patient_desc' => $this->input->post("Patient_desc"),
            'Patient_Email' => $this->input->post("Patient_Email"),
            'Patient_Special' => $this->input->post("Patient_Special"),
            'Patient_Religion' => $this->input->post("Patient_Religion"),
            // // 'Patient_Complete' => $this->input->post("Patient_Complete"),
            'Patient_BPJSNo' => $this->input->post("Patient_BPJSNo"),
            'Patient_Status' => $this->input->post("Patient_Status"),
            'Patient_Job' => $this->input->post("Patient_Job"),
            'Patient_Company' => $this->input->post("Patient_Company"),
            'Patient_Education' => $this->input->post("Patient_Education"),
            'date_modified' => $this->input->post("date_modified"),
            'modified_by' => $this->session->userdata("username")
        ];
        $this->db->where('MR_Code', $MR_Code);
        return $this->db->update('pasien', $data);
    }

    //server side
    var $table = 'pasien'; //nama tabel dari database
    var $column_order = array(null, 'MR_Code','Patient_FName'); //field yang ada di table user
    var $column_search = array('MR_Code','Patient_FName','Patient_DOB'); //field yang diizin untuk pencarian 
    var $order = array('MR_Code' => 'desc'); // default order 
    
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
    function get_no_mr(){
        $q = $this->db->query("SELECT MAX(RIGHT(Mr_Code,8)) AS Mr_Code FROM pasien");
        $mr = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->Mr_Code)+1;
                $mr = sprintf("%08s", $tmp);
            }
        }else{
            $mr = "00000001";
        }
        return $mr;
    }
}
