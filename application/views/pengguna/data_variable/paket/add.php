<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('data_variable/paket/add') ?>" method="post">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Tujuan</label>
					<select name="tujuan" class="form-control">
						<?php foreach ($this->data_tujuan_model->list() as $value) : 
							$loket = $this->data_loket_model->view($value['loket']);
						?>
							<option value="<?php echo $value['id']; ?>"><?php echo $loket['nama_loket'].' - '.$value['nama_tujuan']; ?></option>
						<?php endforeach; ?>
					</select>
					<?php echo form_error('tujuan', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Pengirim</label>
					<input type="text" name="pengirim" placeholder="Pengirim" class="form-control">
					<?php echo form_error('pengirim', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Penerima</label>
					<input type="text" name="penerima" placeholder="Penerima" class="form-control">
					<?php echo form_error('penerima', '<span class="help-block error">', '</span>'); ?>
				</div>
			</div>
			<div class="col-lg-6">
				<table class="table table-hover table-striped table-bordered">
					<tr>
						<td>Bus Loket ID</td>
						<td id="bus_loket"></td>
					</tr>
					<tr>
						<td>Merek Bus</td>
						<td id="merk_bus"></td>
					</tr>
					<tr>
						<td>Kelas Bus</td>
						<td id="kelas_bus"></td>
					</tr>
					<tr>
						<td>Jumlah Jursi</td>
						<td id="jumlah_kursi"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="box-footer">
			<a  class="btn btn-default btn-flat" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Kembali</a>
			&nbsp;&nbsp;
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
</div>

<script type="text/javascript">
$(document).ready(function() {

	ajax_tujuan($('[name="tujuan"]').children('option:selected').val());

	$('[name="tujuan"]').change(function(e){
		e.preventDefault();
		ajax_tujuan($(this).val());
	});

	function ajax_tujuan(id) {
		$.ajax({
			url: '<?php echo base_url('data_variable/ajax_tujuan/') ?>'+id,
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				if (Object.keys(data).length > 0) {
					$('#bus_loket').text(data.bus_loket.id)
					$('#merk_bus').text(data.bus.merk_bus)
					$('#kelas_bus').text(data.bus.kelas_bus)
					$('#jumlah_kursi').text(data.bus.jumlah_kursi)
				} else {
					alert('Tujuan ini tidak bisa digunakan');
				}
			},
			error: function(error) {
				console.log(error)
			}
		});
	}
});
</script>