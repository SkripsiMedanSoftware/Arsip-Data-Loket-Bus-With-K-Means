<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('data_variable/penumpang/add') ?>" method="post">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Nama Penumpang</label>
					<input class="form-control" type="text" name="nama_penumpang" placeholder="Nama Penumpang" value="<?php echo set_value('nama_penumpang') ?>">
					<?php echo form_error('nama_penumpang', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Tujuan</label>
					<select name="tujuan" class="form-control">
						<?php foreach ($this->data_tujuan_model->list() as $value) : ?>
							<option value="<?php echo $value['id']; ?>"><?php echo $value['nama_tujuan']; ?></option>
						<?php endforeach; ?>
					</select>
					<?php echo form_error('tujuan', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Tanggal</label>
					<input class="form-control" type="text" name="tanggal" placeholder="Tanggal" value="<?php echo set_value('tanggal') ?>" id="datepicker">
					<?php echo form_error('tanggal', '<span class="help-block error">', '</span>'); ?>
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