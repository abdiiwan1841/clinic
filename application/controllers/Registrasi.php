<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('Registrasi_model');
        $this->load->model('Pasien_model');
        $this->load->model('Rujukan_model');
        $this->load->model('Diagnosa_model');
        $this->load->model('Dokter_model');
        $this->load->model('Keluhan_model');
	}

	public function index()
	{
		$data['title'] = 'Registrasi';
		$data['content'] = "app/registrasi/page-registrasi";
		$this->load->view('layout',$data);
    }

    public function add()
	{
        date_default_timezone_set('Asia/Jakarta');
		$data['title'] = 'Tambah Registrasi';
        $data['content'] = "app/registrasi/add-registrasi";
        $data['list_rujukan'] = $this->Rujukan_model->getAll()->result_array();
        $data['list_keluhan'] = $this->Keluhan_model->getAllkeluhan()->result_array();
        $data['noantrian'] = $this->get_no_antrian();
        // Pasien Baru
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
        $data['MR_Code'] = $this->Pasien_model->get_no_mr();
		$this->load->view('layout',$data);
    }

    function get_registrasi($mrcode){
        echo json_encode($this->Registrasi_model->get_reg_pasien($mrcode));
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

    function get_no_antrian(){
        $q = $this->db->query("SELECT MAX(RIGHT(no_antrian,3)) AS no_antrian FROM registrasi where visit_date >= CURDATE()
        AND visit_date < CURDATE() + INTERVAL 1 DAY");
        $item = "";
        if($q->num_rows()>0){
            // echo 
            foreach($q->result() as $k){
                $tmp = ((int)$k->no_antrian)+1;
                $item = sprintf("%03s", $tmp);
            }
        }else{
            $item = "001";
        }
        return $item;
    }
    
    function get_data_registrasi(){
        $list = $this->Registrasi_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            if($field->status == 'Menunggu'){
                $msg = '<span class="badge badge-pill badge-success">Menunggu</span>';
                
            }else{
                $msg = '<span class="badge badge-pill badge-danger">Konsul</span>';
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->no_visit;
            $row[] = $field->visit_date;
            $row[] = $field->nama_pasien;
            $row[] = $field->nama_dokter;
            $row[] = $field->keluhan;
            $row[] = $msg;

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

    function get_data_pasien(){
        $list = $this->Pasien_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $mr = $field->MR_Code;
            $novisit = $this->get_no_registrasi($mr);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->MR_Code;
            $row[] = $field->Patient_FName.' '.$field->Patient_LName;
            $row[] = $field->Patient_Sex;
            $row[] = $field->Patient_DOB;
            $row[] = "
            <button type='button' class='waves-effect waves-circle btn btn-circle btn-primary btn-xs pilihpasien' data-dismiss='modal' novisit='".$novisit."' mrcode='".$field->MR_Code."' nama_pasien='".$field->Patient_FName.' '.$field->Patient_LName."' jk='".$field->Patient_Sex."' tgl_lahir='".$field->Patient_DOB."'><i class='fa fa-check'></i></a>";
            // <a class='btn-sm btn btn-primary text-white' data-id='".$field->no_visit."' id='lihat'  data-toggle='modal' data-target='#lihat-mdl'><i
            // class='fa fa-eye'></i></a>

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Pasien_model->count_all(),
            "recordsFiltered" => $this->Pasien_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function save(){
        echo json_encode($this->Registrasi_model->save());
    }
    
    public function cari_dokter(){
		$icd = $this->Dokter_model->data_dokter();
		if(count($icd) >= 1){
			$json['status'] = 1;
			$json["datanya"] = "<ul id='daftar-autocomplete'>";
			foreach($icd as $row){
				$json["datanya"] .= "
					<li>
						<span style='display:none;' id='kode_dokter'>".$row['kode_dokter']."</span>
						<span style='font-weight:bold' id='doktershow'>".$row['nama_dokter']."</span>
					</li>";
			}
			$json["datanya"] .= "</ul>";
		}
		echo json_encode($json);
    }
    
    public function cari_dokter_ref(){
		$icd = $this->Dokter_model->data_dokter();
		if(count($icd) >= 1){
			$json['status'] = 1;
			$json["datanya"] = "<ul id='daftar-autocomplete2'>";
			foreach($icd as $row){
				$json["datanya"] .= "
					<li>
						<span style='display:none;' id='ref_kode_dokter'>".$row['kode_dokter']."</span>
						<span style='font-weight:bold' id='refdoktershow'>".$row['nama_dokter']."</span>
					</li>";
			}
			$json["datanya"] .= "</ul>";
		}
		echo json_encode($json);
    }
    
    public function cari_icd(){
		$icd = $this->Diagnosa_model->data_icd();
		if(count($icd) >= 1){
			$json['status'] = 1;
			$json["datanya"] = "<ul id='daftar-autocomplete3'>";
			foreach($icd as $row){
				$json["datanya"] .= "
					<li>
						<span style='display:none;' id='icd_code'>".$row['ICD_Code']." </span>
						<span style='font-weight:bold' id='icdshow'>".$row['ICD_Code']." - ".$row['ICD_Desc']."</span>
					</li>";
			}
			$json["datanya"] .= "</ul>";
		}
		echo json_encode($json);
    }
}
