<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan_obat extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('satuan_obat_model');
	}

	public function index()
	{
		$data['title'] = 'Satuan Obat Dokter';
		$data['content'] = "app/apotik/satuan-obat/page-satuan-obat";
		$this->load->view('layout',$data);
    }
    
    public function satuan_obat_add()
    {
        
        // $this->form_validation->set_rules('kode_satuan_obat', 'kode satuan_obat', 'required|trim|is_unique[satuan_obat.kode_satuan_obat]');
        $this->form_validation->set_rules('nama_satuan_obat', 'nama satuan obat', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_satuan_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_satuan_obat'))) . "|";
                die();
            }
            if (form_error('nama_satuan_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_satuan_obat'))) . "|";
                die();
            }
        } else {
            $data = [
                // 'kode_satuan_obat' => $this->input->post('kode_satuan_obat'),
                'nama_satuan_obat' => $this->input->post('nama_satuan_obat'),
                'status' => $this->input->post('status')
            ];
            $this->satuan_obat_model->createNewsatuan_obat($data);
            echo 'Success|Successfully add new satuan_obat';
        }
    }

    function satuan_obat_fetch()
    {
        
        $data = $this->satuan_obat_model->getAllsatuan_obat();
        $no = 1;
        $output = '<table class="table " id="example1">
                    <thead>
                        <tr>
                            <th width="10">No.</th>
                            <th>Nama satuan_obat</th>
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
				<td>' .$row->nama_satuan_obat.'</td>
				<td>' .$msg.'</td>
                <td>' .
                // .'<button class="btn btn-danger btn-sm deleteButton"  data-info="Active" data-kode_satuan_obat='.$row->kode_satuan_obat.'><i class="ti-trash"></i></button>' . 
                ' <button class="btn btn-warning btn-sm editButton" data-kode_satuan_obat = '.$row->kode_satuan_obat.'><i class="ti-pencil-alt"></i></button></td>
			</tr>
			';
        }
        $output .= '</tbody></table>';
        echo $output;
    }

    function satuan_obat_delete()
    {
        
        // header("Content-Type: application/json", true);
        $kode_satuan_obat = $_POST['kode_satuan_obat'];
        $this->db->where('kode_satuan_obat', $kode_satuan_obat);
        $this->db->delete('satuan_obat');
        echo json_encode("success");
    }

    function satuan_obat_selected()
    {
        
        // header("Content-Type: application/json", true);
        $kode_satuan_obat = $_POST['kode_satuan_obat'];
        echo  json_encode($this->satuan_obat_model->getOneData($kode_satuan_obat));
    }

    public function satuan_obat_update()
    {
        $old_kode = $this->input->post("old_kode");
        if($this->input->post('kode_satuan_obat') != $old_kode) {
            $is_unique =  '|is_unique[satuan_obat.kode_satuan_obat]';
         } else {
            $is_unique =  '';
         }
        $this->form_validation->set_rules('nama_satuan_obat', 'nama satuan_obat', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_satuan_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_satuan_obat'))) . "|";
                die();
            }
            if (form_error('nama_satuan_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_satuan_obat'))) . "|";
                die();
            }
        } else {

            $data = [
                'nama_satuan_obat' => $this->input->post('nama_satuan_obat'),
                'status' => $this->input->post('status'),
            ];
            $kode_satuan_obat = $this->input->post('kode_satuan_obat');
            $this->satuan_obat_model->updatesatuan_obat($data, $kode_satuan_obat);
            echo 'Success|Successfully edit  satuan_obat';
        }
    }

}
