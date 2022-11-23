<?php if($this->session->flashdata('message')): ?>
	<p class="alert alert-success" role="alert" id="message" style="text-align: center;margin-top: 25px;"><?php echo $this->session->flashdata('message'); ?></p>
<?php endif; ?>

<h1>Data Barang</h1>
<a href="<?php echo base_url(); ?>barang/tambah" class="btn btn-success" style="display: inline-block;margin-bottom:15px;">Tambah Barang</a>

<div class="mt-4">
	<table class="table table-striped table-bordered" id="dataTables">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Nama Barang</th>
				<th scope="col">Harga</th>
				<th scope="col">Tanggal Masuk</th>
				<th scope="col">Tanggal Keluar</th>
				<th scope="col">Foto Barang</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($barang as $no => $b): ?>
				<tr>
					<th><?php echo $no + 1 ?></th>
					<td><?php echo $b['nama_barang'] ?></td>
					<td>Rp. <?php echo $b['harga'] ?></td>
					<td><?php echo $b['tgl_masuk'] ?></td>
					<td><?php echo $b['tgl_keluar'] ?></td>
					<td>
						<img src="<?php echo base_url(); ?>/uploads/<?php echo $b['foto_barang'] ?>" width="150" height="150">
					</td>
					<td>
						<a href="<?= base_url('barang/ubah/'); ?><?= $b['no']; ?>" class="btn btn-primary"">Edit</a>
						<a href="<?= base_url('barang/hapus/'); ?><?= $b['no']; ?>" class="btn btn-danger" onclick="return confirm('Apakah kamu ingin menghapus data ini?');">Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div> 


