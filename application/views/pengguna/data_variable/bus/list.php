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
				<th>Merek</th>
				<th>Kelas</th>
				<th>Jumlah Tujuan</th>
				<th>Jumlah Kursi</th>
				<th>Opsi</th>
			</thead>
			<tbody>
				<?php
				if (!empty($bus)) {
					foreach ($bus as $key => $value) {
				?>
				<tr>
					<td><?php echo $key+=1; ?></td>
					<td><?php echo $value['merk_bus']; ?></td>
					<td><?php echo $value['kelas_bus']; ?></td>
					<td><?php echo $this->data_bus_model->jumlah_tujuan($value['id']); ?></td>
					<td><?php echo $value['jumlah_kursi']; ?></td>
					<td>
						<a class="btn btn-sm btn-flat btn-primary" href="<?php echo base_url('data_variable/bus_option/'.$value['id'].'/update') ?>">Edit</a>
						<a class="btn btn-sm btn-flat btn-danger" href="<?php echo base_url('data_variable/bus_option/'.$value['id'].'/delete') ?>" onclick="return confirm('Konfirmasi penghapusan')">Hapus</a>
					</td>
				</tr>
			<?php 
				}
			}
			?>
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<a class="btn btn-primary btn-flat" href="<?php echo base_url('data_variable/bus/add') ?>"><i class="fa fa-plus"></i> Tambah</a>
	</div>
</div>