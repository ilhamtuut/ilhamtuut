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
