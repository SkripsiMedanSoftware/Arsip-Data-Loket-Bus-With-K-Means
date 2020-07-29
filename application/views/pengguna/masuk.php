<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo isset($page_title)?APP_INFO['name'].' - '.$page_title:APP_INFO['name']; ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/') ?>bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/') ?>dist/css/AdminLTE.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style type="text/css">
		body {
			max-height: 80%;
		}

		.login-page, .register-page {
			background: url("<?php echo base_url('assets/images/629329.jpg') ?>") no-repeat center center fixed;
			background-size: cover;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
		}

		.register-box-body, .login-box-body {
			opacity: 0.92;
		}

		.register-box-body {
			background: #fff;
			padding: 20px;
			padding: 12px;
			border-top: 0;
			color: #666;
		}

		.help-block.error {
			color: red;
		}

	</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<a href="<?php echo base_url() ?>">Halaman Masuk <b><?php echo APP_INFO['name']; ?></b></a>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Masuk untuk memulai sesi anda</p>
		<?php 
		if (!empty($this->session->userdata('masuk')))
		{
			?>
			<div class="alert alert-danger"><?php echo $this->session->userdata('masuk'); ?></div>
			<?php
		}

		if (!empty($this->session->userdata('daftar')))
		{
			?>
			<div class="alert alert-success"><?php echo $this->session->userdata('daftar'); ?></div>
			<?php
		}
		?>
		<form action="<?php echo base_url('pengguna/masuk') ?>" method="post">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Email / Nama Pengguna" name="identitas" value="<?php echo set_value('identitas') ?>">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				<?php echo form_error('identitas', '<span class="help-block error">', '</span>'); ?>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Kata Sandi" name="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				<?php echo form_error('password', '<span class="help-block error">', '</span>'); ?>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
				</div>
			</div>
		</form>
		<br>
		<a href="#" class="pull-right">Lupa kata sandi</a>
		<a href="<?php echo base_url('pengguna/daftar') ?>" class="pull-left">Mendaftar</a>
		<br>
	</div>
</div>

<script src="<?php echo base_url('assets/adminlte-2.4.8/') ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/') ?>plugins/iCheck/icheck.min.js"></script>
<script>
$(function () {
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%'
	});
});
</script>
</body>
</html>