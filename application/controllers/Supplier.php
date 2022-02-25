<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('supplier_model');
	}

	public function index()
	{
		$data['title'] = 'Data Supplier';
        $data['content'] = "app/supplier/page-supplier";
        $data['rm'] = $this->supplier_model->getAllicd()->result_array();
        $data['Cust_Code'] = $this->get_no_supplier();
		$this->load->view('layout',$data);
    }

	public function add()
	{
		$data['title'] = 'Tambah Supplier';
        $data['content'] = "app/supplier/add-supplier";
        $data['rm'] = $this->supplier_model->getAllicd()->result_array();
        $json_negara = file_get_contents("./assets/json/negara.json");
        $data['negara'] = json_decode($json_negara, true);
        $json_prov = file_get_contents("./assets/json/provinsi.json");
        $data['provinsi'] = json_decode($json_prov, true);
        $json_kota = file_get_contents("./assets/json/kota.json");
        $data['kota'] = json_decode($json_kota, true);
        $data['Cust_Code'] = $this->get_no_supplier();
		$this->load->view('layout',$data);
    }
	public function edit($id)
	{
		$data['title'] = 'Edit Supplier';
        $data['content'] = "app/supplier/edit-supplier";
        $data['rm'] = $this->supplier_model->getAllicd()->result_array();
        $json_negara = file_get_contents("./assets/json/negara.json");
        $data['negara'] = json_decode($json_negara, true);
        $json_prov = file_get_contents("./assets/json/provinsi.json");
        $data['provinsi'] = json_decode($json_prov, true);
        $json_kota = file_get_contents("./assets/json/kota.json");
        $data['kota'] = json_decode($json_kota, true);
        $data['data_supp'] = $this->supplier_model->getCurrenticd($id);
		$this->load->view('layout',$data);
    }

    function get_no_supplier(){
        $q = $this->db->query("SELECT MAX(RIGHT(Cust_Code,8)) AS Cust_Code FROM supplier");
        $item = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->Cust_Code)+1;
                $item = sprintf("%08s", $tmp);
            }
        }else{
            $item = "00000001";
        }
        return $item;
    }

    function get_data_supplier(){
        $list = $this->supplier_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            if($field->Status == 'Aktif'){
                $msg = '<span class="badge badge-pill badge-success">Aktif</span>';
                
            }else{
                $msg = '<span class="badge badge-pill badge-danger">Tidak Aktif</span>';
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->Cust_Name;
            $row[] = $field->Cust_Address1;
            $row[] = $field->Cust_Phone;
            // $row[] = $field->Cust_email;
            $row[] = $field->Cust_Jenis;
            $row[] = $field->Cust_Type;
            $row[] = $msg;
            $row[] = "
            <a class='btn-sm btn btn-warning text-white' data-id='".$field->Cust_Code."' id='edit'><i class='ti-pencil-alt'></i></a>";
            // <a class='btn-sm btn btn-primary text-white' data-id='".$field->Cust_Code."' id='lihat'  data-toggle='modal' data-target='#lihat-mdl'><i
            // class='fa fa-eye'></i></a>

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->supplier_model->count_all(),
            "recordsFiltered" => $this->supplier_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function save(){
        $this->form_validation->set_rules('Cust_Code', 'Kode Item', 'required|trim|is_unique[supplier.Cust_Code]');
        if ($this->form_validation->run() == false) {
            if (form_error('Cust_Code')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('Cust_Code'))) . "|";
                die();
            }
        } else {
            echo json_encode($this->supplier_model->save_rm());
        }
    }
    function edit_rm($Cust_Code){
        echo json_encode($this->supplier_model->update_rm($Cust_Code));
    }

    function update_rm($Cust_Code){
        echo json_encode($this->supplier_model->update_rm($Cust_Code));
    }
    function delete_rm($Cust_Code){
        echo json_encode($this->supplier_model->delete_rm($Cust_Code));
    }
    function data_edit($Cust_Code){
        echo json_encode($this->supplier_model->getCurrenticd($Cust_Code));
    }

}