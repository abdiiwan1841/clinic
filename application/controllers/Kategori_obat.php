<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_obat extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
        }
        $this->load->model('kategori_obat_model');
	}

	public function index()
	{
		$data['title'] = 'Kategori Obat Dokter';
		$data['content'] = "app/apotik/kategori-obat/page-kategori-obat";
		$this->load->view('layout',$data);
    }
    
    public function kategori_obat_add()
    {
        
        // $this->form_validation->set_rules('kode_kategori_obat', 'kode kategori_obat', 'required|trim|is_unique[kategori_obat.kode_kategori_obat]');
        $this->form_validation->set_rules('nama_kategori_obat', 'nama kategori obat', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_kategori_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_kategori_obat'))) . "|";
                die();
            }
            if (form_error('nama_kategori_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_kategori_obat'))) . "|";
                die();
            }
        } else {
            $data = [
                // 'kode_kategori_obat' => $this->input->post('kode_kategori_obat'),
                'nama_kategori_obat' => $this->input->post('nama_kategori_obat'),
                'status' => $this->input->post('status')
            ];
            $this->kategori_obat_model->createNewkategori_obat($data);
            echo 'Success|Successfully add new kategori_obat';
        }
    }

    function kategori_obat_fetch()
    {
        
        $data = $this->kategori_obat_model->getAllkategori_obat();
        $no = 1;
        $output = '<table class="table " id="example1">
                    <thead>
                        <tr>
                            <th width="10">No.</th>
                            <th>Nama kategori_obat</th>
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
				<td>' .$row->nama_kategori_obat.'</td>
				<td>' .$msg.'</td>
                <td>' .
                // .'<button class="btn btn-danger btn-sm deleteButton"  data-info="Active" data-kode_kategori_obat='.$row->kode_kategori_obat.'><i class="ti-trash"></i></button>' . 
                ' <button class="btn btn-warning btn-sm editButton" data-kode_kategori_obat = '.$row->kode_kategori_obat.'><i class="ti-pencil-alt"></i></button></td>
			</tr>
			';
        }
        $output .= '</tbody></table>';
        echo $output;
    }

    function kategori_obat_delete()
    {
        
        // header("Content-Type: application/json", true);
        $kode_kategori_obat = $_POST['kode_kategori_obat'];
        $this->db->where('kode_kategori_obat', $kode_kategori_obat);
        $this->db->delete('kategori_obat');
        echo json_encode("success");
    }

    function kategori_obat_selected()
    {
        
        // header("Content-Type: application/json", true);
        $kode_kategori_obat = $_POST['kode_kategori_obat'];
        echo  json_encode($this->kategori_obat_model->getOneData($kode_kategori_obat));
    }

    public function kategori_obat_update()
    {
        $old_kode = $this->input->post("old_kode");
        if($this->input->post('kode_kategori_obat') != $old_kode) {
            $is_unique =  '|is_unique[kategori_obat.kode_kategori_obat]';
         } else {
            $is_unique =  '';
         }
        $this->form_validation->set_rules('nama_kategori_obat', 'nama kategori_obat', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (form_error('kode_kategori_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('kode_kategori_obat'))) . "|";
                die();
            }
            if (form_error('nama_kategori_obat')) {
                echo "Error|" . str_replace("</p>", "", str_replace("<p>", "", form_error('nama_kategori_obat'))) . "|";
                die();
            }
        } else {

            $data = [
                'nama_kategori_obat' => $this->input->post('nama_kategori_obat'),
                'status' => $this->input->post('status'),
            ];
            $kode_kategori_obat = $this->input->post('kode_kategori_obat');
            $this->kategori_obat_model->updatekategori_obat($data, $kode_kategori_obat);
            echo 'Success|Successfully edit  kategori_obat';
        }
    }

}
