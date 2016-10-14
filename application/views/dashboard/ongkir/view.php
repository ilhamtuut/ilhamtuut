<div class="row">
	<div class="col-sm-12">
		<h3 class="label label-info">ID : <?php echo $ongkir->id_ongkir;?></h3>
		<h3><span class="glyphicon glyphicon-map-marker"></span> <?php echo $ongkir->kota;?></h3>
		<h3><span class="glyphicon glyphicon-credit-card"></span> <?php echo currency_format($ongkir->biaya);?></h3>
		<hr>
		<?php echo $link_back; ?>
	</div>
</div>

