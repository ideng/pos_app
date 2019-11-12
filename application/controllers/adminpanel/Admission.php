<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Admission extends MY_Controller
{
    private $class_name = 'admission';
    private $class_link = 'adminpanel/admission';

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
            'page' => $method,
        ];
        $this->load->js('assets/admin_lte/custom/custom_js.js');
        $this->load->js('assets/admin_lte/custom/master_js.js');
        if ($method == 'purchase') {
            $this->load->js('assets/admin_lte/custom/purchase_js.js');
            $this->load->js('js/config_purchase.js');
        }
        if ($method == 'mutasi') {
            $this->load->js('assets/admin_lte/custom/mutasi_beli_js.js');
        }

        $this->load->view('pages/' . $this->class_link . '/index', $data);
    }

    public function load_table()
    {
        $this->load->model(['admission/mutasi']);
        $page = $this->input->get('page');
        $page_url = $this->input->get('page_url');
        $m = $this->mutasi->get_mutasi_pembelian_now();
        $data = [
            'class_link' => $this->class_link,
            'page' => $page,
            'mutasi_pembelian_now' => $m
        ];


        $this->load->view('pages/' . $page_url . '/table', $data);
    }

    public function mutasi_data()
    {
        $this->load->model(['admission/mutasi']);
        $page_url = $this->input->get('page_url');
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $data['mutasi_belis'] = $this->mutasi->get_mutasi_beli($start, $end);
        $data['mutasi_juals'] = $this->mutasi->get_mutasi_jual($start, $end);
        $data['mutasi_pembelian'] = $this->mutasi->get_mutasi_pembelian($start, $end);
        $data['mutasi_penjualan'] = $this->mutasi->get_mutasi_penjualan($start, $end);
        $this->load->view('pages/' . $page_url . '/report', $data);
    }

    public function table_data()
    {
        $page = $this->input->get('page');
        $this->load->library(['custom_ssp']);
        $this->load->model([$this->class_name . '/' . $page]);

        $data = $this->{$page}->ssp_table();
        $this->output->set_output(json_encode(
            Custom_ssp::simple($_GET, $data['sql_details'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['where'], $data['group_by'], $data['having'])
        ));
    }

    public function table_datas()
    {
        $page = $this->input->get('page');
        $this->load->library(['custom_ssp']);
        $this->load->model(['admission/mutasi_jual']);

        $data = $this->mutasi_jual->ssp_table();
        $this->output->set_output(json_encode(
            Custom_ssp::simple($_GET, $data['sql_details'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['where'], $data['group_by'], $data['having'])
        ));
    }

    public function load_detail()
    {
        $this->load->model(['base_model']);
        $id = $this->input->get('id');
        $page_url = $this->input->get('page_url');
        $page = $this->input->get('page');
        if ($page == 'drug_sales') {
            $this->load->model(['admission/diagnoses']);
            $row = $this->diagnoses->get_row($id);
        } else if ($page == 'purchase' || $page == 'purchase_return' || $page == 'sales_return' || $page == 'sales' || $page == 'gudang' || $page == 'adjustment') {
            $page = $this->input->get('page');
            $this->load->model(['base_model', $this->class_name . '/' . $page]);
            $id = $this->input->get('id');
            $id = empty($id) ? '' : $this->input->get('id');
            $id_mutasi = empty($id) ? '' : $this->input->get('id');
            $id_mutasi_jual = empty($id) ? '' : $this->input->get('id');
            $id_mutasi_checkup = empty($id) ? '' : $this->input->get('id');
            $page_url = $this->input->get('page_url');
            $row = $this->{$page}->get_row($id);
        } else {
            $row = $this->base_model->get_row($page, ['id' => $id]);
        }

        $data = [
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
            'class_link' => $this->class_link,
            'page' => $page,
            'row' => $row,
        ];
        if ($page == 'gudang') {
            $this->load->model(['admission/gudang']);
            $data['drugs'] = $this->gudang->get_drugs($id);
            $data['mutasi_beli'] = $this->gudang->get_mutasi_beli($id_mutasi);
            $data['mutasi_jual'] = $this->gudang->get_mutasi_jual($id_mutasi_jual);
            $data['mutasi_checkup'] = $this->gudang->get_mutasi_checkup($id_mutasi_checkup);
        }

        $this->load->view('pages/' . $page_url . '/detail', $data);
    }

    public function load_form()
    {
        $page = $this->input->get('page');
        $this->load->helper(['form']);
        $this->load->model(['base_model', $this->class_name . '/' . $page]);
        $id = $this->input->get('id');
        $page_url = $this->input->get('page_url');
        $row = $this->base_model->get_row($page, ['id' => $id]);
        if ($page == 'purchase' || $page == 'purchase_return') {
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
            $this->load->model(['admission/purchase']);
            $purchase = $this->purchase->get_supplier($row->supplier_id);
            $data = array_merge($data, ['purchase' => $purchase]);
        } elseif ($page == 'purchase_return') {
            $this->load->model(['admission/purchase_return']);
            $data['drugs'] = $this->purchase_return->get_drug();
            $purchase_return = $this->purchase_return->get_faktur($row->no_faktur_id);
            $data = array_merge($data, ['purchase_return' => $purchase_return]);
        }
        $this->load->view('pages/' . $page_url . '/form', $data);
    }

    public function search_purchase()
    {
        // Ambil data NIS yang dikirim via ajax post
        $barcode = $this->input->get('barcode');
        $this->load->model(['admission/purchase']);
        $gudang = $this->purchase->viewByBarcode($barcode);

        if (!empty($gudang)) { // Jika data siswa ada/ditemukan
            // Buat sebuah array
            $callback = array(
                'status' => 'success', // Set array status dengan success
                'id' => $gudang->id,
                'name' => $gudang->name, // Set array nama dengan isi kolom nama pada tabel siswa
                'purchase_price' => $gudang->purchase_price,
            );
        } else {
            $callback = array('status' => 'failed'); // set array status dengan failed
        }

        echo json_encode($callback); // konversi varibael $callback menjadi JSON
    }

    public function submit_form()
    {
        $page = $this->input->post('page');
        $id = empty($id) ? '' : $this->input->get('id');
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
                $data = $this->base_model->submit_data($page, $id, $title, $submit);
                if ($page == 'purchase' && $data['status'] == 'success') {
                    $this->load->model($this->class_name . '/Purchase_faktur');
                    $master_key = $data['key'];
                    $data = $this->Purchase_faktur->post_data_faktur($this->input->post(), $master_key);
                }
            }
            $data['csrf_val'] = $this->security->get_csrf_hash();

            $this->output
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data));
        }
    }

    public function delete_data()
    {
        $page = $this->input->get('page');
        $this->load->model([$this->class_name . '/' . $page, 'base_model']);

        $id = $this->input->get('id');
        $title = $this->{$page}->_get('title');

        $data = $this->base_model->delete_data($page, ['id' => $id], $title);
        if ($page == 'purchase' || $page == 'sales') {
            $page = $this->input->get('page');
            $this->load->model([$this->class_name . '/' . $page]);
            $id = $this->input->get('id');
            $data = $this->{$page}->delete_data($id);
        }

        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }

    public function drug_payment()
    {
        $this->load->model(['base_model', 'admission/diagnoses']);
        $id = $this->input->get('id');
        $diagnose = $this->diagnoses->get_row($id);
        $diagnose_drugs = $this->base_model->get_all('diagnose_drugs', ['diagnose_id' => $id]);

        $data = [
            'id' => $id,
            'diagnose' => $diagnose,
            'diagnose_drugs' => $diagnose_drugs,
            'class_link' => $this->class_link,
            'page' => 'drug_sales',
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_value' => $this->security->get_csrf_hash(),
        ];

        $this->load->view('pages/' . $this->class_link . '/drug_sales/payment_form', $data);
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

    public function submit_payment()
    {
        $this->load->model(['base_model', 'admission/diagnoses', 'admission/drug_sales']);
        $submit = $this->diagnoses->post_payment($this->input->post());
        $data = $this->base_model->submit_data('diagnoses', 'id', 'Data Pembayaran', $submit);
        if ($data['status'] == 'error') {
            $this->output
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data));
        }
        $master_key = $data['key'];
        $diagnose = $this->diagnoses->get_row($master_key);
        $submit = $this->drug_sales->post_data($this->input->post(), $master_key);
        $data = $this->base_model->submit_batch('diagnosedrug_sales', 'Data Pembayaran', $submit);
        if ($data['status'] == 'error') {
            $this->output
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data));
        }
        $data = $this->base_model->submit_data('checkups', 'id', 'Data Pembayaran', ['id' => $diagnose->checkup_id, 'flag' => 'finish']);
        $data['master_key'] = $master_key;
        $data['csrf_val'] = $this->security->get_csrf_hash();

        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
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
}
