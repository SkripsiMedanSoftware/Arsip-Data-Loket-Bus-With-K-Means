<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('data_variable/tujuan_option/'.$tujuan['id'].'/update') ?>" method="post">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Nama Tujuan</label>
					<input class="form-control" type="text" name="nama_tujuan" placeholder="Nama Tujuan" value="<?php echo set_value('nama_tujuan', $tujuan['nama_tujuan']) ?>">
					<?php echo form_error('nama_tujuan', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Loket</label>
					<select class="form-control" name="loket">
						<?php foreach ($this->data_loket_model->list() as $value) { ?>
							<option value="<?php echo $value['id'] ?>" <?php echo $value['id'] == $tujuan['loket']?'selected':'' ?>><?php echo $value['nama_loket'] ?></option>
						<?php } ?>
					</select>
					<?php echo form_error('loket', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Bus</label>
					<select class="form-control" name="bus" id="select_bus"></select>
					<?php echo form_error('bus', '<span class="help-block error">', '</span>'); ?>
				</div>
				<input type="hidden" name="bus_loket_id">
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

	ajax_loket_bus($('[name="loket"]').children('option:selected').val());

	$('[name="loket"]').change(function(e){
		e.preventDefault();
		ajax_loket_bus($(this).val())
	});

	$('[name="bus"]').change(function(e){
		e.preventDefault();
		$('input[name="bus_loket_id"]').val($('[name="bus"]').children('option:selected').attr('bus_loket_id'));
	});

	function ajax_loket_bus(loket) {
		$.ajax({
			url: '<?php echo base_url('data_variable/ajax_bus_loket/') ?>'+loket,
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				$('select[name="bus"]').empty();
				$.each(data, function(index, val) {
					 $('select[name="bus"]').append(
					 	'<option value="'+val.bus_id+'" bus_loket_id="'+val.loket_bus_id+'"># '+val.loket_bus_id+' '+val.merk_bus+' | Kelas '+val.kelas_bus+' - '+val.jumlah_kursi+' Kursi</option>'
					 );
				});

				$('input[name="bus_loket_id"]').val($('[name="bus"]').children('option:selected').attr('bus_loket_id'));
			},
			error: function(error) {

			}
		});
	}
});
</script>