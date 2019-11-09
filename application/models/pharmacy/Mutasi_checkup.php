<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Mutasi_checkup extends CI_Model
{
    private $table = 'diagnose_drugs';
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

            array('db' => 'a.created_at AS tgl_checkup', 'dt' => 1, 'field' => 'tgl_checkup'),
            array('db' => 'a.' . $this->primary_key, 'dt' => 2, 'field' => $this->primary_key),
            array('db' => 'c.name AS nama_pasien', 'dt' => 3, 'field' => 'nama_pasien'),
            array('db' => 'd.name AS nama_obat', 'dt' => 4, 'field' => 'nama_obat'),
            array(
                'db' => 'a.price AS harga_jual', 'dt' => 5, 'field' => 'harga_jual',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => 'a.quantity AS jml_beli', 'dt' => 6, 'field' => 'jml_beli',
                'formatter' => function ($d) {
                    return empty_string($d, '0');
                }
            ),
            array(
                'db' => 'a.price * a.quantity AS nominal_pembelian', 'dt' => 7, 'field' => 'nominal_pembelian',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
        );

        $data['sql_details'] = sql_connect();

        $data['joinQuery'] = '
        FROM
        diagnose_drugs a
        LEFT JOIN diagnoses b ON b.id = a.diagnose_id
        LEFT JOIN customer c ON c.id = b.patient_id
        LEFT JOIN gudang d ON d.id = a.drug_id
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
}
