<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Sales extends CI_Model
{
	private $table = 'sales';
	private $primary_key = 'id';
	private $title = 'Penjualan Barang';

	public function _get($name)
	{
		return isset($this->{$name}) ? $this->{$name} : 'Error, Property not defined!';
	}

	public function ssp_table()
	{
		$data['table'] = $this->table;

		$data['primaryKey'] = 'a.' . $this->primary_key;

		$data['columns'] = array(
			array(
				'db' => 'a.' . $this->primary_key, 'dt' => 1, 'field' => $this->primary_key,
				'formatter' => function ($d, $row) {
					$ttle = $row[2] ? $row[2] : '';
					return $this->tbl_btn($d, $ttle);
				}
			),
			array('db' => 'a.' . $this->primary_key, 'dt' => 2, 'field' => $this->primary_key),
			array(
				'db' => 'a.no_faktur', 'dt' => 3, 'field' => 'no_faktur',
				'formatter' => function ($d) {
					return empty_string($d, '-');
				}
			),
			array('db' => 'b.name AS patient_name', 'dt' => 4, 'field' => 'patient_name'),
			array(
				'db' => 'a.total_price', 'dt' => 5, 'field' => 'total_price',
				'formatter' => function ($d) {
					return number_format(empty_string($d, '0'), 2, ',', '.');
				}
			),
			array(
				'db' => 'a.created_at', 'dt' => 6, 'field' => 'created_at',
				'formatter' => function ($d) {
					return format_date($d, 'd-m-Y H:i:s');
				}
			),
			array(
				'db' => 'a.updated_at', 'dt' => 7, 'field' => 'updated_at',
				'formatter' => function ($d) {
					$date = empty($d) ? empty_string($d, '-') : format_date($d, 'd-m-Y H:i:s');
					return $date;
				}
			),
		);

		$data['sql_details'] = sql_connect();

		$data['joinQuery'] = '
			FROM sales a
			LEFT JOIN customer AS b ON b.id = a.patient_id
		';

		$data['where'] = '';

		$data['group_by'] = '';

		$data['having'] = '';

		return $data;
	}

	private function tbl_btn($id, $vars)
	{
		$this->load->helper(['btn_access_helper']);

		$read_access = true;
		$update_access = true;
		$delete_access = true;

		$btns = [];
		$btns[] = get_btn(['access' => $read_access, 'title' => 'Detail ' . $this->title, 'icon' => 'search', 'onclick' => 'view_detail(\'' . $id . '\')']);
		$btns[] = get_btn(['access' => $update_access, 'title' => 'Ubah Data', 'icon' => 'pencil', 'onclick' => 'load_form(\'' . $id . '\')']);
		$btns[] = get_btn_divider();
		$btns[] = get_btn([
			'access' => $delete_access, 'title' => 'Hapus Data', 'icon' => 'trash',
			'onclick' => 'return confirm(\'Apakah Anda yakin untuk menghapus ' . $this->title . ' = ' . $vars . '?\')?delete_data(\'' . $id . '\'):false'
		]);
		$btn_group = group_btns($btns);

		return $btn_group;
	}

	public function form_rules()
	{
		$this->form_validation->set_rules('patient_id', 'Patient ID', 'required');
		$this->form_validation->set_rules('patient_civilian_id', 'Civilian ID', 'required');
		$this->form_validation->set_rules('patient_name', 'Patient Name', 'required');
	}

	public function post_data(array $post_data)
	{

		$this->load->model(['setting/code_generators']);
		$no_faktur = empty($post_data['no_faktur']) ? $this->code_generators->generate_code('sales') : $post_data['no_faktur'];

		$data = [
			'id' => $post_data['id'],
			'no_faktur' => $no_faktur,
			'patient_id' => $post_data['patient_id'],
			'total_price' => $post_data['drug_bayar']
		];

		return $data;
	}

	public function get_row($id)
	{
		$columns = ['id', 'no_faktur', 'nama_barang', 'barcode', 'patient_id', 'patient_name', 'civilian_id_patient', 'total_price', 'created_at', 'updated_at'];
		$this->db->select('a.id, a.no_faktur, a.patient_id, c.civilian_id AS civilian_id_patient, c.name AS patient_name, d.name AS nama_barang, d.barcode, d.sell_price, b.drug_id, b.quantity, b.subtotal, a.total_price, d.updated_at AS update_obat, a.created_at, a.updated_at')
			->from('sales a')
			->join('sales_item b', 'b.drugpurchase_id = a.id', 'left')
			->join('customer c', 'c.id = a.patient_id', 'left')
			->join('gudang d', 'd.id = b.drug_id', 'left')
			->where(['a.id' => $id]);
		$query = $this->db->get();
		$row = $query->row();
		$data = new stdClass();
		foreach ($columns as $column) {
			$data->{$column} = '';
		}
		if (!empty($row)) {
			foreach ($columns as $column) {
				$data->{$column} = $row->{$column};
			}
		}

		return $data;
	}

	public function patient_drug($patient_id)
	{
		$this->db->select('c.name AS patient_name, a.total_price')
			->from('sales a')
			->join('customer c', 'c.id = a.patient_id')
			->where(['a.patient_id' => $patient_id]);
		$query = $this->db->get();
		$result = $query->result();

		return $result;
	}

	public function delete_data($id)
	{
		$this->load->model(['base_model']);
		$data = $this->base_model->delete_data($this->table, ['id' => $id], $this->title);
		$data = $this->base_model->delete_data('sales_item', ['drugpurchase_id' => $id], $this->title);
		$data = $this->base_model->delete_data('sales_return', ['no_faktur_id' => $id], $this->title);
		return $data;
	}

	public function post_payment(array $post_data)
	{
		$data = [
			'id' => $post_data['id'],
			'total_price' => $post_data['total_price'],
		];

		return $data;
	}

	public function viewByBarcode($barcode)
	{
		$this->db->where('barcode', $barcode);
		$result = $this->db->get('gudang')->row(); // Tampilkan data siswa berdasarkan NIS

		return $result;
	}
}
