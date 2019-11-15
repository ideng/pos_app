<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->library(['session']);
		$this->load->helper(['basic_helper', 'alert_helper', 'key_helper', 'url', 'html']);
	}

	public function admin_tpl()
	{
		if (isset($_SESSION['auth']['id'])) {
			$this->load->model(['base_model']);
			$this->output->set_template('admin_tpl');
			$this->load->helper(['menu_renderer_helper']);

			// Render doctors schedule Yearly

			// Delete unused files in server
			$this->base_model->delete_unused_files('assets/uploads/img/customer/', 'customer', 'image');
			$this->base_model->delete_unused_files('assets/uploads/img/doctors/', 'doctors', 'image');
			$this->base_model->delete_unused_files('assets/uploads/img/employees/', 'employees', 'image');

			$breadcrumbs = [
				'uris' => $this->uri->segment_array()
			];
			//$user_privilege = $this->base_model->get_row('user_privileges', ['user_id' => $_SESSION['auth']['id']]);
			$user_privilege = $this->base_model->get_row('user_privileges', ['user_id' => $_SESSION['auth']['id']], []);
			$menus = [
				'menu_privileges' => $this->base_model->get_all('menu_privileges', ['privilege_id' => $user_privilege->privilege_id], []),
				'menu_level_ones' => $this->base_model->get_all('menus', ['level' => '0', 'modul' => $_SESSION['auth']['module']], ['order' => 'ASC'], []),
				'menu_level_twos' => $this->base_model->get_all('menus', ['level' => '1', 'modul' => $_SESSION['auth']['module']], ['order' => 'ASC'], []),
				'menu_level_threes' => $this->base_model->get_all('menus', ['level' => '2', 'modul' => $_SESSION['auth']['module']], ['order' => 'ASC'], []),
			];
			$privilege = [
				'user_privilege' => $this->base_model->get_row('privileges', ['id' => $user_privilege->privilege_id], []),
			];

			$this->load->section('header', 'templates/components/header', $privilege);
			$this->load->section('sidebar', 'templates/components/dbsidebar', $menus);
			$this->load->section('breadcrumb', 'templates/components/breadcrumb', $breadcrumbs);
			$this->load->section('footer', 'templates/components/footer');
		} else {
			redirect('/');
		}
	}

	public function admin_print_tpl()
	{
		if (isset($_SESSION['auth']['id'])) {
			$this->output->set_template('admin_print_tpl');
		} else {
			redirect('adminpanel/auth');
		}
	}

	public function admin_login_tpl()
	{
		if (!isset($_SESSION['auth']['id'])) {
			$this->output->set_template('admin_login_tpl');
		} else {
			redirect($_SESSION['auth']['module'] . '/home');
		}
	}

	public function error_tpl()
	{
		$this->output->set_template('error_tpl');
	}

	public function datatables_assets()
	{
		$this->load->css('assets/admin_lte/plugins/datatables-1.10.15/media/css/dataTables.bootstrap.min.css');
		$this->load->js('assets/admin_lte/plugins/datatables-1.10.15/media/js/jquery.dataTables.min.js');
		$this->load->js('assets/admin_lte/plugins/datatables-1.10.15/media/js/dataTables.bootstrap.min.js');
	}

	public function tableresponsive_assets()
	{
		$this->load->css('assets/admin_lte/plugins/datatables-1.10.15/extensions/responsive/css/responsive.bootstrap.min.css');
		$this->load->js('assets/admin_lte/plugins/datatables-1.10.15/extensions/responsive/js/dataTables.responsive.min.js');
		$this->load->js('assets/admin_lte/plugins/datatables-1.10.15/extensions/responsive/js/responsive.bootstrap.min.js');
	}

	public function tablefixed_assets()
	{
		$this->load->css('assets/admin_lte/plugins/datatables-1.10.15/extensions/fixedcolumns/css/fixedcolumns.bootstrap.min.css');
		$this->load->js('assets/admin_lte/plugins/datatables-1.10.15/extensions/fixedcolumns/js/datatables.fixedcolumns.min.js');
	}

	public function fullcalendar_assets()
	{
		$this->load->css('assets/admin_lte/plugins/fullcalendar-4.2.0/packages/core/main.min.css');
		$this->load->css('assets/admin_lte/plugins/fullcalendar-4.2.0/packages/daygrid/main.min.css');
		$this->load->css('assets/admin_lte/plugins/fullcalendar-4.2.0/packages/timegrid/main.min.css');
		$this->load->css('assets/admin_lte/plugins/fullcalendar-4.2.0/packages/list/main.min.css');
		// $this->load->css('assets/admin_lte/custom/css/mycalendar.css');
		$this->load->js('assets/admin_lte/plugins/fullcalendar-4.2.0/packages/core/main.js');
		$this->load->js('assets/admin_lte/plugins/fullcalendar-4.2.0/packages/core/locales-all.js');
		$this->load->js('assets/admin_lte/plugins/fullcalendar-4.2.0/packages/interaction/main.js');
		$this->load->js('assets/admin_lte/plugins/fullcalendar-4.2.0/packages/daygrid/main.js');
		$this->load->js('assets/admin_lte/plugins/fullcalendar-4.2.0/packages/timegrid/main.js');
		$this->load->js('assets/admin_lte/plugins/fullcalendar-4.2.0/packages/list/main.js');
	}

	public function moment_assets()
	{
		$this->load->js('assets/admin_lte/plugins/moment.js/moment.min.js');
	}

	public function typeahead_assets()
	{
		$this->load->js('assets/admin_lte/plugins/typeahead.js/dist/typeahead.bundle.min.js');
		$this->load->css('assets/admin_lte/plugins/typeahead.js/dist/typeahead.css');
	}

	public function datetimepicker_assets()
	{
		$this->load->css('assets/admin_lte/plugins/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css');
		$this->load->js('assets/admin_lte/plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js');
	}

	public function icheck_assets()
	{
		$this->load->css('assets/admin_lte/plugins/iCheck/flat/blue.css');
		$this->load->js('assets/admin_lte/plugins/iCheck/icheck.min.js');
	}

	public function ionicons_assets()
	{
		$this->load->css('assets/admin_lte/bootstrap/fonts/ionicons-2.0.1/css/ionicons.min.css');
	}

	public function handlebar_assets()
	{
		$this->load->js('assets/admin_lte/plugins/handlebars-v4.1.2/handlebars-v4.1.2.js');
	}

	public function chart_assets()
	{
		$this->load->js('assets/admin_assets/vendors/raphael/raphael.min.js');
		$this->load->js('assets/admin_assets/vendors/morris.js/morris.min.js');
		$this->load->js('assets/admin_assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js');
	}

	public function daterangepicker_assets()
	{
		$this->load->css('assets/admin_assets/vendors/bootstrap-daterangepicker/daterangepicker.css');
		$this->load->js('assets/admin_assets/js/moment/moment.min.js');
		$this->load->js('assets/admin_assets/vendors/bootstrap-daterangepicker/daterangepicker.js');
	}
}
