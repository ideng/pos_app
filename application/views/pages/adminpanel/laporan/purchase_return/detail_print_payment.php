<?php
defined('BASEPATH') or exit('No direct script access allowed!');
?>

<style>
    table#t01,
    td#t01,
    tr#t01 {
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
    }

    table#t02,
    table#t03 {
        text-align: center;
    }

    td#t04 {
        text-transform: capitalize;
    }

    table#t05,
    tr#t05,
    td#t05 {
        padding: 19px;
        vertical-align: top;
    }
</style>
<table id="t02" style="width:100%">
    <tr>
        <td>
            <label for="detail_pembayaran_diagnosa">Nota Retur Pembelian</label>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr style="text-align:left">
        <td for="medical_record_id">No. Retur</td>
        <td>:</td>
        <td><?php echo $row->no_retur; ?></td>
        <td for="date_in">Tgl Retur</td>
        <td>:</td>
        <td><?php echo format_date($row->created_at, 'd-m-Y'); ?></td>
    </tr>
</table>
<table id="t01" style="width:100%">
    <tr id="t01">
        <td id="t01">
            <label for="drug_id">Nama Barang</label>
        </td>
        <td id="t01">
            <label for="drug_id">Keterangan</label>
        </td>
        <td id="t01">
            <label for="drug_quantity">Jumlah</label>
        </td id="t01">
        <td>
            <label for="drug_price">Harga</label>
        </td>
        <td id="t01">
            <label for="drug_subtotal">Subtotal</label>
        </td>
    </tr>
    <tr id="t01">
        <td id="t01">
            <?php echo $row->drug_name;; ?>
        </td>
        <td id="t01">
            <?php echo $row->description;; ?>
        </td>
        <td id="t01">
            <?php echo $row->quantity; ?>
        </td>
        <td id="t01">
            <?php echo number_format($row->purchase_price, '2', ',', '.'); ?>
        </td>
        <td id="t01">
            <?php echo number_format($row->total_retur, '2', ',', '.'); ?>
        </td>
    </tr>
</table>
<hr>
<table style="width:100%">
    <tr>
        <td>Dicetak Oleh:<?php echo $_SESSION['auth']['name']; ?></td>
        <td style="text-align:center">Kasir</td>
    </tr>
    <tr>
        <td><?php echo format_date($row->created_at, 'd-m-Y, H.i.s'); ?></td>
    </tr>
    <tr style="text-align:center">
        <td></td>
        <td><?php echo '( ' . $_SESSION['auth']['name'] . ' )' ?></td>
    </tr>
</table>