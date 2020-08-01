<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('data_variable/bus_option/'.$bus['id'].'/update') ?>" method="post">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Merek</label>
					<input class="form-control" type="text" name="merek" placeholder="Merek" value="<?php echo set_value('merek', $bus['merk_bus']) ?>">
					<?php echo form_error('merek', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Kelas</label>
					<input class="form-control" type="text" name="kelas" placeholder="Kelas" value="<?php echo set_value('kelas', $bus['kelas_bus']) ?>">
					<?php echo form_error('kelas', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Jumlah Kursi</label>
					<input class="form-control" type="number" name="jumlah_kursi" placeholder="Jumlah Kursi" value="<?php echo set_value('jumlah_kursi', $bus['jumlah_kursi']) ?>" min="1" max="99">
					<?php echo form_error('jumlah_kursi', '<span class="help-block error">', '</span>'); ?>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<a  class="btn btn-default btn-flat" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Kembali</a>
			&nbsp;&nbsp;
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
</div>