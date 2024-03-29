<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Vali Admin</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Si Surat</h1>
      </div>
      <div class="login-box">
        <form class="login-form" action="<?php echo base_url();?>index.php/login/do_login" method="post">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            <?php 
                $notif = $this->session->flashdata('notif');
                if(!empty($notif)){
                 echo '<div class="alert alert-danger">';
                 echo $notif;
                 echo '</div>';
            }
            ?>

          <div class="form-group">
            <label class="control-label">NIK</label>
            <input class="form-control" name="nik" type="number" placeholder="NIK" autofocus required="">
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" name="password" type="password" placeholder="Password" required="">
          </div>

          <div class="form-group btn-container">
            <input type="submit" class="btn btn-primary btn-block" value="SIGN IN">
          </div>
        </form>
      </div>
    </section>
  </body>
  <!-- Essential javascripts for application to work-->
  <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="<?php echo base_url();?>assets/js/plugins/pace.min.js"></script>
</html>
<script type="text/javascript">
  // Login Page Flipbox control
  $('.login-content [data-toggle="flip"]').click(function() {
  	$('.login-box').toggleClass('flipped');
  	return false;
  });
</script>