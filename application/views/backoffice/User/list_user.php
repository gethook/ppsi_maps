<div class="col-xs-12">
	<?php if ($this->session->flashdata('warn_member')) {
		echo '<div class="alert alert-warning alert-dismissable">';
		echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		echo $this->session->flashdata('warn_member');
		echo '</div>';
	}
	?>
	<div class="box box-primary">
		<div class="box-header"></div>
		<div class="box-body table-responsive">
			
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Username</th>
						<th>
							Nama Lengkap
							<span class="pull-right"><i class="fa fa-male" data-toggle="tooltip" data-placement="top" title="Laki-laki"></i>/<i class="fa fa-female" data-toggle="tooltip" data-placement="top" title="Perempuan"></i></span>
						</th>
						<th>No. Telp/WA</th>
						<th>Email</th>
						<th>Roles</th>
						
					</tr>
				</thead>
				<tbody>
				<?php $no = 1; foreach($users as $users): ?>
					<tr>
						<td><?php echo $no; $no++; ?></td>
						<td><?php echo $users['username']; ?></td>
						<td>
							<?php echo $users['full_name']; ?>
							<?php $gender = ($users['gender_id']==1) ? "male" : "female"; ?>
							<i class="pull-right fa fa-<?php echo $gender; ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $users['gender_name']; ?>"></i>
						</td>
						<td><?php echo $users['phone']; ?></td>
						<td><?php echo $users['email']; ?></td>
						<td>
							<?php
								$roles = $this->user_model->get_user_roles($users['user_id']);
								//var_dump($roles);
								if (count($roles) > 0):
									foreach($roles as $role): 
							?>
							<p>
								<span class="btn btn-default btn-flat btn-xs"><?php echo $role['role'] . " " . $role['developer_name']; ?></span>
								<?php if($role['role_id'] == 3 && !$role['developer_id']) {include('make_developer.php');} ?>
								<?php if($role['role_id'] == 5) {include('make_agency.php');} ?>
							</p>
							<?php endforeach; ?>
							<?php endif; ?>
						</td>
						
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>