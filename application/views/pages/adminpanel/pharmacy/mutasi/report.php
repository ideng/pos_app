<?php
defined('BASEPATH') or exit('No direct script access allowed!');
?>
<div>
    <h3 style="text-align:center">Detail Transaksi Tanggal <?php echo $this->input->get('start') . ' s/d ' . $this->input->get('end'); ?></h1>
</div>
<div>
    <H3 style="text-align:center">Mutasi Data Pembelian</H3>
</div>
<table class="table table-bordered table-striped hover">
    <thead>
        <tr>
            <td>No</td>
            <td>Tanggal</td>
            <td>Nama Barang</td>
            <td>No Faktur</td>
            <td>Nama Supplier</td>
            <td>Harga Beli</td>
            <td>Jumlah Beli</td>
            <td>Jumlah Retur Beli</td>
            <td>Jumlah Pembelian</td>
            <td>Nominal Beli</td>
            <td>Nominal Retur Beli</td>
            <td>Nominal Pembelian</td>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($mutasi_belis)) {
            $no = 0;
            foreach ($mutasi_belis as $mutasi_beli) {
                $no++;
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $mutasi_beli->tanggal . '</td>';
                echo '<td>' . $mutasi_beli->nama_obat . '</td>';
                echo '<td>' . $mutasi_beli->faktur_pembelian . '</td>';
                echo '<td>' . $mutasi_beli->supplier_name . '</td>';
                echo '<td>' . $mutasi_beli->harga_beli . '</td>';
                echo '<td>' . $mutasi_beli->jml_beli . '</td>';
                echo '<td>' . $mutasi_beli->jml_retur_beli . '</td>';
                echo '<td>' . $mutasi_beli->jml_pembelian . '</td>';
                echo '<td>' . $mutasi_beli->nominal_beli . '</td>';
                echo '<td>' . $mutasi_beli->nominal_retur_beli . '</td>';
                echo '<td>' . $mutasi_beli->nominal_pembelian . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td colspan="9"><span style="font-weight:bold">' . 'Total Pembelian' . '</span></td>';
            echo '<td><span style="font-weight:bold">' . $mutasi_pembelian->nominal_beli . '</span></td>';
            echo '<td><span style="font-weight:bold">' . $mutasi_pembelian->nominal_retur_beli . '</span></td>';
            echo '<td><span style="font-weight:bold">' . $mutasi_pembelian->nominal_pembelian . '</span></td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td colspan=\'19\'>Maaf tidak ada data yang ditampilkan!</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
<hr>
<div>
    <H3 style="text-align:center">Mutasi Data Penjualan</H3>
</div>
<table class="table table-bordered table-striped hover">
    <thead>
        <tr>
            <td>No</td>
            <td>Tanggal</td>
            <td>Nama Barang</td>
            <td>No Faktur</td>
            <td>Nama Customer</td>
            <td>Harga Jual</td>
            <td>Jumlah Jual</td>
            <td>Jumlah Retur Jual</td>
            <td>Jumlah Penjualan</td>
            <td>Nominal Jual</td>
            <td>Nominal Retur Jual</td>
            <td>Nominal Penjualan</td>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($mutasi_juals)) {
            $no = 0;
            foreach ($mutasi_juals as $mutasi_jual) {
                $no++;
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $mutasi_jual->tanggal . '</td>';
                echo '<td>' . $mutasi_jual->nama_obat . '</td>';
                echo '<td>' . $mutasi_jual->faktur_penjualan . '</td>';
                echo '<td>' . $mutasi_jual->nama_pasien . '</td>';
                echo '<td>' . $mutasi_jual->harga_jual . '</td>';
                echo '<td>' . $mutasi_jual->jml_jual . '</td>';
                echo '<td>' . $mutasi_jual->jml_retur_jual . '</td>';
                echo '<td>' . $mutasi_jual->jml_penjualan . '</td>';
                echo '<td>' . $mutasi_jual->nominal_jual . '</td>';
                echo '<td>' . $mutasi_jual->numinal_retur . '</td>';
                echo '<td>' . $mutasi_jual->nominal_penjualan . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td colspan="9"><span style="font-weight:bold">' . 'Total Penjualan' . '</span></td>';
            echo '<td><span style="font-weight:bold">' . $mutasi_penjualan->nominal_jual . '</span></td>';
            echo '<td><span style="font-weight:bold">' . $mutasi_penjualan->numinal_retur . '</span></td>';
            echo '<td><span style="font-weight:bold">' . $mutasi_penjualan->nominal_penjualan . '</span></td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td colspan=\'19\'>Maaf tidak ada data yang ditampilkan!</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>