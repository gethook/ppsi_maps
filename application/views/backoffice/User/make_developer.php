<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#Dev<?php echo $role['user_role_id']; ?>" title="Jadikan Owner Developer">
	<i class="fa fa-user"></i>
	<i class="fa fa-level-up"></i>
</button>

<div class="modal fade" id="Dev<?php echo $role['user_role_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Jadikan user sebagai Owner Developer</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<p>Menjadikan user sebagai owner developer akan menambahkan satu data developer baru.</p>
					<p>Apakah Anda yakin?</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="fa fa-close"></i> Batal
				</button>
				<a href="<?php echo base_url('user/mdo/' . $role['user_role_id']); ?>" class="btn btn-danger">
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