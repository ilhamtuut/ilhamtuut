<?php if($this->cart->contents()) : ?>
<div class="">
	<div class="">
	<form action="<?php echo base_url(); ?>cart/update" method="post">
		<div class="table-responsive">
		<table class="table">
			<thead class="bg-primary">
				<tr>
					<th>QTY</th>
					<th>Nama Produk</th>
					<th class="text-center">Harga</th>
					<th class="text-center">Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php $rowid=0;$qty=0; ?>
				<?php foreach ($this->cart->contents() as $items) : ?>
				<tr>
					<td>
						<input type="hidden" name="<?php echo ++$rowid.'[rowid]';?>" value="<?php echo $items['rowid']; ?>"/>
						<input type="text" name="<?php echo ++$qty.'[qty]'; ?>" value="<?php echo $items['qty']; ?>" maxlength="3" size="3" class="form-control"/>
					</td>
					<td><?php echo $items['name']; ?></td>
					<td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
					<td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
				</tr>
				<?php endforeach; ?>
				<tr class="success">
					<td colspan="2" class="text-left"><strong>Total</strong></td>
					<td colspan="2" class="text-right">Rp <?php echo $this->cart->format_number($this->cart->total()); ?></td>
				</tr>
				<tr>
					<td><button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Update</button></td>
					<td></td>
					<td></td>
					<td><a class="btn btn-info" href="<?php echo base_url(); ?>cart">Masuk <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></td>
				</tr>
			</tbody>
		</table>
	</div>
	</form>
	</div>
</div>
<?php endif; ?>
<div class="panel panel-default panel-list">
	<div class="panel-heading panel-heading-dark">
		<h3 class="panel-title">Kategori</h3>
	</div>
	<!-- List group -->
	<ul class="list-group">
	<?php foreach(get_categories_h() as $category) : ?>
		<li class="list-group-item"><a href="<?php echo base_url(); ?>produks/category/<?php echo $category->id_kategori; ?>"><?php echo $category->nama; ?></a></li>
	<?php endforeach; ?>
	</ul>
</div>

<div class="panel panel-default panel-list">
	<div class="panel-heading panel-heading-dark">
		<h3 class="panel-title">Populer</h3>
	</div>
	<!-- List group -->
	<ul class="list-group">
		<?php foreach(get_popular_h() as $popular) : ?>
		<li class="list-group-item"><a href="<?php echo base_url(); ?>produks/details/<?php echo $popular->id_produk; ?>"><?php echo $popular->nama_produk; ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>

<div class="panel panel-default panel-list">
	<div class="panel-heading panel-heading-dark">
		<h3 class="panel-title">Informasi Kontak</h3>
	</div>
	<!-- List group -->
	<ul class="list-group">
	<li class="list-group-item">
		<h3 class="panel-title"><strong>UD Sari Alam</strong></h3>
		<span class="glyphicon glyphicon-home" aria-hidden="true"></span><strong> Alamat: </strong><br>Desa Raji, Kecamatan Demak, Kabupaten Demak,Jawa Tengah, Indonesia
		<br><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span><strong> No.Telp:</strong><br>081219517100</br>
	</li>
	</ul>