<?php
defined('BASEPATH') or exit('No direct script access allowed!');
?>

<div class="login-box" style="margin: 5% auto;">
    <div class="login-logo">
        <a href="<?php echo base_url(); ?>"><b><?php echo APP_NAME; ?></b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <div class="form-alert"></div>
        <form method="POST" id="formLogin">
            <input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_value; ?>">
            <input type="hidden" name="url" value="<?php echo base_url($class_link . '/do_login'); ?>">
            <div class="form-group has-feedback">
                <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>
    </div>
</div>
