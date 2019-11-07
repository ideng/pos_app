<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Autocomplete extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library(['session']);
    }

    public function search_data()
    {
        $this->load->model(['base_model']);
        $table = $this->input->get('table');
        $columns = $this->input->get('columns');
        $values = $this->input->get('values');
        if (is_array($columns)) {
            $total = count($columns);
            for ($i = 0; $i < $total; $i++) {
                if (isset($values[$i])) {
                    $params[$columns[$i] . ' LIKE '] = '%' . $values[$i] . '%';
                }
            }
        } else {
            $params = [$columns . ' LIKE ' => '%' . $values . '%'];
        }
        $this->db->from($table)
            ->or_where($params);
        $query = $this->db->get();
        $result = $query->result();

        $this->output
            ->set_content_type('application/json; utf-8;')
            ->set_output(json_encode($result));
    }
}