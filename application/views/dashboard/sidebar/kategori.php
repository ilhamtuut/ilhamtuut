<?php echo $message;?>
<?php echo $pagination;?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kota</th>
            <th class="span2">
                <a href="#modalAddBarang" class="btn btn-primary btn-lg btn-block" data-toggle="modal">
                    <span class="glyphicon glyphicon-plus-sign"></span> Tambah Data
                </a>
            </th>
        </tr>
    </thead>
    <tbody>

    <?php
    $no=1+$offset;
    if(isset($kategoris)){
    foreach($kategoris as $kategori){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $kategori->nama;?></td>
        <td class="text-center">
            <a class="btn btn-info btn-xs" href=""><span class="glyphicon glyphicon-eye-open"></span> view</a>
            <a class="btn btn-warning btn-xs" href="#modalEditBarang<?php echo $kategori->id_kategori;?>" data-toggle="modal">
                <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
            <a class="btn btn-danger btn-xs" href="<?php echo site_url('dashboard/delete_kategori/'.$kategori->id_kategori);?>"onclick="return confirm('Anda yakin?')">
                <span class="glyphicon glyphicon-remove"></span> Hapus
            </a>
        </td>
    </tr>

    <?php }
    }
    ?>

    </tbody>
</table>