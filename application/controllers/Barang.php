<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Database'); 

		$this->load->view('barang/header');
    }

	public function index()
	{
		$data['barang'] = $this->Database->getBarang();

		$this->load->view('barang/index', $data);
		$this->load->view('barang/footer');
	}

	public function tambah() {
		$this->load->view('barang/tambah');
		$this->load->view('barang/footer');
	}

	public function proses_tambah() {
		$validation = $this->form_validation;

		$validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$validation->set_rules('harga', 'Harga', 'required');
		$validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
		$validation->set_rules('tgl_keluar', 'Tanggal Keluar', 'required');

		if ($this->form_validation->run() == FALSE)
        {
        	$page_data['errors'] = validation_errors();
        	$this->tambah();
        }else{
			// Script untuk upload gambar
			$config['upload_path'] = './uploads';
			$config['allowed_types'] = 'jpg|png|jpeg|webp';
			$config['max_size'] = '2048';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('foto_barang')){ 
				// Ambil data Foto Barang yang di upload
				$upload = $this->upload->data();
				
				$data = array(
					'nama_barang' => $this->input->post('nama_barang'),
					'harga' => $this->input->post('harga'),
					'tgl_masuk' => $this->input->post('tgl_masuk'),
					'tgl_keluar' => $this->input->post('tgl_keluar'),
					'foto_barang' => $upload['file_name']
				);
				
				$this->Database->tambahBarang($data);

				//add flash data 
				$this->session->set_flashdata('message','Data barang berhasil di tambahkan.');

				redirect(base_url());
			} else{
				$this->upload->display_errors();
				$this->tambah();
			}
		} 
	} 

	public function ubah($no) {
		$data['barang'] = $this->Database->getBarangByNo($no);
		
		$this->load->view('barang/ubah', $data);
		$this->load->view('barang/footer');
	}

	public function proses_ubah() {
        $validation = $this->form_validation; 

        $validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$validation->set_rules('harga', 'Harga', 'required');
		$validation->set_rules('tlg_masuk', 'Tanggal Masuk', 'required');
		$validation->set_rules('tlg_keluar', 'Tanggal Keluar', 'required'); 

		$no = $this->input->post("no");
		$foto_barang = $this->input->post("foto_barang_lama");  

		$config['upload_path'] = './uploads';
		$config['allowed_types'] = 'jpg|png|jpeg|webp';
		$config['max_size'] = '2048';

		$this->load->library('upload', $config); 

		// Check jika Foto diganti
		if (!empty($_FILES['foto_barang']['name'])) {
			if(!$this->upload->do_upload('foto_barang')){ 
				$this->upload->display_errors();
				$this->ubah($no);
			}else{ 
				// Hapus gambar yang lama
				if(file_exists("./uploads/$foto_barang") && $foto_barang) {
					unlink("./uploads/$foto_barang");
				}

				// Ambil data avatar yang di upload
				$upload = $this->upload->data();
				$foto_barang = $upload['file_name'];
			}
		}

		$data = array(
			'nama_barang' => $this->input->post('nama_barang'),
			'harga' => $this->input->post('harga'),
			'tgl_masuk' => $this->input->post('tgl_masuk'),
			'tgl_keluar' => $this->input->post('tgl_keluar'),
			'foto_barang' => $foto_barang
		);

		$this->Database->ubahBarang($no, $data);

		//add flash data
		$this->session->set_flashdata('message','Data barang berhasil di ubah.');

		redirect(base_url());
    }


	public function hapus($no) {

		$this->Database->hapus($no);

		//add flash data
		$this->session->set_flashdata('message','Data barang berhasil di hapus.'); 

        redirect(base_url());
    }
}
