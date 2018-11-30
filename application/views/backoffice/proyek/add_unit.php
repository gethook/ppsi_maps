<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddUnit">
	<span class="fa fa-plus-square fa-fw"></span>
	Tambah Unit
</button>
<div class="modal fade" id="AddUnit">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open('proyek/tambahunit/' . $project['project_id']);//form_open('proyek/tambahunit'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Tambah Unit</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="project_id" class="sr-only">Proyek ID</label>
					<input type="hidden" name="project_id" class="form-control" value="<?php echo $project['project_id']; ?>">
				</div>
				<div class="form-group">
					<label for="prefix">Blok / Prefix</label>
					<input type="text" name="prefix" class="form-control" required="" placeholder="A">
				</div>
				<div class="form-group">
					<label for="start_no">Nomor Unit</label>
					<div class="input-group">
						<input type="text" name="start_no" class="form-control" placeholder="1">
						<span class="input-group-addon">s.d.</span>
						<input type="text" name="end_no" class="form-control" placeholder="10">
					</div>
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
