<?php
defined('BASEPATH') or exit('No direct script access allowed');

function sql_connect()
{
	$CI = &get_instance();
	$connection = array(
		'user' => $CI->db->username,
		'pass' => $CI->db->password,
		'db'   => $CI->db->database,
		'host' => $CI->db->hostname
	);
	return $connection;
}

function get_client_ip()
{
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP')) :
		$ipaddress = getenv('HTTP_CLIENT_IP');
	elseif (getenv('HTTP_X_FORWARDED_FOR')) :
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	elseif (getenv('HTTP_X_FORWARDED')) :
		$ipaddress = getenv('HTTP_X_FORWARDED');
	elseif (getenv('HTTP_FORWARDED_FOR')) :
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	elseif (getenv('HTTP_FORWARDED')) :
		$ipaddress = getenv('HTTP_FORWARDED');
	elseif (getenv('REMOTE_ADDR')) :
		$ipaddress = getenv('REMOTE_ADDR');
	else :
		$ipaddress = 'UNKNOWN';
	endif;

	return $ipaddress;
}

function hash_text($text)
{
	$options = [
		'cost' => 12,
	];
	$result = password_hash($text, PASSWORD_BCRYPT, $options);

	return $result;
}

function verify_hash($text, $hash)
{
	$decrypt = password_verify($text, $hash);

	return $decrypt;
}

function ya_tidak($var = '')
{
	$text = 'Tidak';
	if ($var == '0') :
		$text = 'Tidak';
	elseif ($var == '1') :
		$text = 'Ya';
	endif;
	return $text;
}

function render_dropdown($title = '', $opts = [], $val = '', $var = '')
{
	$option[''] = '-- Pilih ' . $title . ' --';
	foreach ($opts as $opt) :
		if (is_object($opt)) :
			$option[$opt->{$val}] = $opt->{$var};
		else :
			$option[$opt[$val]] = $opt[$var];
		endif;
	endforeach;
	return $option;
}

function format_date($date, $format)
{
	$date = new DateTime($date);
	return $date->format($format);
}

function empty_string($str = '', $replacement = '-')
{
	if (empty($str)) :
		$string = $replacement;
	else :
		$string = $str;
	endif;
	return $string;
}

function min_string($str = '', $replacement = '-')
{
	$replacement = '<span class=\'label label-warning\'>limited</span>';
	if ($str <= '3' && $str > '0') :
		$string = $replacement;
	elseif ($str >= '4') :
		$string = '<span class=\'label label-info\'>Tersedia</span>';
	elseif ($str == '0') :
		$string = '<span class=\'label label-danger\'>Habis</span>';
	elseif ($str < '0') :
		$string = '<span class=\'label label-default\'>Error</span>';
	else :
		$string = $str;
	endif;
	return $string;
}

function format_phone($phone = '', $split_char = '-', $split = '4')
{
	if (!empty($phone)) :
		$var_phone = '';
		$len_phone = strlen($phone);
		$no = 0;
		for ($i = 0; $i < $len_phone; $i++) :
			$no++;
			$var_phone .= $phone[$i];
			$var_phone .= $no == $split && !empty($phone[$i + 1]) ? $split_char : '';
			$no = $no == $split ? '0' : $no;
		endfor;
		return $var_phone;
	endif;
}

function indo_gender($gender)
{
	if ($gender == 'male') {
		return 'Laki-Laki';
	} elseif ($gender == 'female') {
		return 'Perempuan';
	} else {
		return 'Gender Not Specified!';
	}
}

function days_indo(int $day_number)
{
	$days = ['senin', 'selasa', 'rabu', 'kamis', 'jum\'at', 'sabtu', 'minggu'];
	if ($day_number == 0) {
		return $days;
	} else {
		foreach ($days as $key => $day_name) {
			$day_num = $key + 1;
			if ($day_num == $day_number) {
				return $day_name;
			}
		}
	}
}

function days_name()
{
	$days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
	return $days;
}
