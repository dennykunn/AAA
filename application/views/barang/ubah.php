 <div style="max-width: 700px; margin:auto;">
    <h1 style="margin-top:20px;">Form Ubah Data Barang</h1>
	<?php echo form_open_multipart('barang/proses_ubah'); ?>
    <form action="<?php echo base_url('barang/proses_ubah'); ?>" method="POST" enctype="multipart/form-data">
		<input type="hidden" class="form-control" name="no" value="<?php echo $barang['no']; ?>">
		<input type="hidden" class="form-control" name="foto_barang_lama" value="<?php echo $barang['foto_barang']; ?>">

		<div class="form-group">
            <label for="namaBarang">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" value="<?php echo $barang['nama_barang']; ?>">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" name="harga"  value="<?php echo $barang['harga']; ?>">
        </div>
        <div class="form-group">
            <label for="tgl_masuk">Tanggal Masuk</label>
            <input type="text" id="datepicker1" data-date-format="dd MM yyyy" class="form-control" name="tgl_masuk"  value="<?= $barang['tgl_masuk']; ?>">
        </div>
        <div class="form-group">
            <label for="tgl_keluar">Tanggal Keluar</label>
            <input type="text" id="datepicker2" data-date-format="dd MM yyyy" class="form-control" name="tgl_keluar"  value="<?php echo $barang['tgl_keluar']; ?>">
        </div>
        <div class="form-group">
            <label for="foto_barang">Foto Barang</label>
			<input type="file" class="form-control" name="foto_barang"  value="<?php echo $barang['foto_barang']; ?>">
        	<div style="display: flex; justify-content: end;">
				<img src="<?php echo base_url(); ?>/uploads/<?php echo $barang['foto_barang'] ?>" width="150" height="150" style="margin-left: auto;">
			</div>
		</div>  
        <div style="display: flex; justify-content: space-between;">
            <a href="<?php echo base_url(); ?>" class="btn btn-danger">Back</a>
            <button type="submit" class="btn btn-primary" name="tambah">Ubah Barang</button>
        </div>
    </form>
</div> 
