<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#Age<?php echo $role['user_role_id']; ?>" title="Jadikan Owner Agency">
	<i class="fa fa-user"></i>
	<i class="fa fa-level-up"></i>
</button>

<div class="modal fade" id="Age<?php echo $role['user_role_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Jadikan user sebagai Owner Agency</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<p>Menjadikan user sebagai owner agency akan menambahkan satu data agency baru.</p>
					<p>Apakah Anda yakin?</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="fa fa-close"></i> Batal
				</button>
				<a href="<?php echo base_url('user/mag/' . $role['user_role_id']); ?>" class="btn btn-danger">
					<i class="fa fa-floppy"></i> 
					Ubah Role
				</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->