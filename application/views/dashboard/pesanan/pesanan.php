<?php echo $message;?>
<?php echo $pagination;?>
<?php echo $table;?>
<?php echo $pagination;?>

<!-- ============ MODAL EDIT BARANG =============== -->
<?php if (isset($pesanans)){foreach($pesanans as $asua){?>
<div id="modalEditStatus<?php echo $asua->id_transaksi;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Status</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('pesanan/Update')?>">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <input type="hidden" name="id_transaksi" value="<?php echo (isset($asua->id_transaksi))?$asua->id_transaksi:''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Status</label>
                        <div class="col-sm-6">
							<select name="status" class="form-control" id="status">
								<option value="Tunggu">Tunggu</option>
								<option value="OK">OK</option>
							</select>
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