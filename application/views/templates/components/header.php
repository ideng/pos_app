<header class="main-header">
	<!-- Logo -->
	<a href="<?php echo base_url(); ?>" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>SIM</b>K</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b><?php echo APP_NAME; ?></b></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url('assets/admin_lte/dist/img/user2-160x160.jpg'); ?>" class="user-image" alt="User Image">
						<span class="hidden-xs"><?php echo $_SESSION['auth']['name']; ?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="<?php echo base_url('assets/admin_lte/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
							<p>
								<?php echo $_SESSION['auth']['name']; ?> - <?php echo $user_privilege->name; ?>
								<small>Member sejak <?php echo format_date($_SESSION['auth']['created_at'], 'M. Y'); ?></small>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="#" class="btn btn-default btn-flat">Profil</a>
							</div>
							<div class="pull-right">
								<a href="<?php echo base_url('adminpanel/auth/logout'); ?>" class="btn btn-default btn-flat">Logout</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
