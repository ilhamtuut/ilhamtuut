
	<table class="table table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Kota</th>
			<th>Nama Kota</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=0; foreach($ongkir as $ongkir) :?>
		<tr>
			<td><?php $no++; echo $no; ?></td>
			<td><?php echo $ongkir->kota; ?></td>
			<td>Rp <?php echo $ongkir->biaya; ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	</table>
<p>NB : <em>Untuk wilayah Demak dan Semarang Gratis Ongkos Kirim</em></p>