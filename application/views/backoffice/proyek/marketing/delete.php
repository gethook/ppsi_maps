<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#HapusMarketing<?php echo $marketing['project_marketing_id']; ?>">
	<span class="fa fa-trash fa-fw"></span>
	Hapus Marketing
</button>
<div class="modal fade" id="HapusMarketing<?php echo $marketing['project_marketing_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open('proyek/hapusmarketing/' . $marketing['project_marketing_id']); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Hapus Marketing?</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					Apakah Anda yakin ingin menghapus marketing <?php echo $marketing['full_name']; ?> dari proyek <?php echo $project['project_name']; ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="fa fa-close fa-fw"></i> Batal
				</button>
				<button type="submit" class="btn btn-danger">
					<span class="fa fa-trash fa-fw"></span>
					Ya, Hapus
				</button>
				
			</div>
			<?php echo form_close(); ?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
