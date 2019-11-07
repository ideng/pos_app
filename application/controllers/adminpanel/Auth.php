<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Auth extends MY_Controller {
    private $class_link = 'adminpanel/auth';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        parent::admin_login_tpl();
        $this->login_form();
    }

    public function login_form()
    {
		$this->load->helper(array('form'));
		$str = [
			'class_link' => $this->class_link,
			'csrf_name' => $this->security->get_csrf_token_name(),
			'csrf_value' => $this->security->get_csrf_hash(),
		];
		$this->load->js('assets/admin_lte/custom/custom_js.js');
		$this->load->js('assets/admin_lte/custom/login_js.js');
		$this->load->view('pages/'.$this->class_link.'/login_form', $str);
	}

	public function do_login()
	{
		$this->load->model(['base_model', 'auth_model']);
		$this->load->library(['form_validation']);

		$this->form_validation->set_rules($this->auth_model->form_rules());
		if (!$this->form_validation->run()) {
			$msg = $this->base_model->form_warning($this->input->post());
			$str['msg'] = build_alert('warning', 'Warning!', implode('', $msg));
			$str['status'] = 'error';
		} else {
			$data = [
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
			];
			$str = $this->auth_model->verify_login($data);
			$module = isset($_SESSION['auth']['module']) ? $_SESSION['auth']['module'] : '' ;
			$str['redirect'] = base_url($module);
		}
		$str['csrf_val'] = $this->security->get_csrf_hash();

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($str));
	}

	public function logout()
	{
		session_destroy();
		redirect('adminpanel/auth');
	}
}
