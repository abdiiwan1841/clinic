<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnosa extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('diagnosa_model');
	}

	public function index()
	{
		$data['title'] = 'Data Diagnosa';
        $data['content'] = "app/diagnosa/page-diagnosa";
        $data['rm'] = $this->diagnosa_model->getAllicd()->result_array();
		$this->load->view('layout',$data);
    }

    function get_data_icd(){
        $list = $this->diagnosa_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->ICD_Code;
            $row[] = $field->ICD_Desc;
            $row[] = "<a class='btn-sm btn btn-warning text-white' data-id='".$field->ICD_Code."' id='edit'><i class='ti-pencil-alt'></i></a>";
            // <a class='btn-sm btn btn-danger text-white' data-id='".$field->ICD_Code."' id='hapus'><i
            // class='fa fa-trash'></i></a>

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->diagnosa_model->count_all(),
            "recordsFiltered" => $this->diagnosa_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function save_rm(){
        $this->form_validation->set_rules('ICD_Code', 'Kode ICD', 'required|trim|is_unique[icd_10.ICD_Code]');
        if ($this->form_validation->run() == false) {
            if (form_error('ICD_Code')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('ICD_Code'))) . "|";
                die();
            }
        } else {
            echo json_encode($this->diagnosa_model->save_rm());
        }
    }
    function edit_rm($icd_code){
        echo json_encode($this->diagnosa_model->update_rm($icd_code));
    }

    function update_rm($icd_code){
        echo json_encode($this->diagnosa_model->update_rm($icd_code));
    }
    function delete_rm($icd_code){
        echo json_encode($this->diagnosa_model->delete_rm($icd_code));
    }
    function data_edit($icd_code){
        echo json_encode($this->diagnosa_model->getCurrenticd($icd_code));
    }


}
