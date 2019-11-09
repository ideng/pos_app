<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Polies extends CI_Model {
    private $table = 'polies';
    private $primary_key = 'id';
	private $title = 'Polies Data';
	
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

					return $this->tbl_btn($d, $row[2]);
				} ),
			array( 'db' => $this->primary_key, 'dt' => 2, 'field' => $this->primary_key ),
			array( 'db' => 'name', 'dt' => 3, 'field' => 'name' ),
			array( 'db' => 'description', 'dt' => 4, 'field' => 'description' ),
            array( 'db' => 'created_at', 'dt' => 5, 'field' => 'created_at',
                'formatter' => function($d) {
                    return format_date($d, 'd-m-Y H:i:s');
                } ),
            array( 'db' => 'updated_at', 'dt' => 6, 'field' => 'updated_at',
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
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
	}

	public function post_data(array $post_data)
	{
		$data = [
			'id' => $post_data['id'],
			'name' => $post_data['name'],
			'description' => $post_data['description'],
		];

		return $data;
	}
}