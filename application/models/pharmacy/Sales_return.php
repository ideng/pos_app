<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Sales_return extends CI_Model
{
    private $table = 'sales_return';
    private $primary_key = 'id';
    private $title = 'Retur Penjualan';

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
                'db' => 'a.no_retur', 'dt' => 3, 'field' => 'no_retur',
                'formatter' => function ($d) {
                    return empty_string($d, '-');
                }
            ),
            array(
                'db' => 'b.no_faktur', 'dt' => 4, 'field' => 'no_faktur',
                'formatter' => function ($d) {
                    return empty_string($d, '-');
                }
            ),
            array('db' => 'c.name AS drug_name', 'dt' => 5, 'field' => 'drug_name'),
            array('db' => 'a.quantity', 'dt' => 6, 'field' => 'quantity'),
            array('db' => 'a.description', 'dt' => 7, 'field' => 'description'),
            array(
                'db' => 'a.created_at', 'dt' => 8, 'field' => 'created_at',
                'formatter' => function ($d) {
                    return format_date($d, 'd-m-Y H:i:s');
                }
            ),
            array(
                'db' => 'a.updated_at', 'dt' => 9, 'field' => 'updated_at',
                'formatter' => function ($d) {
                    $date = empty($d) ? empty_string($d, '-') : format_date($d, 'd-m-Y H:i:s');
                    return $date;
                }
            ),
        );

        $data['sql_details'] = sql_connect();

        $data['joinQuery'] = '
            FROM sales_return AS a
            JOIN sales AS b ON b.id = a.no_faktur_id
            JOIN gudang AS c ON c.id = a.drug_id
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
        $this->form_validation->set_rules('no_faktur', 'No faktur', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
    }

    public function get_row(string $id)
    {
        $columns = ['id', 'no_retur', 'no_faktur_sales', 'no_faktur_id', 'drug_id', 'drug_name', 'quantity', 'description', 'created_at', 'updated_at'];
        $this->db->select('a.id, a.no_retur, b.no_faktur AS no_faktur_sales, a.no_faktur_id, a.drug_id, a.quantity, a.description, a.created_at, a.updated_at, c.name AS drug_name')
            ->from('sales_return a')
            ->join('sales b', 'b.id = a.no_faktur_id', 'left')
            ->join('gudang c', 'c.id = a.drug_id', 'left')
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
        $no_retur = empty($post_data['no_retur']) ? $this->code_generators->generate_code('sales_return') : $post_data['no_retur'];

        $data = [
            'id' => $post_data['id'],
            'no_retur' => $no_retur,
            'no_faktur_id' => $post_data['no_faktur_id'],
            'drug_id' => $post_data['drug_id'],
            'quantity' => $post_data['quantity'],
            'description' => $post_data['description'],
        ];

        return $data;
    }

    public function get_faktur(string $no_faktur_id)
    {
        $this->db->select('b.no_faktur')
            ->from('sales_return a')
            ->join('sales b', 'b.id = a.no_faktur_id')
            ->where(['a.no_faktur_id' => $no_faktur_id]);
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    function get_drug()
    {
        $query = $this->db->query('SELECT * FROM gudang');
        return $query->result();
    }
}
