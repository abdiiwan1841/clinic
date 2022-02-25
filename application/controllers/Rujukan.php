<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rujukan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('Rujukan_model');
	}

	public function index()
	{
		$data['title'] = 'Data Rujukan';
        $data['content'] = "app/rujukan/page-rujukan";
        $data['rm'] = $this->Rujukan_model->getAll()->result_array();
        $data['kode_rujukan'] = $this->get_no_rujukan();
		$this->load->view('layout',$data);
    }

	public function add()
	{
		$data['title'] = 'Tambah Rujukan';
        $data['content'] = "app/rujukan/add-rujukan";
        $data['rm'] = $this->Rujukan_model->getAll()->result_array();
        $json_negara = file_get_contents("./assets/json/negara.json");
        $data['negara'] = json_decode($json_negara, true);
        $json_prov = file_get_contents("./assets/json/provinsi.json");
        $data['provinsi'] = json_decode($json_prov, true);
        $json_kota = file_get_contents("./assets/json/kota.json");
        $data['kota'] = json_decode($json_kota, true);
        $data['kode_rujukan'] = $this->get_no_rujukan();
		$this->load->view('layout',$data);
    }
	public function edit($id)
	{
		$data['title'] = 'Edit Rujukan';
        $data['content'] = "app/rujukan/edit-rujukan";
        $data['rm'] = $this->Rujukan_model->getAll()->result_array();
        $json_negara = file_get_contents("./assets/json/negara.json");
        $data['negara'] = json_decode($json_negara, true);
        $json_prov = file_get_contents("./assets/json/provinsi.json");
        $data['provinsi'] = json_decode($json_prov, true);
        $json_kota = file_get_contents("./assets/json/kota.json");
        $data['kota'] = json_decode($json_kota, true);
        $data['get'] = $this->Rujukan_model->getCurrenticd($id);
		$this->load->view('layout',$data);
    }

    function get_no_rujukan(){
        $q = $this->db->query("SELECT MAX(RIGHT(kode_rujukan,8)) AS kode_rujukan FROM rujukan");
        $item = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kode_rujukan)+1;
                $item = sprintf("%08s", $tmp);
            }
        }else{
            $item = "00000001";
        }
        return $item;
    }

    function get_data_rujukan(){
        $list = $this->Rujukan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            if($field->status == 'Aktif'){
                $msg = '<span class="badge badge-pill badge-success">Aktif</span>';
                
            }else{
                $msg = '<span class="badge badge-pill badge-danger">Tidak Aktif</span>';
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_rujukan;
            $row[] = $field->alamat;
            $row[] = $field->no_telp;
            $row[] = $field->no_hp;
            $row[] = $field->jenis_rujukan;
            $row[] = $msg;
            $row[] = "
            <a class='btn-sm btn btn-warning text-white' data-id='".$field->kode_rujukan."' id='edit'><i class='ti-pencil-alt'></i></a>";
            // <a class='btn-sm btn btn-primary text-white' data-id='".$field->kode_rujukan."' id='lihat'  data-toggle='modal' data-target='#lihat-mdl'><i
            // class='fa fa-eye'></i></a>

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Rujukan_model->count_all(),
            "recordsFiltered" => $this->Rujukan_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function save(){
        $this->form_validation->set_rules('kode_rujukan', 'Kode Rujukan', 'required|trim|is_unique[rujukan.kode_rujukan]');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_rujukan')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_rujukan'))) . "|";
                die();
            }
        } else {
            echo json_encode($this->Rujukan_model->save());
        }
    }
    

    function update($kode_rujukan){
        echo json_encode($this->Rujukan_model->update($kode_rujukan));
    }
    function delete($kode_rujukan){
        echo json_encode($this->Rujukan_model->delete($kode_rujukan));
    }
    function data_edit($kode_rujukan){
        echo json_encode($this->Rujukan_model->getCurrenticd($kode_rujukan));
    }

}