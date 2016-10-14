<?php echo $message;?>
<?php if($this->cart->contents()) : ?>
	<form method="post" action="<?php echo base_url(); ?>cart/process">	
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nama Item</th>
					<th>Jumlah</th>
					<th style="text-align:right">Harga</th>
					<th style="text-align:right">Subtotal</th>
				</tr>
			</thead>
			<?php $i = 0; ?>
			<tbody>
			<?php foreach ($this->cart->contents() as $items): ?>
			<tr>
				<td><?php echo $items['name']; ?></td>
				<td><?php echo $items['qty']; ?></td>
				<td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
				<td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
			</tr>
				<?php echo '<input type="hidden" name="item_name['.$i.']" value="'.$items['name'].'" />';?>
				<?php echo '<input type="hidden" name="item_code['.$i.']" value="'.$items['id'].'" />';?>
				<?php echo '<input type="hidden" name="item_qty['.$i.']" value="'.$items['qty'].'" />';?>
			<?php $i++; ?>
			<?php endforeach; ?>
			<tr>
				<td colspan="3" class="info right"><strong>Total</strong></td>
				<td class="info" class="right" style="text-align:right"><strong><?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
			</tr>
			</tbody>
		</table>
		<hr>
		<p><em>NB: Total diatas belum termasuk ongkos kirim</br>Anda harus login untuk melakukan pembelian</em></p>
		<?php if(!$this->session->userdata('logged_in')) : ?>
			<p><a href="<?php echo base_url(); ?>users/register" class="btn btn-primary">Buat Akun</a></p>
			
		<?php else : ?>
		<h3>Informasi Pengiriman</h3>
		<div class="form-group">
			<label>Alamat Kirim</label>
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
		<p><button class="btn btn-primary" type="submit" name="submit">Checkout</button></p>
		<?php endif; ?>
	</form>
<?php else : ?>
	<p class="alert alert-info"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Tidak ada barang di keranjang belanja</p>
<?php endif; ?>