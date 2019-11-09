<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Purchase_faktur extends CI_Model
{
    private $table = 'purchase_faktur';
    private $title = 'Faktur Pembelian Data';

    public function _get($name)
    {
        return isset($this->{$name}) ? $this->{$name} : 'Error, Property not defined!';
    }

    public function post_data_faktur(array $post_data, $key)
    {
        $this->load->model(['base_model']);
        $delete_purchase_faktur = $this->base_model->delete_data($this->table, ['id_purchase' => $key], $this->title);
        if ($delete_purchase_faktur['status'] == 'error') {
            $this->output
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($delete_purchase_faktur));
            exit();
        }

        $total = count($post_data['drug_id']);
        for ($i = 0; $i < $total; $i++) {
            if (!empty($post_data['drug_id'][$i])) {
                $data[] = [
                    'id_purchase' => $key,
                    'drug_id' => $post_data['drug_id'][$i],
                    'barcode' => $post_data['barcode'][$i],
                    'name' => $post_data['nama'][$i],
                    'price' => $post_data['drug_price'][$i],
                    'quantity' => $post_data['drug_quantity'][$i],
                    'subtotal' => $post_data['drug_subtotal'][$i],
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            }
        }
        if (isset($data)) {
            $submit = $this->base_model->submit_batch($this->table, $this->title, $data);
        }

        return $submit;
    }
}
