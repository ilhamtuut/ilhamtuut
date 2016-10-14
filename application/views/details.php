<div class="row-details">
	<div class="col-md-4">
		<img class="img-thumbnail" src="<?php echo base_url(); ?>assets/images/produks/<?php echo $produk->gambar; ?>"/>
	</div>
	<div class="col-md-8">
		<h3>
			<?php echo $produk->nama_produk; ?>
		</h3>
		<div class="detail-price">
			<p class="text-info">
			Rp <?php echo $produk->harga; ?>/Kg
			</p>
		</div>
		<div class="details-description">
			<p>
			<?php echo $produk->deskripsi; ?>
			</p>
		</div>
		<div class="details-buy">
			<form class="form-inline" method="post" action="<?php echo base_url(); ?>cart/add">
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">QTY</div>
			      <input type="text" class="form-control qty" type="text" name="qty" value="1">
			      <input type="hidden" name="item_number" value="<?php echo $produk->id_produk; ?>" />
				  <input type="hidden" name="price" value="<?php echo $produk->harga; ?>" />
				  <input type="hidden" name="title" value="<?php echo $produk->nama_produk; ?>" />
			    </div>
			  </div>
			  <button class="btn btn-primary" type="submit">Tambah <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
			</form>
		</div>
	</div>
</div>