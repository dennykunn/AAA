<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends CI_Model {

	function getBarang(){
		$q = $this->db->get('data_barang');
		$data = $q->result_array();
		return $data;
	}

	public function tambahBarang($data) {
		return $this->db->insert('data_barang', $data);
    }

	public function getBarangByNo($no)
    {
        return $this->db->get_where('data_barang', ['no' => $no])->row_array();
    }
	
	public function ubahBarang($no, $data)
	{
		return $this->db->where('no', $no)->update('data_barang', $data); 
	} 

	public function hapus($no)
    {
        // $this->db->where('no', $no);
        // $this->db->delete('data_barang');
		return $this->db->delete('data_barang', array('no' => $no));
    }

}
