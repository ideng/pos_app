<?php
defined('BASEPATH') or exit('No direct script access allowed!');

function number_to_roman($number = 1) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $ret_val = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if($number >= $int) {
                $number -= $int;
                $ret_val .= $roman;
                break;
            }
        }
    }
    return $ret_val;
}

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
    $temp = '';
    if ($nilai < 12) {
        $temp = ' ' . $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10) . ' Belas';
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10) . ' Puluh' . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = ' Seratus' . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . ' Ratus' . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = ' Seribu' . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . ' Ribu' . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . ' Juta' . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . ' Milyar' . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . ' Trilyun' . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}
function terbilang($nilai) {
    if($nilai<0) {
        $hasil = 'Minus ' . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

function indo_date(string $date) {
    $CI =& get_instance();
    $CI->load->helper(['basic']);
    $date = format_date($date, 'Y-m-d');
    $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	$split = explode('-', $date);
	return $split[2] . ' ' . $month[ (int) $split[1] - 1 ] . ' ' . $split[0];
}
