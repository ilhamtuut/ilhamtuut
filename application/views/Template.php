<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dashboard.css"/>
	<link href="<?php echo base_url();?>/assets/css/custom.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/tinymce/tinymce.min.js"></script>
	<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.png">
	<title><?php echo $judul;?></title>
	<script type="text/javascript" >
		$(document).ready(function()
		{
			$("#notificationLink").click(function()
			{
				$("#notificationContainer").fadeToggle(300);
				$("#notification_count").fadeOut("slow");
				return false;
			});

			//Document Click
			$(document).click(function()
			{
				$("#notificationContainer").hide();
			});
			//Popup Click
			$("#notificationContainer").click(function()
			{
				$.ajax({
				data: ID, 
				cache: false,
				});
				return false
			});

		});
		tinymce.init({
		selector:"textarea"
		});
	</script>
</head>
<body>
	<?php echo $_top_menu;?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <?php echo $_right_menu;?>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <?php echo $_header;?>
                <?php echo $_content;?>
				<?php echo $_footer;?>
				<a href="#" class="scrollToTop" title="Back To Top"><span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span></a>
            </div>
        </div>
    </div>
	<style>
	.green{color: green;
	}
	.red{color: red;
	}
	</style>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/js.js"></script>
</body>
</html>