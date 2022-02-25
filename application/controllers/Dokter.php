<?php
 ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Dokter_model');
        $this->load->model('Spesialis_model');
        $this->load->model('Poli_model');
        $this->load->library('excel');
        ini_set('max_execution_time', 50000);

    }
    public function index(){
        $data['title'] = 'Dokter';
		$data['content'] = "app/dokter/page-dokter";
		$this->load->view('layout',$data);
    }
    function import(){
        if (isset($_FILES["uploadFile"]["name"])) {
            $path = $_FILES["uploadFile"]["tmp_name"];

            // get data from table where the date is tracking date, if exist delete the data
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $date = date_format(date_create(date("Y-m-d")), "Ymd");
                for ($row = 2; $row <= $highestRow; $row++) {
                    $kategori = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $kategori = rtrim(ltrim($kategori));
                    $detail_kategori = $this->db->query("SELECT * FROM kategori WHERE nama_kategori = '$kategori'")->row_array();

                    $kategori_id = $detail_kategori['kategori_id'];
                    $produk_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $barcode = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nama_produk = rtrim(ltrim($worksheet->getCellByColumnAndRow(3,$row)->getValue()));
                    $deskripsi_produk = $worksheet->getCellByColumnAndRow(4,$row)->getValue();
                    $harga_produk = $worksheet->getCellByColumnAndRow(5,$row)->getValue();
                    $diskon_produk = $worksheet->getCellByColumnAndRow(6,$row)->getValue();
                    $stok = $worksheet->getCellByColumnAndRow(7,$row)->getValue();

                    $nama_produk = str_replace('"',"",str_replace("'","",$nama_produk));
                    if($this->db->query("SELECT * FROM produk WHERE nama_produk = '$nama_produk' OR produk_id = '$produk_id'")->num_rows() == 0){
                        if($detail_kategori){
                            if($produk_id == ''){
                                $produk_id = $this->Dokter_model->getDokterId();
                            }
                            $data = [
                                'produk_id'        =>    rtrim(ltrim($produk_id)),
                                'barcode'        =>  rtrim(ltrim($barcode)),
                                'nama_produk'        =>  rtrim(ltrim($nama_produk)),
                                'kategori_id'        =>  rtrim(ltrim($kategori_id)),
                                'deskripsi_produk'        =>  rtrim(ltrim($deskripsi_produk)),
                                'harga_produk'        =>  rtrim(ltrim($harga_produk)),
                                'diskon_produk'        =>  rtrim(ltrim($diskon_produk)),
                                'stok'        =>  rtrim(ltrim($stok)),
                                'produk_image' => 'default.png',
                                'is_active' => 'Aktif',
                                'created_by' => $_SESSION['admin_username'],
                                'modified_by' => $_SESSION['admin_username'],
                                'created_datetime'=>date("Y-m-d H:i"),
                                'modified_datetime'=>date("Y-m-d H:i"),
                            ];
                            if(rtrim(ltrim($nama_produk)) != '' && rtrim(ltrim($kategori_id)) != ''){
                                $this->Dokter_model->createNewDokter($data);
                                if($stok > 0){
                                    // Insert into inventory as stok awal
                                    $inventory = [
                                        'id_inventory'=>$this->Inventory_model->getInventoryId(),
                                        'produk_id'=>$produk_id,
                                        'inventory_code'=>'masuk',
                                        'deskripsi'=>'Stok awal barang per tanggal '.date("Y-m-d H:i"),
                                        'qty'=>$stok,
                                        'created_by' => $_SESSION['admin_username'],
                                        'modified_by' => $_SESSION['admin_username'],
                                        'created_datetime'=>date("Y-m-d H:i"),
                                        'modified_datetime'=>date("Y-m-d H:i"),
                                    ];
                                    $this->Inventory_model->createNewinventory($inventory);
                                }
                            }
                           
                        }
                    }
                    
                    
                }
            }
            // echo var_dump($data);
            echo "Success Imported";
        }
    }

    public function add_dokter(){
         $this->form_validation->set_rules('kode_dokter', 'kode dokter', 'required|trim|is_unique[dokter.kode_dokter]');
        $this->form_validation->set_rules('nama_dokter', 'nama dokter', 'required|trim');
        $this->form_validation->set_rules('kode_spesialis', 'spesialis', 'required|trim');
        $this->form_validation->set_rules('dob_dokter', 'tanggal lahir', 'required|trim');
        $this->form_validation->set_rules('agama_dokter', 'agama dokter', 'required|trim');
        $this->form_validation->set_rules('kode_poli', 'kode_poli', 'trim');
         $this->form_validation->set_rules('kode_prefix', 'kode prefix', 'required|trim|min_length[3]|max_length[4]|is_unique[dokter.kode_prefix]');
        $this->form_validation->set_rules('telp1_dokter', 'nomor telepon 1 dokter', 'required|trim|is_numeric');
        
        if ($this->form_validation->run() == false) {
            if (form_error('kode_dokter')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_dokter'))) . "|";
                die();
            }
            if (form_error('nama_dokter')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_dokter'))) . "|";
                die();
            }
            if (form_error('kode_spesialis')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_spesialis'))) . "|";
                die();
            }
            if (form_error('id_dokter')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('id_dokter'))) . "|";
                die();
            }
            if (form_error('kode_menkes')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_menkes'))) . "|";
                die();
            }
            if (form_error('dob_dokter')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('dob_dokter'))) . "|";
                die();
            }
            if (form_error('agama_dokter')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('agama_dokter'))) . "|";
                die();
            }
            if (form_error('provinsi_dokter')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('provinsi_dokter'))) . "|";
                die();
            }
            if (form_error('kota_dokter')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kota_dokter'))) . "|";
                die();
            }
            if (form_error('kecamatan_dokter')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kecamatan_dokter'))) . "|";
                die();
            }
            if (form_error('telp1_dokter')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('telp1_dokter'))) . "|";
                die();
            }
            if (form_error('kode_prefix')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_prefix'))) . "|";
                die();
            }
            if (form_error('kode_poli')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_poli'))) . "|";
                die();
            }
            if (form_error('alamat_dokter')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('alamat_dokter'))) . "|";
                die();
            }
        }else{
            $data = [
                "kode_dokter"=>$this->input->post('kode_dokter'),
                "nama_dokter"=>$this->input->post('nama_dokter'),
                "kode_spesialis"=>$this->input->post('kode_spesialis'),
                "dob_dokter"=>$this->input->post('dob_dokter'),
                "agama_dokter"=>$this->input->post('agama_dokter'),
                "alamat_dokter"=>$this->input->post('alamat_dokter'),
                "kode_poli"=>$this->input->post('kode_poli'),
                "kode_prefix"=>$this->input->post('kode_prefix'),
                "telp1_dokter"=>$this->input->post('telp1_dokter'),
                "telp2_dokter"=>$this->input->post('telp2_dokter'),
                "status"=>$this->input->post('status')
            ];
            $this->db->insert("dokter",$data);
            // $this->Dokter_model->createNewDokter($data);
            // Add User
            $dataUser=[
                "nama"=>$this->input->post('nama_dokter'),
                "username"=>$this->input->post('kode_dokter'),
                "password"=> password_hash($this->input->post('kode_dokter'), PASSWORD_DEFAULT),
                "level"=>"Dokter",
                "status"=>"Aktif",
                "created_date"=> date("Y-m-d H:i:s")
            ];
            $this->db->insert("users",$dataUser);
            echo "Success|Berhasil menambah dokter";
        }
       
    }

    public function add()
    {

            $data['title'] = 'Tambah Dokter';
            $data['content'] = "app/dokter/add-dokter";
            $data['list_spesialis'] = $this->Spesialis_model->getAllSpesialis();
            $json_negara = file_get_contents("./assets/json/negara.json");
            $data['negara'] = json_decode($json_negara, true);
            $json_prov = file_get_contents("./assets/json/provinsi.json");
            $data['provinsi'] = json_decode($json_prov, true);
            $json_kota = file_get_contents("./assets/json/kota.json");
            $data['kota'] = json_decode($json_kota, true);
            $json_kecamatan = file_get_contents("./assets/json/kecamatan.json");
            $data['kecamatan'] = json_decode($json_kecamatan, true);
            $data['poli'] = $this->Poli_model->getActivepoli();
            $this->load->view('layout',$data);
    }
    public function edit($kode_dokter= '')
    {
        $data['title'] = 'Edit Dokter';
        $data['content'] = "app/dokter/edit-dokter";
        $data['list_spesialis'] = $this->Spesialis_model->getAllSpesialis();
        $json_negara = file_get_contents("./assets/json/negara.json");
        $data['negara'] = json_decode($json_negara, true);
        $json_prov = file_get_contents("./assets/json/provinsi.json");
        $data['provinsi'] = json_decode($json_prov, true);
        $json_kota = file_get_contents("./assets/json/kota.json");
        $data['kota'] = json_decode($json_kota, true);
        $json_kecamatan = file_get_contents("./assets/json/kecamatan.json");
        $data['kecamatan'] = json_decode($json_kecamatan, true);
        $data['dokter']= $this->Dokter_model->getCurrentDokter($kode_dokter);
        $data['poli'] = $this->Poli_model->getActivepoli();
        if($data['dokter']){
            $this->load->view('layout',$data);
        }else{
            redirect("dokter");
        }
    }
    public function edit_action()
    {
        $original_value = $this->input->post('original_value');
        if($this->input->post('kode_dokter') != $original_value) {
            $is_unique =  '|is_unique[dokter.kode_dokter]';
        } else {
            $is_unique =  '';
        }
        $original_value2 = $this->input->post('original_value2');
        if($this->input->post('kode_prefix') != $original_value2) {
            $is_unique2 =  '|is_unique[dokter.kode_prefix]';
        } else {
            $is_unique2 =  '';
        }
         $this->form_validation->set_rules('kode_dokter', 'kode dokter', 'required|trim'.$is_unique);
         $this->form_validation->set_rules('nama_dokter', 'nama dokter', 'required|trim');
         $this->form_validation->set_rules('kode_spesialis', 'spesialis', 'required|trim');
         $this->form_validation->set_rules('dob_dokter', 'tanggal lahir', 'required|trim');
         $this->form_validation->set_rules('agama_dokter', 'agama dokter', 'required|trim');
         $this->form_validation->set_rules('kode_poli', 'kode_poli', 'required|trim');
         $this->form_validation->set_rules('kode_prefix', 'kode prefix', 'required|trim|min_length[3]|max_length[4]'. $is_unique2);
         $this->form_validation->set_rules('telp1_dokter', 'nomor telepon 1 dokter', 'required|trim|is_numeric');
         if ($this->form_validation->run() == false) {
             if (form_error('kode_dokter')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_dokter'))) . "|";
                 die();
             }
             if (form_error('nama_dokter')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_dokter'))) . "|";
                 die();
             }
             if (form_error('kode_spesialis')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_spesialis'))) . "|";
                 die();
             }
             if (form_error('id_dokter')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('id_dokter'))) . "|";
                 die();
             }
             if (form_error('kode_menkes')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_menkes'))) . "|";
                 die();
             }
             if (form_error('dob_dokter')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('dob_dokter'))) . "|";
                 die();
             }
             if (form_error('agama_dokter')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('agama_dokter'))) . "|";
                 die();
             }
             if (form_error('provinsi_dokter')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('provinsi_dokter'))) . "|";
                 die();
             }
             if (form_error('kota_dokter')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kota_dokter'))) . "|";
                 die();
             }
             if (form_error('kecamatan_dokter')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kecamatan_dokter'))) . "|";
                 die();
             }
             if (form_error('telp1_dokter')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('telp1_dokter'))) . "|";
                 die();
             }
             if (form_error('alamat_dokter')) {
                 echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('alamat_dokter'))) . "|";
                 die();
             }
             if (form_error('kode_prefix')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_prefix'))) . "|";
                die();
            }
            if (form_error('kode_poli')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_poli'))) . "|";
                die();
            }
         } else {
             $original_value = $this->input->post('original_value');
             
             $data = [
                 "kode_spesialis"=>$this->input->post('kode_spesialis'),
                 "nama_dokter"=>$this->input->post('nama_dokter'),
                 "dob_dokter"=>$this->input->post('dob_dokter'),
                 "agama_dokter"=>$this->input->post('agama_dokter'),
                 "kode_poli"=>$this->input->post('kode_poli'),
                 "kode_prefix"=>$this->input->post('kode_prefix'),
                 "alamat_dokter"=>$this->input->post('alamat_dokter'),
                 "telp1_dokter"=>$this->input->post('telp1_dokter'),
                 "telp2_dokter"=>$this->input->post('telp2_dokter'),
                 "status"=>$this->input->post('status'),
             ];
            //  if($original_value != $this->input->post('kode_dokter')){
            //     $data["kode_dokter"]=$this->input->post('kode_dokter');
            //       // Add User
            //     $dataUser=[
            //     "username"=>$this->input->post('kode_dokter'),

            //         "password"=> password_hash($this->input->post('kode_dokter'), PASSWORD_DEFAULT)
            //     ];
            //     $this->db->where("username",$original_value);
            //     $this->db->update("users",$dataUser);
            //  }
             $this->Dokter_model->updateDokter($data,$original_value);
            
             echo "Success|Berhasil mengubah dokter";
             die(); 
 
         }
    }
    function set_Active()
    {
        // header("Content-Type: application/json", true);
        $produk_id = $_POST['produk_id'];
        $status = $_POST['status'];
        $this->Dokter_model->setActiveNotActive($produk_id, $status);
        echo json_encode("success");
    }

    // Data Table Server Side
    function get_dokter()
	{
        $list = $this->Dokter_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$row = array();
			// $row[] = $field->kode_dokter;
			$row[] = $field->nama_dokter;
			$row[] = $field->nama_spesialis;
			$row[] = $field->alamat_dokter;
			$row[] = $field->telp1_dokter;
			$row[] = $field->status;
            $row[]='<a class="btn-sm btn btn-warning text-white" href="'.base_url().'dokter/edit/'.$field->kode_dokter.'"><i
            class="fa fa-pencil"></i></a';
            // $row[]='<a href="'.base_url().'dokter/edit/'.$field->kode_dokter.'" class="edit-btn m-1"><i class="fas fa-edit"></i></a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Dokter_model->count_all(),
			"recordsFiltered" => $this->Dokter_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
}
ob_flush();