<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Supplier extends CI_Model
{
    private $table = 'supplier';
    private $primary_key = 'id';
    private $title = 'Supplier Data';

    public function _get(string $name)
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
                'db' => 'a.supplier_code', 'dt' => 3, 'field' => 'supplier_code',
                'formatter' => function ($d) {
                    return empty_string($d, '-');
                }
            ),
            array('db' => 'a.name AS supplier_name', 'dt' => 4, 'field' => 'supplier_name'),
            array('db' => 'a.address', 'dt' => 5, 'field' => 'address'),
            array('db' => 'b.name AS city_name', 'dt' => 6, 'field' => 'city_name'),
            array(
                'db' => 'a.created_at', 'dt' => 7, 'field' => 'created_at',
                'formatter' => function ($d) {
                    return format_date($d, 'd-m-Y H:i:s');
                }
            ),
            array(
                'db' => 'a.updated_at', 'dt' => 8, 'field' => 'updated_at',
                'formatter' => function ($d) {
                    $date = empty($d) ? empty_string($d, '-') : format_date($d, 'd-m-Y H:i:s');
                    return $date;
                }
            ),
        );

        $data['sql_details'] = sql_connect();

        $data['joinQuery'] = '
            FROM supplier AS a
			JOIN city AS b ON b.id = a.city_id
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
        $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city_name', 'City Name', 'required');
    }

    public function get_row(string $id)
    {
        $columns = ['id', 'supplier_code', 'city_id', 'city_name', 'address', 'supplier_name', 'created_at', 'updated_at'];
        $this->db->select('a.id, a.supplier_code, a.city_id, a.address, a.name AS supplier_name, b.name AS city_name, a.created_at, a.updated_at')
            ->from('supplier a')
            ->join('city b', 'b.id = a.city_id', 'left')
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
            'supplier_code' => $supplier_code,
            'name' => $post_data['supplier_name'],
            'address' => $post_data['address'],
            'city_id' => $post_data['city_id'],
        ];

        return $data;
    }

    public function get_city(string $city_id)
    {
        $this->db->select('b.name AS city_name')
            ->from('supplier a')
            ->join('city b', 'b.id = a.city_id')
            ->where(['a.city_id' => $city_id]);
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }
}
