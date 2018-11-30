<a href="javascript:void(0)" data-toggle="modal" data-target="#HapusType<?php echo $unit_type['unit_type_id']; ?>">
	<span class="fa fa-trash fa-fw" data-toggle="tooltip" data-placement="bottom" title="Hapus Tipe"></span>
</a>
<div class="modal fade" id="HapusType<?php echo $unit_type['unit_type_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Hapus Tipe</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					Apakah Anda yakin ingin menghapus Tipe <?php echo $unit_type['lb'] . '/' . $unit_type['lt'] . ' (' . $unit_type['floor'] . ' lantai) dari ' . $project['project_name'] . '?'; ?>
					<p><span class="fa fa-warning fa-fw"></span> Perhatian! Semua pilihan harga pada unit ini akan ikut terhapus</p>
				</div>
			</div>
			<div class="modal-footer">
				<?php echo form_open('proyek/hapustipe/' . $unit_type['unit_type_id']); ?>
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="fa fa-undo fa-fw"></i> Tidak, kembali
				</button>
				
				<button type="submit" class="btn btn-danger">
					<span class="fa fa-trash fa-fw"></span>
					Ya, Hapus Tipe
				</button>
				<?php echo form_close(); ?>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
