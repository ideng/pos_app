<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Type_drugs extends CI_Model
{
    private $table = 'type_drugs';
    private $primary_key = 'id';
    private $title = 'Kategori Data';

    public function _get(string $name)
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
                    $ttle = $row[2] ? $row[2] : '';
                    return $this->tbl_btn($d, $ttle);
                }
            ),
            array('db' => $this->primary_key, 'dt' => 2, 'field' => $this->primary_key),
            array('db' => 'name', 'dt' => 3, 'field' => 'name'),
            array(
                'db' => 'created_at', 'dt' => 4, 'field' => 'created_at',
                'formatter' => function ($d) {
                    return format_date($d, 'd-m-Y H:i:s');
                }
            ),
            array(
                'db' => 'updated_at', 'dt' => 5, 'field' => 'updated_at',
                'formatter' => function ($d) {
                    return format_date($d, 'd-m-Y H:i:s');
                }
            ),
        );

        $data['sql_details'] = sql_connect();

        $data['joinQuery'] = '
            FROM type_drugs
        ';

        $data['where'] = '';

        $data['group_by'] = '';

        $data['having'] = '';

        return $data;
    }

    private function tbl_btn(string $id, string $var)
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
        $this->form_validation->set_rules('kategori_name', 'Kategori Name', 'required');
    }

    public function get_row(string $id)
    {
        $columns = ['id', 'name', 'created_at'];
        $this->db->select('id, name, created_at')
            ->from('type_drugs')
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

    public function post_data(array $post_data)
    {
        $this->load->model(['setting/code_generators']);
        $supplier_code = empty($post_data['supplier_code']) ? $this->code_generators->generate_code('supplier') : $post_data['supplier_code'];


        $data = [
            'id' => $post_data['id'],
            'name' => $post_data['kategori_name'],
        ];

        return $data;
    }
}
