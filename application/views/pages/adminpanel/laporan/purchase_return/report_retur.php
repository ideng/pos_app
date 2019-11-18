<?php
defined('BASEPATH') or exit('No direct script access allowed!');
?>
<div>
    <h3 style="text-align:center">Detail Transaksi Tanggal <?php echo $this->input->get('start') . ' s/d ' . $this->input->get('end'); ?></h1>
</div>
<div>
    <H3 style="text-align:center">Laporan Data Retur Pembelian Berdasar Nama Barang</H3>
</div>
<table class="table table-bordered table-striped hover">
    <thead>
        <tr>
            <td>No</td>
            <td>Tanggal</td>
            <td>No Retur</td>
            <td>Nama Barang</td>
            <td>Keterangan</td>
            <td>Harga Beli</td>
            <td>Jumlah Retur</td>
            <td>Nominal Retur</td>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($mutasi_retur_belis)) {
            $no = 0;
            foreach ($mutasi_retur_belis as $mutasi_retur_beli) {
                $no++;
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $mutasi_retur_beli->created_at . '</td>';
                echo '<td>' . $mutasi_retur_beli->no_retur . '</td>';
                echo '<td>' . $mutasi_retur_beli->drug_name . '</td>';
                echo '<td>' . $mutasi_retur_beli->description . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_retur_beli->purchase_price, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . $mutasi_retur_beli->quantity . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_retur_beli->purchase_price_total, '0'), 2, ',', '.') . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td colspan="7"><span style="font-weight:bold">' . 'Total Retur Pembelian' . '</span></td>';
            echo '<td><span style="font-weight:bold">' . number_format(empty_string($mutasi_retur_pembelian->nominal_retur_beli, '0'), 2, ',', '.') . '</span></td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td colspan=\'19\'>Maaf tidak ada data yang ditampilkan!</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>