<?php foreach($produk as $category) : ?>
	<div class="col-md-3 game">
		<div class="game-price">Rp<?php echo $category->harga; ?>/Kg</div>
		<a href="<?php echo base_url(); ?>produks/details/<?php echo $category->id_produk; ?>">
			<img src="<?php echo base_url(); ?>assets/images/produks/<?php echo $category->gambar; ?>"/>
		</a>
		<div class="game-title">
			<?php echo $category->nama_produk; ?>
		</div>
		<div class="game-add">
			<form class="" method="post" action="<?php echo base_url(); ?>cart/add">
				<div class="form-group">
			    <div class="input-group">
				    <div class="input-group-addon">QTY</div>
					<input class="form-control qty" type="text" name="qty" value="1" />
					<input type="hidden" name="item_number" value="<?php echo $category->id_produk; ?>" />
					<input type="hidden" name="price" value="<?php echo $category->harga; ?>" />
					<input type="hidden" name="title" value="<?php echo $category->nama_produk; ?>" />
				</div>
			  	</div>
				<button class="btn btn-primary" type="submit">Tambah <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
			</form>
		</div>
	</div>
<?php endforeach; ?>
