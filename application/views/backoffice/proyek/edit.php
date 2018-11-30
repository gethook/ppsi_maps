<div class="col-md-12">
	<?php
	if (isset($error_upload)) {
		echo '<div class="alert alert-danger alert-dismissable">';
		echo '<button class="close" data-dismiss="alert" aria-hidden="true">&times</button>';
		echo $error_upload;
		echo '</div>';
	}

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
			<?php echo form_open_multipart('proyek/edit/' . $project['project_id']); ?>			
			<div class="form-group">
				<label for="project_name">Nama proyek</label>
				<input type="text" name="project_name" class="form-control" value="<?php echo set_value('project_name', $project['project_name']); ?>" required="">
			</div>
			<div class="form-group">
				<label for="project_description">Deskripsi</label>
				<textarea name="project_description" class="form-control textarea"><?php echo set_value('project_description', $project['project_description']); ?></textarea>
			</div>
			<div class="form-group">
				<label for="area_id">Area/Lokasi proyek</label>
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
					$selected = ($project['area_id'] == $kota['area_id']);
					?>
					<option value="<?php echo $kota['area_id']; ?>" <?php echo set_select('area_id', $kota['area_id'], $selected); ?>>
						<?php echo $opt_lbl;//$kota['area_name'] . ', ' . $kota['induk']; ?>
					</option>
				<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="project_address">Alamat lengkap proyek</label>
				<textarea name="project_address" class="form-control"><?php echo set_value('project_address', $project['project_address']); ?></textarea>
			</div>
			<div class="form-group">
				<label for="project_gmaps">Link Gmaps</label>
				<input type="text" name="project_gmaps" class="form-control" value="<?php echo set_value('project_gmaps', $project['project_gmaps']); ?>">
			</div>

			<div class="form-group">
				<label for="status_unit_id">Status proyek</label>
				<select class="form-control select2" name="status_unit_id" required="">
					<?php foreach($status_unit as $status): ?>
					<?php
					$selected = ($project['status_unit_id'] == $status_unit['status_unit_id']);
					?>
						<option value="<?php echo $status['status_unit_id']; ?>" <?php echo set_select('status_unit_id', $status['status_unit_id'], $selected); ?>><?php echo $status['status_unit_name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="project_path_img">Upload Gambar Utama</label>
				<input type="file" name="project_path_img" class="form-control">
			</div>
			<div class="form-group">
				<label for="project_note">Catatan untuk marketing</label>
				<textarea name="project_note" class="form-control textarea"><?php echo set_value('project_note', $project['project_note']); ?></textarea>
			</div>
			
		</div>
		<div class="box-footer">
			<div class="pull-right">
				<a href="<?php echo base_url('proyek/developer'); ?>" class="btn btn-default"><span class="fa fa-undo fa-fw"></span> Batal</a>
				<button type="submit" class="btn btn-primary"><span class="fa fa-save fa-fw"></span> Simpan</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>