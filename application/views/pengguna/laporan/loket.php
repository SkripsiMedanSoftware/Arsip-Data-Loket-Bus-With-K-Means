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
				<th>Nama Loket</th>
				<th>Jumlah Penumpang Total</th>
				<th>Jumlah Bus Total</th>
				<th>Jumlah Paket Total</th>
			</thead>
			<tbody>
				<?php
				if (!empty($loket)) {
					$no = 1;
					foreach ($loket as $key => $value) {
				?>
				<tr>
					<td><?php echo $key+1; ?></td>
					<td><?php echo $value['nama_loket']; ?></td>
					<td><?php echo $this->data_loket_model->jumlah_penumpang_total($value['id']); ?></td>
					<td><?php echo $this->data_loket_model->jumlah_bus_total($value['id']); ?></td>
					<td><?php echo $this->data_loket_model->jumlah_paket_total($value['id']); ?></td>
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
		<a class="btn btn-primary btn-flat" href="<?php echo base_url('laporan/loket_print') ?>"><i class="fa fa-print"></i> Cetak Laporan</a>
	</div>
</div>