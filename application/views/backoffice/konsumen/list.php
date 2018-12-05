<div class="col-xs-12">
	<?php if ($this->session->flashdata('sukses')) {
		echo '<div class="alert alert-success alert-dismissable">';
		echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		echo $this->session->flashdata('sukses');
		echo '</div>';
	}
	?>
	<div class="box box-primary">
		<div class="box-header">
			<a href="<?php echo base_url('konsumen/tambah'); ?>" class="btn btn-primary">
				<span class="fa fa-plus-square fa-fw"></span>
				Tambah Konsumen
			</a>
		</div>
		<div class="box-body table-responsive">
			
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>
							Nama Konsumen
							<span class="pull-right"><i class="fa fa-male" data-toggle="tooltip" data-placement="top" title="Laki-laki"></i>/<i class="fa fa-female" data-toggle="tooltip" data-placement="top" title="Perempuan"></i></span>
						</th>
						<th>No. Telp/WA</th>
						<th>Email</th>
						<th>Domisili</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php $no = 1; foreach($customers as $customer): ?>
					<tr>
						<td><?php echo $no; $no++; ?></td>
						<td>
							<?php echo $customer['customer_name']; ?>
							<?php $gender = ($customer['gender_id']==1) ? "male" : "female"; ?>
							<i class="pull-right fa fa-<?php echo $gender; ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $customer['gender_name']; ?>"></i>
						</td>
						<td><?php echo $customer['customer_phone']; ?></td>
						<td><?php echo $customer['customer_email']; ?></td>
						<td><?php echo $customer['area_name']; ?></td>
						<td>
							<a href="<?php echo base_url('konsumen/edit/' . $customer['customer_id']); ?>" class="btn btn-primary btn-sm">
								<span class="fa fa-pencil fa-fw"></span>
								Edit
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>