<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spesialis extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('Spesialis_model');
	}

	public function index()
	{
		$data['title'] = 'Spesialis Dokter';
		$data['content'] = "app/spesialis/page-spesialis";
		$this->load->view('layout',$data);
    }
    
    public function spesialis_add()
    {
        
        $this->form_validation->set_rules('kode_spesialis', 'kode spesialis', 'required|trim|is_unique[spesialis.kode_spesialis]');
        $this->form_validation->set_rules('nama_spesialis', 'nama spesialis', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_spesialis')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_spesialis'))) . "|";
                die();
            }
            if (form_error('nama_spesialis')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_spesialis'))) . "|";
                die();
            }
        } else {
            $data = [
                'kode_spesialis' => $this->input->post('kode_spesialis'),
                'nama_spesialis' => $this->input->post('nama_spesialis'),
                'status' => $this->input->post('status')
            ];
            $this->Spesialis_model->createNewSpesialis($data);
            echo 'Success|Successfully add new spesialis';
        }
    }

    function spesialis_fetch()
    {
        
        $data = $this->Spesialis_model->getAllSpesialis();
        $no = 1;
        $output = '<table class="table " id="example1">
                    <thead>
                        <tr>
                            <th width="10">No.</th>
                            <th width="150">Kode Spesialis</th>
                            <th>Nama Spesialis</th>
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
				<td>' .$row->kode_spesialis.'</td>
				<td>' .$row->nama_spesialis.'</td>
				<td>' .$msg.'</td>
                <td>' .
                // .'<button class="btn btn-danger btn-sm deleteButton"  data-info="Active" data-kode_spesialis='.$row->kode_spesialis.'><i class="ti-trash"></i></button>' . 
                ' <button class="btn btn-warning btn-sm editButton" data-kode_spesialis = '.$row->kode_spesialis.'><i class="ti-pencil-alt"></i></button></td>
			</tr>
			';
        }
        $output .= '</tbody></table>';
        echo $output;
    }

    function spesialis_delete()
    {
        
        // header("Content-Type: application/json", true);
        $kode_spesialis = $_POST['kode_spesialis'];
        $this->db->where('kode_spesialis', $kode_spesialis);
        $this->db->delete('spesialis');
        echo json_encode("success");
    }

    function spesialis_selected()
    {
        
        // header("Content-Type: application/json", true);
        $kode_spesialis = $_POST['kode_spesialis'];
        echo  json_encode($this->Spesialis_model->getOneData($kode_spesialis));
    }

    public function spesialis_update()
    {
        $old_kode = $this->input->post("old_kode");
        if($this->input->post('kode_spesialis') != $old_kode) {
            $is_unique =  '|is_unique[spesialis.kode_spesialis]';
         } else {
            $is_unique =  '';
         }
        $this->form_validation->set_rules('kode_spesialis', 'kode spesialis', 'required|trim'.$is_unique);
        $this->form_validation->set_rules('nama_spesialis', 'nama spesialis', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_spesialis')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_spesialis'))) . "|";
                die();
            }
            if (form_error('nama_spesialis')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_spesialis'))) . "|";
                die();
            }
        } else {

            $data = [
                'kode_spesialis' => $this->input->post('kode_spesialis'),
                'nama_spesialis' => $this->input->post('nama_spesialis'),
                'status' => $this->input->post('status'),
            ];
            $kode_spesialis = $this->input->post('kode_spesialis');
            $this->Spesialis_model->updateSpesialis($data, $kode_spesialis);
            echo 'Success|Successfully edit  Spesialis';
        }
    }

}
