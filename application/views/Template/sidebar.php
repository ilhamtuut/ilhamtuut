<div class="nav nav-sidebar panel-primary">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
	        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
	          Konten <span class="glyphicon glyphicon-th pull-right"></span>
	        </a>
	      </h4>
	    </div>
	    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
	    <div class="panel-body">
			<ul class="nav nav-sidebar">		  
				<li>
				<a href="<?php echo base_url('konten/pemesanan');?>">Pemesanan</a>
				</li>
				<li>
				<a href="<?php echo base_url('konten/pembayaran');?>">Pembayaran</a>
				</li>
				<li>
				<a href="<?php echo base_url('konten/pesan');?>">Pesan</a>
				</li>
			</ul>
	    </div> 
	    </div>
</div>
<ul class="nav nav-sidebar">
  <li class="active">
    <a href="<?php echo base_url('produk');?>">
      <span class="glyphicon glyphicon-barcode  pull-right"></span>Produk <span class="sr-only">(current)</span>
    </a>
  </li>
</ul>
<ul class="nav nav-sidebar">
  <li class="active">
    <a href="<?php echo base_url('ongkir');?>">
    <span class="glyphicon glyphicon-usd pull-right"></span>Ongkos Kirim
    </a>
  </li>
</ul>
<ul class="nav nav-sidebar">
  <li class="active">
    <a href="<?php echo base_url('kategori');?>">
      <span class="glyphicon glyphicon-tag pull-right"></span>Kategori
    </a>
  </li>
</ul>

<div class="nav nav-sidebar panel-primary">
	    <div class="panel-heading" role="tab" id="headingTwo">
	      <h4 class="panel-title">
	        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	          Pesanan <span class="glyphicon glyphicon-shopping-cart pull-right"></span>
	        </a>
	      </h4>
	    </div>
	    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
	      <div class="panel-body">
			<ul class="nav nav-sidebar">		  
				<li>
				<a href="<?php echo base_url('pesanan');?>">Pesanan Masuk 
				<span class="btn-danger badge"><?php echo $banyak;?></span>
				</a>
				</li>
				<li>
				<a href="<?php echo base_url('pesanan/pesanan_selesai');?>">Pesanan Selesai
				<span class="btn-success badge"><?php echo $banyaks;?></span>
				</a>
				</li>
			</ul>
	      </div>
	    </div>
 </div>