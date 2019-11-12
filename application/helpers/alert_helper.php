<?php
defined('BASEPATH') or exit('No direct script access allowed!');

function build_label($label_type = 'success', $label_msg = '')
{
    $icon = build_icon($label_type);

    $label = '<span class="label label-' . $label_type . '">
		<i class="ace-icon fa fa-' . $icon . '"></i> 
		' . $label_msg . '
	</span>';

    return $label;
}

function build_icon($text = 'danger')
{
    if ($text == 'danger') :
        $icon = 'ban';
    elseif ($text == 'warning') :
        $icon = 'exclamation-triangle';
    elseif ($text == 'success') :
        $icon = 'check';
    else :
        $icon = build_icon();
    endif;
    return $icon;
}

function build_alert($alert_type = '', $alert_title = '', $alert_msg = '')
{
    $icon = build_icon($alert_type);
    $alert = '<div class="alert alert-' . $alert_type . ' alert-dismissible fade in" role="alert">';
    $alert .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    $alert .= '<span aria-hidden="true">×</span>';
    $alert .= '</button>';
    $alert .= '<strong><i class="ace-icon fa fa-' . $icon . '"></i> ' . $alert_title . '</strong>';
    $alert .= '<br>' . $alert_msg;
    $alert .= '</div>';

    return $alert;
}

function get_report($act = '', $label = '', $key = '')
{
    $status = $act ? 'success' : 'error';
    $title = $act ? 'Berhasil!' : 'Gagal!';
    $str = render_report($status, build_alert($status, $title, $label . '!'), $key);
    return $str;
}

function render_report($status = '', $msg = '', $key = '')
{
    $report['status'] = $status;
    $report['msg'] = $msg;
    $report['key'] = $key;
    return $report;
}
