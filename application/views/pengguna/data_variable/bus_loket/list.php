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
				<th>Merk Bus</th>
				<th>Kelas Bus</th>
				<th>Jumlah Kursi</th>
				<th>Opsi</th>
			</thead>
			<tbody>
				<?php
				if (!empty($bus_loket)) {
					foreach ($bus_loket as $key => $value) {
						$loket = $this->data_loket_model->view($value['loket']);
						$bus = $this->data_bus_model->view($value['bus']);
						if (!empty($loket) && !empty($bus)) :
				?>
				<tr>
					<td><?php echo $key+=1; ?></td>
					<td><?php echo $bus['merk_bus']; ?></td>
					<td><?php echo $bus['kelas_bus']; ?></td>
					<td><?php echo $bus['jumlah_kursi']; ?></td>
					<td>
						<a class="btn btn-sm btn-flat btn-danger" href="<?php echo base_url('data_variable/bus_loket_option/'.$value['id'].'/delete') ?>" onclick="return confirm('Konfirmasi penghapusan')">Hapus</a>
					</td>
				</tr>
			<?php 
					endif;
				}
			}
			?>
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<a  class="btn btn-default btn-flat"  href="<?php echo base_url('data_variable/loket') ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
		&nbsp;&nbsp;
		<a class="btn btn-primary btn-flat" href="<?php echo base_url('data_variable/bus_loket/'.$loket['id'].'/add') ?>"><i class="fa fa-plus"></i> Tambah</a>
	</div>
</div>