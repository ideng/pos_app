<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Customer extends CI_Model
{
	private $table = 'customer';
	private $primary_key = 'id';
	private $title = 'Customer Data';

	public function _get($name)
	{
		return isset($this->{$name}) ? $this->{$name} : 'Error, Property not defined!';
	}

	public function ssp_table()
	{
		$data['table'] = $this->table;

		$data['primaryKey'] = $this->primary_key;

		$data['columns'] = array(
			array(
				'db' => $this->primary_key, 'dt' => 1, 'field' => $this->primary_key,
				'formatter' => function ($d, $row) {

					return $this->tbl_btn($d, $row[3]);
				}
			),
			array('db' => $this->primary_key, 'dt' => 2, 'field' => $this->primary_key),
			array(
				'db' => 'patient_code', 'dt' => 3, 'field' => 'patient_code',
				'formatter' => function ($d) {
					return empty_string($d, '-');
				}
			),
			array('db' => 'name', 'dt' => 4, 'field' => 'name'),
			array(
				'db' => 'gender', 'dt' => 5, 'field' => 'gender',
				'formatter' => function ($d) {
					return indo_gender($d);
				}
			),
			array('db' => 'address', 'dt' => 6, 'field' => 'address'),
			array(
				'db' => 'created_at', 'dt' => 7, 'field' => 'created_at',
				'formatter' => function ($d) {
					return format_date($d, 'd-m-Y H:i:s');
				}
			),
			array(
				'db' => 'updated_at', 'dt' => 8, 'field' => 'updated_at',
				'formatter' => function ($d) {
					$date = empty($d) ? empty_string($d, '-') : format_date($d, 'd-m-Y H:i:s');
					return $date;
				}
			),
		);

		$data['sql_details'] = sql_connect();

		$data['joinQuery'] = 'FROM customer';

		$data['where'] = '';

		return $data;
	}

	private function tbl_btn($id, $var)
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
			'onclick' => 'return confirm(\'Apakah Anda yakin untuk menghapus ' . $this->title . ' = ' . $var . '?\')?delete_data(\'' . $id . '\'):false'
		]);
		$btn_group = group_btns($btns);

		return $btn_group;
	}

	public function form_rules()
	{
		$this->load->model(['master/users']);

		$this->form_validation->set_rules('civilian_id', 'Civilian ID', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('religion', 'Religion', 'required');
		$this->form_validation->set_rules('place_of_birth', 'Place of Birth', 'required');
		$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');
		$this->form_validation->set_rules('telephone', 'Telephone', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->users->external_form_rules();
	}

	public function post_data(array $post_data)
	{
		$this->load->model(['base_model', 'setting/code_generators', 'master/users']);
		$file_img = $_FILES['image'];
		if (!empty($file_img['name'])) {
			$path = 'assets/uploads/img/patients/';
			$upload = $this->base_model->upload_file('image', $path, ['jpg', 'png', 'gif', 'jpeg']);
			if (isset($upload['status']) && $upload['status'] == 'error') {
				return $upload;
			} else {
				$image = $upload['upload_data']['file_name'];
				$this->base_model->manipulate_image($path . $image, '150');
			}
		}
		$patient_code = empty($post_data['patient_code']) ? $this->code_generators->generate_code('customer') : $post_data['patient_code'];

		$data = [
			'id' => $post_data['id'],
			'patient_code' => $patient_code,
			'civilian_id' => $post_data['civilian_id'],
			'name' => $post_data['name'],
			'gender' => $post_data['gender'],
			'address' => empty_string($post_data['address'], NULL),
			'religion' => $post_data['religion'],
			'place_of_birth' => $post_data['place_of_birth'],
			'date_of_birth' => format_date($post_data['date_of_birth'], 'Y-m-d'),
			'telephone' => $post_data['telephone'],
			'email' => empty_string($post_data['email'], NULL),
			'blood_type' => empty_string($post_data['blood_type'], NULL),
		];
		if (isset($image)) {
			$data = array_merge($data, ['image' => $image]);
		}
		$user_id = $this->users->submit_userdata($post_data);
		$data = array_merge($data, ['user_id' => $user_id]);

		return $data;
	}

	public function get_medical_histories($id)
	{
		$this->load->model(['base_model']);
		$this->db->select('a.id, a.medical_record_id, c.name AS poly_name, d.name AS doctor_name, a.date_in, a.complaint, b.id AS diagnose_id, b.date_in AS diagnose_date, b.description, b.total_price, b.flag')
			->from('checkups a')
			->join('diagnoses b', 'b.checkup_id = a.id', 'left')
			->join('polies c', 'c.id = a.poly_id', 'left')
			->join('doctors d', 'd.id = a.doctor_id', 'left')
			->where(['a.patient_id' => $id])
			->order_by('a.date_in DESC');
		$query = $this->db->get();
		$data['checkups'] = $query->result();
		if (!empty($data['checkups'])) {
			$diagnose_ids = [];
			foreach ($data['checkups'] as $checkup) {
				$diagnose_ids[] = $checkup->diagnose_id;
			}
			$this->db->select('a.diagnose_id, b.name AS drug_name, a.price, a.quantity')
				->from('diagnose_drugs a')
				->join('drugs b', 'b.id = a.drug_id', 'left')
				->where_in('a.diagnose_id', $diagnose_ids);
			$query = $this->db->get();
			$data['diagnose_drugs'] = $query->result();

			$this->db->from('diagnosedrug_sales')
				->where_in('diagnose_id', $diagnose_ids);
			$query = $this->db->get();
			$data['diagnosedrug_sales'] = $query->result();
		}
		return $data;
	}
}
