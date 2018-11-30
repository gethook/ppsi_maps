<a href="javascript:void(0)" data-toggle="modal" data-target="#HapusUnit<?php echo $unit['unit_id']; ?>">
	<span class="fa fa-trash fa-fw" data-toggle="tooltip" data-placement="bottom" title="Hapus Unit"></span>
</a>
<div class="modal fade" id="HapusUnit<?php echo $unit['unit_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Hapus Unit</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					Apakah Anda yakin ingin menghapus Unit <?php echo $unit['unit_name'] . ' dari ' . $project['project_name'] . '?'; ?>
					<p><span class="fa fa-warning fa-fw"></span> Perhatian! Unit yang sudah terhapus tidak dapat dikembalikan.</p>
				</div>
			</div>
			<div class="modal-footer">
				<?php echo form_open('proyek/hapusunit/' . $unit['unit_id']); ?>
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="fa fa-undo fa-fw"></i> Tidak, kembali
				</button>
				
				<button type="submit" class="btn btn-danger">
					<span class="fa fa-trash fa-fw"></span>
					Ya, Hapus Unit
				</button>
				<?php echo form_close(); ?>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
