<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title><?php echo APP_NAME; ?></title>
	<link rel="shortcut icon" href='<?php echo base_url('assets/admin_lte/dist/img/clinic_icon.png'); ?>'>

	<link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/bootstrap/fonts/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/dist/css/AdminLTE.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/dist/css/skins/_all-skins.min.css'); ?>">

	<?php
    /** -- Copy from here -- */
    if (!empty($meta)) {
        foreach ($meta as $name => $content) {
            echo "\n\t\t"; ?>
			<meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
        }
        echo "\n";
    }
    if (!empty($canonical)) {
        echo "\n\t\t"; ?>
		<link rel="canonical" href="<?php echo $canonical ?>" />
		<?php
    }
    echo "\n\t";

    foreach ($css as $file) {
        echo "\n\t\t"; ?>
		<link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
    }
    echo "\n\t";
    /** -- to here -- */
    ?>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
	<div class="wrapper">

		<?php echo $this->load->get_section('header'); ?>

		<?php echo $this->load->get_section('sidebar'); ?>

		<div class="content-wrapper">
			<section class="content-header">
				<?php echo $this->load->get_section('breadcrumb'); ?>
			</section>

			<section id="idMainContent" class="content" style="padding-bottom: 250px;">

				<?php echo $output; ?>

			</section>
		</div>

		<?php echo $this->load->get_section('footer'); ?>

		<?php echo $this->load->get_section('control_sidebar'); ?>
	</div>

	<script src="<?php echo base_url('assets/admin_lte/plugins/jQuery/jquery-3.3.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin_lte/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin_lte/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin_lte/plugins/fastclick/fastclick.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin_lte/dist/js/app.min.js'); ?>"></script>
	<?php
    foreach ($js as $file) {
        echo "\n\t\t"; ?><script src="<?php echo $file; ?>"></script><?php
    }
    echo "\n\t";
    ?>
</body>

</html>