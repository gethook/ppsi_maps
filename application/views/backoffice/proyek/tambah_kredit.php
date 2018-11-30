<div class="col-md-12">
	<?php

	if(validation_errors())
	{
		echo '<div class="alert alert-danger alert-dismissible">';
		echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		echo validation_errors();
		echo '</div>';
	}
	?>

	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?php echo $project['project_name']; ?></h3>
			<p class="text-muted"><kbd><?php echo 'Tipe '. $unit_type['lb'].'/'.$unit_type['lt'] . ' (' . $unit_type['floor'] . ' lantai)'; ?></kbd></p>
		</div>
		<div class="box-body">
			<?php echo form_open('harga/tambah/' . $unit_type_id); ?>			
			<div class="form-group">
				<label for="dp">Uang Muka/DP</label>
				<input type="number" name="dp" class="form-control" value="<?php echo set_value('dp'); ?>" required="">
			</div>
			<div class="form-group">
				<label for="installment">Angsuran</label>
				<input type="number" name="installment" class="form-control" value="<?php echo set_value('installment'); ?>" required="">
			</div>
			<div class="form-group">
				<label for="tenor">Tenor (tahun)</label>
				<input type="number" name="tenor" class="form-control" value="<?php echo set_value('tenor'); ?>" required="">
			</div>
		<div class="box-footer">
			<div class="pull-right">
				<a href="<?php echo base_url('proyek/detil/' . $project['project_id']); ?>" class="btn btn-default"><span class="fa fa-undo fa-fw"></span> Batal</a>
				<button type="submit" class="btn btn-primary"><span class="fa fa-save fa-fw"></span> Simpan</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>