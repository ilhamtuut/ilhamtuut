<div class="row-details">
	<div class="col-md-4">
		<img src="<?php echo base_url(); ?>assets/images/produks/<?php echo $produk->gambar; ?>"/>
	</div>
	<div class="col-md-8">
		<h3><?php echo $produk->nama_produk; ?></h3>
		<div class="detail-price">
			Rp <?php echo $produk->harga; ?>/Kg
		</div>
		<div class="details-description">
			<?php echo $produk->deskripsi; ?>
		</div>
		<div class="details-buy">
			<form method="post" action="<?php echo base_url(); ?>admin/tambah_produk">
				QTY: <input class="qty" type="text" name="qty" value="1" /><br>
				<button class="btn btn-primary" type="submit">Tambah</button>
				<a class="btn btn-danger" href="<?php echo base_url(); ?>admin/hapus_produk">Delete</a>
			</form>
		</div>
	</div>
</div>