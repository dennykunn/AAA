<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	public function __construct(){
        parent::__construct();

		// Menghubungkan ke model database
        $this->load->model('Database'); 

		// Menghubungkan ke view header
		$this->load->view('barang/header');
    }

	public function index()
	{
		// Memasukkan function getBarang yang ada di database model ke variabel data
		$data['barang'] = $this->Database->getBarang();

		// link ke index dengan membawa variabel data yang sudah diisi dengan function getBarang
		$this->load->view('barang/index', $data);
		// Menghubungkan ke view footer
		$this->load->view('barang/footer');
	}

	public function tambah() {
		// link ke view tambah
		$this->load->view('barang/tambah');
		// Menghubungkan ke view footer
		$this->load->view('barang/footer');
	}

	public function proses_tambah() {
		// Biar singkat aja
		$validation = $this->form_validation;

		// Kasih validasi / rules
		$validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$validation->set_rules('harga', 'Harga', 'required');
		$validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
		$validation->set_rules('tgl_keluar', 'Tanggal Keluar', 'required');

		if ($this->form_validation->run() == FALSE)
        {
			// tetap di view tambah jika error
        	$page_data['errors'] = validation_errors();
        	$this->tambah();
        }else{
			// pengaturan untuk upload gambar
			// simpan dimana
			$config['upload_path'] = './uploads';
			// extensi gambar yang boleh upload
			$config['allowed_types'] = 'jpg|png|jpeg|webp';
			// ukuran gambar maks 2mb
			$config['max_size'] = '2048';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('foto_barang')){ 
				// Ambil data Foto Barang yang di upload
				$upload = $this->upload->data();
				
				// Ambil data yang di input di form view tambah
				$data = array(
					'nama_barang' => $this->input->post('nama_barang'),
					'harga' => $this->input->post('harga'),
					'tgl_masuk' => $this->input->post('tgl_masuk'),
					'tgl_keluar' => $this->input->post('tgl_keluar'),
					'foto_barang' => $upload['file_name']
				);
				
				// link ke model Database function tambahBarang dengan membawa variabel data yang sudah diisi inputan tadi
				$this->Database->tambahBarang($data);

				//tambah flash data / pesan 
				$this->session->set_flashdata('message','Data barang berhasil di tambahkan.');

				// kembali ke index
				redirect(base_url());
			} else{
				// Tetap di view tambah jika error
				$this->upload->display_errors();
				$this->tambah();
			}
		} 
	} 

	public function ubah($no) {
		// Memasukkan function getBarangByNo yang ada di model database ke variabel data
		$data['barang'] = $this->Database->getBarangByNo($no);
		
		// link ke view ubah dengan membawa variabel data yang sudah diisi dengan function getBarangByNo
		$this->load->view('barang/ubah', $data);
		// Menghubungkan ke view footer
		$this->load->view('barang/footer');
	}

	public function proses_ubah() {
		// Biar singkat aja
        $validation = $this->form_validation; 

		// Kasih validasi / rules
        $validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$validation->set_rules('harga', 'Harga', 'required');
		$validation->set_rules('tlg_masuk', 'Tanggal Masuk', 'required');
		$validation->set_rules('tlg_keluar', 'Tanggal Keluar', 'required'); 

		// Ambil no barang yang mau diubah
		$no = $this->input->post("no");
		// Ambil foto_barang yang mau diubah
		$foto_barang = $this->input->post("foto_barang_lama");  

		// pengaturan untuk upload gambar
		// simpan dimana
		$config['upload_path'] = './uploads';
		// extensi gambar yang boleh upload
		$config['allowed_types'] = 'jpg|png|jpeg|webp';
		// ukuran gambar maks 2mb
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

		// Ambil data yang di input di form view tambah
		$data = array(
			'nama_barang' => $this->input->post('nama_barang'),
			'harga' => $this->input->post('harga'),
			'tgl_masuk' => $this->input->post('tgl_masuk'),
			'tgl_keluar' => $this->input->post('tgl_keluar'),
			'foto_barang' => $foto_barang
		);

		// link ke model Database function ubahBarang dengan membawa variabel data dan no yang sudah diisi inputan tadi
		$this->Database->ubahBarang($no, $data);

		//add flash data
		$this->session->set_flashdata('message','Data barang berhasil di ubah.');

		// Kembali ke index 
		redirect(base_url());
    }


	public function hapus($no) {
		// Ambil Data Barang sesuai no
		$barang = $this->Database->getBarangByNo($no);

		// print_r($barang['foto_barang']);

		// hapus foto barang
		if (is_file('./uploads/'.$barang['foto_barang'])) {
			unlink('./uploads/'.$barang['foto_barang']);
		}

		// hubungkan ke model hapus
		$this->Database->hapus($no);

		//tambah flash data / pesan
		$this->session->set_flashdata('message','Data barang berhasil di hapus.'); 

		// kembali ke index
        redirect(base_url());
    }
}
