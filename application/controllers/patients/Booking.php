<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Booking extends MY_Controller
{
    private $class_link = 'patients/booking';

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
        parent::moment_assets();
        parent::fullcalendar_assets();
        parent::datetimepicker_assets();

        $data = [
            'class_link' => $this->class_link,
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
        ];

        $this->load->js('assets/admin_lte/custom/custom_js.js');
        $this->load->js('assets/admin_lte/custom/front_schedule_js.js');
        $this->load->view('pages/' . $this->class_link . '/index', $data);
    }

    public function load_form()
    {
        $this->load->helper(['number', 'flag']);
        $this->load->model(['base_model', 'admission/checkups', 'schedule/daily_schedules']);

        $daily_schedule = $this->daily_schedules->doctor_poly_schedule($this->input->get('id'));
        $schedule_start = $daily_schedule->date . ' ' . $daily_schedule->start_at;
        $schedule_end = $daily_schedule->date . ' ' . $daily_schedule->end_at;
        $patient = $this->base_model->get_row('customer', ['user_id' => $_SESSION['auth']['id']]);
        $checkup = $this->checkups->checkup_filter([
            'patient_id' => $patient->id,
            'doctor_id' => $daily_schedule->doctor_id,
            'poly_id' => $daily_schedule->poly_id,
            'date_in >=' => $schedule_start, 'date_in <=' => $schedule_end
        ]);
        $data = [
            'class_link' => $this->class_link,
            'page' => $this->input->get('page'),
            'daily_schedule' => $daily_schedule,
            'patient' => $patient,
            'checkup' => $checkup,
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
        ];
        $this->load->view('pages/' . $this->class_link . '/form', $data);
    }

    public function submit_form()
    {
        $this->load->library(['form_validation']);
        $this->load->model(['base_model', 'admission/checkups']);

        $this->checkups->form_booking_rules();
        if ($this->form_validation->run() === FALSE) {
            $msgs = $this->base_model->form_warning($this->input->post());
            $data['msg'] = build_alert('warning', 'Warning!', implode('', $msgs));
            $data['status'] = 'error';
        } else {
            $submit = $this->checkups->post_data_booking($this->input->post());
            $data = $this->base_model->submit_data('checkups', 'id', 'Data Booking Checkup', $submit);
        }
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_value'] = $this->security->get_csrf_hash();

        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }
}
