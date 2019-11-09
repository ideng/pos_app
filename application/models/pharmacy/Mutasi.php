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

            array('db' => 'a.created_at AS tgl_beli', 'dt' => 1, 'field' => 'tgl_beli'),
            array('db' => 'a.' . $this->primary_key, 'dt' => 2, 'field' => $this->primary_key),
            array('db' => 'a.no_faktur AS faktur_beli', 'dt' => 3, 'field' => 'faktur_beli'),
            array('db' => 'c.name AS nama_supplier', 'dt' => 4, 'field' => 'nama_supplier'),
            array('db' => 'd.name AS nama_obat', 'dt' => 5, 'field' => 'nama_obat'),
            array(
                'db' => 'b.price AS harga_beli', 'dt' => 6, 'field' => 'harga_beli',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => 'COALESCE (b.quantity,0) AS jml_beli', 'dt' => 7, 'field' => 'jml_beli',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => 'COALESCE (e.quantity,0) AS retur_beli', 'dt' => 8, 'field' => 'retur_beli',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => 'COALESCE (b.quantity,0) - COALESCE (e.quantity,0) AS total_beli', 'dt' => 9, 'field' => 'total_beli',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => 'COALESCE (b.subtotal,0) AS nominal_beli', 'dt' => 10, 'field' => 'nominal_beli',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => '(COALESCE (b.price,0) * COALESCE(e.quantity,0)) AS nominal_retur_beli', 'dt' => 11, 'field' => 'nominal_retur_beli',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => '(COALESCE (b.subtotal,0) - (COALESCE (b.price,0) * COALESCE(e.quantity,0))) AS nominal_pembelian', 'dt' => 12, 'field' => 'nominal_pembelian',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
        );

        $data['sql_details'] = sql_connect();

        $data['joinQuery'] = '
        FROM
        purchase a
        LEFT JOIN purchase_faktur b ON b.id_purchase = a.id
        LEFT JOIN supplier c ON c.supplier_code = a.supplier_id
        LEFT JOIN gudang d ON d.id = b.drug_id
        LEFT JOIN purchase_return e ON e.drug_id = b.drug_id AND e.no_faktur_id = b.id_purchase
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

    public function get_mutasi_data($start, $end, $type = 'beli')
    {
        $this->db->select('b.created_at AS tanggal, a.name AS nama_obat, b.no_faktur AS faktur_pembelian, e.name AS supplier_name, c.price AS harga_beli, COALESCE (c.quantity,0) AS jml_beli, COALESCE (d.quantity,0) AS jml_retur_beli, COALESCE (c.quantity,0) - COALESCE (d.quantity,0) AS jml_pembelian, COALESCE (c.subtotal,0) AS nominal_beli, c.price * COALESCE (d.quantity,0) AS nominal_retur_beli, COALESCE (c.subtotal,0) - (c.price * COALESCE (d.quantity,0)) AS nominal_pembelian');
        if ($type == 'beli') {
            $this->db->from('gudang a')
                ->join('purchase_faktur c', 'c.drug_id = a.id', 'left')
                ->join('purchase b', 'b.id = c.id_purchase', 'left')
                ->join('purchase_return d', 'd.drug_id = c.drug_id AND d.no_faktur_id = c.id_purchase', 'left')
                ->join('supplier e', 'e.supplier_code = b.supplier_id', 'left');
        } elseif ($type == 'beli') {
            $this->db->from('gudang a')
                ->join('sales_item c', 'c.drug_id = a.id', 'left')
                ->join('sales b', 'b.id = c.drugpurchase_id', 'left')
                ->join('gudang d', 'd.id = b.patient_id', 'left')
                ->join('sales_return e', 'e.drug_id = c.drug_id AND e.no_faktur_id = c.drugpurchase_id', 'left');
        }
        $this->db->where('DATE(b.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_mutasi_beli($start, $end)
    {
        $this->db->select('b.created_at AS tanggal, a.name AS nama_obat, b.no_faktur AS faktur_pembelian,
        e.name AS supplier_name, c.price AS harga_beli, COALESCE (c.quantity,0) AS jml_beli, COALESCE (d.quantity,0) AS jml_retur_beli, COALESCE (c.quantity,0) - COALESCE (d.quantity,0) AS jml_pembelian,
        COALESCE (c.subtotal,0) AS nominal_beli, c.price * COALESCE (d.quantity,0) AS nominal_retur_beli,
        COALESCE (c.subtotal,0) - (c.price * COALESCE (d.quantity,0)) AS nominal_pembelian')
            ->from('gudang a')
            ->join('purchase_faktur c', 'c.drug_id = a.id', 'left')
            ->join('purchase b', 'b.id = c.id_purchase', 'left')
            ->join('purchase_return d', 'd.drug_id = c.drug_id AND d.no_faktur_id = c.id_purchase', 'left')
            ->join('supplier e', 'e.supplier_code = b.supplier_id', 'left')
            ->where('DATE(b.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
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
        COALESCE (e.quantity,0) AS jml_retur_jual,
        COALESCE (c.quantity,0) - COALESCE (e.quantity,0) AS jml_penjualan,
        c.subtotal AS nominal_jual,
        c.price * COALESCE (e.quantity,0) AS numinal_retur,
        c.subtotal - (c.price * COALESCE (e.quantity,0)) AS nominal_penjualan')
            ->from('gudang a')
            ->join('sales_item c', 'c.drug_id = a.id', 'left')
            ->join('sales b', 'b.id = c.drugpurchase_id', 'left')
            ->join('customer d', 'd.id = b.patient_id', 'left')
            ->join('sales_return e', 'e.drug_id = c.drug_id AND e.no_faktur_id = c.drugpurchase_id', 'left')
            ->where('DATE(b.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_mutasi_pembelian($start, $end)
    {
        $this->db->select('SUM(c.subtotal) AS nominal_beli,
        SUM(c.price * d.quantity) AS nominal_retur_beli,
        (SUM(c.subtotal) - SUM(c.price * d.quantity)) AS nominal_pembelian')
            ->from('gudang a')
            ->join('purchase_faktur c', 'c.drug_id = a.id', 'left')
            ->join('purchase b', 'b.id = c.id_purchase', 'left')
            ->join('purchase_return d', 'd.drug_id = c.drug_id AND d.no_faktur_id = c.id_purchase', 'left')
            ->where('DATE(b.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function get_mutasi_penjualan($start, $end)
    {
        $this->db->select('SUM(c.subtotal) AS nominal_jual,
        COALESCE(SUM(c.price * e.quantity),0) AS numinal_retur,
        (SUM(c.subtotal) - COALESCE(SUM(c.price * e.quantity),0)) AS nominal_penjualan')
            ->from('sales_item c')
            ->join('sales b', 'b.id = c.drugpurchase_id', 'left')
            ->join('sales_return e', 'e.drug_id = c.drug_id AND e.no_faktur_id = c.drugpurchase_id', 'left')
            ->where('DATE(b.created_at) BETWEEN "' . format_date($start, 'Y-m-d') . '" and "' . format_date($end, 'Y-m-d') . '"');
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
}
