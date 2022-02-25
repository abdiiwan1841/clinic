<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_obat extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('obat_model');
	}

	public function index()
	{
		$data['title'] = 'Data Obat';
		$data['content'] = "app/apotik/data-obat/page-data-obat";
		$this->load->view('layout',$data);
    }
    
    function get_kode_obat(){
        $q = $this->db->query("SELECT MAX(RIGHT(kode_obat,8)) AS kode_obat FROM obat");
        $mr = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kode_obat)+1;
                $mr = sprintf("%04s", $tmp);
            }
        }else{
            $mr = "0001";
        }
        return $mr;
    }

    public function obat_add()
    {
        
        // $this->form_validation->set_rules('kode_obat', 'kode obat', 'required|trim|is_unique[obat.kode_obat]');
        $this->form_validation->set_rules('nama_obat', 'nama kategori obat', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_obat'))) . "|";
                die();
            }
            if (form_error('nama_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_obat'))) . "|";
                die();
            }
            if (form_error('kategori_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kategori_obat'))) . "|";
                die();
            }
            if (form_error('satuan')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('satuan'))) . "|";
                die();
            }
            if (form_error('harga')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('harga'))) . "|";
                die();
            }
        } else {
            $data = [
                'kode_obat' => $this->get_kode_obat(),
                'nama_obat' => $this->input->post('nama_obat'),
                'kategori_obat' => $this->input->post('kategori_obat'),
                'satuan' => $this->input->post('satuan'),
                'harga' => $this->input->post('harga'),
                'status' => $this->input->post('status')
            ];
            $this->obat_model->createNewobat($data);
            echo 'Success|Successfully add new obat';
        }
    }

    function obat_fetch()
    {
        
        $data = $this->obat_model->getAllobat();
        $no = 1;
        $output = '<table class="table " id="example1">
                    <thead>
                        <tr>
                            <th width="10">No.</th>
                            <th>Kode obat</th>
                            <th>Nama obat</th>
                            <th>Kategori obat</th>
                            <th>Satuan obat</th>
                            <th>Harga obat</th>
                            <th width="10">Status</th>
                            <th width="10"></th>
                        </tr>
                    </thead>
                    <tbody>
                ';
        foreach ($data->result() as $row) {
            if($row->status == 'Aktif'){
                $msg = '<span class="badge badge-pill badge-success">Aktif</span>';
                
            }else{
                $msg = '<span class="badge badge-pill badge-danger">Tidak Aktif</span>';
            }
            $output .= '
			<tr>
                <td>' .$no++.'.</td>
				<td>' .$row->kode_obat.'</td>
				<td>' .$row->nama_obat.'</td>
				<td>' .$row->nama_kategori_obat.'</td>
				<td>' .$row->nama_satuan_obat.'</td>
				<td>' .$row->harga.'</td>
				<td>' .$msg.'</td>
                <td>' .
                // .'<button class="btn btn-danger btn-sm deleteButton"  data-info="Active" data-kode_obat='.$row->kode_obat.'><i class="ti-trash"></i></button>' . 
                ' <button class="btn btn-warning btn-sm editButton" data-kode_obat = '.$row->kode_obat.'><i class="ti-pencil-alt"></i></button></td>
			</tr>
			';
        }
        $output .= '</tbody></table>';
        echo $output;
    }

    function obat_delete()
    {
        
        // header("Content-Type: application/json", true);
        $kode_obat = $_POST['kode_obat'];
        $this->db->where('kode_obat', $kode_obat);
        $this->db->delete('obat');
        echo json_encode("success");
    }

    function obat_selected()
    {
        
        // header("Content-Type: application/json", true);
        $kode_obat = $_POST['kode_obat'];
        echo  json_encode($this->obat_model->getOneData($kode_obat));
    }

    public function obat_update()
    {
        $old_kode = $this->input->post("old_kode");
        if($this->input->post('kode_obat') != $old_kode) {
            $is_unique =  '|is_unique[obat.kode_obat]';
         } else {
            $is_unique =  '';
         }
        $this->form_validation->set_rules('nama_obat', 'nama obat', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_obat'))) . "|";
                die();
            }
            if (form_error('nama_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_obat'))) . "|";
                die();
            }
            if (form_error('kategori_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kategori_obat'))) . "|";
                die();
            }
            if (form_error('satuan')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('satuan'))) . "|";
                die();
            }
            if (form_error('harga')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('harga'))) . "|";
                die();
            }
        } else {

            $data = [
                'nama_obat' => $this->input->post('nama_obat'),
                'kategori_obat' => $this->input->post('kategori_obat'),
                'satuan' => $this->input->post('satuan'),
                'harga' => $this->input->post('harga'),
                'status' => $this->input->post('status')
            ];
            $kode_obat = $this->input->post('kode_obat');
            $this->obat_model->updateobat($data, $kode_obat);
            echo 'Success|Successfully edit  obat';
        }
    }

}
