<?php echo $message;?>
<?php foreach($cara as $cara){?>
<?php echo $cara->cara_pesan;?>
 <a class="btn btn-warning btn-xs" href="#modalEdit<?php echo $cara->id;?>" data-toggle="modal">
    <span class="glyphicon glyphicon-edit"></span> Edit</a>		

<!-- ============ MODAL EDIT =============== -->
<div id="modalEdit<?php echo $cara->id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Cara Pemesanan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('konten/update_pesan')?>">
                <div class="modal-body2">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <input class="form-control" type="hidden" value="<?php echo $cara->id;?>" name="id" readonly>
                            <input type="hidden" name="id" value="<?php echo (isset($cara->id))?$cara->id:''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
							<textarea name="cara_pesan"><?php echo $cara->cara_pesan;?> </textarea>
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
<?php } ?>