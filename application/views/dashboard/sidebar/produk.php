<?php echo $message;?>
<?php echo $pagination;?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th class="span2">
                <a href="#modalAddProduk" class="btn btn-primary btn-lg btn-block" data-toggle="modal">
                    <span class="glyphicon glyphicon-plus-sign"></span> Tambah Data
                </a>
            </th>
        </tr>
    </thead>
    <tbody>

    <?php
    $no=1+$offset;
    if(isset($produks)){
    foreach($produks as $produk){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $produk->nama_produk; ?></td>
        <td><?php echo  word_limiter($produk->deskripsi,2); ?></td>
        <td><?php echo $produk->gambar; ?></td>
        <td><?php echo currency_format($produk->harga);?></td>
        <td><?php echo strtoupper($produk->id_kategori)=='1'?'Kering':'Basah'?></td>
        <td class="text-center">
            <a class="btn btn-info btn-xs" href="<?php echo site_url('dashboard/view_produk/'.$produk->id_produk);?>"><span class="glyphicon glyphicon-eye-open"></span> view</a>
            <a class="btn btn-warning btn-xs" href="#modalEditProduk<?php echo $produk->id_produk;?>" data-toggle="modal">
                <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
            <a class="btn btn-danger btn-xs" href="<?php echo site_url('dashboard/delete_produk/'.$produk->id_produk);?>"onclick="return confirm('Anda yakin?')">
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

<!-- ============ MODAL ADD PRODUK =============== -->
<div id="modalAddProduk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah produk</h4>
        </div>
        <form class="form-horizontal" method="post" action="<?php echo site_url('dashboard/tambah_produk')?>" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Id</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Id" disabled="disable" name="id_produk">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Nama" name="nama_produk">
                </div>
                <label class="col-sm-1 control-label">Harga</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <div class="input-group-addon">Rp</div>
                        <input class="form-control" type="text" name="harga"  placeholder="Harga" value="" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Kategoi</label>
                <div class="col-sm-6">
                    <select class="form-control" name="id_kategori" value="<?php echo set_value('id_kategori')?set_value('id_kategori'):$produk->id_kategori; ?>">
                        <option value="2">Basah</option>
                        <option value="1">Kering</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Deskripsi</label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="3" name="deskripsi"  placeholder="Deskripsi" value=""></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Gambar</label>
                <div class="col-sm-9">
                    <input class="form-control" type="file" name="userfile"  value="" />
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
<!-- ============ MODAL EDIT PRODUK =============== -->
<?php if (isset($produks)){foreach($produks as $produk){?>
<div id="modalEditProduk<?php echo $produk->id_produk?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 id="myModalLabel"><span class="glyphicon glyphicon-edit"></span> Data Produk</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('dashboard/update_produk')?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Id</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Id" disabled="disable" name="id_produk" value="<?php echo $produk->id_produk;?>"/>
                            <input type="hidden" name="id_produk" value="<?php echo (isset($produk->id_produk))?$produk->id_produk:''; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Nama" name="nama_produk" value="<?php echo $produk->nama_produk;?>"/>
                        </div>
                        <label class="col-sm-1 control-label">Harga</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                                    <input class="form-control" type="text" name="harga"  placeholder="Harga" value="<?php echo $produk->harga;?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kategoi</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="id_kategori" value="<?php echo set_value('id_kategori')?set_value('id_kategori'):$produk->id_kategori; ?>">
                                <option value="2">Basah</option>
                                <option value="1">Kering</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="3" name="deskripsi"  placeholder="Deskripsi"><?php echo $produk->deskripsi;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Gambar</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="file" name="userfile"  value="<?php echo $produk->gambar;?>" />
                            <input class="form-control" type="hidden" name="gambar"  value="<?php echo $produk->gambar;?>" />
                        </div>
                        <div class="col-sm-4">
                            <img class="img-thumbnail" src="<?php echo base_url('assets/images/produks');echo '/'.$produk->gambar; ?>"/>
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
<?php } } ?>