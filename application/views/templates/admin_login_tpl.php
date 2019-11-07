<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo APP_NAME; ?> | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="shortcut icon" href='<?php echo base_url('assets/admin_lte/dist/img/clinic_icon.png'); ?>'>
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/bootstrap/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/bootstrap/fonts/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/bootstrap/fonts/ionicons-2.0.1/css/ionicons.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/dist/css/AdminLTE.min.css'); ?>">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url('assets/admin_lte/plugins/iCheck/square/blue.css'); ?>">

        <?php
        /** -- Copy from here -- */
        if(!empty($meta)) {
            foreach($meta as $name=>$content){
            echo "\n\t\t";
                ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
            }
            echo "\n";
        }
        if(!empty($canonical)) {
            echo "\n\t\t";
                ?><link rel="canonical" href="<?php echo $canonical?>" /><?php
        }
        echo "\n\t";
            
        foreach($css as $file) {
            echo "\n\t\t";
                ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
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
    <body class="hold-transition login-page">
        <?php echo $output; ?>

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url('assets/admin_lte/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo base_url('assets/admin_lte/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/admin_lte/plugins/iCheck/icheck.min.js'); ?>"></script>
		<?php
		foreach($js as $file) {
			echo "\n\t\t";
				?><script src="<?php echo $file; ?>"></script><?php
		}
		echo "\n\t";
		?>
        <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
        </script>
    </body>
</html>
