<div class="col-md-12">
	<div class="box box-primary" style="background-color:#f7f7f7;">
		<div class="box-header">
			<?php if($is_devteam): ?>
				<a href="<?php echo base_url('proyek/tambah'); ?>" class="btn btn-primary"><span class="fa fa-plus fa-fw"></span> Tambah Proyek</a>
			<?php endif; ?>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-10">
					<div class="pull-right">
						<input type="text" class="form-control" name="search" placeholder="Cari...">
					</div>
				</div>
			</div>

		</div>
		<div class="box-body">
			<?php if($projects == FALSE): ?>
				<p>Tidak ada proyek yang ditampilkan.</p>
			<?php return; endif; ?>
			<?php foreach($projects as $project): ?>
				<div class="box box-solid">
					<div class="box-body">
						<div class="col-md-2">
							<img src="<?php echo base_url('assets/uploads/projects/thumbs/' . $project['project_path_img']); ?>" alt="<?php echo $project['project_path_img'] ?>" style="width: 170px;height: 120px;">
						</div>
						<div class="col-md-7">
							<h4 style="margin-top: 0"><?php echo $project['project_name']; ?></h4>
							<p>Mulai <?php echo rupiah($project['lowest_price']); ?></p>
							<p>
								<?php
								$area = $this->area_model->get_prov_kec($project['area_id']);
								$area_name = trim($area['area_name']);
								if($area['induk'])
								{
									$area_name .= ', ' . $area['induk'];
									if($area['induk2'])
									{
										$area_name .= ', ' . $area['induk2'];
									}
								}
								if($project['project_gmaps'])
								{
									$fa = '<span class="fa fa-map-marker"></span> ';
									//echo anchor($project['project_gmaps'], $fa . $project['area_name'], 'target="_blank"');
									echo anchor($project['project_gmaps'], $fa . $area_name, 'target="_blank"');
								}
								else
								{
									//echo $project['area_name'];
									echo $area_name;
								}
								?>								
							</p>
						</div>
						<div class="col-md-3">
							<div class="btn-group pull-right">
								<button type="button" class="btn btn-default">--- Pilihan ---</button>
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="<?php echo base_url('proyek/detil/' . $project['project_id']); ?>"><span class="fa fa-eye fa-fw"></span> Lihat Detil</a></li>
									<li><a href="<?php echo base_url('proyek/edit/' . $project['project_id']); ?>"><span class="fa fa-pencil fa-fw"></span> Edit</a></li>
									<li class="disabled"><a href=""><span class="fa fa-trash fa-fw"></span> Hapus</a></li>
									<li class="divider"></li>
									<li><a href="#"><span class="fa fa-users fa-fw"></span> Marketing/Agency</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>