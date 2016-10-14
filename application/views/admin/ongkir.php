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
            <a class="btn btn-info btn-xs" href="<?php echo site_url('ongkir/view/'.$ongkir->id_ongkir);?>"><span class="glyphicon glyphicon-eye-open"></span> view</a>
            <a class="btn btn-warning btn-xs" href="#modalEditOngkir<?php echo $ongkir->id_ongkir;?>" data-toggle="modal">
                <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
            <a class="btn btn-danger btn-xs" href="<?php echo site_url('ongkir/delete/'.$ongkir->id_ongkir);?>"onclick="return confirm('Anda yakin?')">
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
            <form class="form-horizontal" method="post" action="<?php echo site_url('ongkir/tambah')?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Id</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Id" name="" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kota</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Kota" name="kota">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Biaya</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                                <input type="text" class="form-control" placeholder="Biaya" name="biaya">
                            </div>
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
<?php if (isset($ongkirs)){foreach($ongkirs as $ongkir){?>
<div id="modalEditOngkir<?php echo $ongkir->id_ongkir;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Data ongkir</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('ongkir/Update')?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Id</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" value="<?php echo $ongkir->id_ongkir;?>" name="id_ongkir" readonly>
                            <input type="hidden" name="id_ongkir" value="<?php echo (isset($ongkir->id_ongkir))?$ongkir->id_ongkir:''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Kota</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="kota" type="text" value="<?php echo $ongkir->kota;?>" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Biaya</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                            <input class="form-control" name="biaya" type="text" value="<?php echo $ongkir->biaya;?>">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php }}?>