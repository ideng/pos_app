<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Sales_return extends CI_Model
{
    private $table = 'sales_return';
    private $primary_key = 'id';
    private $title = 'Retur Penjualan';

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
            array(
                'db' => 'a.no_retur', 'dt' => 3, 'field' => 'no_retur',
                'formatter' => function ($d) {
                    return empty_string($d, '-');
                }
            ),
            array('db' => 'c.name AS drug_name', 'dt' => 4, 'field' => 'drug_name'),
            array('db' => 'a.quantity', 'dt' => 5, 'field' => 'quantity'),
            array('db' => 'a.description', 'dt' => 6, 'field' => 'description'),
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
            FROM sales_return AS a
            JOIN gudang AS c ON c.id = a.drug_id
        ';

        $data['where'] = 'CURDATE() = DATE(a.created_at)';

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
        $btns[] = get_btn(['access' => $read_access, 'title' => 'Cetak Transaksi', 'icon' => 'print', 'onclick' => 'window.open(\'' . base_url('adminpanel/laporan/print_payment_retur_jual/' . $id) . '\')']);
        $btn_group = group_btns($btns);

        return $btn_group;
    }

    public function form_rules()
    {
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
    }

    public function get_row($id)
    {
        $columns = ['id', 'no_retur', 'drug_id', 'drug_name', 'quantity', 'sell_price', 'total_retur', 'description', 'created_at', 'updated_at'];
        $this->db->select('a.id, a.no_retur, a.drug_id, a.quantity, a.description, a.created_at, a.updated_at, c.name AS drug_name, c.sell_price, (c.sell_price * a.quantity) AS total_retur')
            ->from('sales_return a')
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
            'drug_id' => $post_data['drug_id'],
            'quantity' => $post_data['quantity'],
            'description' => $post_data['description'],
        ];

        return $data;
    }

    function get_drug($drug_id)
    {
        $this->db->select('b.name AS drug_name')
            ->from('sales_return a')
            ->join('gudang b', 'b.id = a.drug_id')
            ->where(['a.drug_id' => $drug_id]);
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    function get_drug_new()
    {
        $query = $this->db->query('SELECT * FROM gudang');
        return $query->result();
    }

    public function get_retur_jual($start, $end)
    {
        $this->db->select('a.created_at, a.no_retur, c.name AS drug_name, c.sell_price, a.quantity, (c.sell_price * a.quantity) AS sell_price_total, a.description')
            ->from('sales_return a')
            ->join('gudang c', 'c.id = a.drug_id', 'left')
            ->where('DATE(a.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_retur_penjualan_data($start, $end)
    {
        $this->db->select('SUM(c.sell_price * a.quantity) AS nominal_retur_jual')
            ->from('sales_return a')
            ->join('gudang c', 'c.id = a.drug_id', 'left')
            ->where('DATE(a.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function get_retur_jual_byname($name)
    {
        $this->db->select('a.created_at, a.no_retur, c.name AS drug_name, c.sell_price, a.quantity, (c.sell_price * a.quantity) AS sell_price_total, a.description')
            ->from('sales_return a')
            ->join('gudang c', 'c.id = a.drug_id', 'left')
            ->where(['c.name' => $name]);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_retur_penjualan_byname($name)
    {
        $this->db->select('SUM(c.sell_price * a.quantity) AS nominal_retur_jual')
            ->from('sales_return a')
            ->join('gudang c', 'c.id = a.drug_id', 'left')
            ->where(['c.name' => $name]);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function get_retur_jual_retur($retur)
    {
        $this->db->select('a.created_at, a.no_retur, c.name AS drug_name, c.sell_price, a.quantity, (c.sell_price * a.quantity) AS sell_price_total, a.description')
            ->from('sales_return a')
            ->join('gudang c', 'c.id = a.drug_id', 'left')
            ->where(['a.no_retur' => $retur]);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_retur_penjualan_retur($retur)
    {
        $this->db->select('SUM(c.sell_price * a.quantity) AS nominal_retur_jual')
            ->from('sales_return a')
            ->join('gudang c', 'c.id = a.drug_id', 'left')
            ->where(['a.no_retur' => $retur]);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
}
