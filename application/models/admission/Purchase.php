<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Purchase extends CI_Model
{
    private $table = 'purchase';
    private $primary_key = 'id';
    private $title = 'Pembelian Barang';

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
                'db' => 'a.no_faktur', 'dt' => 3, 'field' => 'no_faktur',
                'formatter' => function ($d) {
                    return empty_string($d, '-');
                }
            ),
            array('db' => 'b.name AS supplier_name', 'dt' => 4, 'field' => 'supplier_name'),
            array(
                'db' => 'a.total_bayar', 'dt' => 5, 'field' => 'total_bayar',
                'formatter' => function ($d) {
                    return number_format(empty_string($d, '0'), 2, ',', '.');
                }
            ),
            array(
                'db' => 'a.created_at', 'dt' => 6, 'field' => 'created_at',
                'formatter' => function ($d) {
                    return format_date($d, 'd-m-Y H:i:s');
                }
            ),
            array(
                'db' => 'a.updated_at', 'dt' => 7, 'field' => 'updated_at',
                'formatter' => function ($d) {
                    $date = empty($d) ? empty_string($d, '-') : format_date($d, 'd-m-Y H:i:s');
                    return $date;
                }
            ),
        );

        $data['sql_details'] = sql_connect();

        $data['joinQuery'] = '
            FROM purchase AS a
            LEFT JOIN supplier AS b ON b.id = a.supplier_id
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

        $this->form_validation->set_rules('code_supplier_id', 'Code Supplier ID', 'required');
        //$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
    }

    public function get_row($id)
    {
        $columns = ['id', 'no_faktur', 'nama_obat', 'drug_id', 'barcode', 'supplier_code', 'supplier_id', 'supplier_name', 'total_bayar', 'created_at', 'updated_at'];
        $this->db->select('a.id, c.name AS nama_obat, b.drug_id, c.barcode, a.no_faktur, d.name AS supplier_name, d.supplier_code, b.price, b.quantity, b.subtotal, a.total_bayar, a.created_at, a.updated_at, a.supplier_id, d.supplier_code')
            ->from('purchase a')
            ->join('purchase_faktur b', 'b.id_purchase = a.id', 'left')
            ->join('supplier d', 'd.id = a.supplier_id', 'left')
            ->join('gudang c', 'c.id = b.drug_id', 'left')
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
        $no_faktur = empty($post_data['no_faktur']) ? $this->code_generators->generate_code('purchase') : $post_data['no_faktur'];

        $data = [
            'id' => $post_data['id'],
            'no_faktur' => $no_faktur,
            'supplier_id' => $post_data['supplier_id'],
            'total_bayar' => $post_data['drug_bayar'],
        ];

        return $data;
    }

    public function get_supplier($supplier_id)
    {
        $this->db->select('b.name AS supplier_name, b.supplier_code, a.total_bayar')
            ->from('purchase a')
            ->join('supplier b', 'b.id = a.supplier_id')
            ->where(['a.supplier_id' => $supplier_id]);
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    public function delete_data($id)
    {
        $this->load->model(['base_model']);
        $data = $this->base_model->delete_data($this->table, ['id' => $id], $this->title);
        $data = $this->base_model->delete_data('purchase_faktur', ['id_purchase' => $id], $this->title);
        $data = $this->base_model->delete_data('purchase_return', ['no_faktur_id' => $id], $this->title);
        return $data;
    }

    public function get_barcode($drug_id)
    {
        $this->db->select('b.barcode')
            ->from('purchase_faktur a')
            ->join('gudang b', 'b.id = a.drug_id')
            ->where(['a.drug_id' => $drug_id]);
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    public function viewByBarcode($barcode)
    {
        $this->db->where('barcode', $barcode);
        $result = $this->db->get('gudang')->row(); // Tampilkan data siswa berdasarkan NIS

        return $result;
    }

    // public function get_drugs(string $drug_id)
    // {
    //     $this->db->select('a.id, b.name AS drug_name')
    //         ->from('purchase a')
    //         ->join('drugs b', 'b.id = a.drug_id')
    //         ->where(['a.drug_id' => $drug_id]);
    //     $query = $this->db->get();
    //     $result = $query->result();

    //     return $result;
    // }
}
