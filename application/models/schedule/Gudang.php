<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Gudang extends CI_Model
{
    private $table = 'gudang';
    private $primary_key = 'id';
    private $title = 'Data Gudang';

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
            array('db' => 'a.name AS drug_name', 'dt' => 3, 'field' => 'drug_name'),
            array('db' => 'a.barcode AS barcode', 'dt' => 4, 'field' => 'barcode'),
            array(
                'db' => 'Coalesce(SUM(DISTINCT b.quantity),0) AS jumlah_pembelian', 'dt' => 5, 'field' => 'jumlah_pembelian',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => 'Coalesce(SUM(DISTINCT c.quantity),0) AS jumlah_retur_pembelian', 'dt' => 6, 'field' => 'jumlah_retur_pembelian',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => '(Coalesce(SUM(DISTINCT b.quantity),0) - Coalesce(SUM(DISTINCT c.quantity),0)) AS Stock_masuk', 'dt' => 7, 'field' => 'Stock_masuk',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => '(a.purchase_price * Coalesce(SUM(DISTINCT b.quantity),0)) AS nominal_pembelian', 'dt' => 8, 'field' => 'nominal_pembelian',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => '(a.purchase_price * Coalesce(SUM(DISTINCT c.quantity),0)) AS nominal_retur', 'dt' => 9, 'field' => 'nominal_retur',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => '((a.purchase_price * Coalesce(SUM(DISTINCT b.quantity),0)) - (a.purchase_price * Coalesce(SUM(DISTINCT c.quantity),0))) AS total_pembelian', 'dt' => 10, 'field' => 'total_pembelian',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => 'COALESCE ( SUM( DISTINCT d.quantity ), 0 ) AS jml_jual', 'dt' => 11, 'field' => 'jml_jual',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => 'COALESCE ( SUM( DISTINCT e.quantity ), 0 ) AS jml_retur_jual', 'dt' => 12, 'field' => 'jml_retur_jual',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => '((COALESCE ( SUM( DISTINCT d.quantity ), 0 ) - COALESCE ( SUM( DISTINCT e.quantity ), 0 ) )) AS stock_jual', 'dt' => 13, 'field' => 'stock_jual',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => '(a.sell_price * COALESCE ( SUM( DISTINCT d.quantity ), 0 )) AS nominal_jual', 'dt' => 14, 'field' => 'nominal_jual',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => '( a.sell_price * COALESCE ( SUM( DISTINCT e.quantity ), 0 ) ) AS nominal_retur_jual', 'dt' => 15, 'field' => 'nominal_retur_jual',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => '(( a.sell_price * COALESCE ( SUM( DISTINCT d.quantity ), 0 ) ) - ( a.sell_price * COALESCE ( SUM( DISTINCT e.quantity ), 0 ) )) AS total_penjualan', 'dt' => 16, 'field' => 'total_penjualan',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => '(( COALESCE ( SUM( DISTINCT b.quantity ), 0 ) - COALESCE ( SUM( DISTINCT c.quantity ), 0 ) ) - (COALESCE ( SUM( DISTINCT d.quantity ), 0 ) - COALESCE ( SUM( DISTINCT e.quantity ), 0 ) )) AS stock_akhir', 'dt' => 17, 'field' => 'stock_akhir',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => '(( COALESCE ( SUM( DISTINCT b.quantity ), 0 ) - COALESCE ( SUM( DISTINCT c.quantity ), 0 ) ) - (COALESCE ( SUM( DISTINCT d.quantity ), 0 ) - COALESCE ( SUM( DISTINCT e.quantity ), 0 ) )) AS stock_akhir_new', 'dt' => 18, 'field' => 'stock_akhir_new',
                'formatter' => function ($d) {
                    return min_string($d);
                }
            ),
        );

        $data['sql_details'] = sql_connect();

        $data['joinQuery'] = '
        FROM gudang AS a
        LEFT JOIN purchase_faktur AS b ON b.drug_id = a.id
        LEFT JOIN purchase_return AS c ON c.drug_id = a.id
        LEFT JOIN sales_item AS d ON d.drug_id = a.id
        LEFT JOIN sales_return AS e ON e.drug_id = a.id
        ';

        $data['where'] = '';

        $data['group_by'] = 'a.id';

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
        $this->form_validation->set_rules('name', 'Drug Name', 'required');
        $this->form_validation->set_rules('barcode', 'Barcode', 'required');
        $this->form_validation->set_rules('sell_price', 'Sell Price', 'required');
        $this->form_validation->set_rules('purchase_price', 'Purchase Price', 'required');
    }

    public function post_data(array $post_data)
    {
        $data = [
            'id' => $post_data['id'],
            'name' => $post_data['name'],
            'barcode' => $post_data['barcode'],
            'type_id' => $post_data['type_drug'],
            'sell_price' => $post_data['sell_price'],
            'purchase_price' => $post_data['purchase_price'],
            'description' => $post_data['description'],
        ];

        return $data;
    }

    public function get_row($id)
    {
        $columns = ['id', 'drug_name', 'barcode', 'type_id', 'type_name', 'sell_price', 'purchase_price', 'description', 'created_at', 'updated_at'];
        $this->db->select('a.id, a.name AS drug_name, a.barcode, a.type_id, b.name AS type_name, a.sell_price, a.purchase_price, a.description, a.created_at, a.updated_at')
            ->from('gudang a')
            ->join('type_drugs b', 'b.id = a.type_id')
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

    public function get_type_drugs()
    {
        $query = $this->db->query('SELECT * FROM type_drugs');
        return $query->result();
    }


    public function get_type($type_id)
    {
        $this->db->select('b.name AS type_name, b.id')
            ->from('gudang a')
            ->join('type_drugs b', 'b.id = a.type_id')
            ->where(['a.type_id' => $type_id]);
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    public function get_drugs($id)
    {
        $this->db->select('a.name AS obat, a.barcode,
        a.purchase_price AS harga_beli,
        COALESCE ( SUM( DISTINCT b.quantity ), 0 ) AS jml_beli,
        COALESCE ( SUM( DISTINCT c.quantity ), 0 ) AS jml_retur_beli, ( COALESCE ( SUM( DISTINCT b.quantity ), 0 ) - COALESCE ( SUM( DISTINCT c.quantity ), 0 ) ) AS stock_beli, ( a.purchase_price * COALESCE ( SUM( DISTINCT b.quantity ), 0 ) ) AS nominal_beli,
        ( a.purchase_price * COALESCE ( SUM( DISTINCT c.quantity ), 0 ) ) AS nominal_retur_beli,
        ( a.purchase_price * COALESCE ( SUM( DISTINCT b.quantity ), 0 ) ) - ( a.purchase_price * COALESCE ( SUM( DISTINCT c.quantity ), 0 ) ) AS total_pembelian,
        a.sell_price,
        COALESCE ( SUM( DISTINCT d.quantity ), 0 ) AS jml_jual,
        COALESCE ( SUM( DISTINCT e.quantity ), 0 ) AS jml_retur_jual,
        (COALESCE ( SUM( DISTINCT d.quantity ), 0 ) - COALESCE ( SUM( DISTINCT e.quantity ), 0 ) ) AS stock_jual,
        ( a.sell_price * COALESCE ( SUM( DISTINCT d.quantity ), 0 ) ) AS nominal_jual,
        ( a.sell_price * COALESCE ( SUM( DISTINCT e.quantity ), 0 ) ) AS nominal_retur_jual,
        ( a.sell_price * COALESCE ( SUM( DISTINCT d.quantity ), 0 ) ) - ( a.sell_price * COALESCE ( SUM( DISTINCT e.quantity ), 0 ) ) AS total_penjualan,
        ( COALESCE ( SUM( DISTINCT b.quantity ), 0 ) - COALESCE ( SUM( DISTINCT c.quantity ), 0 ) ) - (COALESCE ( SUM( DISTINCT d.quantity ), 0 ) - COALESCE ( SUM( DISTINCT e.quantity ), 0 ) ) AS stock_akhir')
            ->from('gudang a')
            ->join('purchase_faktur b', 'b.drug_id = a.id', 'left')
            ->join('purchase_return c', 'c.drug_id = a.id', 'left')
            ->join('sales_item d', 'd.drug_id = a.id', 'left')
            ->join('sales_return e', 'e.drug_id = a.id', 'left')
            ->where(['a.id' => $id]);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_mutasi_beli($id)
    {
        $this->db->select('b.created_at AS tanggal,
        a.name AS nama_obat, a.barcode,
        b.no_faktur AS faktur_pembelian,
        e.name AS supplier_name,
        c.price AS harga_beli,
        COALESCE (c.quantity,0) AS jml_beli,
        COALESCE (d.quantity,0) AS jml_retur_beli,
        COALESCE (c.quantity,0) - COALESCE (d.quantity,0) AS jml_pembelian,
        COALESCE (c.subtotal,0) AS nominal_beli,
        c.price * COALESCE (d.quantity,0) AS nominal_retur_beli,
        COALESCE (c.subtotal,0) - (c.price * COALESCE (d.quantity,0)) AS nominal_pembelian')
            ->from('gudang a')
            ->join('purchase_faktur c', 'c.drug_id = a.id', 'left')
            ->join('purchase b', 'b.id = c.id_purchase', 'left')
            ->join('purchase_return d', 'd.drug_id = c.drug_id', 'left')
            ->join('supplier e', 'e.id = b.supplier_id', 'left')
            ->where(['a.id' => $id]);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_mutasi_jual($id)
    {
        $this->db->select('b.created_at AS tanggal,
        a.name AS nama_obat, a.barcode,
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
            ->join('sales_return e', 'e.drug_id = c.drug_id', 'left')
            ->where(['a.id' => $id]);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_mutasi_checkup($id)
    {
        $this->db->select('c.created_at AS tanggal, a.name AS nama_obat,
        d.name AS nama_pasien,
        b.price AS harga_jual,
        b.quantity AS jml_penjualan,
        (b.price * b.quantity) AS nominal_penjualan')
            ->from('gudang a')
            ->join('diagnose_drugs b', 'b.drug_id = a.id', 'left')
            ->join('diagnoses c', 'c.id = b.diagnose_id', 'left')
            ->join('customer d', 'd.id = c.patient_id', 'left')
            ->where(['a.id' => $id]);
        $query = $this->db->get();
        return $query->result();
    }

    public function purchase_faktur($start_date, $end_date)
    {
        $this->db->select('name', 'drug_id', 'quantity', 'price', 'subtotal');
        $this->db->from('purchase_faktur a');
        $this->db->join('gudang b', 'b.id = a.drug_id', 'left');
        $this->db->where("DATE_FORMAT(a.created_at, '%d-%m-%Y') < ", "DATE_FORMAT('$start_date', '%d-%m-%Y')");
        $this->db->where("DATE_FORMAT(a.created_at, '%d-%m-%Y') < ", "DATE_FORMAT('$end_date', '%d-%m-%Y')");
        return $this->db->get('')->result();
    }

    public function tampil_data()
    {
        return $this->db->get('gudang');
    }

    public function cari($id)
    {
        $query = $this->db->get_where('gudang', array('barcode' => $id));
        return $query;
    }
}
