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
            <label for="detail_pembayaran_diagnosa">Nota Pembelian</label>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr style="text-align:left">
        <td for="medical_record_id">No. Faktur</td>
        <td>:</td>
        <td><?php echo $row->no_faktur; ?></td>
        <td for="date_in">Tgl Pembelian</td>
        <td>:</td>
        <td><?php echo format_date($row->created_at, 'd-m-Y'); ?></td>
    </tr>
    <tr style="text-align:left">
        <td for="medical_record_id">Nama Suplier</td>
        <td>:</td>
        <td><?php echo $row->supplier_name; ?></td>
        <td for="date_in"></td>
        <td></td>
        <td></td>
    </tr>
</table>
<table id="t01" style="width:100%">
    <tr id="t01">
        <td id="t01">
            <label for="drug_id">Nama Barang</label>
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
    <?php
    if (!empty($pembelian)) {
        foreach ($pembelian as $pembelians) {
            ?>
            <tr id="t01">
                <td id="t01">
                    <?php echo $pembelians->name; ?>
                </td>
                <td id="t01">
                    <?php echo $pembelians->quantity; ?>
                </td>
                <td id="t01">
                    <?php echo number_format($pembelians->price, '2', ',', '.'); ?>
                </td>
                <td id="t01">
                    <?php echo number_format($pembelians->subtotal, '2', ',', '.'); ?>
                </td>
            </tr>
    <?php
        }
    }
    ?>
    <tr>
        <td style="text-align:left" colspan="3">
            <label>-- Total Bayar --</label>
        </td>
        <td id="t01">
            <label><?php echo number_format($row->total_bayar, '2', ',', '.'); ?></label>
        </td>
    </tr>
</table>
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