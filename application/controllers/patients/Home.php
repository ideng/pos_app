<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Home extends MY_Controller
{
    private $class_link = 'patients/home';

    public function __construct()
    {
        parent::__construct();
        if ($_SESSION['auth']['module'] != 'customer') {
            redirect('/');
        }
    }

    public function index()
    {
        parent::admin_tpl();
        $this->load->model(['base_model', 'admission/checkups']);
        $this->load->model(['base_model', 'schedule/daily_schedules']);

        $data['patient'] = $this->base_model->get_row('customer', ['user_id' => $_SESSION['auth']['id']]);
        $data['checkups'] = $this->checkups->get_all_with_join($data['patient']->id);
        $data['daily_schedules'] = $this->daily_schedules->date_now('daily_schedules');

        $this->load->view('pages/' . $this->class_link . '/mydashboard', $data);
    }
}
