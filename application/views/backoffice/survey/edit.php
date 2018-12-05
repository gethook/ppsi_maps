<div class="col-md-12">
	<?php
	if(validation_errors())
	{
		echo '<div class="alert alert-danger alert-dismissible">';
		echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		echo validation_errors();
		echo '</div>';
	}
	$survey_date = date('d F Y', strtotime($project_survey['project_survey_date']));
	$survey_time = date('H:i', strtotime($project_survey['project_survey_date']));
	?>

	<div class="box box-primary">
		<div class="box-body">
			<?php echo form_open('survey/edit/' . $project_survey['project_survey_id']); ?>			
			<div class="form-group">
				<label for="tanggal">Tanggal</label>
				<input id="datepicker" name="tanggal" class="form-control" type="text" readonly="" value="<?php echo $survey_date; ?>">
			</div>
			<div class="form-group">
				<label for="jam">Jam</label>
				<input name="jam" class="form-control timepicker" type="text" value="<?php echo $survey_time; ?>">
			</div>
			<div class="form-group">
				<label for="project_id">Proyek</label>
				<select name="project_id" id="" class="form-control select2">
					<option value="" selected="">&nbsp;</option>
					<?php foreach($projects as $project): ?>
					<option value="<?php echo $project['project_id']; ?>" <?php echo set_select('project_id', $project['project_id'], ($project['project_id']==$project_survey['project_id'])); ?>>
						<?php echo $project['project_name']; ?>
					</option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="customer_id">Konsumen</label>
				<select name="customer_id" id="" class="form-control select2">
					<option value="" selected="">&nbsp;</option>
					<?php foreach($customers as $customer): ?>
					<option value="<?php echo $customer['customer_id']; ?>" <?php echo set_select('customer_id', $customer['customer_id'], ($customer['customer_id']==$project_survey['customer_id'])); ?>>
						<?php echo $customer['customer_name']; ?>
					</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="box-footer">
			<div class="pull-right">
				<a href="<?php echo base_url('survey'); ?>" class="btn btn-default"><span class="fa fa-undo fa-fw"></span> Batal</a>
				<button type="submit" class="btn btn-primary"><span class="fa fa-save fa-fw"></span> Simpan</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>