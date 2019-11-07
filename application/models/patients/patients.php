<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Patients extends CI_Model
{

    function patients_profil()
    {
        $id = $_SESSION['auth']['id'];
        $this->db->where('user_id', $id);
        return $this->db->get('customer')->result();
    }

    function checkups_data()
    {
        $id = $_SESSION['auth']['id'];
        $this->db->select('c.id, b.user_id, b.id, a.patient_id, b.name, a.complaint')
            ->from('checkups a')
            ->join('customer b', 'b.id = a.patient_id')
            ->join('users c', 'c.id = b.user_id')
            ->where('c.id = b.user_id ')
            ->where('c.id', $id)
            ->order_by('a.date_in DESC');
        return $this->db->get('checkups')->result();
    }
}
