 <div class="mt-5" style="max-width: 700px; margin:auto;">
    <h1 style="margin-top:100px;">Form Tambah Data Barang</h1>
    <form action="<?php echo base_url(); ?>barang/proses_tambah" method="POST" enctype="multipart/form-data">    
		<div class="form-group">
            <label for="namaBarang">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" name="harga" placeholder="">
        </div>
        <div class="form-group">
            <label for="tgl_masuk">Tanggal Masuk</label>
            <input type="text" class="form-control" name="tgl_masuk" id="datepicker1" data-date-format="dd MM yyyy">
        </div>
        <div class="form-group">
            <label for="tgl_keluar">Tanggal Keluar</label>
            <input type="text" class="form-control" name="tgl_keluar" id="datepicker2" data-date-format="dd MM yyyy">
        </div>
        <div class="form-group">
            <label for="foto_barang">Foto Barang</label>
            <input type="file" class="form-control" name="foto_barang">
        </div> 

        <div style="display: flex; justify-content: space-between;">
            <a href="<?php echo base_url(); ?>" class="btn btn-danger">Back</a>
            <button type="submit" class="btn btn-success" name="tambah">Tambah Barang</button>
        </div>
    </form>
</div> 
