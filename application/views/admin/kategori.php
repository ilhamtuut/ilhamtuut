<?php //echo $tabel; ?>
<table class="table table-striped">
	<thead>
		<th>Id</th>
		<th>Nama</th>
		<th>Action</th>
	</thead>
	<tbody>
	<?php foreach ($kategori as $kategoris) :?>
		<tr>
			<td><?php echo $kategoris->id_kategori; ?></td>
			<td><?php echo $kategoris->nama; ?></td>
			<td>
				<a href="">Edit</a> |
				<a href="">Tambah</a> |
				<a href="">Hapus</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
