<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poli extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('poli_model');
	}

	public function index()
	{
		$data['title'] = 'Poli Dokter';
		$data['content'] = "app/poli/page-poli";
		$this->load->view('layout',$data);
    }
    
    public function poli_add()
    {
        
        $this->form_validation->set_rules('kode_poli', 'kode poli', 'required|trim|is_unique[poli.kode_poli]');
        $this->form_validation->set_rules('nama_poli', 'nama poli', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_poli')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_poli'))) . "|";
                die();
            }
            if (form_error('nama_poli')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_poli'))) . "|";
                die();
            }
        } else {
            $data = [
                'kode_poli' => $this->input->post('kode_poli'),
                'nama_poli' => $this->input->post('nama_poli')
            ];
            $this->poli_model->createNewpoli($data);
            echo 'Success|Successfully add new poli';
        }
    }

    function poli_fetch()
    {
        
        $data = $this->poli_model->getAllpoli();
        $no = 1;
        $output = '<table class="table" id="example1">
                    <thead>
                        <tr>
                            <th width="10">No.</th>
                            <th width="150">Kode Poli</th>
                            <th>Nama Poli</th>
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
				<td>' .$row->kode_poli.'</td>
                <td>' .$row->nama_poli.'</td>
                <td>' .$msg.'</td>
                <td>' .
                // '<button class="btn btn-danger btn-sm deleteButton"  data-info="Active" data-kode_poli='.$row->kode_poli.'><i class="ti-trash"></i></button>' . 
                ' <button class="btn btn-warning btn-sm editButton" data-kode_poli = '.$row->kode_poli.'><i class="ti-pencil-alt"></i></button></td>
			</tr>
			';
        }
        $output .= '</tbody></table>';
        echo $output;
    }

    function poli_delete()
    {
        
        // header("Content-Type: application/json", true);
        $kode_poli = $_POST['kode_poli'];
        $this->db->where('kode_poli', $kode_poli);
        $this->db->delete('poli');
        echo json_encode("success");
    }

    function poli_selected()
    {
        
        // header("Content-Type: application/json", true);
        $kode_poli = $_POST['kode_poli'];
        echo  json_encode($this->poli_model->getOneData($kode_poli));
    }

    public function poli_update()
    {
        $old_kode = $this->input->post("old_kode");
        if($this->input->post('kode_poli') != $old_kode) {
            $is_unique =  '|is_unique[poli.kode_poli]';
         } else {
            $is_unique =  '';
         }
        $this->form_validation->set_rules('kode_poli', 'kode poli', 'required|trim'.$is_unique);
        $this->form_validation->set_rules('nama_poli', 'nama poli', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_poli')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_poli'))) . "|";
                die();
            }
            if (form_error('nama_poli')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_poli'))) . "|";
                die();
            }
        } else {

            $data = [
                'nama_poli' => $this->input->post('nama_poli'),
                'status' => $this->input->post('status')
            ];
            $kode_poli = $this->input->post('kode_poli');
            $this->poli_model->updatepoli($data, $kode_poli);
            echo 'Success|Successfully edit  poli';
        }
    }

}
