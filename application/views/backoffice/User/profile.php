<div class="col-md-6">
	<?php //print_r($user); ?>
	<div class="box box-primary">
		<div class="box-body box-profile">
			<ul class="list-group list-group-unbordered">
				<li class="list-group-item">
					<b>Username</b><a class="pull-right"><?php echo $user['username']; ?></a>
				</li>
				<li class="list-group-item">
					<b>Nama Lengkap</b><a class="pull-right"><?php echo $user['full_name']; ?></a>
				</li>
				<li class="list-group-item">
					<?php $jk = ($user['gender_id'] == 1) ? "Laki-Laki" : "Perempuan"; ?>
					<b>Jenis Kelamin</b><a class="pull-right"><?php echo $jk; ?></a>
				</li>
				<li class="list-group-item">
					<b>No. Telp/WhatsApp</b><a class="pull-right"><?php echo $user['phone']; ?></a>
				</li>
				<li class="list-group-item">
					<b>Email</b><a class="pull-right"><?php echo $user['email']; ?></a>
				</li>
			</ul>
		</div>
	</div>
</div>