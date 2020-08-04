<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<div class="box-body">
		<div class="col-lg-6">
			<table class="table table-hover">
				<tr>
					<td>Nama</td><td>: <?php echo $pengguna['nama_lengkap'] ?></td>
				</tr>
				<tr>
					<td>Jabatan</td><td>: <?php echo ucfirst($pengguna['role']) ?></td>
				</tr>
				<tr>
					<td>Email</td><td>: <?php echo $pengguna['email'] ?></td>
				</tr>
				<tr>
					<td>Username</td><td>: @<?php echo $pengguna['username'] ?></td>
				</tr>
				<tr>
					<td>Seluler</td><td>: <?php echo $pengguna['seluler'] ?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="box-footer">
		<a  class="btn btn-default btn-flat" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Kembali</a>
	</div>
</div>