<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Mutasi_jual extends CI_Model
{
    private $table = 'purchase_return';
    private $primary_key = 'id';
    private $title = 'Retur Pembelian';

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
                'db' => 'c.purchase_price AS purchase_price', 'dt' => 5, 'field' => 'purchase_price',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array('db' => 'a.quantity', 'dt' => 6, 'field' => 'quantity'),
            array(
                'db' => 'c.purchase_price * a.quantity AS total_purchase_price', 'dt' => 7, 'field' => 'total_purchase_price',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array('db' => 'a.description', 'dt' => 8, 'field' => 'description'),
        );

        $data['sql_details'] = sql_connect();

        $data['joinQuery'] = '
            FROM purchase_return AS a
            JOIN gudang AS c ON c.id = a.drug_id
        ';

        $data['where'] = 'CURDATE() = DATE(a.created_at)';

        $data['group_by'] = '';

        $data['having'] = '';

        return $data;
    }
}
