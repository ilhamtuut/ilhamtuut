<h1><?php echo $title;?></h1>
	<table class="table">
		<tr>
			<td>ID</td>
			<td><?php echo $produk->id_produk;?></td>
		</tr>
		<tr>
			<td>Gambar</td>
			<td><?php echo $produk->gambar;?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td><?php echo $produk->nama_produk;?></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td><?php echo $produk->harga;?></td>
		</tr>
		<tr>
			<td>Kategori</td>
			<td><?php echo ($produk->id_kategori)=='1'?'Kering':'Basah'; ?></td>
		</tr>
		<tr>
			<td>Deskripsi</td>
			<td><?php echo $produk->deskripsi;?></td>
		</tr>
	</table>
	<?php echo $link_back; ?>