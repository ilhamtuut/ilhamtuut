
<!DOCTYPE html> 
<html>

<head>
  <title>Administrator UD Sari Alam</title>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/signin.css" rel="stylesheet">
	<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
<body>
  <div id="main">
	<div id="site_content">		
	  <div id="content">
        <div class="content_item">
			<div class="container">
			<?php if($this->session->flashdata('registered')) : ?>
				<div class="alert alert-success">
					<?php echo $this->session->flashdata('registered'); ?>
				</div>
			<?php endif; ?>
			<?php if($this->session->flashdata('pass_login')) : ?>
				<div class="alert alert-success">
					<?php echo $this->session->flashdata('pass_login'); ?>
				</div>
			<?php endif; ?>
			<?php if($this->session->flashdata('fail_login')) : ?>
				<div class="alert alert-danger">
					<?php echo $this->session->flashdata('fail_login'); ?>
				</div>
			<?php endif; ?>
			  <form action="<?php echo base_url(); ?>admin/aksilogin" method="post" class="form-signin" role="form">
				<h2 class="form-signin-heading"><center>Administrator<br>UD Sari Alam</center></h2>
				<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
				<input type="password" name="password" class="form-control" placeholder="Password" required>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
			  </form>
			</div> <!-- /container -->
		</div><!--close content_item-->
      </div><!--close content-->   
	</div><!--close site_content-->  	
  </div><!--close main-->
  
</body>
</html>