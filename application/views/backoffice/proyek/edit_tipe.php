<a href="javascript:void(0)" data-toggle="modal" data-target="#EditType<?php echo $unit_type['unit_type_id']; ?>">
	<span class="fa fa-pencil fa-fw" data-toggle="tooltip" data-placement="bottom" title="Edit Tipe"></span>
</a>
<div class="modal fade" id="EditType<?php echo $unit_type['unit_type_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open('proyek/edittipe/' . $unit_type['unit_type_id']); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Edit Tipe</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="unit_type_id" class="sr-only">Proyek ID</label>
					<input type="hidden" name="project_id" class="form-control" value="<?php echo $unit_type['unit_type_id']; ?>">
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="floor">Jumlah lantai</label>
						<input type="number" name="floor" class="form-control" value="<?php echo set_value('floor', $unit_type['floor']); ?>">
					</div>
					<div class="form-group">
						<label for="lb">Luas bangunan</label>
						<input type="number" name="lb" class="form-control" value="<?php echo set_value('lb', $unit_type['lb']); ?>">
					</div>
					<div class="form-group">
						<label for="lt">Luas tanah</label>
						<input type="number" name="lt" class="form-control" value="<?php echo set_value('lt', $unit_type['lt']); ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="kt">Jumlah kamar tidur</label>
						<input type="number" name="kt" class="form-control" value="<?php echo set_value('kt', $unit_type['kt']); ?>">
					</div>
					<div class="form-group">
						<label for="km">Jumlah kamar mandi</label>
						<input type="number" name="km" class="form-control" value="<?php echo set_value('km', $unit_type['km']); ?>">
					</div>
					<div class="form-group">
						<label for="price">Harga</label>
						<div class="input-group">
						<input type="number" name="price" class="form-control" value="<?php echo set_value('price', $unit_type['price']); ?>">
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="units">Pilih Unit</label>
					<select name="units[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih unit" style="width: 100%;">
						<?php foreach($units as $unit): ?>
							<?php
							foreach ($unit_type['units'] as $my_unit) {
								$sel = FALSE;
								if ($unit['unit_id'] == $my_unit['unit_id']) {
									$sel = TRUE;
									break;
								}
							}
							?>
							<option value="<?php echo $unit['unit_id']; ?>" <?php if($sel) echo "selected=''"; ?>><?php echo $unit['unit_name']; ?></option>
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
