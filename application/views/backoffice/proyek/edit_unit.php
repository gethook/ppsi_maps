<a href="javascript:void(0)" data-toggle="modal" data-target="#EditUnit<?php echo $unit['unit_id']; ?>">
	<span class="fa fa-pencil fa-fw" data-toggle="tooltip" data-placement="bottom" title="Edit Unit"></span>
</a>
<div class="modal fade" id="EditUnit<?php echo $unit['unit_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open('proyek/editunit/' . $unit['unit_id']); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Edit Unit</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="unit_id" class="sr-only">Unit ID</label>
					<input type="hidden" name="unit_id" class="form-control" value="<?php echo $unit['unit_id']; ?>">
				</div>

				<div class="form-group">
					<label for="unit_name">Nama/Nomor Unit</label>
					<input type="text" name="unit_name" class="form-control" value="<?php echo set_value('unit_name', $unit['unit_name']); ?>">
				</div>
				<div class="form-group">
					<label for="status_unit_id">Pilih Status</label>
					<select name="status_unit_id" class="form-control select2" data-placeholder="Pilih status unit" style="width: 100%;">
						<?php foreach($status_unit as $status): 
							$su = ($status['status_unit_id'] == $unit['status_unit_id']) ? TRUE : FALSE;
							?>
							<option value="<?php echo $status['status_unit_id']; ?>" <?php if($su) echo "selected=''"; ?>><?php echo $status['status_unit_name']; ?></option>
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
