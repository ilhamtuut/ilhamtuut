<?php echo $message;?>
<?php echo $pagination;?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kota</th>
            <th>Biaya</th>
            <th class="span2">
                <a href="#modalAddOngkir" class="btn btn-primary btn-lg btn-block" data-toggle="modal">
                    <span class="glyphicon glyphicon-plus-sign"></span> Tambah Data
                </a>
            </th>
        </tr>
    </thead>
    <tbody>

    <?php
    $no=1+$offset;
    if(isset($ongkirs)){
    foreach($ongkirs as $ongkir){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $ongkir->kota; ?></td>
        <td><?php echo currency_format($ongkir->biaya);?></td>
        <td class="text-center">
            <a class="btn btn-info btn-xs" href=""><span class="glyphicon glyphicon-eye-open"></span> view</a>
            <a class="btn btn-warning btn-xs" href="#modalEditBarang<?php echo $ongkir->id_ongkir;?>" data-toggle="modal">
                <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
            <a class="btn btn-danger btn-xs" href="<?php echo site_url('dashboard/delete_ongkir/'.$ongkir->id_ongkir);?>"onclick="return confirm('Anda yakin?')">
                <span class="glyphicon glyphicon-remove"></span> Hapus
            </a>
        </td>
    </tr>

    <?php }
    }
    ?>

    </tbody>
</table>
<?php echo $pagination;?>

<!-- ============ MODAL ADD BARANG =============== -->
<div id="modalAddOngkir" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Ongkir</h4>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('dashboard/tambah_ongkir')?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Id</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kota</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Kota">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Biaya</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Biaya">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form> 
        </div>
    </div>
</div>
<!-- ============ MODAL EDIT BARANG =============== -->
<?php
if (isset($data_barang)){
    foreach($data_barang as $row){
        ?>
        <div id="modalEditBarang<?php echo $row->kd_barang?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Data Barang</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('master/edit_barang')?>">
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label">Kode Barang</label>
                        <div class="controls">
                            <input name="kd_barang" type="text" value="<?php echo $row->kd_barang;?>" readonly>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Nama Barang</label>
                        <div class="controls">
                            <input name="nm_barang" type="text" value="<?php echo $row->nm_barang;?>" >
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Stok</label>
                        <div class="controls">
                            <input name="stok" type="text" value="<?php echo $row->stok;?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Harga</label>
                        <div class="controls">
                            <input name="harga" type="text" value="<?php echo $row->harga;?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    <?php }
}
?>