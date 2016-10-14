<?php echo $message;?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  	 <div class="item active">
      <img src="<?php echo base_url().'assets/images/produks/'.$images['1'];?>" alt="..." style="height:300px;margin: 0 auto;">
      <div class="carousel-caption">
 		<?php echo $images['1'];?>
      </div>
    </div>
  	<?php foreach ($images as $image):?>
    <div class="item ">
      <img src="<?php echo base_url().'assets/images/produks/'.$image;?>" alt="..." style="height:300px;margin: 0 auto;">
      <div class="carousel-caption">
 		<?php echo $image;?>
      </div>
    </div>
    <?php endforeach;?>
   
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="row">
	<?php
	$atts=array(
			'width'=>'800',
			'height'=>'600',
			'status'=>'yes',
			'resizble'=>'yes',
			'scrollbar'=>'yes',
			'screenx'=>'0',
			'screeny'=>'0'
		);
	foreach ($images as $image):
	?>
	<div class="col-xs-6 col-md-3">
		<div class="thumbnail">
			<a href="<?php echo base_url().'assets/images/produks/'.$image; ?>">
			<?php echo anchor_popup(base_url().'assets/images/produks/'.$image,'<img src="'.base_url().'assets/images/produks/'.$image.'" alt=""/>',$atts);?>
			</a>
      <a class="pull-right" title="delete" href="<?php echo base_url().'admin/del/'.$image; ?>"><span class="glyphicon glyphicon-remove"></span></a>
		</div>
	</div>
	<?php endforeach;?>
</div>
