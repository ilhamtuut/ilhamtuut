<?php echo $message;?>
<?php echo $pagination;?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
			<th>Pesan</th>
			<th>Tanggal</th>
            <th class="span2">
                Aksi
            </th>
        </tr>
    </thead>
    <tbody>

    <?php
    $no=1+$offset;
    if(isset($pesans)){
    foreach($pesans as $pesan){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $pesan->nama; ?></td>
        <td><?php echo $pesan->email;?></td>
		<td><?php echo $pesan->pesan;?></td>
		<td><?php echo $pesan->tgl;?></td>
        <td class="text-center">
            <a class="btn btn-danger btn-xs" href="<?php echo site_url('konten/delete/'.$pesan->id);?>"onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini???')">
                <span class="glyphicon glyphicon-remove"></span> Hapus
            </a>
        </td>
    </tr>

    <?php }
    }
    ?>

    </tbody>
</table>