<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-body">
			<!--<p><strong>Deskripsi</strong></p>-->
			<h4 style="margin-bottom: 0;">Deskripsi:</h4>
			<div class="row"><div class="col-md-12"><?php echo $project['project_description']; ?></div></div>
			<hr>
			<h4>Galeri: <?php if ($is_devteam) { include 'add_gallery.php'; } ?></h4>
      <div class="row">
        <?php foreach($project_gallery as $gallery): ?>
        <div class="responsive">
        <div class="gallery">  <!-- gambar col-md-3 col-sm-4 -->
          <a target="_blank" href="<?php echo base_url('assets/uploads/projects/') . $gallery['path_file']; ?>">
            <img src="<?php echo base_url('assets/uploads/projects/') . $gallery['path_file']; ?>" width="400" height="600" >
          </a>
          <?php if($is_devteam): ?>
          <div class="desc">
            <!-- <a href="#" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</a> -->
            <!-- <a href="#" class="btn btn-danger form-control"><i class="fa fa-trash-o"></i> Hapus</a> -->
            <?php include 'hapus_gallery.php'; ?>
          </div>
          <?php endif; ?>
        </div>
        </div>
        <?php endforeach; ?>
      </div>
      <hr>
			<h4>Tipe Unit</h4>

      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_unit" data-toggle="tab">View Unit</a></li>
              <li><a href="#tab_tipe" data-toggle="tab">View Tipe</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_unit">
              <?php if($is_devteam): ?>
                	<div class="margin">
	                <?php include 'add_unit.php'; ?>
	                <?php include 'add_type.php'; ?>
                	</div>
              <?php endif; ?>
              <?php include 'list_unit.php'; ?>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_tipe">
              <?php if($is_devteam): ?>
                <div class="margin">
                  <?php include 'add_unit.php'; ?>
                  <?php include 'add_type.php'; ?>
                </div>
              <?php endif; ?>
              <?php include 'list_type.php'; ?>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
      <!-- END CUSTOM TABS -->


			<h4 style="margin-bottom: 0;">Catatan Agency/Marketing:</h4>
			<div class="row"><div class="col-md-12"><?php echo $project['project_note']; ?></div></div>
		</div>
	</div>
</div>

<!--<pre><?php //var_dump($project); ?></pre>-->
