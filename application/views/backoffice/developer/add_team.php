<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddTeam">
	<span class="fa fa-plus-square fa-fw"></span>
	Tambah Team
</button>
<div class="modal fade" id="AddTeam">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open('developer/addteam'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Tambah Tim</h4>
			</div>
			<div class="modal-body">				
				<div class="form-group">
					<label for="developer_id" class="sr-only">Developer ID</label>
					<input type="hidden" name="developer_id" class="form-control" value="<?php echo $developer['developer_id']; ?>">
				</div>
				<div class="form-group">
					<label for="team_members">Pilih User sebagai tim developer</label>
					<select name="team_members[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih user" style="width: 100%;">
					<?php foreach($users as $user): 
						$disabled = $user['disabled'];
					?>
						<option value="<?php echo $user['user_id']; ?>" <?php if($disabled) echo "disabled"; ?>><?php echo $user['full_name']; ?></option>
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
