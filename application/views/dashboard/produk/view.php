<div class="row">
	<div class="col-xs-6 col-md-3">
		<img class="img-thumbnail" src="<?php echo base_url('assets/images/produks');echo '/'.$produk->gambar ; ?>" />
	</div>
	<div class="col-xs-12 col-sm-6 col-md-9">
		<span class="label label-info">ID : <?php echo $produk->id_produk;?></span>
		<h3><?php echo $produk->nama_produk;?></h3>
		<p><?php echo $produk->deskripsi;?></p>
		<span class="glyphicon glyphicon-credit-card"></span> <?php echo currency_format($produk->harga);?>
		<span class="glyphicon glyphicon-picture"></span> <?php echo $produk->gambar;?>
		<span class="glyphicon glyphicon-tag"></span> <?php echo ($produk->id_kategori)=='1'?'Kering':'Basah'; ?>
		<hr>
		<?php echo $link_back; ?>
	</div>
</div>

