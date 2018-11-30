<button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#RmTeam<?php echo $team_member['user_role_id']; ?>">
	<span class="fa fa-trash fa-fw fa-lg"></span>
</button>

<div class="modal fade" id="RmTeam<?php echo $team_member['user_role_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php //echo form_open('developer/rmteam'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Hapus Anggota Tim</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					Apakah Anda yakin ingin menghapus <?php echo $team_member['full_name']; ?> dari anggota tim <?php echo $developer['developer_name']; ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="fa fa-undo fa-fw"></i> Tidak, Batalkan
				</button>
				<a href="<?php echo base_url('developer/rmteam/'.$team_member['user_role_id']); ?>" class="btn btn-danger">
					<span class="fa fa-trash fa-fw"></span>
					Ya, Hapus
				</a>
				
			</div>
			<?php //echo form_close(); ?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
