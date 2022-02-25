<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('Pasien_model');
	}

	public function index()
	{
		$data['title'] = 'Data Pasien';
        $data['content'] = "app/pasien/page-pasien";
        $json_negara = file_get_contents("./assets/json/negara.json");
        $data['negara'] = json_decode($json_negara, true);
        $json_prov = file_get_contents("./assets/json/provinsi.json");
        $data['provinsi'] = json_decode($json_prov, true);
        $json_kota = file_get_contents("./assets/json/kota.json");
        $data['kota'] = json_decode($json_kota, true);
        $json_kecamatan = file_get_contents("./assets/json/kecamatan.json");
        $data['kecamatan'] = json_decode($json_kecamatan, true);
        $json_pekerjaan = file_get_contents("./assets/json/pekerjaan.json");
        $data['pekerjaan'] = json_decode($json_pekerjaan, true);
        $data['MR_Code'] = $this->get_no_mr();
		$this->load->view('layout',$data);
    }

	public function edit()
	{
		$data['title'] = 'Data Pasien';
        $data['content'] = "app/pasien/edit-pasien";
        $data['pasien'] = $this->Pasien_model->getCurrentPatient($this->input->get('MR_Code'));
        $json_negara = file_get_contents("./assets/json/negara.json");
        $data['negara'] = json_decode($json_negara, true);
        $json_prov = file_get_contents("./assets/json/provinsi.json");
        $data['provinsi'] = json_decode($json_prov, true);
        $json_kota = file_get_contents("./assets/json/kota.json");
        $data['kota'] = json_decode($json_kota, true);
        $json_kecamatan = file_get_contents("./assets/json/kecamatan.json");
        $data['kecamatan'] = json_decode($json_kecamatan, true);
		$this->load->view('layout',$data);
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

    public function save(){
        $this->Pasien_model->save_pasien();
        
    }
    public function save_pasien_registrasi(){
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
        $this->db->insert("pasien", $data);
        echo $data['MR_Code']."|".$this->get_no_registrasi($data['MR_Code'])."|".$data['Patient_DOB']."|".$data['Patient_FName']."|".$data['Patient_Sex']."|".$this->get_no_mr();
        
    }
    function get_no_registrasi($mrcode){
        $q = $this->db->query("SELECT MAX(RIGHT(no_visit,3)) AS no_visit FROM registrasi where mr_code='$mrcode'");
        $item = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->no_visit)+1;
                $item = sprintf("%03s", $tmp);
            }
        }else{
            $item = "001";
        }
        return $item;
    }
    public function save_edit($MR_Code){
        $this->Pasien_model->edit_pasien($MR_Code);
    }

    public function data_pasien(){
        echo json_encode($this->Pasien_model->get());
    }

}
