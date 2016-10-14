<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Administrator UD Sari Alam</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/js.js"></script>
	
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>admin">Dahsboard</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
		      <?php if(!$this->session->flashdata('registered')) : ?>
            <li class="<?php if($this->uri->segment(2)=="produk"){echo "active";}?>"><a href="<?php echo base_url(); ?>admin/produk">Produk</a></li>
            <li class="<?php if($this->uri->segment(2)=="ongkir"){echo "active";}?>"><a href="<?php echo base_url(); ?>admin/ongkir">Ongkos Kirim</a></li>
            <li class="<?php if($this->uri->segment(2)=="Kategori"){echo "active";}?>"><a href="<?php echo base_url(); ?>admin/Kategori">Kategori</a></li>
            <li><a href="<?php echo base_url(); ?>admin/pesanan">Pesanan</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
        		<li>
        			<a class="navbar-right show-tooltip" data-placement="bottom" href="<?php echo base_url(); ?>admin/logout" title="Logout">
        				<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
        			</a>
        		</li>
        	</ul>
			   <?php endif; ?>
		</div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php $this->load->view('admin/layouts/includes/sidebar'); ?>
			</div>
			</div>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading panel-heading-green">
						<h3 class="panel-title"><strong>UD SARI ALAM</strong></h3>
					</div>
					<div class="panel-body">