<?php
defined('BASEPATH') or exit('No direct script access allowed!');
?>
<div>
    <h3 style="text-align:center">Detail Transaksi Tanggal <?php echo $this->input->get('start') . ' s/d ' . $this->input->get('end'); ?></h1>
</div>
<div>
    <H3 style="text-align:center">Laporan Data Retur Penjualan Berdasar Nama Barang</H3>
</div>
<table class="table table-bordered table-striped hover">
    <thead>
        <tr>
            <td>No</td>
            <td>Tanggal</td>
            <td>No Retur</td>
            <td>Nama Barang</td>
            <td>Keterangan</td>
            <td>Harga Jual</td>
            <td>Jumlah Retur</td>
            <td>Nominal Retur</td>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($mutasi_retur_juals)) {
            $no = 0;
            foreach ($mutasi_retur_juals as $mutasi_retur_jual) {
                $no++;
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $mutasi_retur_jual->created_at . '</td>';
                echo '<td>' . $mutasi_retur_jual->no_retur . '</td>';
                echo '<td>' . $mutasi_retur_jual->drug_name . '</td>';
                echo '<td>' . $mutasi_retur_jual->description . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_retur_jual->sell_price, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . $mutasi_retur_jual->quantity . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_retur_jual->sell_price_total, '0'), 2, ',', '.') . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td colspan="7"><span style="font-weight:bold">' . 'Total Retur Penjualan' . '</span></td>';
            echo '<td><span style="font-weight:bold">' . number_format(empty_string($mutasi_retur_penjualan->nominal_retur_jual, '0'), 2, ',', '.') . '</span></td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td colspan=\'19\'>Maaf tidak ada data yang ditampilkan!</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>