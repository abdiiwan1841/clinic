<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class antrian extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('Antrian_model');
        $this->load->model('Registrasi_model');
        $this->load->model('Pasien_model');
        $this->load->model('Rujukan_model');
        $this->load->model('Diagnosa_model');
        $this->load->model('Dokter_model');
        $this->load->model('Keluhan_model');
	}

	public function index()
	{
		$data['title'] = 'Antrian Pasien';
		$data['content'] = "app/antrian/page-antrian";
		$this->load->view('layout',$data);
    }

    public function front()
	{
		$data['title'] = 'Antrian Pasien';
		$this->load->view('app/antrian/front-antrian',$data);
    }

    function get_data_registrasi(){
        $list = $this->Antrian_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            if($field->status_antrian == 'Menunggu'){
                $msg = '<span class="badge badge-pill badge-success">Menunggu</span>';
                $call = "<button type='button' class='btn btn-success btn-sm call' novisit='".$field->no_visit."' status='Konsultasi'>Call</button>";
            }else{
                $msg = '<span class="badge badge-pill badge-danger">'.$field->status_antrian.'</span>';
                $call = "<button type='button' class='btn btn-secondary btn-sm' disabled style='cursor: no-drop;'>Call</button>";
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->no_antrian;
            $row[] = $field->no_visit;
            $row[] = $field->visit_date;
            $row[] = $field->nama_pasien;
            $row[] = $field->nama_dokter;
            $row[] = $msg;
            $row[] = $call;

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Registrasi_model->count_all(),
            "recordsFiltered" => $this->Registrasi_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function call($no_visit){
        echo json_encode($this->Antrian_model->callAntrian($no_visit));
    }

}