<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('data_variable/bus_loket/'.$loket.'/add') ?>" method="post">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Bus</label>
					<select class="form-control" name="bus">
						<?php foreach ($this->data_bus_model->list() as $value) { ?>
							<option value="<?php echo $value['id'] ?>"><?php echo $value['merk_bus'].' | Kelas '.$value['kelas_bus'].' - '.$value['jumlah_kursi'].' kursi';  ?></option>
						<?php } ?>
					</select>
					<?php echo form_error('merek', '<span class="help-block error">', '</span>'); ?>
				</div>
				<input type="hidden" name="loket" value="<?php echo $loket; ?>">
			</div>
		</div>
		<div class="box-footer">
			<a  class="btn btn-default btn-flat" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Kembali</a>
			&nbsp;&nbsp;
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
</div>