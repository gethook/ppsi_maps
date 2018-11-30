<div class="col-md-12">
	<?php
	if ($error_upload) {
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
			<?php echo form_open_multipart('developer/edit/' . $developer['developer_id']); ?>			
			<div class="form-group">
				<label for="developer_name">Nama developer</label>
				<input type="text" name="developer_name" class="form-control" value="<?php echo set_value('developer_name', $developer['developer_name']); ?>" required="">
			</div>
			<div class="form-group">
				<label for="ownership_id">Legalitas/Status Hukum</label>
				<select class="form-control select2" name="ownership_id" required="">
					<?php foreach($ownerships as $ownership): ?>
						<?php 
						//$selected = ($developer['ownership_id'] == $ownership['ownership_id'] ? "selected" : "");
						$selected = ($developer['ownership_id'] == $ownership['ownership_id']);  
						$ket = ($ownership['ownership_code'] == '' ? $ownership['ownership_name'] : $ownership['ownership_code'] . ' - ' . $ownership['ownership_name']);
						$ownership_id = $ownership['ownership_id'];
						?>
						<option value="<?php echo $ownership['ownership_id']; ?>" <?php echo set_select('ownership_id', $ownership_id, $selected); ?>><?php echo $ket; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="developer_path_logo">Logo</label>
				<input type="file" name="developer_path_logo" class="form-control">
			</div>
			<div class="form-group">
				<label for="area_id">Kota</label>
				<select name="area_id" id="" class="form-control select2">
					<option value="" <?php if(!$developer['area_id']){echo "selected";} ?>>&nbsp;</option>
					<?php foreach($kota as $kota): 
						//$selected = $developer['area_id'] == $kota['area_id'] ? "selected" : "";
						$selected = ($developer['area_id'] == $kota['area_id']);
						$area_id = $kota['area_id'];
					?>
					<option value="<?php echo $kota['area_id']; ?>" <?php echo set_select('area_id', $area_id, $selected); ?>>
						<?php echo $kota['kota'] . ', ' . $kota['provinsi']; ?>
					</option>
				<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="developer_address">Alamat Kantor</label>
				<textarea name="developer_address" class="form-control"><?php echo set_value('developer_address', $developer['developer_address']); ?></textarea>
			</div>
			<div class="form-group">
				<label for="developer_gmaps">Link Gmaps</label>
				<input type="text" name="developer_gmaps" class="form-control" value="<?php echo set_value('developer_gmaps', $developer['developer_gmaps']); ?>">
			</div>
			<div class="form-group">
				<label for="developer_description">Deskripsi</label>
				<textarea name="developer_description" class="form-control textarea">
					<?php echo set_value('developer_description', $developer['developer_description']); ?>
				</textarea>
			</div>
			
		</div>
		<div class="box-footer">
			<div class="pull-right">
				<a href="<?php echo base_url('developer/profile'); ?>" class="btn btn-default"><span class="fa fa-undo fa-fw"></span> Batal</a>
				<button type="submit" class="btn btn-info"><span class="fa fa-save fa-fw"></span> Simpan</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>