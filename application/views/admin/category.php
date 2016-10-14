<?php foreach($produk as $category) : ?>
	<div class="col-md-3 game">
		<div class="game-price">Rp<?php echo $category->harga; ?>/Kg</div>
		<a href="<?php echo base_url(); ?>admin/details/<?php echo $category->id_produk; ?>">
			<img src="<?php echo base_url(); ?>assets/images/produks/<?php echo $category->gambar; ?>"/>
		</a>
		<div class="game-title">
			<?php echo $category->nama_produk; ?>
		</div>
		<div class="game-add">
			<form method="post" action="<?php echo base_url(); ?>admin/tambah_produk">
				QTY: <input class="qty" type="text" name="qty" value="1" /><br>
				<button class="btn btn-primary" type="submit">Tambah</button>
				<a class="btn btn-danger" href="<?php echo base_url(); ?>admin/hapus_produk">Delete</a>
			</form>
		</div>
	</div>
<?php endforeach; ?>
