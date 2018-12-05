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
		<div class="box-body">
			<?php echo form_open('konsumen/tambah'); ?>			
			<div class="form-group">
				<label for="customer_name">Nama Konsumen</label>
				<input type="text" name="customer_name" class="form-control" value="<?php echo set_value('customer_name'); ?>" required="">
			</div>
			<div class="form-group has-feedback">
				<label for="gender_id">Jenis Kelamin</label><br>
				<?php foreach($gender as $gender): ?>
					<div class="radio">
						<label>
							<input type="radio" name="gender_id" value="<?php echo $gender['gender_id']; ?>" <?php echo set_radio('gender_id', $gender['gender_id']); ?>>
							<?php echo $gender['gender_name'] ?>
						</label>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="form-group">
				<label for="customer_phone">No Telp/WA</label>
				<input type="text" name="customer_phone" class="form-control" value="<?php echo set_value('customer_phone'); ?>" required="">
			</div>
			<div class="form-group">
				<label for="customer_email">Email</label>
				<input type="text" name="customer_email" class="form-control" value="<?php echo set_value('customer_email'); ?>" required="">
			</div>
			<div class="form-group">
				<label for="area_id">Domisili</label>
				<select name="area_id" id="" class="form-control select2">
					<option value="" selected="">&nbsp;</option>
					<?php foreach($kota as $kota): ?>
					<?php
					$opt_lbl = trim($kota['area_name']);
					if($kota['induk'])
					{
						$opt_lbl .= ', ' . $kota['induk'];
						if($kota['induk2'])
						{
							$opt_lbl .= ', ' . $kota['induk2'];
						}
					}
					?>
					<option value="<?php echo $kota['area_id']; ?>" <?php echo set_select('area_id', $kota['area_id']); ?>>
						<?php echo $opt_lbl;//$kota['area_name'] . ', ' . $kota['induk']; ?>
					</option>
				<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="box-footer">
			<div class="pull-right">
				<a href="<?php echo base_url('konsumen'); ?>" class="btn btn-default"><span class="fa fa-undo fa-fw"></span> Batal</a>
				<button type="submit" class="btn btn-primary"><span class="fa fa-save fa-fw"></span> Simpan</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>