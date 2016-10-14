<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
<?php echo $message;?>
<form method="post" action="<?php echo base_url(); ?>users/tambah">
	<div class="form-group">
		<label>Nama*</label>
		<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Anda">
	</div>
	<div class="form-group">
		<label>Email*</label>
		<input type="text" class="form-control" name="email" placeholder="Masukkan Email Anda">
	</div>
	<div class="form-group">
		<label>Pesan*</label> 
		<textarea class="form-control" name="pesan" placeholder="Masukkan Pesan Anda"></textarea>
	</div>
	<button name="submit" type="submit" class="btn btn-primary">Kirim Pesan</button>
</form>