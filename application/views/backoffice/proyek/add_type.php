<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddType">
	<span class="fa fa-plus-square fa-fw"></span>
	Tambah Type
</button>
<div class="modal fade" id="AddType">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open('proyek/tambahtipe/' . $project['project_id']);//form_open('proyek/tambahunit'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Tambah Tipe</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="project_id" class="sr-only">Proyek ID</label>
					<input type="hidden" name="project_id" class="form-control" value="<?php echo $project['project_id']; ?>">
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="floor">Jumlah lantai</label>
						<input type="number" name="floor" class="form-control" value="<?php echo set_value('floor'); ?>">
					</div>
					<div class="form-group">
						<label for="lb">Luas bangunan</label>
						<input type="number" name="lb" class="form-control" value="<?php echo set_value('lb'); ?>">
					</div>
					<div class="form-group">
						<label for="lt">Luas tanah</label>
						<input type="number" name="lt" class="form-control" value="<?php echo set_value('lt'); ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="kt">Jumlah kamar tidur</label>
						<input type="number" name="kt" class="form-control" value="<?php echo set_value('kt'); ?>">
					</div>
					<div class="form-group">
						<label for="km">Jumlah kamar mandi</label>
						<input type="number" name="km" class="form-control" value="<?php echo set_value('km'); ?>">
					</div>
					<div class="form-group">
						<label for="price">Harga</label>
						<div class="input-group">
						<input type="number" name="price" class="form-control" value="<?php echo set_value('price'); ?>">
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="units">Pilih Unit</label>
					<select name="units[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih unit" style="width: 100%;">
						<?php foreach($units as $unit): ?>
							<option value="<?php echo $unit['unit_id']; ?>"><?php echo $unit['unit_name']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="fa fa-close fa-fw"></i> Batal
				</button>
				<button type="submit" class="btn btn-primary">
					<span class="fa fa-save fa-fw"></span>
					Simpan
				</button>
				
			</div>
			<?php echo form_close(); ?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
