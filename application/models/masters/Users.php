<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Users extends CI_Model {
    private $table = 'users';
    private $primary_key = 'id';
	private $title = 'Users Data';

	public function _get(string $name)
	{
		return isset($this->{$name}) ? $this->{$name} : 'Error, Property not defined!' ;
	}

	public function ssp_table()
	{
		$this->load->model(['setting/privileges']);
		$user_privilege = $this->privileges->get_user_privilege($_SESSION['auth']['id']);

		$data['table'] = $this->table;

		$data['primaryKey'] = 'a.'.$this->primary_key;

		$data['columns'] = array(
            array( 'db' => 'a.'.$this->primary_key, 'dt' => 1, 'field' => $this->primary_key,
                'formatter' => function($d, $row) {

					return $this->tbl_btn($d, $row[2]);
				} ),
			array( 'db' => 'a.'.$this->primary_key, 'dt' => 2, 'field' => $this->primary_key ),
			array( 'db' => 'a.username', 'dt' => 3, 'field' => 'username' ),
			array( 'db' => 'a.name', 'dt' => 4, 'field' => 'name' ),
			array( 'db' => 'c.name AS privilege_name', 'dt' => 5, 'field' => 'privilege_name' ),
            array( 'db' => 'a.created_at', 'dt' => 6, 'field' => 'created_at',
                'formatter' => function($d) {
                    return format_date($d, 'd-m-Y H:i:s');
                } ),
            array( 'db' => 'a.updated_at', 'dt' => 7, 'field' => 'updated_at',
                'formatter' => function($d) {
					$date = empty($d) ? empty_string($d, '-') : format_date($d, 'd-m-Y H:i:s') ;
                    return $date;
                } ),
		);

		$data['sql_details'] = sql_connect();

		$data['joinQuery'] = 'FROM users a LEFT JOIN user_privileges b ON b.user_id = a.id LEFT JOIN privileges c ON c.id = b.privilege_id';

		$data['where'] = 'a.id != \'' . $_SESSION['auth']['id'] . '\' AND c.level >= \'' . $user_privilege->level . '\'';

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
		$this->form_validation->set_rules('username', 'Username', ['required', ['chk_username', [$this->users, 'chk_username']]]);
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('privilege_id', 'Privilege', 'required');
		if (empty($this->input->post('id')) || !empty($this->input->post('password'))) {
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required|matches[password]');
		}
	}

	public function chk_username(string $str)
	{
		$this->load->model(['base_model']);
		if ($str == 'test') {
			$this->form_validation->set_message('chk_username', 'The {field} field can\'t be the word \'test\'');
			return FALSE;
		} else {
			$chk_user = $this->base_model->count_data('users', ['username' => $str, 'id !=' => $this->input->post('id')]);
			if ($chk_user > 0) :
				$this->form_validation->set_message('chk_username', '{field} already exist, pick anothoer {field}!');
				return FALSE;
			else :
				return TRUE;
			endif;
		}
	}

	public function post_data(array $post_data)
	{
		$data = [
			'id' => $post_data['id'],
			'username' => $post_data['username'],
			'name' => $post_data['name'],
		];
		if (!empty($post_data['password'])) {
			$data = array_merge($data, ['password' => hash_text($post_data['password'])]);
		}

		return $data;
	}

	public function get_row(string $id)
	{
		$columns = ['id', 'username', 'name', 'privilege_name', 'created_at', 'updated_at'];
		$this->db->select('a.id, a.username, a.name, c.name AS privilege_name, a.created_at, a.updated_at')
			->from('users a')
			->join('user_privileges b', 'b.user_id = a.id', 'left')
			->join('privileges c', 'c.id = b.privilege_id', 'left')
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

	public function submit_userdata(array $post_data)
	{
		$this->load->model(['base_model']);
		$user_data = [
			'id' => $post_data['user_id'],
			'username' => $post_data['username'],
			'name' => $post_data['name']
		];
		if (!empty($post_data['password'])) {
			$user_data = array_merge($user_data, ['password' => hash_text($post_data['password'])]);
		}
		$submit = $this->base_model->submit_data('users', 'id', $this->title, $user_data);
		if ($submit['status'] == 'error') {
			$submit['csrf_val'] = $this->security->get_csrf_hash();
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output($submit);
			exit();
		}
		$user_id = $submit['key'];
		$userprivilege_data = [
			'id' => $post_data['user_privilege_id'],
			'user_id' => $user_id,
			'privilege_id' => $post_data['privilege_id'],
		];
		$submit = $this->base_model->submit_data('user_privileges', 'id', $this->title, $userprivilege_data);
		if ($submit['status'] == 'error') {
			$submit['csrf_val'] = $this->security->get_csrf_hash();
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output($submit);
			exit();
		}

		return $user_id;
	}

	public function external_form_rules()
	{
		$this->form_validation->set_rules('username', 'Username', ['required', ['chk_username_external', [$this->users, 'chk_username_external']]]);
		$this->form_validation->set_rules('privilege_id', 'User Privilege', 'required');
		if (empty($this->input->post('user_id')) || !empty($this->input->post('password'))) {
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]');
		}
	}

	public function chk_username_external(string $str)
	{
		$this->load->model(['base_model']);
		if ($str == 'test') {
			$this->form_validation->set_message('chk_username_external', 'The {field} field can\'t be the word \'test\'');
			return FALSE;
		} else {
			$chk_user = $this->base_model->count_data('users', ['username' => $str, 'id !=' => $this->input->post('user_id')]);
			if ($chk_user > 0) :
				$this->form_validation->set_message('chk_username_external', '{field} already exist, pick anothoer {field}!');
				return FALSE;
			else :
				return TRUE;
			endif;
		}
	}
}
