<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function createNewDokter($data)
    {
        $this->db->insert('dokter', $data);
    }
    public function getAllDokter()
    {
        return $this->db->query('SELECT p.*,k.medical_name FROM dokter p inner join kategori k on p.kategori_id = k.kategori_id');
    }
    public function getCurrentDokter($kode_dokter)
    {
		return $this->db->query("SELECT d.*,s.nama_spesialis FROM dokter d inner join spesialis s on s.kode_spesialis = d.kode_spesialis WHERE kode_dokter = '$kode_dokter'")->row_array();
    }
    public function getActiveDokter()
    {
        return $this->db->get_where('dokter', ['is_active' => 'Aktif'])->result_array();
    }
    public function setActiveNotActive($kode_dokter, $active)
    {
        $this->db->set('modified_datetime', date("Y-m-d H:i"));
        $this->db->set('modified_by', $_SESSION['admin_username']);
        $this->db->set('is_active', $active);
        $this->db->where('kode_dokter', $kode_dokter);
        $this->db->update('dokter');
    }
    public function getOneData($kode_dokter)
    {
        $query = $this->db->query("SELECT p.*, k.medical_name FROM dokter p INNER JOIN kategori k on k.kategori_id = p.kategori_id WHERE kode_dokter = '$kode_dokter'");
        $dataTobeReturn =  $query->row_array();
        return $dataTobeReturn;
    }
    public function updateDokter($data, $kode_dokter)
    {
 
        $this->db->where('kode_dokter', $kode_dokter);
        $this->db->update('dokter', $data);
    }
    // Datatable Serverside
    var $table = 'dokter'; //nama tabel dari database
	var $column_order = array(null, 'kode_dokter','nama_spesialis','nama_dokter'); //field yang ada di table user
	var $column_search = array('kode_dokter','nama_spesialis','nama_dokter'); //field yang diizin untuk pencarian 
    var $order = array('kode_dokter' => 'asc'); // default order 
    
    private function _get_datatables_query()
	{
		$this->db->select('dokter.*, spesialis.nama_spesialis');
        $this->db->from('dokter');
        $this->db->join('spesialis', 'spesialis.kode_spesialis = dokter.kode_spesialis');
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from('dokter');
		return $this->db->count_all_results();
	}

	public function data_dokter(){
		$like = $this->input->post_get('like');
		if(!empty($like)){
			$this->db->like('kode_dokter',$like);
			$this->db->or_like('nama_dokter',$like);
		}
		$this->db->limit(10);
		return $this->db->get('dokter')->result_array();
	}
}
