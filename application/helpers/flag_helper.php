<?php
defined('BASEPATH') or exit('No direct script access allowed!');

function checkup_flag(string $flag)
{
    $result = '<span class=\'label label-danger\'>Tidak Ada Status</span>';
    if ($flag == 'pending') {
        $result = '<span class=\'label label-default\'>Pending</span>';
    } elseif ($flag == 'inline') {
        $result = '<span class=\'label label-info\'>Dalam Antrian</span>';
    } elseif ($flag == 'diagnose') {
        $result = '<span class=\'label label-warning\'>Diagnosa</span>';
    } elseif ($flag == 'finish') {
        $result = '<span class=\'label label-success\'>Selesai</span>';
    }
    return $result;
}

function module_list()
{
    $modules = ['adminpanel', 'customer'];
    return $modules;
}
