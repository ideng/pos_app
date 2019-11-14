<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Schedule extends MY_Controller
{
    private $class_name = 'schedule';
    private $class_link = 'adminpanel/schedule';

    public function __construct()
    {
        parent::__construct();
        if ($_SESSION['auth']['module'] != 'adminpanel') {
            redirect('/');
        }
    }

    public function _remap($method, array $args = [])
    {
        if (method_exists($this, $method)) {
            $this->{$method}($args);
        } else {
            $this->index($method);
        }
    }

    public function index($method)
    {
        parent::admin_tpl();
        parent::datatables_assets();
        parent::typeahead_assets();
        parent::moment_assets();
        parent::datetimepicker_assets();

        $data = [
            'class_link' => $this->class_link,
            'page' => $method,
        ];
        $this->load->js('assets/admin_lte/custom/custom_js.js');
        $this->load->js('assets/admin_lte/custom/masters_js.js');
        $this->load->view('pages/' . $this->class_link . '/index', $data);
    }

    public function load_table()
    {
        $page = $this->input->get('page');
        $page_url = $this->input->get('page_url');
        $data = [
            'class_link' => $this->class_link,
            'page' => $page,
        ];

        $this->load->view('pages/' . $page_url . '/table', $data);
    }

    public function table_data()
    {
        $page = $this->input->get('page');
        $this->load->library(['custom_ssp']);
        $this->load->model([$this->class_name . '/' . $page]);

        $data = $this->{$page}->ssp_table();
        $this->output->set_output(json_encode(
            Custom_ssp::simple($_GET, $data['sql_details'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['where'], $data['group_by'], $data['having'])
        ));
    }

    public function load_detail()
    {
        $this->load->model(['base_model']);
        $id = $this->input->get('id');
        $page_url = $this->input->get('page_url');
        $page = $this->input->get('page');
        if ($page == 'gudang') {
            $page = $this->input->get('page');
            $this->load->model(['base_model', $this->class_name . '/' . $page]);
            $id = $this->input->get('id');
            $id = empty($id) ? '' : $this->input->get('id');
            $id_mutasi = empty($id) ? '' : $this->input->get('id');
            $id_mutasi_jual = empty($id) ? '' : $this->input->get('id');
            $id_mutasi_checkup = empty($id) ? '' : $this->input->get('id');
            $page_url = $this->input->get('page_url');
            $row = $this->{$page}->get_row($id);
        } else {
            $row = $this->base_model->get_row($page, ['id' => $id]);
        }

        $data = [
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
            'class_link' => $this->class_link,
            'page' => $page,
            'row' => $row,
        ];
        if ($page == 'gudang') {
            $this->load->model(['schedule/gudang']);
            $data['drugs'] = $this->gudang->get_drugs($id);
            $data['mutasi_beli'] = $this->gudang->get_mutasi_beli($id_mutasi);
            $data['mutasi_jual'] = $this->gudang->get_mutasi_jual($id_mutasi_jual);
            $data['mutasi_checkup'] = $this->gudang->get_mutasi_checkup($id_mutasi_checkup);
        }

        $this->load->view('pages/' . $page_url . '/detail', $data);
    }

    public function load_form()
    {
        $page = $this->input->get('page');
        $this->load->helper(['form']);
        $this->load->model(['base_model', $this->class_name . '/' . $page]);
        $id = $this->input->get('id');
        $page_url = $this->input->get('page_url');
        $row = $this->base_model->get_row($page, ['id' => $id]);
        if ($page == 'gudang') {
            $row = $this->{$page}->get_row($id);
        }
        $data = [
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
            'class_link' => $this->class_link,
            'page' => $page,
            'row' => $row,
        ];
        if ($page == 'gudang') {
            $this->load->model(['schedule/gudang']);
            $data['record'] =  $this->gudang->tampil_data();
            $data['type'] = $this->gudang->get_type_drugs();
            $drugs = $this->gudang->get_type($row->type_id);
            $data = array_merge($data, ['gudang' => $drugs]);
        }
        $this->load->view('pages/' . $page_url . '/form', $data);
    }

    public function submit_form()
    {
        $page = $this->input->post('page');
        $this->load->library(['form_validation']);
        $this->load->model([$this->class_name . '/' . $page, 'base_model']);

        $title = $this->{$page}->_get('title');
        $this->{$page}->form_rules();
        if ($this->form_validation->run() == FALSE) {
            $msgs = $this->base_model->form_warning($this->input->post());
            $data['msg'] = build_alert('warning', 'Warning!', implode('', $msgs));
            $data['status'] = 'error';
        } else {
            $submit = $this->{$page}->post_data($this->input->post());
            if (isset($submit['status']) && $submit['status'] == 'error') {
                $data['msg'] = $submit['msg'];
                $data['status'] = $submit['status'];
            } else {
                $data = $this->base_model->submit_data($page, 'id', $title, $submit);
            }
            $data['csrf_val'] = $this->security->get_csrf_hash();

            $this->output
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data));
        }
    }

    public function delete_data()
    {
        $page = $this->input->get('page');
        $this->load->model([$this->class_name . '/' . $page, 'base_model']);

        $id = $this->input->get('id');
        $title = $this->{$page}->_get('title');

        $data = $this->base_model->delete_data($page, ['id' => $id], $title);

        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }
}
