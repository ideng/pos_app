<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Privilege extends MY_Controller
{
    private $class_name = 'privilege';
    private $class_link = 'adminpanel/setting/privilege';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        parent::admin_tpl();
        parent::datatables_assets();
        parent::icheck_assets();
        $data = [
            'class_link' => $this->class_link,
        ];
        $this->load->js('assets/admin_lte/custom/custom_js.js');
        $this->load->js('assets/admin_lte/custom/masters_js.js');
        $this->load->js('assets/admin_lte/custom/privilege_js.js');
        $this->load->view('pages/' . $this->class_link . '/index', $data);
    }

    public function load_table()
    {
        $data = [
            'class_link' => $this->class_link,
        ];
        $this->load->view('pages/' . $this->class_link . '/table', $data);
    }

    public function table_data()
    {
        $this->load->library(['custom_ssp']);
        $this->load->model(['setting/privileges']);

        $data = $this->privileges->ssp_table();
        $this->output->set_output(json_encode(
            Custom_ssp::simple($_GET, $data['sql_details'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['where'])
        ));
    }

    public function load_detail()
    {
        $this->load->model(['base_model']);
        $id = $this->input->get('id');

        $data = [
            'row' => $this->base_model->get_row('privileges', ['id' => $id]),
        ];
        $this->load->view('pages/' . $this->class_link . '/detail', $data);
    }

    public function load_form()
    {
        $this->load->model(['base_model']);
        $this->load->helper(['flag']);
        $id = $this->input->get('id');

        $data = [
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
            'class_link' => $this->class_link,
            'row' => $this->base_model->get_row('privileges', ['id' => $id]),
        ];
        $this->load->view('pages/' . $this->class_link . '/form', $data);
    }

    public function submit_form()
    {
        $this->load->library(['form_validation']);
        $this->load->model(['setting/privileges', 'base_model']);

        $title = $this->privileges->_get('title');
        $this->privileges->form_rules();
        if ($this->form_validation->run() == FALSE) {
            $msgs = $this->base_model->form_warning($this->input->post());
            $data['msg'] = build_alert('warning', 'Warning!', implode('', $msgs));
            $data['status'] = 'error';
        } else {
            $submit = $this->privileges->post_data($this->input->post());
            $data = $this->base_model->submit_data('privileges', 'id', $title, $submit);
        }
        $data['csrf_val'] = $this->security->get_csrf_hash();

        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }

    public function delete_data()
    {
        $this->load->model(['setting/privileges', 'base_model']);

        $id = $this->input->get('id');
        $title = $this->privileges->_get('title');

        $data = $this->base_model->delete_data('privileges', ['id' => $id], $title);

        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }

    public function load_form_menu()
    {
        $this->load->model(['base_model']);
        $this->load->helper(['menu_renderer']);
        $id = $this->input->get('id');
        $row = $this->base_model->get_row('privileges', ['id' => $id]);

        $data = [
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
            'class_link' => $this->class_link,
        ];
        if (!empty($row->id)) {
            $data = array_merge($data, [
                'row' => $row,
                'menu_privileges' => $this->base_model->get_all('menu_privileges', ['privilege_id' => $id]),
                'level_one_menus' => $this->base_model->get_all('menus', ['level' => '0', 'modul' => $row->module]),
                'level_two_menus' => $this->base_model->get_all('menus', ['level' => '1', 'modul' => $row->module]),
                'level_three_menus' => $this->base_model->get_all('menus', ['level' => '2', 'modul' => $row->module]),
            ]);
        }
        $this->load->view('pages/' . $this->class_link . '/form_menu', $data);
    }

    public function submit_form_menu()
    {
        $this->load->model(['setting/privileges', 'base_model']);

        $title = $this->privileges->_get('title');
        $submit = $this->privileges->post_menu_data($this->input->post());
        $data = $this->base_model->submit_batch('menu_privileges', $title, $submit);
        $data['submit'] = $submit;
        $data['csrf_val'] = $this->security->get_csrf_hash();

        $this->output
            ->set_content_type('application/json', 'utf8')
            ->set_output(json_encode($data));
    }
}
