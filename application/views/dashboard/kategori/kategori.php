<?php echo $message;?>
<?php echo $pagination;?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kota</th>
            <th class="span2">
                <a href="#modalAddKategori" class="btn btn-primary btn-lg btn-block" data-toggle="modal">
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
            <a class="btn btn-info btn-xs" href="<?php echo site_url('kategori/view/'.$kategori->id_kategori);?>"><span class="glyphicon glyphicon-eye-open"></span> view</a>
            <a class="btn btn-warning btn-xs" href="#modalEditKategori<?php echo $kategori->id_kategori;?>" data-toggle="modal">
                <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
            <a class="btn btn-danger btn-xs" href="<?php echo site_url('kategori/delete/'.$kategori->id_kategori);?>"onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini???')">
                <span class="glyphicon glyphicon-remove"></span> Hapus
            </a>
        </td>
    </tr>

    <?php }
    }
    ?>

    </tbody>
</table>

<!-- ============ MODAL ADD BARANG =============== -->
<div id="modalAddKategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Kategori</h4>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('kategori/tambah')?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Id</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Id" name="" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kategori</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Kategori" name="nama">
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
<?php if (isset($kategoris)){foreach($kategoris as $kategori){?>
<div id="modalEditKategori<?php echo $kategori->id_kategori;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Data Kategori</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('kategori/Update')?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Id</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" value="<?php echo $kategori->id_kategori;?>" name="id_kategori" readonly>
                            <input type="hidden" name="id_kategori" value="<?php echo (isset($kategori->id_kategori))?$kategori->id_kategori:''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Nama</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="nama" type="text" value="<?php echo $kategori->nama;?>" >
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