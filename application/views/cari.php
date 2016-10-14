
<?php
	if(count($cari)>0)
		{
			foreach ($cari as $data) :?>
				<div class="col-md-3 game">
		<div class="game-price">Rp<?php echo $data->harga; ?>/Kg</div>
		<a href="<?php echo base_url(); ?>produks/details/<?php echo $data->id_produk; ?>">
			<img src="<?php echo base_url(); ?>assets/images/produks/<?php echo $data->gambar; ?>"/>
		</a>
		<div class="game-title">
			<?php echo $data->nama_produk; ?>
		</div>
		<div class="game-add">
			<form method="post" action="<?php echo base_url(); ?>cart/add">
				<div class="form-group">
				    
				    <div class="input-group">
				      <div class="input-group-addon">QTY</div>
				      	<input class="qty form-control" type="text" name="qty" value="1" />
						<input type="hidden" name="item_number" value="<?php echo $data->id_produk; ?>" />
						<input type="hidden" name="price" value="<?php echo $data->harga; ?>" />
						<input type="hidden" name="title" value="<?php echo $data->nama_produk; ?>" />
				    </div>
				  </div>
				
				<button class="btn btn-primary" type="submit">Tambah <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
			
			</form>
		</div>
	</div>
<?php
			endforeach;
		}
		else
		{
			echo "Data tidak ditemukan";
		}
		?>