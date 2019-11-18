<?php
defined('BASEPATH') or exit('No direct script access allowed!');
?>
<div>
    <H3 style="text-align:center">Detail <?php echo $this->input->get('name'); ?></H3>
</div>
<table class="table table-bordered table-striped hover">
    <thead>
        <tr>
        <tr>
            <th style='text-align:center' colspan='3'>Data Barang</th>
            <th style='text-align:center' colspan='3'>Stock Pembelian</th>
            <th style='text-align:center' colspan='3'>Nominal Pembelian</th>
            <th style='text-align:center' colspan='3'>Stock Penjualan</th>
            <th style='text-align:center' colspan='3'>Nominal Penjualan</th>
            <th style='text-align:center' colspan='1'>Stock</th>
        </tr>
        <th>No</th>
        <th>Nama</th>
        <th>Barcode</th>

        <th>Beli</th>
        <th>Retur</th>
        <th>Total</th>

        <th>Beli</th>
        <th>Retur</th>
        <th>Total</th>

        <th>Jual</th>
        <th>Retur</th>
        <th>Total</th>

        <th>Jual</th>
        <th>Retur</th>
        <th>Total</th>

        <th style='text-align:center'>Akhir</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($barangs)) {
            $no = 0;
            foreach ($barangs as $barang) {
                $no++;
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $barang->obat . '</td>';
                echo '<td>' . $barang->barcode . '</td>';
                echo '<td>' . $barang->jml_beli . '</td>';
                echo '<td>' . $barang->jml_retur_beli . '</td>';
                echo '<td>' . $barang->stock_beli . '</td>';
                echo '<td>' . number_format(empty_string($barang->nominal_beli, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . number_format(empty_string($barang->nominal_retur_beli, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . number_format(empty_string($barang->total_pembelian, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . $barang->jml_jual . '</td>';
                echo '<td>' . $barang->jml_retur_jual . '</td>';
                echo '<td>' . $barang->stock_jual . '</td>';
                echo '<td>' . number_format(empty_string($barang->nominal_jual, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . number_format(empty_string($barang->nominal_retur_jual, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . number_format(empty_string($barang->total_penjualan, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . $barang->stock_akhir . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan=\'19\'>Maaf tidak ada data yang ditampilkan!</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>