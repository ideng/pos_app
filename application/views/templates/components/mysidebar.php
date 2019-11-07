<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$total_uri = count($uris);
$parent = $this->uri->segment($total_uri - 1);
$child = $this->uri->segment($total_uri);
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/admin_lte/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['auth']['name']; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li <?php echo empty($child) || $child == 'administrator' || $child == 'home' ? 'class=\'active\'' : ''; ?>>
                <a href="<?php echo base_url('administrator/home'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview <?php echo $parent == 'master' ? 'active' : ''; ?>">
                <a href="#">
                    <i class="fa fa-archive"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php echo $parent == 'master' && $child == 'users' ? 'class=\'active\'' : ''; ?>>
                        <a href="<?php echo base_url('administrator/master/users'); ?>"><i class="fa fa-circle-o"></i> Users</a>
                    </li>
                    <li <?php echo $parent == 'master' && $child == 'polies' ? 'class=\'active\'' : ''; ?>>
                        <a href="<?php echo base_url('administrator/master/polies'); ?>"><i class="fa fa-circle-o"></i> Polies</a>
                    </li>
                    <li <?php echo $parent == 'master' && $child == 'doctors' ? 'class=\'active\'' : ''; ?>>
                        <a href="<?php echo base_url('administrator/master/doctors'); ?>"><i class="fa fa-circle-o"></i> Doctors</a>
                    </li>
                    <li <?php echo $parent == 'master' && $child == 'employees' ? 'class=\'active\'' : ''; ?>>
                        <a href="<?php echo base_url('administrator/master/employees'); ?>"><i class="fa fa-circle-o"></i> Employees</a>
                    </li>
                    <li <?php echo $parent == 'master' && $child == 'patients' ? 'class=\'active\'' : ''; ?>>
                        <a href="<?php echo base_url('administrator/master/patients'); ?>"><i class="fa fa-circle-o"></i> Patients</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?php echo $parent == 'schedule' ? 'active' : ''; ?>">
                <a href="#">
                    <i class="fa fa-calendar"></i> <span>Schedules</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php echo $parent == 'schedule' && $child == 'doctors' ? 'class=\'active\'' : ''; ?>>
                        <a href="<?php echo base_url('administrator/schedule/doctors'); ?>"><i class="fa fa-circle-o"></i> Doctor Schedules</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?php echo $parent == 'admission' ? 'active' : ''; ?>">
                <a href="#">
                    <i class="fa fa-address-book-o"></i> <span>Admission</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php echo $parent == 'admission' && $child == 'checkups' ? 'class=\'active\'' : ''; ?>>
                        <a href="<?php echo base_url('administrator/admission/checkups'); ?>"><i class="fa fa-circle-o"></i> Check Up</a>
                    </li>
                    <li <?php echo $parent == 'admission' && $child == 'diagnoses' ? 'class=\'active\'' : ''; ?>>
                        <a href="<?php echo base_url('administrator/admission/diagnoses'); ?>"><i class="fa fa-circle-o"></i> Diagnose</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?php echo $parent == 'pharmacy' ? 'active' : ''; ?>">
                <a href="#">
                    <i class="fa fa-hospital-o"></i> <span>Pharmacy</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php echo $parent == 'pharmacy' && $child == 'drugs' ? 'class=\'active\'' : ''; ?>>
                        <a href="<?php echo base_url('administrator/pharmacy/drugs'); ?>"><i class="fa fa-circle-o"></i> Drugs</a>
                    </li>
                    <li <?php echo $parent == 'pharmacy' && $child == 'drug_sales' ? 'class=\'active\'' : ''; ?>>
                        <a href="<?php echo base_url('administrator/pharmacy/drug_sales'); ?>"><i class="fa fa-circle-o"></i> Drug Store</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?php echo $parent == 'setting' || $parent == 'code_generator' ? 'active' : ''; ?>">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Setting</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview <?php echo $parent == 'code_generator' ? 'active' : ''; ?>">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> <span>Code Generator</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li <?php echo $parent == 'code_generator' && $child == 'patients' ? 'class=\'active\'' : ''; ?>>
                                <a href="<?php echo base_url('administrator/setting/code_generator/patients'); ?>"><i class="fa fa-circle-o"></i> Patients</a>
                            </li>
                            <li <?php echo $parent == 'code_generator' && $child == 'doctors' ? 'class=\'active\'' : ''; ?>>
                                <a href="<?php echo base_url('administrator/setting/code_generator/doctors'); ?>"><i class="fa fa-circle-o"></i> Doctors</a>
                            </li>
                            <li <?php echo $parent == 'code_generator' && $child == 'employees' ? 'class=\'active\'' : ''; ?>>
                                <a href="<?php echo base_url('administrator/setting/code_generator/employees'); ?>"><i class="fa fa-circle-o"></i> Employees</a>
                            </li>
                            <li <?php echo $parent == 'code_generator' && $child == 'checkups' ? 'class=\'active\'' : ''; ?>>
                                <a href="<?php echo base_url('administrator/setting/code_generator/checkups'); ?>"><i class="fa fa-circle-o"></i> Medical Record</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo $child == 'privilege' ? 'class=\'active\'' : ''; ?>>
                        <a href="<?php echo base_url('administrator/setting/privilege'); ?>">
                            <i class="fa fa-circle-o"></i> Privilege
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>