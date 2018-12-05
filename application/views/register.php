<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?> | MaPS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/adminlte/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/adminlte/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?php echo base_url(); ?>"><b>M</b>aPS</a>
  </div>

  <?php 
  if(validation_errors())
    {
      echo '<div class="alert alert-danger alert-dismissible">';
      echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      echo 'Terdapat kesalahan:<br><ol>';
      echo validation_errors('<li>', '</li>');
      echo '<ol></div>';
    }
  ?>

  <div class="register-box-body">
    <p class="login-box-msg">Daftar keanggotaan</p>

    <?php echo form_open('register'); ?>
    <h3>Profil</h3>
    <div class="form-group has-feedback">
      <input type="text" name="full_name" class="form-control" placeholder="Nama Lengkap" required="" value="<?php echo set_value('full_name'); ?>">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <?php foreach($gender as $gender): ?>
        <input type="radio" name="gender_id" value="<?php echo $gender['gender_id']; ?>" <?php echo set_radio('gender_id', $gender['gender_id']); ?>>&nbsp;&nbsp;<?php echo $gender['gender_name'] ?>
      <?php endforeach; ?>
    </div>
    <div class="form-group has-feedback">
      <input type="text" name="phone" class="form-control" placeholder="Nomor telp/WhatsApp" required="" value="<?php echo set_value('phone'); ?>">
    </div>
    <div class="form-group has-feedback">
      <select name="role" id="role" class="form-control">
        <!--<?php //foreach($role as $role): ?>
        <option value="<?php //echo $role['role_id']; ?>" <?php //echo set_select('role', $role['role_id']); ?>><?php //echo $role['role_type_name']; ?></option>
        <?php //endforeach; ?>-->
        <option value="3">Developer (Operator)</option>
        <option value="6">Marketing</option>
      </select>
    </div>
    <h3>Login detil</h3>
    <div class="form-group has-feedback">
      <input type="email" name="email" class="form-control" placeholder="Email" required="" value="<?php echo set_value('email'); ?>">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" name="password" class="form-control" placeholder="Password" required="">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" name="password2" class="form-control" placeholder="Ulangi Password" required="">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group">
      <button type="submit" name="submit" class="form-control btn btn-primary">Daftar Sekarang</button>
    </div>
    <?php echo form_close(); ?>

<!--    <form action="<?php //echo base_url(); ?>/assets/adminlte/index.html" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <-- /.col --
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <-- /.col --
      </div>
    </form>
-->
    <p>Sudah punya akun? <a href="<?php echo base_url('login'); ?>" class="text-center">Login</a></p>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>/assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>/assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>/assets/adminlte/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
