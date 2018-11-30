<div class="col-md-12">
	<?php 
	  	if ($this->session->flashdata('sukses')) { //isset($_SESSION['sukses'])  
  			echo '<div class="alert alert-success alert-dismissable">';
  			echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
  			echo $this->session->flashdata('sukses');
  			echo '</div>';
		}
		
	?>

	<div class="box">
		<div class="box-header">
			<?php if($is_owner_developer): ?>
				<a href="<?php echo base_url('developer/edit/' . $developer['developer_id']); ?>" class="btn btn-primary">
					<span class="fa fa-pencil-square fa-fw"></span>
					Edit
				</a>
			<?php endif; ?>
		</div>
		<div class="box-body">
			<div class="col-md-3">
				<img src="<?php echo base_url('assets/uploads/developers/thumbs/' . $developer['developer_path_logo']) ?>" alt="Logo Developer" class="profile-user-img img-responsive img-circle">
				<h3 class="profile-username text-center">
					<?php 
					echo $developer['developer_name'];
					if($developer['ownership_code'] == ''){
						echo ' - ' . $developer['ownership_name'];
					} else {
						echo ' - ' . $developer['ownership_code'];
					}
					?>
				</h3>
				<?php if($developer['developer_gmaps']): ?>
					<a href="<?php echo $developer['developer_gmaps']; ?>" class="text-center center-block"><?php echo $developer['developer_address']; ?> <span class="fa fa-map-marker"></span></a>
				<?php else: ?>
					<span class="text-center center-block"><?php echo $developer['developer_address']; ?></span>
				<?php endif; ?>
				<span class="text-center center-block"><?php if(array_key_exists('kota', $kota)) echo $kota['kota']; ?></span>
			</div>
			<div class="col-md-9"><?php echo $developer['developer_description']; ?></div>
		</div>
	</div>
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Developer Team</h3><div class="clearfix"></div>
			<?php if($is_owner_developer) include 'add_team.php'; ?>
				
			<?php 
				if ($this->session->flashdata('rmteam_sukses')) { //isset($_SESSION['sukses'])
					echo '<div class="alert alert-success alert-dismissable">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					echo $this->session->flashdata('rmteam_sukses');
					echo '</div>';
				} 

			 ?>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Telp</th>
						<th>Email</th>
						<th>Domisili</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1;foreach($team as $team_member): ?>
						<tr>
							<td><?php echo $no; $no++; ?></td>
							<td><?php echo $team_member['full_name']; ?></td>
							<td><?php echo $team_member['phone']; ?></td>
							<td><?php echo $team_member['email']; ?></td>
							<td></td>
							<td><?php echo $team_member['role']; ?></td>
							<td><?php if($team_member['role_id'] != 2) include 'rm_team.php'; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>