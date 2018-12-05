<?php 
$roles = array_column($this->session->userdata('user_roles'), 'role_id');
$role_types = array_column($this->session->userdata('user_roles'), 'role_type_id');
$is_employee = in_array(1, $role_types);
$is_developer = in_array(2, $role_types);
$is_agency = in_array(3, $role_types);
$is_marketing = in_array(4, $role_types);
$is_owner_developer = in_array(2, $roles);
$is_owner_agency = in_array(4, $roles);
//print_r($available_roles);

?>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel --
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->
      <!-- search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <!--li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li-->
        <?php if($is_employee || $is_marketing) { ?>
          <li><a href="<?php echo base_url('user/profile'); ?>"><i class="fa fa-user"></i> <span>Profil</span></a></li>
        <?php if($is_employee) { ?>
          <li><a href="<?php echo base_url('user'); ?>"><i class="fa fa-users"></i> <span>Manajemen User</span></a></li>
        <?php } ?>
        <?php } else { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Profil</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('user/profile'); ?>"><i class="fa fa-circle-o"></i> Profil Saya</a></li>
              <?php if($is_developer){ ?>
                <li><a href="<?php echo base_url('developer/profile'); ?>"><i class="fa fa-circle-o"></i> Profil Developer</a></li>
              <?php } else { ?>
                <!-- <li><a href="#"><i class="fa fa-circle-o"></i> Profil Agency</a></li> -->
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

        <?php if(!$is_employee){ ?>
          <li><a href="<?php echo base_url('proyek/developer'); ?>"><i class="fa fa-building"></i> <span>Proyek</span></a></li>
          <?php if($is_agency) { ?>
            <!-- <li><a href="#"><i class="fa fa-address-card"></i> <span>Marketing</span></a></li> -->
          <?php } ?>
          <!-- <li><a href="#"><i class="fa fa-address-book"></i> <span>Konsumen</span></a></li> -->
          <!-- <li><a href="#"><i class="fa fa-calendar"></i> <span>Survey</span></a></li> -->
          <!-- <li><a href="#"><i class="fa fa-book"></i> <span>Booking &amp; Akad</span></a></li> -->
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
        <!--small>Control panel</small-->
      </h1>
      <?php 
      if(isset($h2))
      {
        echo '<p>' . $h2 . '</p>';
      }
      if(isset($h3))
      {
        echo '<p>' . $h3 . '</p>';
      }
      ?>
      <!--ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol-->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!--div class="col-xs-12"-->
