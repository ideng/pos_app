<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Base_model extends CI_Model
{
	public function get_all($tbl, array $params = [], array $orders = [])
	{
		$this->db->from($tbl);
		if (count($params) > 0) :
			$this->db->where($params);
		endif;
		if (count($orders) > 0) :
			foreach ($orders as $col => $ordering) :
				$this->db->order_by($col, $ordering);
			endforeach;
		endif;
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function get_row($table, array $params = [], array $orders = [])
	{
		$this->db->from($table)
			->where($params);
		if (count($orders) > 0) :
			foreach ($orders as $col => $ordering) :
				$this->db->order_by($col, $ordering);
			endforeach;
		endif;
		$query = $this->db->get();
		$row = $query->row();
		$data = $this->render_table_column($table, $row);

		return $data;
	}

	public function count_data($tbl, array $params = [])
	{
		$this->db->from($tbl)
			->where($params);
		$query = $this->db->get();
		$num = $query->num_rows();
		return $num;
	}

	public function submit_data($tbl_name, $p_key, $title_name, array $data)
	{
		if (!empty($data[$p_key])) :
			$label = 'Mengubah ' . $title_name;
			$submit = array_merge($data, ['updated_at' => date('Y-m-d H:i:s')]);
			$where = [$p_key => $data[$p_key]];
			$act = $this->db->update($tbl_name, $submit, $where);
		else :
			$label = 'Menambahkan ' . $title_name;
			$submit = array_merge($data, ['created_at' => date('Y-m-d H:i:s')]);
			$act = $this->db->insert($tbl_name, $submit);
			$data[$p_key] = $this->db->insert_id();
		endif;
		$str = get_report($act, $label, $data[$p_key]);
		return $str;
	}

	public function delete_data($tbl_name, array $data, $title_name)
	{
		$act = $this->db->delete($tbl_name, $data);
		$str = get_report($act, 'Delete ' . $title_name, $data);
		return $str;
	}

	public function soft_delete($tbl_name, array $data, $title_name)
	{
		$act = $this->db->update($tbl_name, ['is_deleted' => 1], $data);
		$str = get_report($act, 'Delete ' . $title_name, $data);
		return $str;
	}

	public function submit_batch($tbl_name, $title_name, array $data = [])
	{
		$act = $this->db->insert_batch($tbl_name, $data);
		$str = get_report($act, 'Menambahkan ' . $title_name, $data);
		return $str;
	}

	public function edit_batch($tbl_name, $title_name, array $data, $key_row)
	{
		$N_row = $this->db->update_batch($tbl_name, $data, $key_row);
		$act = $N_row > 0 ? true : false;
		$str = get_report($act, 'Update ' . $title_name, $data);
		return $str;
	}

	public function form_errs($tbl_name, $column)
	{
		$form_errs = [];
		$this->db->select($column)
			->from($tbl_name);
		$query = $this->db->get();
		$result = $query->result();
		foreach ($result as $row) :
			$form_errs[] = 'idErr' . $row->{$column};
		endforeach;
		return $form_errs;
	}

	public function delete_unused_files($file_path, $file_tbl, $file_column, array $params = [])
	{
		$arr_file = [];
		$arr_file_table = [];
		$files = glob(FCPATH . $file_path . '*.*');
		$path = strlen(FCPATH . $file_path);

		$this->db->trans_start();
		foreach ($files as $file) {
			$arr_file[] = substr($file, $path);
		}

		$this->db->select($file_column)->from($file_tbl);
		if (!empty($arr_file)) {
			$this->db->where_in($file_column, $arr_file);
		}
		if (!empty($params)) {
			$this->db->where($params);
		}
		$query = $this->db->get();
		$result = $query->result();
		foreach ($result as $row) {
			$arr_file_table[] = $row->{$file_column};
		}

		foreach ($arr_file as $file) {
			if (!in_array($file, $arr_file_table)) {
				unlink($file_path . $file);
			}
		}
		$this->db->trans_complete();
	}

	public function define_container($class_link, $box_type)
	{
		$data['class_link'] = $class_link;
		$data['box_id'] = 'idBox' . $box_type;
		$data['box_alert_id'] = 'idAlertBox' . $box_type;
		$data['box_loader_id'] = 'idLoaderBox' . $box_type;
		$data['box_content_id'] = 'idContentBox' . $box_type;
		$data['btn_hide_id'] = 'idBtnHide' . $box_type;
		$data['btn_add_id'] = 'idBtnAdd' . $box_type;
		$data['btn_close_id'] = 'idBtnClose' . $box_type;
		return $data;
	}

	public function form_warning(array $inputs)
	{
		foreach ($inputs as $input => $value) {
			if ($input != 'url' || $input != 'page' || $input != 'id') {
				$form_error = form_error($input);
				$str[] = !empty($form_error) ? form_error($input, '<li>', '</li>') : '';
			}
		}

		return $str;
	}

	public function upload_file($file, $path, array $exts, $max_name)
	{
		$max_name = !empty($max_name) ? '50' : $max_name;
		$exts = implode('|', $exts);
		$config['upload_path'] = $path;
		$config['allowed_types'] = $exts;
		$config['encrypt_name'] = true;
		$config['max_filename'] = $max_name;
		$config['detect_mime'] = true;

		$this->load->library('upload', $config);
		$this->load->helper(['alert_helper']);
		if (!$this->upload->do_upload($file)) {
			$data = ['status' => 'error', 'msg' => build_alert('warning', 'Warning!', $this->upload->display_errors('<li>', '</li>'))];
		} else {
			$data = ['upload_data' => $this->upload->data()];
		}

		return $data;
	}

	public function manipulate_image($path, $width)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $path;
		$config['maintain_ratio'] = true;
		$config['width'] = $width;
		$this->load->library('image_lib', $config);

		$this->image_lib->resize();
	}

	public function render_column_object(array $columns, stdClass $result = null)
	{
		$data = new stdClass();
		foreach ($columns as $column) {
			$data->{$column} = '';
		}
		if (!empty($result)) {
			foreach ($columns as $column) {
				$data->{$column} = $result->{$column};
			}
		}

		return $data;
	}

	public function render_table_column($table, stdClass $row = null)
	{
		$columns = $this->db->list_fields($table);
		$data = new stdClass();
		foreach ($columns as $column) {
			$data->{$column} = '';
		}
		if (!empty($row)) {
			foreach ($columns as $column) {
				$data->{$column} = $column == 'created_at' || $column == 'updated_at' ? format_date($row->{$column}, 'd-m-Y H:i:s') : $row->{$column};
			}
		}
		return $data;
	}
}
