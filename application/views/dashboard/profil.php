<?php echo $message;?>
<form class="form-horizontal">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Nama</label>
    <div class="col-sm-3">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $admin->nama;?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-3">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $admin->alamat;?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">E-mail</label>
    <div class="col-sm-3">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $admin->email;?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Username</label>
    <div class="col-sm-3">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $admin->username;?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Password</label>
    <div class="col-sm-3">
      <input type="password" class="form-control" id="inputPassword3" value="<?php echo $admin->password;?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-3">
       <a class="btn btn-warning btn-xs" href="#modalEditProfil<?php echo $admin->id_admin;?>" data-toggle="modal">
            <span class="glyphicon glyphicon-edit"></span> Edit
        </a>
    </div>
  </div>
</form>

<!-- ============ MODAL EDIT BARANG =============== -->

<div id="modalEditProfil<?php echo $admin->id_admin;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Data Profile</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('dashboard/update_profile')?>">
                <div class="modal-body">
                    <div class="form-group">
                        
                        <div class="col-sm-4">
                            <input class="form-control" type="hidden" value="<?php echo $admin->id_admin;?>" name="id_admin" readonly>
                            <input type="hidden" name="id_admin" value="<?php echo (isset($admin->id_admin))?$admin->id_admin:''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Nama</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="nama" type="text" value="<?php echo $admin->nama;?>" >
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label" >Alamat</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="alamat" type="text" value="<?php echo $admin->alamat;?>" >
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label" >E-mail</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="email" type="text" value="<?php echo $admin->email;?>" >
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label" >Username</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="username" type="text" value="<?php echo $admin->username;?>" >
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label" >Password</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="password" type="password" value="<?php echo $admin->password;?>" >
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

  