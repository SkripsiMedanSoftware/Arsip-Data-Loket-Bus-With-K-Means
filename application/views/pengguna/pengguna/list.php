<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<div class="box-body">
		<?php 
		if ($this->session->flashdata('flash_message'))
		{
			?>
				<div class="alert alert-<?php echo $this->session->flashdata('flash_message')['status'] ?> alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $this->session->flashdata('flash_message')['message'] ?>
				</div>
			<?php
		}
		?>
		<table class="table table-hover table-striped datatable">
			<thead>
				<th>No</th>
				<th>Nama Lengkap</th>
				<th>Role</th>
				<th>Email</th>
				<th>Seluler</th>
				<th>Opsi</th>
			</thead>
			<tbody>
				<?php
				if (!empty($pengguna)) {
					$no = 1;
					foreach ($pengguna as $key => $value) {
				?>
				<tr>
					<td><?php echo $key+1; ?></td>
					<td><?php echo $value['nama_lengkap']; ?></td>
					<td><?php echo $value['role']; ?></td>
					<td><?php echo $value['email']; ?></td>
					<td><?php echo $value['seluler']; ?></td>
					<td>
						<a class="btn btn-sm btn-flat btn-primary" href="<?php echo base_url('pengguna/profil/'.$value['id']) ?>">Profil</a>
					</td>
				</tr>
				<?php 
					}
					$no++;
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="box-footer">
	</div>
</div>