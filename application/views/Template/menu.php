<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url('dashboard');?>">UD SARI ALAM</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="<?php if($this->uri->segment(2)==''){echo 'active';}?>">
              <a href="<?php echo base_url('dashboard');?>">
                <span class="glyphicon glyphicon-dashboard"></span>
                <?php
                echo $this->session->userdata('logged_in_admin')['username'];
                ?>
              </a>
            </li>
			<li id="notification_li" class="<?php if($this->uri->segment(2)===''){echo 'active';}?>">
				<span id="notification_count"><?php echo $pesan_masuk;?></span>
				<a href="#" id="notificationLink"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Pemberitahuan </a>
				<div id="notificationContainer">
				<div id="notificationTitle">Pemberitahuan</div>
				<div id="notificationsBody" class="notifications">
				<?php foreach($pesanan_masuk2 as $pesanan_masuk2){?>
				
				<ul class="nav navbar-sidebar">
				<li>
				<a href="<?php echo base_url();?>dashboard/pesan_masuk/<?php echo $pesanan_masuk2->id_transaksi;?>" id="a">
				<span class="glyphicon glyphicon-shopping-cart"></span> Akun <?php echo $pesanan_masuk2->nama;?> Telah Memesan Produk <br> 
				<span class="glyphicon glyphicon-time"></span> <?php echo $pesanan_masuk2->tgl_pesan;?></a>
				</a>
				</li>
				</ul>
					
				<?php } ?>
				</div>
				<div id="notificationFooter"><a href="<?php echo base_url();?>dashboard/lihat_semua" id="a">Lihat Semua</a></div>
				</div>
			</li>
            <li class="<?php if($this->uri->segment(2)==='profile')?>">
              <a href="<?php echo base_url('dashboard/profile');?>">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url(); ?>dashboard/logout">
                <span class="glyphicon glyphicon-log-out"></span> Logout
              </a>
            </li>
          </ul>         
        </div>
      </div>
</nav>