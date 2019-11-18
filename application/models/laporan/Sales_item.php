<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Sales_item extends CI_Model
{
    private $table = 'sales_item';
    private $title = 'Barang';

    public function _get($name)
    {
        return isset($this->{$name}) ? $this->{$name} : 'Error, Property not defined!';
    }

    public function post_data_drugs(array $post_data, $key)
    {
        $this->load->model(['base_model']);
        $delete_purchase_drug = $this->base_model->delete_data($this->table, ['drugpurchase_id' => $key], $this->title);
        if ($delete_purchase_drug['status'] == 'error') {
            $this->output
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($delete_purchase_drug));
            exit();
        }

        $total = count($post_data['drug_id']);
        for ($i = 0; $i < $total; $i++) {
            if (!empty($post_data['drug_id'][$i])) {
                $data[] = [
                    'drugpurchase_id' => $key,
                    'drug_id' => $post_data['drug_id'][$i],
                    'barcode' => $post_data['barcode'][$i],
                    'name' => $post_data['name'][$i],
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
