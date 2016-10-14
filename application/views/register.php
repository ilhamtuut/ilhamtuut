<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
<form method="post" action="<?php echo base_url(); ?>users/register">
	<div class="form-group">
		<label>Nama Lengkap</label>
		<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Anda">
	</div>
	<div class="form-group">
		<label>No. Telp</label>
		<input type="text" class="form-control" name="notelp" placeholder="Masukkan No Telp Anda">
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat Anda">
	</div>
	<div class="form-group">
			<label>Kota</label>
			<select name="kota" class="form-control" id="kota">
			<?php
				if (count($album)) {
				foreach ($album as $list) {
					echo "<option value='". $list['kota'] . "'>" . $list['kota'] . "</option>";
				}		
			}	
			?>
			</select>
	</div>
	<div class="form-group">
		<label>Email</label> <em>*Diisi (-) jika tidak memiliki email</em>
		<input type="text" class="form-control" name="email" placeholder="Masukkan Email Anda">
	</div>
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username" placeholder="Buat Username Anda">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password" placeholder="Masukkan Password">
	</div>
	<div class="form-group">
		<label>Konfirmasi Password</label>
		<input type="password" class="form-control" name="password2" placeholder="Konfirmasi Password Anda">
	</div>			
	<button name="submit" type="submit" class="btn btn-primary">Daftar</button>
</form>