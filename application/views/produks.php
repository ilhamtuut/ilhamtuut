<?php echo $message;?>
<?php if($this->session->flashdata('registered')) : ?>
	<div class="alert alert-success">
		<?php echo $this->session->flashdata('registered'); ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?php endif; ?>

<?php if($this->session->flashdata('pass_login')) : ?>
	<div class="alert alert-success">
		<?php echo $this->session->flashdata('pass_login'); ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?php endif; ?>

<?php if($this->session->flashdata('fail_login')) : ?>
	<div class="alert alert-danger">
		<?php echo $this->session->flashdata('fail_login'); ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?php endif; ?>

<?php foreach($produks as $produk) : ?>
	<div class="col-md-3 game">
		<div class="game-price">Rp<?php echo $produk->harga; ?>/Kg</div>
		<a href="<?php echo base_url(); ?>produks/details/<?php echo $produk->id_produk; ?>">
			<img height=200 src="<?php echo base_url(); ?>assets/images/produks/<?php echo $produk->gambar; ?>"/>
		</a>
		<div class="game-title">
			<?php echo $produk->nama_produk; ?>
		</div>
		<div class="game-add">
			<form method="post" action="<?php echo base_url(); ?>cart/add">
				<div class="form-group">
				    
				    <div class="input-group">
				      <div class="input-group-addon">QTY</div>
				      	<input class="qty form-control" type="text" name="qty" value="1" />
						<input type="hidden" name="item_number" value="<?php echo $produk->id_produk; ?>" />
						<input type="hidden" name="price" value="<?php echo $produk->harga; ?>" />
						<input type="hidden" name="title" value="<?php echo $produk->nama_produk; ?>" />
				    </div>
				  </div>
				
				<button class="btn btn-primary" type="submit">Tambah <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
			
			</form>
		</div>
	</div>
<?php endforeach; ?>