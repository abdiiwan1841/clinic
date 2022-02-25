<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluhan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('keluhan_model');
	}

	public function index()
	{
		$data['title'] = 'Keluhan Dokter';
		$data['content'] = "app/keluhan/page-keluhan";
		$this->load->view('layout',$data);
    }
    
    public function keluhan_add()
    {
        
        // $this->form_validation->set_rules('kode_keluhan', 'kode keluhan', 'required|trim|is_unique[keluhan.kode_keluhan]');
        $this->form_validation->set_rules('nama_keluhan', 'nama keluhan', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_keluhan')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_keluhan'))) . "|";
                die();
            }
            if (form_error('nama_keluhan')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_keluhan'))) . "|";
                die();
            }
        } else {
            $data = [
                // 'kode_keluhan' => $this->input->post('kode_keluhan'),
                'nama_keluhan' => $this->input->post('nama_keluhan'),
                'status' => $this->input->post('status')
            ];
            $this->keluhan_model->createNewkeluhan($data);
            echo 'Success|Successfully add new keluhan';
        }
    }

    function keluhan_fetch()
    {
        
        $data = $this->keluhan_model->getAllkeluhan();
        $no = 1;
        $output = '<table class="table " id="example1">
                    <thead>
                        <tr>
                            <th width="10">No.</th>
                            <th>Nama keluhan</th>
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
				<td>' .$row->nama_keluhan.'</td>
				<td>' .$msg.'</td>
                <td>' .
                // .'<button class="btn btn-danger btn-sm deleteButton"  data-info="Active" data-kode_keluhan='.$row->kode_keluhan.'><i class="ti-trash"></i></button>' . 
                ' <button class="btn btn-warning btn-sm editButton" data-kode_keluhan = '.$row->kode_keluhan.'><i class="ti-pencil-alt"></i></button></td>
			</tr>
			';
        }
        $output .= '</tbody></table>';
        echo $output;
    }

    function keluhan_delete()
    {
        
        // header("Content-Type: application/json", true);
        $kode_keluhan = $_POST['kode_keluhan'];
        $this->db->where('kode_keluhan', $kode_keluhan);
        $this->db->delete('keluhan');
        echo json_encode("success");
    }

    function keluhan_selected()
    {
        
        // header("Content-Type: application/json", true);
        $kode_keluhan = $_POST['kode_keluhan'];
        echo  json_encode($this->keluhan_model->getOneData($kode_keluhan));
    }

    public function keluhan_update()
    {
        $old_kode = $this->input->post("old_kode");
        if($this->input->post('kode_keluhan') != $old_kode) {
            $is_unique =  '|is_unique[keluhan.kode_keluhan]';
         } else {
            $is_unique =  '';
         }
        $this->form_validation->set_rules('nama_keluhan', 'nama keluhan', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_keluhan')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_keluhan'))) . "|";
                die();
            }
            if (form_error('nama_keluhan')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_keluhan'))) . "|";
                die();
            }
        } else {

            $data = [
                'nama_keluhan' => $this->input->post('nama_keluhan'),
                'status' => $this->input->post('status'),
            ];
            $kode_keluhan = $this->input->post('kode_keluhan');
            $this->keluhan_model->updatekeluhan($data, $kode_keluhan);
            echo 'Success|Successfully edit  keluhan';
        }
    }

}
