<div class="col-xs-12">
	<?php if ($this->session->flashdata('warn_member')) {
		echo '<div class="alert alert-warning alert-dismissable">';
		echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		echo $this->session->flashdata('warn_member');
		echo '</div>';
	}
	?>
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Marketing</h3>
			
		</div>
		<div class="box-body table-responsive">
			<p><?php include 'add.php'; ?></p>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Marketing</th>
						<th>No. Telp/WA</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php $no = 1; foreach($marketings as $marketing): ?>
					<tr>
						<td><?php echo $no; $no++; ?></td>
						<td><?php echo $marketing['full_name']; ?></td>
						<td>
							<?php echo $marketing['phone']; ?>
						</td>
						<td><?php echo $marketing['email']; ?></td>
						<td><?php include 'delete.php'; ?>
						</td>						
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>