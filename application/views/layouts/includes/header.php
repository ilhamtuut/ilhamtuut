<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>UD SARI ALAM</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
	<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.png">
	  <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/js.js"></script>
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url(); ?>users/login" class="form-horizontal modal-body">
              <div class="form-group">
              <label>Username</label>
              <input name="username" type="text" class="form-control" placeholder="Enter Username">
              </div>
              <div class="form-group">
              <label>Password</label>
              <input name="password" type="password" class="form-control" placeholder="Enter Password">
              </div>
      </div>
      <div class="modal-footer">
        <button name="submit" type="submit" class="btn btn-default">Login</button>
		<a class="btn btn-primary" href="<?php echo base_url(); ?>users/register">
          Buat Akun <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        </a>
      </div>
      </form>
    </div>
  </div>
</div>
<!--End Modal -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  
          <a class="navbar-brand" href="<?php echo base_url(); ?>">UD SARI ALAM</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
            <?php if(!$this->session->userdata('logged_in')) : ?>
				    <li class="<?php if($this->uri->segment(2)=="caraorder"){echo "active";}?>"><a href="<?php echo base_url(); ?>users/caraorder">Cara Pemesanan</a></li>
				    <li class="<?php if($this->uri->segment(2)=="carabayar"){echo "active";}?>"><a href="<?php echo base_url(); ?>users/carabayar">Cara Pembayaran</a></li>
				    <li class="<?php if($this->uri->segment(2)=="ongkir"){echo "active";}?>"><a href="<?php echo base_url(); ?>users/ongkir">Cek Ongkos Kirim</a></li>
					<li class="<?php if($this->uri->segment(2)=="kontak"){echo "active";}?>"><a href="<?php echo base_url(); ?>users/kontak">Kontak Kami</a></li>
				    <li class="<?php if($this->uri->segment(2)=="register"){echo "active";}?>"><a href="<?php echo base_url(); ?>users/register">Buat Akun</a></li>
			     <?php endif; ?>
		  </ul>
      <?php if(!$this->session->userdata('logged_in')) : ?>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="" class="show-tooltip" data-placement="bottom" data-toggle="modal" data-target="#myModal" title="Login">
            <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login
          </a>
        </li>
      </ul>
      <?php else : ?>
      <ul class="nav navbar-nav">
        <li class="<?php if($this->uri->segment(2)=="belanja"){echo "active";}?>">
          <a href="<?php echo base_url(); ?>users/belanja">
          Data <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
          </a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a class="show-tooltip" data-placement="bottom" href="<?php echo base_url(); ?>users/logout" title="Logout">
            <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout
          </a>
        </li>
      </ul>
	  <?php endif; ?>
	  <form class="navbar-form navbar-right" action="<?php echo base_url('produks/hasil_cari')?>" action="GET">
        <input name="cari" type="text" class="form-control" placeholder="Search...">
    </form>
    </div><!--/.nav-collapse -->
  </div>
</nav>

<div class="container">
  <div class="row">
		<div class="col-md-4">
			<?php $this->load->view('layouts/includes/sidebar'); ?>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-default">
		  <div class="panel-heading panel-heading-green">
        <h3 class="panel-title"><strong>UD SARI ALAM</strong></h3>
			</div>
			<div class="panel-body">