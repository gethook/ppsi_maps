<a href="javascript:void(0)" data-toggle="modal" data-target="#HapusGaleri<?php echo $gallery['project_gallery_id']; ?>" class="btn btn-danger form-control">
	<span class="fa fa-trash fa-fw"></span> Hapus
</a>
<div class="modal fade" id="HapusGaleri<?php echo $gallery['project_gallery_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-left">Hapus Galeri</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger text-left">
					Apakah Anda yakin ingin menghapus Gambar <?php echo $gallery['path_file'] . ' dari ' . $project['project_name'] . '?'; ?>
				</div>
				<div class="text-center">
					<img src="<?php echo base_url('assets/uploads/projects/') . $gallery['path_file']; ?>" alt="<?php echo $gallery['path_file']; ?>" class="myimg img-responsive">
				</div>
			</div>
			<div class="modal-footer">
				<?php echo form_open('proyek/hapusgaleri/' . $gallery['project_gallery_id']); ?>
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="fa fa-undo fa-fw"></i> Tidak, kembali
				</button>
				
				<button type="submit" class="btn btn-danger">
					<span class="fa fa-trash fa-fw"></span>
					Ya, Hapus
				</button>
				<?php echo form_close(); ?>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
