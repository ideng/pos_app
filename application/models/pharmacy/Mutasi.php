<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Mutasi extends CI_Model
{
    private $table = 'purchase';
    private $primary_key = 'id';
    private $title = 'Mutasi Data';

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
                'db' => 'a.created_at', 'dt' => 1, 'field' => 'created_at',
                'formatter' => function ($d) {
                    return format_date($d, 'd-m-Y H:i:s');
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
            array(
                'db' => 'c.sell_price', 'dt' => 5, 'field' => 'sell_price',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array('db' => 'a.quantity', 'dt' => 6, 'field' => 'quantity'),
            array(
                'db' => 'c.sell_price * a.quantity AS total_sell_price', 'dt' => 7, 'field' => 'total_sell_price',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array('db' => 'a.description', 'dt' => 8, 'field' => 'description'),
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
        $btn_group = group_btns($btns);

        return $btn_group;
    }

    public function get_mutasi_data($start, $end, $type = 'beli')
    {
        $this->db->select('b.created_at AS tanggal, a.name AS nama_obat, b.no_faktur AS faktur_pembelian, e.name AS supplier_name, c.price AS harga_beli, COALESCE (c.quantity,0) AS jml_beli, COALESCE (d.quantity,0) AS jml_retur_beli, COALESCE (c.quantity,0) - COALESCE (d.quantity,0) AS jml_pembelian, COALESCE (c.subtotal,0) AS nominal_beli, c.price * COALESCE (d.quantity,0) AS nominal_retur_beli, COALESCE (c.subtotal,0) - (c.price * COALESCE (d.quantity,0)) AS nominal_pembelian');
        if ($type == 'beli') {
            $this->db->from('gudang a')
                ->join('purchase_faktur c', 'c.drug_id = a.id', 'left')
                ->join('purchase b', 'b.id = c.id_purchase', 'left')
                ->join('supplier e', 'e.supplier_code = b.supplier_id', 'left');
        } elseif ($type == 'beli') {
            $this->db->from('gudang a')
                ->join('sales_item c', 'c.drug_id = a.id', 'left')
                ->join('sales b', 'b.id = c.drugpurchase_id', 'left')
                ->join('gudang d', 'd.id = b.patient_id', 'left');
        }
        $this->db->where('DATE(b.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_mutasi_jual($start, $end)
    {
        $this->db->select('b.created_at AS tanggal,
        a.name AS nama_obat,
        b.no_faktur AS faktur_penjualan,
        d.name AS nama_pasien,
        c.price AS harga_jual,
        COALESCE (c.quantity,0) AS jml_jual,
        c.subtotal AS nominal_jual,')
            ->from('gudang a')
            ->join('sales_item c', 'c.drug_id = a.id', 'left')
            ->join('sales b', 'b.id = c.drugpurchase_id', 'left')
            ->join('customer d', 'd.id = b.patient_id', 'left')
            ->where('DATE(b.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_mutasi_penjualan($start, $end)
    {
        $this->db->select('SUM(c.subtotal) AS nominal_jual')
            ->from('sales_item c')
            ->join('sales b', 'b.id = c.drugpurchase_id', 'left')
            ->where('DATE(b.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    public function get_mutasi_penjualan_now()
    {
        $this->db->select('SUM(c.subtotal) AS nominal_jual')
            ->from('sales_item c')
            ->join('sales b', 'b.id = c.drugpurchase_id', 'left')
            ->where('CURDATE() = DATE(b.created_at)');
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function get_mutasi_retur_jual_now()
    {
        $this->db->select('SUM(a.sell_price * b.quantity) AS nominal_retur_jual')
            ->from('gudang a')
            ->join('sales_return b', 'b.drug_id = a.id', 'left')
            ->where('CURDATE() = DATE(b.created_at)');
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function get_mutasi_retur_penjualan_now($start, $end)
    {
        $this->db->select('SUM(a.sell_price * b.quantity) AS nominal_retur_jual')
            ->from('gudang a')
            ->join('sales_return b', 'b.drug_id = a.id', 'left')
            ->where('DATE(b.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function get_retur_jual($start, $end)
    {
        $this->db->select('a.created_at, a.no_retur, c.name AS drug_name, c.purchase_price, a.quantity, (c.sell_price * a.quantity) AS sell_price_total, a.description')
            ->from('sales_return a')
            ->join('gudang c', 'c.id = a.drug_id', 'left')
            ->where('DATE(a.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
}
