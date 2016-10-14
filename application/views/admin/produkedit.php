<h3 class="text-center"><?php echo $title;?></h3>
<hr>
		<?php echo $message;?>
		<?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
		<?php echo form_open_multipart($action,$attributes);?>

				<div class="form-group">
					<label class="col-sm-2 control-label">ID Produk</label>
					<div class="col-sm-2">
						<input class="form-control" type="text" name="id_produk" disabled="disable"  value="<?php echo (isset($produk['id_produk']))?$produk['id_produk']:'';?>"/>
					</div>
					<input type="hidden" name="id_produk" value="<?php echo (isset($produk['id_produk']))?$produk['id_produk']:''; ?>"/>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="nama_produk"  value="<?php echo set_value('nama_produk')?set_value('nama_produk'):$produk['nama_produk']; ?>" />
						<?php echo form_error('nama_produk','<p class="text-danger">','</p>'); ?>
					</div>
				
					<label class="col-sm-1 control-label">Harga</label>
					<div class="col-sm-4">
						<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input class="form-control" type="text" name="harga"  value="<?php echo set_value('harga')?set_value('harga'):$produk['harga'] ;?>" />
					</div>
					<?php echo form_error('harga','<p class="text-danger">','</p>'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Kategori</label>
					<div class="col-sm-9">
					<select class="form-control" name="id_kategori" value="<?php echo set_value('id_kategori')?set_value('id_kategori'):$produk['id_kategori']; ?>">
						<option value="<?php echo set_value('id_kategori')?set_value('id_kategori'):$produk['id_kategori']; ?>"><?php echo set_value('id_kategori')==1?'Kering':'';echo set_value('id_kategori')==2?'Basah':''; ?></option>
	          			<option value="2">Basah</option>
	          			<option value="1">Kering</option>
        			</select>
        			<?php echo form_error('id_kategori','<p class="text-danger">','</p>'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Deskripsi</label>
					<div class="col-sm-9">
						<textarea class="form-control" rows="3" name="deskripsi"  value=""><?php echo set_value('deskripsi')?set_value('deskripsi'):$produk['deskripsi'];?></textarea>
						<?php echo form_error('deskripsi','<p class="text-danger">','</p>'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Gamar</label>
					<div class="col-sm-4">
						<input class="form-control" type="file" name="userfile"  value="<?php echo set_value('gambar')?set_value('gambar'):$produk['gambar'] ;?>" />
						<?php if($this->uri->segment(2)==='update'){?>
						<img class="img-thumbnail" src="<?php echo base_url('assets/images/produks');echo '/'.$produk['gambar'] ; ?>"/>
						<?php } ;?>
						<?php echo form_error('gambar','<p class="text-danger">','</p>'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-8 col-sm-3">
						<input class="btn btn-primary btn-lg btn-block" type="submit" value="Save"/>
					</div>
				</div>
	</form>
	<br/>
	<?php echo $link_back;?>