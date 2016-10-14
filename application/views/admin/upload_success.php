<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>
<hr>


<div class="panel panel-default">
	<div class="panel-heading"><h4><?php echo $upload_data['file_name'];?></h3></div>
	<div class="panel-body">
		<img class="img-thumbnail" src="<?php echo base_url(); ?>/assets/images/produks/<?php echo $upload_data['file_name'];?>"/>
		<ul>
			<?php foreach ($upload_data as $item => $value):?>
			<li><?php echo $item;?> : <?php echo $value;?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<p><?php echo anchor('admin/upload', 'Upload Another File!'); ?></p>

</body>
</html>