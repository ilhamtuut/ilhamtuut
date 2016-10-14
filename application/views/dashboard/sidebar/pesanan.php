<?php echo $message;?>
<?php echo $pagination;?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
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
        <td>   </td>
    </tr>

    <?php }
    }
    ?>

    </tbody>
</table>