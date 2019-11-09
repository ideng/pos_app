<?php
defined('BASEPATH') or exit('No direct script access allowed!');
foreach ($menu_privileges as $menu_privilege) {
    $privilege[$menu_privilege->menu_id] = '1';
}
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
            <li class="header">MAIN MENU</li>
            <?php
            foreach ($menu_level_ones as $menu_level_one) {
                $is_active = '';
                //$is_active = ($this->uri->segment(2) == $menu_level_one->link) || ($menu_level_one->link == 'home' && empty($this->uri->segment(2))) ? 'class=\'active\'' : '' ;
                if ($menu_level_one->is_global || isset($privilege[$menu_level_one->id])) {
                    if ($menu_level_one->link != '#') {
                        ?>
                        <li <?php echo $is_active; ?>>
                            <a href="<?php echo base_url($menu_level_one->modul . '/' . $menu_level_one->link); ?>">
                                <i class="<?php echo $menu_level_one->icon; ?>"></i> <span><?php echo $menu_level_one->title; ?></span>
                            </a>
                        </li>
                    <?php
                            } else {
                                $is_active = $this->uri->segment(2) == $menu_level_one->name ? 'active' : '';
                                ?>
                        <li class="treeview <?php echo $is_active; ?>">
                            <a href="#">
                                <i class="<?php echo $menu_level_one->icon; ?>"></i> <span><?php echo $menu_level_one->title; ?></span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                            foreach ($menu_level_twos as $menu_level_two) {
                                                $is_active = $this->uri->segment(3) == $menu_level_two->link ? 'class=\'active\'' : '';
                                                if ($menu_level_two->parent_id == $menu_level_one->id && isset($privilege[$menu_level_two->id])) {
                                                    if ($menu_level_two->link != '#') {
                                                        ?>
                                            <li <?php echo $is_active; ?>>
                                                <a href="<?php echo base_url($menu_level_two->modul . '/' . $menu_level_one->name . '/' . $menu_level_two->link); ?>">
                                                    <i class="fa fa-circle-o"></i> <span><?php echo $menu_level_two->title; ?></span>
                                                </a>
                                            </li>
                                        <?php
                                                            } else {
                                                                $is_active = $this->uri->segment(3) == $menu_level_two->name ? 'active' : '';
                                                                ?>
                                            <li class="treeview <?php echo $is_active; ?>">
                                                <a href="#">
                                                    <i class="fa fa-circle-o"></i> <span><?php echo $menu_level_two->title; ?></span> <i class="fa fa-angle-left pull-right"></i>
                                                </a>
                                                <ul class="treeview-menu">
                                                    <?php
                                                                            foreach ($menu_level_threes as $menu_level_three) {
                                                                                $is_active = $this->uri->segment(4) == $menu_level_three->link ? 'class=\'active\'' : '';
                                                                                if ($menu_level_three->parent_id == $menu_level_two->id && isset($privilege[$menu_level_three->id])) {
                                                                                    ?>
                                                            <li <?php echo $is_active; ?>>
                                                                <a href="<?php echo base_url($menu_level_three->modul . '/' . $menu_level_one->name . '/' . $menu_level_two->name . '/' . $menu_level_three->link); ?>">
                                                                    <i class="fa fa-circle-o"></i> <span><?php echo $menu_level_three->title; ?></span>
                                                                </a>
                                                            </li>
                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                </ul>
                                            </li>
                                <?php
                                                    }
                                                }
                                            }
                                            ?>
                            </ul>
                        </li>
            <?php
                    }
                }
            }
            ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>