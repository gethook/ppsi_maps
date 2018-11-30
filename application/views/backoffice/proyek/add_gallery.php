<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AddGallery">
	<span class="fa fa-plus-square fa-fw"></span>
	Tambah Gambar/Galeri
</button>
<div class="modal fade" id="AddGallery">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open_multipart('proyek/tambahgaleri/' . $project['project_id']);//form_open('proyek/tambahunit'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Tambah Gambar/Galeri</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="path_file">Upload Gambar</label>
					<input type="file" name="path_file" class="form-control">
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
