<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Adjustment extends CI_Model
{
    private $table = 'adjustment';
    private $primary_key = 'id';
    private $title = 'adjustment Data';

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
            array('db' => 'b.name AS nama_obat', 'dt' => 3, 'field' => 'nama_obat'),
            array(
                'db' => 'b.purchase_price', 'dt' => 4, 'field' => 'purchase_price',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array('db' => 'a.quantity', 'dt' => 5, 'field' => 'quantity'),
            array(
                'db' => 'a.subtotal', 'dt' => 6, 'field' => 'subtotal',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
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
            FROM adjustment a
            LEFT JOIN gudang b ON b.id = a.drug_id
        ';

        $data['where'] = '';

        $data['group_by'] = '';

        $data['having'] = '';

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
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
    }

    public function get_row($id)
    {
        $columns = ['id', 'drug_id', 'nama_obat', 'purchase_price', 'quantity', 'subtotal', 'created_at', 'updated_at'];
        $this->db->select('a.id, a.drug_id, b.name AS nama_obat, b.purchase_price, a.quantity, a.subtotal, a.created_at, a.updated_at')
            ->from('adjustment a')
            ->join('gudang b', 'b.id = a.drug_id', 'left')
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
        if (!empty($post_data['drug_id'])) {
            $subtotal = $post_data['drug_price'] * $post_data['quantity'];
        }
        $data = [
            'id' => $post_data['id'],
            'drug_id' => $post_data['drug_id'],
            'quantity' => $post_data['quantity'],
            'subtotal' => $subtotal,
        ];

        return $data;
    }

    function get_drug()
    {
        $query = $this->db->query('SELECT * FROM gudang');
        return $query->result();
    }
}
