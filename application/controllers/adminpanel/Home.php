<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Home extends MY_Controller
{
    private $class_link = 'adminpanel/home';

    public function __construct()
    {
        parent::__construct();
        if ($_SESSION['auth']['module'] != 'adminpanel') {
            redirect('/');
        }
    }

    public function index()
    {
        parent::admin_tpl();
        parent::ionicons_assets();
        parent::typeahead_assets();
        parent::handlebar_assets();
        $this->load->js('assets/admin_lte/custom/custom_js.js');
        $this->load->js('assets/admin_lte/custom/home_js.js');

        $data = [
            'class_link' => $this->class_link,
        ];

        $this->load->view('pages/' . $this->class_link . '/mydashboard', $data);
    }

    public function load_data_statistics()
    {
        $this->load->model(['base_model']);
        $data = [
            'doctors' => $this->base_model->count_data('doctors'),
            'polies' => $this->base_model->count_data('polies'),
            'customer' => $this->base_model->count_data('customer'),
            'checkups' => $this->base_model->count_data('checkups', ['DATE(date_in)' => date('Y-m-d')]),
        ];

        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }
}
