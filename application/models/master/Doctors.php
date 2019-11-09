<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Doctors extends CI_Model {
    private $table = 'doctors';
    private $primary_key = 'id';
	private $title = 'Doctors Data';

	public function _get(string $name)
	{
		return isset($this->{$name}) ? $this->{$name} : 'Error, Property not defined!' ;
	}

	public function ssp_table()
	{
		$data['table'] = $this->table;

		$data['primaryKey'] = $this->primary_key;

		$data['columns'] = array(
            array( 'db' => $this->primary_key, 'dt' => 1, 'field' => $this->primary_key,
                'formatter' => function($d, $row) {

					return $this->tbl_btn($d, $row[3]);
				} ),
			array( 'db' => $this->primary_key, 'dt' => 2, 'field' => $this->primary_key ),
			array( 'db' => 'doctor_id', 'dt' => 3, 'field' => 'doctor_id' ),
			array( 'db' => 'name', 'dt' => 4, 'field' => 'name' ),
			array( 'db' => 'gender', 'dt' => 5, 'field' => 'gender',
				'formatter' => function($d) {
					return indo_gender($d);
				} ),
			array( 'db' => 'address', 'dt' => 6, 'field' => 'address' ),
            array( 'db' => 'created_at', 'dt' => 7, 'field' => 'created_at',
                'formatter' => function($d) {
                    return format_date($d, 'd-m-Y H:i:s');
                } ),
            array( 'db' => 'updated_at', 'dt' => 8, 'field' => 'updated_at',
                'formatter' => function($d) {
					$date = empty($d) ? empty_string($d, '-') : format_date($d, 'd-m-Y H:i:s') ;
                    return $date;
                } ),
		);

		$data['sql_details'] = sql_connect();

		$data['joinQuery'] = '';

		$data['where'] = '';

		return $data;
	}

	private function tbl_btn(string $id, string $var)
	{
		$this->load->helper(['btn_access_helper']);

		$read_access = true;
		$update_access = true;
		$delete_access = true;

		$btns = [];
		$btns[] = get_btn(['access' => $read_access, 'title' => 'Detail '.$this->title, 'icon' => 'search', 'onclick' => 'view_detail(\''.$id.'\')']);
		$btns[] = get_btn(['access' => $update_access, 'title' => 'Ubah Data', 'icon' => 'pencil', 'onclick' => 'load_form(\''.$id.'\')']);
		$btns[] = get_btn_divider();
		$btns[] = get_btn(['access' => $delete_access, 'title' => 'Hapus Data', 'icon' => 'trash',
			'onclick' => 'return confirm(\'Apakah Anda yakin untuk menghapus '.$this->title.' = '.$var.'?\')?delete_data(\''.$id.'\'):false']);
		$btn_group = group_btns($btns);

		return $btn_group;
	}

	public function form_rules()
	{
		$this->load->model(['master/users']);

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->users->external_form_rules();
	}

	public function post_data(array $post_data)
	{
		$this->load->model(['base_model', 'setting/code_generators', 'master/users']);
		$file_img = $_FILES['image'];
		if (!empty($file_img['name'])) {
			$path = 'assets/uploads/img/doctors/';
			$upload = $this->base_model->upload_file('image', $path, ['jpg', 'png', 'gif', 'jpeg']);
			if (isset($upload['status']) && $upload['status'] == 'error') {
				return $upload;
			} else {
				$image = $upload['upload_data']['file_name'];
				$this->base_model->manipulate_image($path . $image, '150');
			}
		}
		$doctor_id = empty($post_data['doctor_id']) ? $this->code_generators->generate_code('doctors') : $post_data['doctor_id'] ;

		$data = [
			'id' => $post_data['id'],
			'doctor_id' => $doctor_id,
			'name' => $post_data['name'],
			'gender' => $post_data['gender'],
			'address' => $post_data['address'],
		];
		if (isset($image)) {
			$data = array_merge($data, ['image' => $image]);
		}
		$user_id = $this->users->submit_userdata($post_data);
		$data = array_merge($data, ['user_id' => $user_id]);

		return $data;
	}
}