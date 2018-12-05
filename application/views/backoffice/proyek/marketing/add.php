<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddMarketing">
	<span class="fa fa-plus-square fa-fw"></span>
	Tambah Marketing
</button>
<div class="modal fade" id="AddMarketing">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open('proyek/tambahmarketing/' . $project['project_id']); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Tambah Marketing</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="project_id" class="sr-only">Proyek ID</label>
					<input type="hidden" name="project_id" class="form-control" value="<?php echo $project['project_id']; ?>">
				</div>

				<div class="form-group">
					<label for="marketings">Pilih Marketing</label>
					<select name="marketings[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih marketing" style="width: 100%;">
						<?php foreach($available_marketing as $am): ?>
							<option value="<?php echo $am['user_id']; ?>"><?php echo $am['full_name']; ?></option>
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
