<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Privileges extends CI_Model
{
	private $table = 'privileges';
	private $primary_key = 'id';
	private $title = 'Privileges Data';

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
			array('db' => 'name', 'dt' => 3, 'field' => 'name'),
			array('db' => 'level', 'dt' => 4, 'field' => 'level'),
			array(
				'db' => 'module', 'dt' => 5, 'field' => 'module',
				'formatter' => function ($d) {
					return empty_string(ucwords($d), '-');
				}
			),
			array(
				'db' => 'created_at', 'dt' => 6, 'field' => 'created_at',
				'formatter' => function ($d) {
					return format_date($d, 'd-m-Y H:i:s');
				}
			),
			array(
				'db' => 'updated_at', 'dt' => 7, 'field' => 'updated_at',
				'formatter' => function ($d) {
					$date = empty($d) ? empty_string($d, '-') : format_date($d, 'd-m-Y H:i:s');
					return $date;
				}
			),
		);

		$data['sql_details'] = sql_connect();

		$data['joinQuery'] = '';

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
		$btns[] = get_btn(['access' => $update_access, 'title' => 'Edit', 'icon' => 'pencil', 'onclick' => 'load_form(\'' . $id . '\')']);
		$btns[] = get_btn(['access' => $update_access, 'title' => 'Set Menus', 'icon' => 'list', 'onclick' => 'load_form_menu(\'' . $id . '\')']);
		$btns[] = get_btn_divider();
		$btns[] = get_btn([
			'access' => $delete_access, 'title' => 'Delete', 'icon' => 'trash',
			'onclick' => 'return confirm(\'Are you sure to delete ' . $this->title . ' = ' . $var . '?\')?delete_data(\'' . $id . '\'):false'
		]);
		$btn_group = group_btns($btns);

		return $btn_group;
	}

	public function form_rules()
	{
		$this->load->helper(['flag']);
		$module = implode(',', module_list());
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required|integer|in_list[0,1,2,3,4,5]');
		$this->form_validation->set_rules('module', 'Modul', 'required|in_list[' . $module . ']');
	}

	public function post_data(array $post_data)
	{
		$data = [
			'id' => $post_data['id'],
			'name' => $post_data['name'],
			'level' => $post_data['level'],
			'module' => $post_data['module'],
		];

		return $data;
	}

	public function post_menu_data(array $post_data)
	{
		$this->load->model(['base_model']);
		$this->base_model->delete_data('menu_privileges', ['privilege_id' => $post_data['id']], $this->title);

		$data = [];
		$total = count($post_data['menu_id']);
		for ($i = 0; $i < $total; $i++) {
			$menu_id = $post_data['menu_id'][$i];
			if (
				isset($post_data['chk_create'][$menu_id]) ||
				isset($post_data['chk_read'][$menu_id]) ||
				isset($post_data['chk_update'][$menu_id]) ||
				isset($post_data['chk_delete'][$menu_id])
			) {
				$master[$menu_id] = ['privilege_id' => $post_data['id'], 'created_at' => date('Y-m-d H:i:s')];
				if (isset($post_data['chk_create'][$menu_id])) {
					$master[$menu_id] = array_merge($master[$menu_id], [
						'menu_id' => $menu_id,
						'create_access' => '1'
					]);
					if (is_array($post_data['chk_create'][$menu_id])) {
						foreach ($post_data['chk_create'][$menu_id] as $key => $vals) {
							$master[$key] = ['privilege_id' => $post_data['id'], 'created_at' => date('Y-m-d H:i:s')];
							$master[$key] = array_merge($master[$key], [
								'menu_id' => $key,
								'create_access' => '1'
							]);
						}
					}
				}
				if (isset($post_data['chk_read'][$menu_id])) {
					$master[$menu_id] = array_merge($master[$menu_id], [
						'menu_id' => $menu_id,
						'read_access' => '1'
					]);
					if (is_array($post_data['chk_read'][$menu_id])) {
						foreach ($post_data['chk_read'][$menu_id] as $key => $vals) {
							$master[$key] = array_merge($master[$key], [
								'menu_id' => $key,
								'read_access' => '1'
							]);
						}
					}
				}
				if (isset($post_data['chk_update'][$menu_id])) {
					$master[$menu_id] = array_merge($master[$menu_id], [
						'menu_id' => $menu_id,
						'update_access' => '1'
					]);
					if (is_array($post_data['chk_update'][$menu_id])) {
						foreach ($post_data['chk_update'][$menu_id] as $key => $vals) {
							$master[$key] = array_merge($master[$key], [
								'menu_id' => $key,
								'update_access' => '1'
							]);
						}
					}
				}
				if (isset($post_data['chk_delete'][$menu_id])) {
					$master[$menu_id] = array_merge($master[$menu_id], [
						'menu_id' => $menu_id,
						'delete_access' => '1'
					]);
					if (is_array($post_data['chk_delete'][$menu_id])) {
						foreach ($post_data['chk_delete'][$menu_id] as $key => $vals) {
							$master[$key] = array_merge($master[$key], [
								'menu_id' => $key,
								'delete_access' => '1'
							]);
						}
					}
				}
			}
		}

		return $master;
	}

	public function get_user_privilege($user_id)
	{
		$this->load->model(['base_model']);
		$columns = ['id', 'name', 'level'];
		$this->db->select('a.id, a.name, a.level')
			->from('privileges a')
			->join('user_privileges b', 'b.privilege_id = a.id', 'left')
			->where(['b.user_id' => $user_id]);
		$query = $this->db->get();
		$row = $query->row();
		$data = $this->base_model->render_column_object($columns, $row);

		return $data;
	}

	public function get_user_privileges($user_id)
	{
		$columns = ['module'];
		$this->db->select('b.module')
			->from('user_privileges a')
			->join('privileges b', 'b.id = a.privilege_id', 'left')
			->where(['a.user_id' => $user_id]);
		$query = $this->db->get();
		$row = $query->row();
		$data = $this->base_model->render_column_object($columns, $row);

		return $data;
	}
}
