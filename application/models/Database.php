<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends CI_Model {

	function getBarang(){
		// Ambil data barang yang ada di database
		$q = $this->db->get('data_barang');
		// Data barangnya disimpan didalam array
		$data = $q->result_array();
		return $data;
	}

	public function tambahBarang($data) {
		// Sisispkan / masukkan variabel data yang dikirim ke table data_barang di database barang
		return $this->db->insert('data_barang', $data);
    }

	public function getBarangByNo($no)
    {
		// Ambil data barang yang ada di database sesuai dengan no barang
        return $this->db->get_where('data_barang', ['no' => $no])->row_array();
    }
	
	public function ubahBarang($no, $data)
	{
		// update / ubah variabel data barang sebelumnya dengan data yang dikirim melalui variabel data ke table data_barang di database barang
		return $this->db->where('no', $no)->update('data_barang', $data); 
	} 

	public function hapus($no)
    {
        // hapus  data barang sesuai dengan no barangnya
		return $this->db->delete('data_barang', array('no' => $no));
    }

}
