<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Mutasi_jual extends CI_Model
{
    private $table = 'sales';
    private $primary_key = 'id';
    private $title = 'Mutasi Jual Data';

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
                'db' => 'a.created_at AS tgl_penjualan', 'dt' => 1, 'field' => 'tgl_penjualan',
                'formatter' => function ($d) {
                    return format_date($d, 'd-m-Y');
                }
            ),
            array('db' => 'a.' . $this->primary_key, 'dt' => 2, 'field' => $this->primary_key),
            array('db' => 'a.no_faktur AS faktur_jual', 'dt' => 3, 'field' => 'faktur_jual'),
            array('db' => 'c.name AS nama_pasien', 'dt' => 4, 'field' => 'nama_pasien'),
            array('db' => 'e.name AS nama_obat', 'dt' => 5, 'field' => 'nama_obat'),
            array(
                'db' => 'b.price AS harga_jual', 'dt' => 6, 'field' => 'harga_jual',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => 'b.quantity AS jml_jual', 'dt' => 7, 'field' => 'jml_jual',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => 'b.subtotal AS nominal_jual', 'dt' => 8, 'field' => 'nominal_jual',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
        );

        $data['sql_details'] = sql_connect();

        $data['joinQuery'] = '
        FROM
        sales a
        LEFT JOIN sales_item b ON b.drugpurchase_id = a.id
        LEFT JOIN customer c ON c.id = a.patient_id
        LEFT JOIN gudang e ON e.id = b.drug_id
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
}
