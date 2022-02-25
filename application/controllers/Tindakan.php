<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tindakan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('Tindakan_model');
	}

	public function index()
	{
		$data['title'] = 'Data Tindakan';
        $data['content'] = "app/tindakan/page-tindakan";
        $data['rm'] = $this->Tindakan_model->getAllicd()->result_array();
        $data['code_item'] = $this->get_no_item();
		$this->load->view('layout',$data);
    }

    function get_no_item(){
        $q = $this->db->query("SELECT MAX(RIGHT(item_code,8)) AS item_code FROM tindakan");
        $item = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->item_code)+1;
                $item = sprintf("%08s", $tmp);
            }
        }else{
            $item = "00000001";
        }
        return $item;
    }

    function get_data_tindakan(){
        $list = $this->Tindakan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $q = $this->db->query('SELECT * FROM dokter where kode_dokter = "'.$field->doctor_code.'"');
            $dokter = $q->row();
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->item_code;
            $row[] = $field->item_name;
            $row[] = $field->item_type;
            $row[] = $field->item_uom;
            $row[] = $field->item_price;
            $row[] = $dokter->nama_dokter;
            $row[] = $field->status;
            $row[] = "<a class='btn-sm btn btn-warning text-white' data-id='".$field->item_code."' id='edit'><i class='ti-pencil-alt'></i></a>";
            // <a class='btn-sm btn btn-danger text-white' data-id='".$field->item_code."' id='hapus'><i
            // class='fa fa-trash'></i></a>

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Tindakan_model->count_all(),
            "recordsFiltered" => $this->Tindakan_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function save_rm(){
        $this->form_validation->set_rules('item_code', 'Kode Item', 'required|trim|is_unique[tindakan.item_code]');
        if ($this->form_validation->run() == false) {
            if (form_error('item_code')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('item_code'))) . "|";
                die();
            }
        } else {
            echo json_encode($this->Tindakan_model->save_rm());
        }
    }
    function edit_rm($item_code){
        echo json_encode($this->Tindakan_model->update_rm($item_code));
    }

    function update_rm($item_code){
        echo json_encode($this->Tindakan_model->update_rm($item_code));
    }
    function delete_rm($item_code){
        echo json_encode($this->Tindakan_model->delete_rm($item_code));
    }
    function data_edit($item_code){
        echo json_encode($this->Tindakan_model->getCurrenticd($item_code));
    }

}