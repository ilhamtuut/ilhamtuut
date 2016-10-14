<?php echo $message;?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<div class="panel panel-primary">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
	        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	          <span class="glyphicon glyphicon-user"></span> Data User
	        </a>
	      </h4>
	    </div>
	    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
	      <div class="panel-body">
	        <ul class="list-group">
			  <li class="list-group-item"><span class="badge"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span><?php echo $dbelanja->nama; ?></li>
			  <li class="list-group-item"><span class="badge"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></span><?php echo $dbelanja->alamat; ?></li>
			  <li class="list-group-item"><span class="badge"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span></span><?php echo $dbelanja->telp; ?></li>
			  <li class="list-group-item"><span class="badge"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span><?php echo $dbelanja->email; ?></li>
			</ul>
			<a class="btn btn-warning btn-xs" href="#modalEditUser<?php echo $dbelanja->id_user;?>" data-toggle="modal">
            <span class="glyphicon glyphicon-edit"></span> Edit Data
			</a>
			<a class="btn btn-warning btn-xs" href="#modalEditPassword<?php echo $dbelanja->id_user;?>" data-toggle="modal">
            <span class="glyphicon glyphicon-edit"></span> Edit Password
			</a>
	      </div>
	    </div>
	</div>
 	<div class="panel panel-info">
	    <div class="panel-heading" role="tab" id="headingTwo">
	      <h4 class="panel-title">
	        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	         <span class="glyphicon glyphicon-shopping-cart"></span>  Riwayat Belanja <span class="badge"><?php echo $banyak;?></span>
	        </a>
	      </h4>
	    </div>
	    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
	      <div class="panel-body">     
			<?php echo $pagination;?>
			<?php echo $table;?>
			<?php echo $pagination;?>
	      </div>
	    </div>
 	</div>
</div>

<!-- ============ MODAL EDIT Data User=============== -->

<div id="modalEditUser<?php echo $dbelanja->id_user;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Data User</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('users/update_user')?>">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <input class="form-control" type="hidden" value="<?php echo $dbelanja->id_user;?>" name="id_user" readonly>
                            <input type="hidden" name="id_admin" value="<?php echo (isset($dbelanja->id_user))?$dbelanja->id_user:''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Nama</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="nama" type="text" value="<?php echo $dbelanja->nama;?>" >
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label" >Alamat</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="alamat" type="text" value="<?php echo $dbelanja->alamat;?>" >
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label" >Telepon</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="telp" type="text" value="<?php echo $dbelanja->telp;?>" >
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label" >E-mail</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="email" type="text" value="<?php echo $dbelanja->email;?>" >
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

<!-- ============ MODAL EDIT Data Password=============== -->

<div id="modalEditPassword<?php echo $dbelanja->id_user;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Data Password</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('users/update_pass')?>">
                <div class="modal-body">
                    <div class="form-group">
                        
                        <div class="col-sm-4">
                            <input class="form-control" type="hidden" value="<?php echo $dbelanja->id_user;?>" name="id_user" readonly>
                            <input type="hidden" name="id_admin" value="<?php echo (isset($dbelanja->id_user))?$dbelanja->id_user:''; ?>"/>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label" >Username</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="username" type="text" value="<?php echo $dbelanja->username;?>" >
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label" >Password</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="password" type="password" placeholder="Masukkan Password Baru">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label" >Konfirmasi Password</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="password2" type="password" placeholder="Konfirmasi Password Anda">
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
