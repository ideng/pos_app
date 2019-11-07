<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Code_generator extends MY_Controller {
	private $class_name = 'code_generator';
	private $class_link = 'adminpanel/setting/code_generator';

	public function __construct()
	{
		parent::__construct();
	}

    public function _remap(string $method, array $args)
    {
        if (method_exists($this, $method)) {
            $this->{$method}($args);
        } else {
            $this->index($method);
        }
	}
	
	public function index(string $method)
	{
        parent::admin_tpl();
        $data = [
            'class_link' => $this->class_link,
            'page' => $method
        ];
		$this->load->js('assets/admin_lte/custom/custom_js.js');
		$this->load->js('assets/admin_lte/custom/code_generator_js.js');
        $this->load->view('pages/' . $this->class_link . '/index', $data);
	}

	public function load_view()
	{
		$this->load->model(['base_model', 'setting/code_generators']);
		$page = $this->input->get('page');
		$row = $this->base_model->get_row('code_generators', ['table' => $page]);
		$code_sample = $this->code_generators->generate_code($page);
		$data = [
			'row' => $row,
			'code_sample' => $code_sample,
		];
		
		$this->load->view('pages/' . $this->class_link . '/code_generator_view', $data);
	}

	public function load_form()
	{
        $this->load->model(['base_model', 'setting/code_generators']);
        $page = $this->input->get('page');
        $row = $this->base_model->get_row('code_generators', ['table' => $page]);
        
        $data = [
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
            'class_link' => $this->class_link,
            'page' => $page,
			'row' => $row,
			'code_reset_opts' => $this->code_generators->code_reset_opts(),
        ];
		$this->load->view('pages/' . $this->class_link . '/form', $data);
	}

	public function load_code_part_form()
	{
		$no = 0;
		$this->load->model(['base_model', 'setting/code_generators']);
		$page = $this->input->get('page');
		$code_generator = $this->base_model->get_row('code_generators', ['table' => $page]);
		$code_parts = $this->base_model->get_all('code_generator_parts', ['code_generator_id' => $code_generator->id]);
		$data = [
			'parts' => $this->code_generators->code_parts(),
			'separators' => $this->code_generators->code_separators(),
			'button' => 'plus',
			'code_part' => '',
			'code_unique' => '',
			'code_separator' => '',
		];

		if (!empty($code_parts)) {
			foreach ($code_parts as $code_part) {
				$no++;
				$data['button'] = $no > 1 ? 'minus' : $data['button'] ;
				$data['code_part'] = $code_part->code_part;
				$data['code_unique'] = $code_part->code_unique;
				$data['code_separator'] = $code_part->code_separator;

				$this->load->view('pages/' . $this->class_link . '/code_part_form', $data);
			}
		} else {
			$this->load->view('pages/' . $this->class_link . '/code_part_form', $data);
		}

	}

	public function add_code_format_form()
	{
		$this->load->model(['setting/code_generators']);
		$data = [
			'parts' => $this->code_generators->code_parts(),
			'separators' => $this->code_generators->code_separators(),
			'button' => 'minus',
			'code_part' => '',
			'code_unique' => '',
			'code_separator' => '',
		];
		$this->load->view('pages/' . $this->class_link . '/code_part_form', $data);
	}

	public function submit_form()
	{
		$data = [
			'inputs' => $this->input->post()
		];
		$this->load->library(['form_validation']);
		$this->load->model(['base_model', 'setting/code_generators']);

		$title = $this->code_generators->_get('title');
		$this->code_generators->form_rules();
		if ($this->form_validation->run() == FALSE) {
			$msgs = $this->base_model->form_warning($this->input->post());
			$data['msg'] = build_alert('warning', 'Warning!', implode('', $msgs));
			$data['status'] = 'error';
		} else {
            $master = $this->code_generators->post_data($this->input->post());
			$data = $this->base_model->submit_data('code_generators', 'id', $title, $master);
			if ($data['status'] == 'error') {
				$this->output
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($data));
				exit();
			}
			$master_key = $data['key'];
			$child = $this->code_generators->post_child_data($this->input->post(), $master_key);
			$data = $this->base_model->submit_batch('code_generator_parts', $title, $child['submit']);
			if ($data['status'] == 'error') {
				$this->output
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($data));
				exit();
			}
			$data = $this->base_model->submit_data('code_generators', 'id', $title, ['id' => $master_key, 'code_format' => $child['code_format']]);
		}
		$data['csrf_val'] = $this->security->get_csrf_hash();

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data));
	}
}