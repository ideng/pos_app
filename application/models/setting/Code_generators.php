<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Code_generators extends CI_Model
{
	private $table = 'code_generators';
	private $primary_key = 'id';
	private $title = 'Code Generator Data';

	public function _get($name)
	{
		return isset($this->{$name}) ? $this->{$name} : 'Error, Property not defined!';
	}

	public function code_reset_opts()
	{
		$opts = [
			0 => (object) ['key' => 'day', 'value' => 'Hari'],
			1 => (object) ['key' => 'month', 'value' => 'Bulan'],
			2 => (object) ['key' => 'year', 'value' => 'Tahun'],
			3 => (object) ['key' => 'none', 'value' => 'Tidak Ada'],
		];
		return $opts;
	}

	public function code_column($table)
	{
		if ($table == 'customer') {
			$column = 'patient_code';
		} elseif ($table == 'doctors') {
			$column = 'doctor_id';
		} elseif ($table == 'employees') {
			$column = 'employee_id';
		} elseif ($table == 'checkups') {
			$column = 'medical_record_id';
		} elseif ($table == 'supplier') {
			$column = 'supplier_code';
		} elseif ($table == 'purchase_return') {
			$column = 'no_retur';
		} elseif ($table == 'purchase') {
			$column = 'no_faktur';
		} elseif ($table == 'sales') {
			$column = 'no_faktur';
		} elseif ($table == 'sales_return') {
			$column = 'no_retur';
		}

		return $column;
	}

	public function code_parts()
	{
		$opts = [
			0 => (object) ['key' => 'yyyy', 'value' => 'Tahun (yyyy)'],
			1 => (object) ['key' => 'yy', 'value' => 'Tahun (yy)'],
			2 => (object) ['key' => 'mm', 'value' => 'Bulan (mm)'],
			4 => (object) ['key' => 'dd', 'value' => 'Hari (dd)'],
			6 => (object) ['key' => 'yyyy_roman', 'value' => 'Tahun Romawi (yyyy)'],
			7 => (object) ['key' => 'yy_roman', 'value' => 'Tahun Romawi (yy)'],
			8 => (object) ['key' => 'mm_roman', 'value' => 'Bulan Romawi (mm)'],
			10 => (object) ['key' => 'dd_roman', 'value' => 'Hari Romawi (dd)'],
			12 => (object) ['key' => 'urutan_angka', 'value' => 'Urutan Angka'],
			13 => (object) ['key' => 'kode_huruf', 'value' => 'Kode Unik'],
		];
		return $opts;
	}

	public function code_separators()
	{
		$opts = [
			0 => (object) ['key' => 'n', 'value' => 'Tidak Ada'],
			1 => (object) ['key' => '.', 'value' => 'Titik (.)'],
			2 => (object) ['key' => ',', 'value' => 'Koma (,)'],
			3 => (object) ['key' => '/', 'value' => 'Garis Miring (/)'],
			4 => (object) ['key' => '\\', 'value' => 'Garis Miring (\)'],
			5 => (object) ['key' => '|', 'value' => 'Garis (|)'],
			6 => (object) ['key' => '-', 'value' => 'Strip (-)'],
			7 => (object) ['key' => '_', 'value' => 'Garis Bawah (_)'],
			7 => (object) ['key' => '&nbsp;', 'value' => 'Spasi ( )'],
		];
		return $opts;
	}

	public function form_rules()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('code_reset', 'Code Reset', 'required');
	}

	public function post_data(array $post_data)
	{
		$this->load->model(['base_model']);
		$delete_child = $this->base_model->delete_data('code_generator_parts', ['code_generator_id' => $post_data['id']], $this->title);
		if ($delete_child['status'] == 'error') {
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($delete_child));
			exit();
		}
		$code_column = $this->code_column($post_data['page']);

		$data = [
			'id' => $post_data['id'],
			'name' => $post_data['name'],
			'table' => $post_data['page'],
			'column' => $code_column,
			'code_reset' => $post_data['code_reset'],
		];

		return $data;
	}

	public function post_child_data(array $post_data, $master_key)
	{
		$code_format = '';
		$total = count($post_data['code_part']);

		for ($i = 0; $i < $total; $i++) {
			$code_unique = $post_data['code_part'][$i] == 'urutan_angka' || $post_data['code_part'][$i] == 'kode_huruf' ? $post_data['code_unique'][$i] : NULL;
			$format_unique = empty($code_unique) ? '' : '[' . $code_unique . ']';
			$code_separator = empty_string($post_data['code_separator'][$i], 'n');
			$format_separator = $code_separator == 'n' ? '' : $code_separator;
			$data[] = [
				'code_generator_id' => $master_key,
				'code_part_order' => $i,
				'code_part' => $post_data['code_part'][$i],
				'code_unique' => $code_unique,
				'code_separator' => $code_separator,
				'created_at' => date('Y-m-d H:i:s'),
			];
			$code_format .= $post_data['code_part'][$i] . $format_unique . $format_separator;
		}

		return ['submit' => $data, 'code_format' => $code_format];
	}

	private function render_code_part($code_part, $code_unique)
	{
		$this->load->helper(['number']);

		if ($code_part == 'yyyy') :
			$code = date('Y');
		elseif ($code_part == 'yy') :
			$code = date('y');
		elseif ($code_part == 'mm') :
			$code = date('m');
		elseif ($code_part == 'dd') :
			$code = date('d');
		elseif ($code_part == 'yyyy_roman') :
			$code = number_to_roman(date('Y'));
		elseif ($code_part == 'yy_roman') :
			$code = number_to_roman(date('y'));
		elseif ($code_part == 'mm_roman') :
			$code = number_to_roman(date('m'));
		elseif ($code_part == 'dd_roman') :
			$code = number_to_roman(date('d'));
		elseif ($code_part == 'urutan_angka') :
			$code = $code_unique;
		elseif ($code_part == 'kode_huruf') :
			$code = $code_unique;
		endif;
		return $code;
	}

	public function generate_code($table)
	{
		$this->load->model(['base_model']);
		$code_generator = $this->base_model->get_row('code_generators', ['table' => $table]);
		$code_generator_parts = $this->base_model->get_all('code_generator_parts', ['code_generator_id' => $code_generator->id], ['code_part_order' => 'ASC']);

		$params = [];
		if ($code_generator->code_reset == 'day') {
			$params = ['DATE(created_at)' => date('Y-m-d')];
		} elseif ($code_generator->code_reset == 'month') {
			$params = ['MONTH(created_at)' => date('m'), 'YEAR(created_at)' => date('Y')];
		} elseif ($code_generator->code_reset == 'year') {
			$params = ['YEAR(created_at)' => date('Y')];
		}
		$data_row = $this->base_model->get_row($table, $params, ['created_at' => 'DESC', 'id' => 'DESC']);
		$last_data_code = $data_row->{$this->code_column($table)};

		$code_format = '';
		$urutan_angka = $this->base_model->get_row('code_generator_parts', ['code_generator_id' => $code_generator->id, 'code_part' => 'urutan_angka']);
		$urutan_order = $urutan_angka->code_part_order;
		if (!empty($last_data_code)) {
			$this->db->select('DISTINCT(code_separator)')
				->from('code_generator_parts')->where(['code_generator_id' => $code_generator->id]);
			$query = $this->db->get();
			$result = $query->result();
			foreach ($result as $row) {
				$glue_code = str_replace($row->code_separator, '-', $last_data_code);
				$last_data_code = $glue_code;
			}
			$explode_glues = explode('-', $last_data_code);
			if (!empty($urutan_order)) {
				$jml_inc = strlen($explode_glues[$urutan_order]);
				$angka = $explode_glues[$urutan_order] + 1;
				$urutan = str_pad($angka, $jml_inc, '000', STR_PAD_LEFT);
				$explode_glues[$urutan_order] = $urutan;
			}
		} else {
			if (!empty($urutan_order)) {
				$jml_inc = strlen($urutan_angka->code_unique);
				$angka = $urutan_angka->code_unique;
				$urutan = str_pad($angka, $jml_inc, '000', STR_PAD_LEFT);
				$explode_glues[$urutan_order] = $urutan;
			}
		}
		$no = 0;
		foreach ($code_generator_parts as $code_generator_part) {
			$format_separator = $code_generator_part->code_separator == 'n' ? '' : $code_generator_part->code_separator;
			$code_unique = $urutan_order == $no && $code_generator_part->code_part == 'urutan_angka' ? $explode_glues[$urutan_order] : $code_generator_part->code_unique;
			$code_format .= $this->render_code_part($code_generator_part->code_part, empty_string($code_unique, '')) . $format_separator;
			$no++;
		}

		return $code_format;
	}
}
