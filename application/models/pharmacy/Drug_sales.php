<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Drug_sales extends CI_Model
{
	public function _get(string $name)
	{
		return isset($this->{$name}) ? $this->{$name} : 'Error, Property not defined!';
	}

	public function ssp_table()
	{
		$this->load->model(['admission/diagnoses']);
		$data = $this->diagnoses->ssp_table(TRUE);
		return $data;
	}

	public function post_data(array $post_data, string $key)
	{
		$this->load->model(['base_model']);
		$data = [];
		$total_payment = count($post_data['payment_name']);
		for ($i = 0; $i < $total_payment; $i++) {
			$price = empty($post_data['payment_price'][$i]) ? '0' : $post_data['payment_price'][$i];
			$quantity = empty($post_data['payment_quantity'][$i]) ? '1' : $post_data['payment_quantity'][$i];
			$subtotal = empty($post_data['payment_subtotal'][$i]) ? '0' : $post_data['payment_subtotal'][$i];
			$data[] = [
				'diagnose_id' => $key,
				'name' => $post_data['payment_name'][$i],
				'description' => $post_data['payment_name'][$i],
				'price' => $price,
				'quantity' => $quantity,
				'subtotal' => $subtotal,
				'created_at' => date('Y-m-d H:i:s'),
			];
		}
		if (!empty($data)) {
			$this->base_model->delete_data('diagnosedrug_sales', ['diagnose_id' => $key], 'Data Pembayaran');
		}

		return $data;
	}
}
