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
		<?php if($allowed_to_add) { ?>
			<a href="<?php echo base_url('survey/tambah'); ?>" class="btn btn-primary">
				<span class="fa fa-plus-square fa-fw"></span>
				Tambah Jadwal Survey
			</a>
		<?php } ?>
		</div>
		<div class="box-body table-responsive">
			
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Jam</th>
						<th>Proyek</th>
						<th>Nama Konsumen</th>
						<th>No Telp Konsumen</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php $no = 1; foreach($jadwal_survey as $survey): ?>
					<tr>
						<?php $dt = explode(' ', $survey['project_survey_date']); ?>
						<td><?php echo $no; $no++; ?></td>
						<td><?php echo tanggal($survey['project_survey_date']); ?></td>
						<td><?php echo substr($dt[1],0,5); ?></td>
						<td><?php echo $survey['project_name']; ?></td>
						<td>
							<?php echo $survey['customer_name']; ?>
						</td>
						<td><?php echo $survey['customer_phone']; ?></td>
						<td>
							<a href="<?php echo base_url('survey/edit/' . $survey['project_survey_id']); ?>" class="btn btn-primary btn-sm">
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