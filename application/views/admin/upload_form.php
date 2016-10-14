<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>
<?php $attributes = array('class' => 'form-inline');?>
<?php echo form_open_multipart('admin/upload_success',$attributes);?>

<input type="file" class="form-control" name="userfile" size="20" />

<button type="submit" class="btn btn-success btn-lg" value="upload" title="upload">
	<span class="glyphicon glyphicon-upload" aria-hidden="true"></span>
</button>
</form>

</body>
</html>