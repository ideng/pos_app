<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo APP_NAME . ' | Cetak Data'; ?></title>
    <?php echo $this->load->get_section('favicon'); ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/bootstrap/fonts/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/dist/css/AdminLTE.min.css'); ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-red sidebar-mini fixed" onload="window.print()">
    <div class="wrapper">

        <section id="idMainContent" class="content">

          <?php echo $output; ?>

        </section>
    </div>

    <script src="<?php echo base_url('assets/admin_lte/plugins/jQuery/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin_lte/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin_lte/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin_lte/dist/js/app.min.js'); ?>"></script>
  </body>
</html>