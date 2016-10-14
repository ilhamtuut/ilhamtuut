<?php foreach($pesanan_masuk as $pesanan_masuk){?>			
	<ul class="nav navbar-sidebar">
	<li>
	<a href="<?php echo base_url();?>dashboard/pesan_masuk/<?php echo $pesanan_masuk->id_transaksi;?>" id="a">
	<span class="glyphicon glyphicon-shopping-cart"></span> 
	Akun <?php echo $pesanan_masuk->nama;?> Telah Memesan Produk <br> 
	<span class="glyphicon glyphicon-time"></span> <?php echo $pesanan_masuk->tgl_pesan;?></a>
	</a>
	</li>
	</ul>
<?php } ?>