<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Laporan extends MY_Controller
{
    private $class_name = 'laporan';
    private $class_link = 'adminpanel/laporan';

    public function __construct()
    {
        parent::__construct();
        if ($_SESSION['auth']['module'] != 'adminpanel') {
            redirect('/');
        }
    }

    public function _remap($method, array $args)
    {
        if (method_exists($this, $method)) {
            $this->{$method}($args);
        } else {
            $this->index($method);
        }
    }

    public function index($method)
    {
        parent::admin_tpl();
        parent::datatables_assets();
        parent::typeahead_assets();
        parent::moment_assets();
        parent::datetimepicker_assets();
        $data = [
            'class_link' => $this->class_link,
            'page' => $method
        ];
        $this->load->js('assets/admin_lte/custom/custom_js.js');
        $this->load->js('assets/admin_lte/custom/masters_js.js');
        if ($method == 'purchase') {
            $this->load->js('assets/admin_lte/custom/purchase_js.js');
            $this->load->js('js/config_purchase_laporan.js');
            $this->load->js('assets/admin_lte/custom/mutasi_beli_laporan_js.js');
            $this->load->js('assets/admin_lte/custom/mutasi_beli_name_js.js');
            $this->load->js('assets/admin_lte/custom/mutasi_beli_faktur_js.js');
            //$this->load->js('js/config_purchase_barang.js');
        }
        if ($method == 'sales') {
            $this->load->js('assets/admin_lte/custom/sales_js.js');
            $this->load->js('js/config_sales_laporan.js');
            $this->load->js('assets/admin_lte/custom/mutasi_jual_laporan_js.js');
            $this->load->js('assets/admin_lte/custom/mutasi_jual_name_js.js');
            $this->load->js('assets/admin_lte/custom/mutasi_jual_faktur_js.js');
            //$this->load->js('js/config_purchase_barang.js');
        }
        if ($method == 'purchase_return') {
            $this->load->js('assets/admin_lte/custom/retur_beli_laporan_js.js');
            $this->load->js('assets/admin_lte/custom/retur_beli_name_js.js');
            $this->load->js('assets/admin_lte/custom/retur_beli_js.js');
            //$this->load->js('js/config_purchase_barang.js');
        }
        if ($method == 'sales_return') {
            $this->load->js('assets/admin_lte/custom/retur_jual_laporan_js.js');
            $this->load->js('assets/admin_lte/custom/retur_jual_name_js.js');
            $this->load->js('assets/admin_lte/custom/retur_jual_js.js');
            //$this->load->js('js/config_purchase_barang.js');
        }
        $this->load->view('pages/' . $this->class_link . '/index', $data);
    }

    public function load_table()
    {
        $page = $this->input->get('page');
        $page_url = $this->input->get('page_url');
        $data = [
            'class_link' => $this->class_link,
            'page' => $page,
        ];
        $this->load->view('pages/' . $page_url . '/table', $data);
    }

    public function table_data()
    {
        $page = $this->input->get('page');
        $this->load->library(['custom_ssp']);
        $this->load->model([$this->class_name . '/' . $page]);

        $data = $this->{$page}->ssp_table();
        $this->output->set_output(json_encode(
            Custom_ssp::simple($_GET, $data['sql_details'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['where'])
        ));
    }

    public function load_detail()
    {
        $this->load->helper(['flag']);
        $page = $this->input->get('page');
        $this->load->model(['base_model', 'laporan/' . $page]);
        $id = $this->input->get('id');
        $page_url = $this->input->get('page_url');
        $row = $this->base_model->get_row($page, ['id' => $id]);
        if ($page == 'purchase' || $page == 'sales' || $page == 'purchase_return' || $page == 'sales_return') {
            $row = $this->{$page}->get_row($id);
        }
        $data = [
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
            'class_link' => $this->class_link,
            'page' => $page,
            'row' => $row,
        ];
        if ($page == 'purchase') {
            $this->load->model(['laporan/purchase']);
            $purchase = $this->purchase->get_supplier($row->supplier_id);
            $data = array_merge($data, ['purchase' => $purchase]);
        } elseif ($page == 'sales') {
            $this->load->model(['laporan/sales']);
            $sales = $this->sales->patient_drug($row->patient_id);
            $data = array_merge($data, ['sales' => $sales]);
        } elseif ($page == 'purchase_return') {
            $this->load->model(['laporan/purchase_return']);
            $purchase_return = $this->purchase_return->get_drug($row->drug_id);
            $data = array_merge($data, ['purchase_return' => $purchase_return]);
        } elseif ($page == 'sales_return') {
            $this->load->model(['laporan/sales_return']);
            $sales_return = $this->sales_return->get_drug($row->drug_id);
            $data = array_merge($data, ['sales_return' => $sales_return]);
        }
        $this->load->view('pages/' . $page_url . '/detail', $data);
    }

    public function load_form()
    {
        $this->load->helper(['form']);
        $page_url = $this->input->get('page_url');
        $page = $this->input->get('page');
        $this->load->model(['base_model', 'laporan/' . $page]);
        $id = $this->input->get('id');
        $row = $this->base_model->get_row($page, ['id' => $id]);
        if ($page == 'purchase' || $page == 'sales' || $page == 'purchase_return' || $page == 'sales_return') {
            $row = $this->{$page}->get_row($id);
        }
        $data = [
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
            'class_link' => $this->class_link,
            'page' => $page,
            'row' => $row,
        ];
        if ($page == 'purchase') {
            $this->load->model(['laporan/purchase']);
            $purchase = $this->purchase->get_supplier($row->supplier_id);
            $data = array_merge($data, ['purchase' => $purchase]);
        } elseif ($page == 'sales') {
            $this->load->model(['laporan/sales']);
            $sales = $this->sales->patient_drug($row->patient_id);
            $data = array_merge($data, ['sales' => $sales]);
        } elseif ($page == 'purchase_return') {
            $this->load->model(['laporan/purchase_return']);
            $data['drugs'] = $this->purchase_return->get_drug_new();
            $purchase_return = $this->purchase_return->get_drug($row->drug_id);
            $data = array_merge($data, ['purchase_return' => $purchase_return]);
        } elseif ($page == 'sales_return') {
            $this->load->model(['laporan/sales_return']);
            $data['drugs'] = $this->sales_return->get_drug_new();
            $sales_return = $this->sales_return->get_drug($row->drug_id);
            $data = array_merge($data, ['sales_return' => $sales_return]);
        }
        $this->load->view('pages/' . $page_url . '/form', $data);
    }

    public function submit_form()
    {
        $page = $this->input->post('page');
        $this->load->library(['form_validation']);
        $this->load->model([$this->class_name . '/' . $page, 'base_model']);

        $title = $this->{$page}->_get('title');
        $this->{$page}->form_rules();
        if ($this->form_validation->run() == FALSE) {
            $msgs = $this->base_model->form_warning($this->input->post());
            $data['msg'] = build_alert('warning', 'Warning!', implode('', $msgs));
            $data['status'] = 'error';
        } else {
            $submit = $this->{$page}->post_data($this->input->post());
            if (isset($submit['status']) && $submit['status'] == 'error') {
                $data['msg'] = $submit['msg'];
                $data['status'] = $submit['status'];
            } else {
                $data = $this->base_model->submit_data($page, 'id', $title, $submit);
                if ($page == 'purchase' && $data['status'] == 'success') {
                    $this->load->model($this->class_name . '/Purchase_faktur');
                    $master_key = $data['key'];
                    $data = $this->Purchase_faktur->post_data_faktur($this->input->post(), $master_key);
                } elseif ($page == 'sales' && $data['status'] == 'success') {
                    $this->load->model($this->class_name . '/sales_item');
                    $master_key = $data['key'];
                    $data = $this->sales_item->post_data_drugs($this->input->post(), $master_key);
                }
            }
        }
        $data['csrf_val'] = $this->security->get_csrf_hash();

        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }

    public function delete_data()
    {
        $page = $this->input->get('page');
        $this->load->model([$this->class_name . '/' . $page, 'base_model']);

        $id = $this->input->get('id');
        $title = $this->{$page}->_get('title');

        $data = $this->base_model->delete_data($page, ['id' => $id], $title);

        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }

    public function search_purchase()
    {
        // Ambil data NIS yang dikirim via ajax post
        $barcode = $this->input->get('barcode');
        $this->load->model(['laporan/purchase']);
        $gudang = $this->purchase->viewByBarcode($barcode);

        if (!empty($gudang)) { // Jika data barcode ada/ditemukan
            // Buat sebuah array
            $callback = array(
                'status' => 'success', // Set array status dengan success
                'id' => $gudang->id,
                'name' => $gudang->name,
                'purchase_price' => $gudang->purchase_price,
            );
        } else {
            $callback = array('status' => 'failed'); // set array status dengan failed
        }

        echo json_encode($callback); // konversi varibael $callback menjadi JSON
    }

    public function search_sales()
    {
        // Ambil data NIS yang dikirim via ajax post
        $barcode = $this->input->get('barcode');
        $this->load->model(['pharmacy/sales']);
        $gudang = $this->sales->viewByBarcode($barcode);

        if (!empty($gudang)) { // Jika data siswa ada/ditemukan
            // Buat sebuah array
            $callback = array(
                'status' => 'success', // Set array status dengan success
                'id' => $gudang->id,
                'name' => $gudang->name, // Set array nama dengan isi kolom nama pada tabel siswa
                'sell_price' => $gudang->sell_price,
            );
        } else {
            $callback = array('status' => 'failed'); // set array status dengan failed
        }

        echo json_encode($callback); // konversi varibael $callback menjadi JSON
    }

    public function drug_purchase_payment()
    {
        $this->load->model(['base_model', 'admission/purchase']);
        $id = $this->input->get('id');
        $purchase = $this->purchase->get_row($id);
        $purchase_faktur = $this->base_model->get_all('purchase_faktur', ['id_purchase' => $id]);

        $data = [
            'id' => $id,
            'purchase' => $purchase,
            'purchase_faktur' => $purchase_faktur,
            'class_link' => $this->class_link,
            'page' => 'purchase',
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
        ];

        $this->load->view('pages/' . $this->class_link . '/purchase/form', $data);
    }

    public function load_form_purchase()
    {
        $this->load->model(['base_model']);
        $id = $this->input->get('id');
        $drugs = $this->base_model->get_all('gudang');
        $purchase = $this->base_model->get_all('purchase_faktur', ['id_purchase' => $id]);
        $data = [
            'drug_view' => $this->input->get('drug_view'),
            'purchase' => $purchase,
            'drugs' => $drugs,
            'drug_id' => '',
            'barcode' => '',
            'name' => '',
            'price' => '',
            'quantity' => '',
            'subtotal' => '',
            'btn' => 'plus',
            'is_hidden' => false,
        ];

        if (!empty($purchase)) {
            $no = 0;
            foreach ($purchase as $purchases) {
                $no++;
                $data['drug_id'] = $purchases->drug_id;
                $data['barcode'] = $purchases->barcode;
                $data['name'] = $purchases->name;
                $data['price'] = $purchases->price;
                $data['quantity'] = $purchases->quantity;
                $data['subtotal'] = $purchases->subtotal;
                $data['btn'] = $no > 1 ? 'minus' : $data['btn'];
                $data['is_hidden'] = $no > 1 ? true : false;
                $this->load->view('pages/' . $this->class_link . '/purchase/drug_form', $data);
            }
        } else {
            $this->load->view('pages/' . $this->class_link . '/purchase/drug_form', $data);
        }
    }

    public function add_form_purchase()
    {
        $this->load->model(['base_model']);
        $drugs = $this->base_model->get_all('gudang');
        $get_drug = $this->input->get('drug_view');
        $drug_view = empty($get_drug) ? 'form' : $this->input->get('drug_view');
        $data = [
            'drugs' => $drugs,
            'drug_view' => $drug_view,
            'drug_id' => '',
            'barcode' => '',
            'name' => '',
            'price' => '',
            'quantity' => '',
            'subtotal' => '',
            'btn' => 'minus',
            'is_hidden' => true,
        ];
        $this->load->view('pages/' . $this->class_link . '/purchase/drug_form', $data);
    }

    public function drug_payment_purchase()
    {
        $this->load->model(['base_model', 'laporan/sales']);
        $id = $this->input->get('id');
        $sales = $this->sales->get_row($id);
        $sales_item = $this->base_model->get_all('sales_item', ['drugpurchase_id' => $id]);

        $data = [
            'id' => $id,
            'sales' => $sales,
            'sales_item' => $sales_item,
            'class_link' => $this->class_link,
            'page' => 'sales',
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
        ];

        $this->load->view('pages/' . $this->class_link . '/sales/form', $data);
    }

    public function load_drug_form_purchase()
    {
        $this->load->model(['base_model']);
        $id = $this->input->get('id');
        $drugs = $this->base_model->get_all('gudang');
        $sales_items = $this->base_model->get_all('sales_item', ['drugpurchase_id' => $id]);
        $data = [
            'drug_view' => $this->input->get('drug_view'),
            'sales_item' => $sales_items,
            'drugs' => $drugs,
            'drug_id' => '',
            'barcode' => '',
            'name' => '',
            'price' => '',
            'quantity' => '',
            'subtotal' => '',
            'btn' => 'plus',
            'is_hidden' => false,
        ];

        if (!empty($sales_items)) {
            $no = 0;
            foreach ($sales_items as $sales_item) {
                $no++;
                $data['drug_id'] = $sales_item->drug_id;
                $data['barcode'] = $sales_item->barcode;
                $data['name'] = $sales_item->name;
                $data['price'] = $sales_item->price;
                $data['quantity'] = $sales_item->quantity;
                $data['subtotal'] = $sales_item->subtotal;
                $data['btn'] = $no > 1 ? 'minus' : $data['btn'];
                $data['is_hidden'] = $no > 1 ? true : false;
                $this->load->view('pages/' . $this->class_link . '/sales/drug_form', $data);
            }
        } else {
            $this->load->view('pages/' . $this->class_link . '/sales/drug_form', $data);
        }
    }

    public function add_drug_form_purchase()
    {
        $this->load->model(['base_model']);
        $drugs = $this->base_model->get_all('gudang');
        $data_drug = $this->input->get('drug_view');
        $drug_view = empty($data_drug) ? 'form' : $this->input->get('drug_view');
        $data = [
            'drugs' => $drugs,
            'drug_view' => $drug_view,
            'drug_id' => '',
            'barcode' => '',
            'name' => '',
            'price' => '',
            'quantity' => '',
            'subtotal' => '',
            'btn' => 'minus',
            'is_hidden' => true,
        ];
        $this->load->view('pages/' . $this->class_link . '/sales/drug_form', $data);
    }

    public function print_payment($id)
    {
        parent::admin_print_tpl();
        $this->load->helper(['number_helper']);
        $this->load->model(['base_model', 'laporan/purchase']);
        $row = $this->purchase->get_row($id[0]);
        $pembelian = $this->base_model->get_all('purchase_faktur', ['id_purchase' => $row->id]);

        $data = [
            'row' => $row,
            'pembelian' => $pembelian,
        ];
        $this->load->view('pages/' . $this->class_link . '/purchase/detail_print_payment', $data);
    }

    public function print_payment_jual($id)
    {
        parent::admin_print_tpl();
        $this->load->helper(['number_helper']);
        $this->load->model(['base_model', 'laporan/sales']);
        $row = $this->sales->get_row($id[0]);
        $penjualan = $this->base_model->get_all('sales_item', ['drugpurchase_id' => $row->id]);

        $data = [
            'row' => $row,
            'penjualan' => $penjualan,
        ];
        $this->load->view('pages/' . $this->class_link . '/sales/detail_print_payment', $data);
    }

    public function print_payment_retur_beli($id)
    {
        parent::admin_print_tpl();
        $this->load->helper(['number_helper']);
        $this->load->model(['base_model', 'laporan/purchase_return']);
        $row = $this->purchase_return->get_row($id[0]);

        $data = [
            'row' => $row,
        ];

        $this->load->view('pages/' . $this->class_link . '/purchase_return/detail_print_payment', $data);
    }

    public function print_payment_retur_jual($id)
    {
        parent::admin_print_tpl();
        $this->load->helper(['number_helper']);
        $this->load->model(['base_model', 'laporan/sales_return']);
        $row = $this->sales_return->get_row($id[0]);

        $data = [
            'row' => $row,
        ];

        $this->load->view('pages/' . $this->class_link . '/sales_return/detail_print_payment', $data);
    }


    public function pembelian_data()
    {
        $this->load->model(['laporan/purchase']);
        $page_url = $this->input->get('page_url');
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $name = $this->input->get('name');
        $data['mutasi_belis'] = $this->purchase->get_mutasi_beli($start, $end);
        $data['mutasi_pembelian'] = $this->purchase->get_mutasi_pembelian($start, $end);
        $this->load->view('pages/' . $page_url . '/report', $data);
    }

    public function pembelian_name()
    {
        $this->load->model(['laporan/purchase']);
        $page_url = $this->input->get('page_url');
        $name = $this->input->get('name');
        $data['mutasi_beli_names'] = $this->purchase->get_mutasi_beli_byname($name);
        $data['mutasi_beli_sum_name'] = $this->purchase->get_mutasi_beli_sum_byname($name);
        $this->load->view('pages/' . $page_url . '/report_name', $data);
    }

    public function pembelian_faktur()
    {
        $this->load->model(['laporan/purchase']);
        $page_url = $this->input->get('page_url');
        $faktur = $this->input->get('faktur');
        $data['mutasi_beli_fakturs'] = $this->purchase->get_mutasi_beli_faktur($faktur);
        $data['mutasi_beli_sum_faktur'] = $this->purchase->get_mutasi_beli_sum_faktur($faktur);
        $this->load->view('pages/' . $page_url . '/report_faktur', $data);
    }

    public function penjualan_data()
    {
        $this->load->model(['laporan/sales']);
        $page_url = $this->input->get('page_url');
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $name = $this->input->get('name');
        $data['mutasi_juals'] = $this->sales->get_mutasi_jual($start, $end);
        $data['mutasi_penjualan'] = $this->sales->get_mutasi_penjualan($start, $end);
        $this->load->view('pages/' . $page_url . '/report', $data);
    }

    public function penjualan_name()
    {
        $this->load->model(['laporan/sales']);
        $page_url = $this->input->get('page_url');
        $name = $this->input->get('name');
        $data['mutasi_jual_names'] = $this->sales->get_mutasi_jual_byname($name);
        $data['mutasi_jual_sum_name'] = $this->sales->get_mutasi_jual_sum_byname($name);
        $this->load->view('pages/' . $page_url . '/report_name', $data);
    }

    public function penjualan_faktur()
    {
        $this->load->model(['laporan/sales']);
        $page_url = $this->input->get('page_url');
        $faktur = $this->input->get('faktur');
        $data['mutasi_jual_fakturs'] = $this->sales->get_mutasi_jual_faktur($faktur);
        $data['mutasi_jual_sum_faktur'] = $this->sales->get_mutasi_jual_sum_faktur($faktur);
        $this->load->view('pages/' . $page_url . '/report_faktur', $data);
    }

    public function retur_beli_data()
    {
        $this->load->model(['laporan/purchase_return']);
        $page_url = $this->input->get('page_url');
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $data['mutasi_retur_belis'] = $this->purchase_return->get_retur_beli($start, $end);
        $data['mutasi_retur_pembelian'] = $this->purchase_return->get_retur_pembelian_data($start, $end);
        $this->load->view('pages/' . $page_url . '/report', $data);
    }

    public function retur_beli_name()
    {
        $this->load->model(['laporan/purchase_return']);
        $page_url = $this->input->get('page_url');
        $name = $this->input->get('name');
        $data['mutasi_retur_belis'] = $this->purchase_return->get_retur_beli_byname($name);
        $data['mutasi_retur_pembelian'] = $this->purchase_return->get_retur_pembelian_byname($name);
        $this->load->view('pages/' . $page_url . '/report_name', $data);
    }

    public function retur_beli()
    {
        $this->load->model(['laporan/purchase_return']);
        $page_url = $this->input->get('page_url');
        $retur = $this->input->get('retur');
        $data['mutasi_retur_belis'] = $this->purchase_return->get_retur_beli_retur($retur);
        $data['mutasi_retur_pembelian'] = $this->purchase_return->get_retur_pembelian_retur($retur);
        $this->load->view('pages/' . $page_url . '/report_retur', $data);
    }

    public function retur_jual_data()
    {
        $this->load->model(['laporan/sales_return']);
        $page_url = $this->input->get('page_url');
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $data['mutasi_retur_juals'] = $this->sales_return->get_retur_jual($start, $end);
        $data['mutasi_retur_penjualan'] = $this->sales_return->get_retur_penjualan_data($start, $end);
        $this->load->view('pages/' . $page_url . '/report', $data);
    }

    public function retur_jual_name()
    {
        $this->load->model(['laporan/sales_return']);
        $page_url = $this->input->get('page_url');
        $name = $this->input->get('name');
        $data['mutasi_retur_juals'] = $this->sales_return->get_retur_jual_byname($name);
        $data['mutasi_retur_penjualan'] = $this->sales_return->get_retur_penjualan_byname($name);
        $this->load->view('pages/' . $page_url . '/report_name', $data);
    }

    public function retur_jual()
    {
        $this->load->model(['laporan/sales_return']);
        $page_url = $this->input->get('page_url');
        $retur = $this->input->get('retur');
        $data['mutasi_retur_juals'] = $this->sales_return->get_retur_jual_retur($retur);
        $data['mutasi_retur_penjualan'] = $this->sales_return->get_retur_penjualan_retur($retur);
        $this->load->view('pages/' . $page_url . '/report_retur', $data);
    }
}
