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
                echo '<td>' . number_format(empty_string($mutasi_beli->harga_beli, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . $mutasi_beli->jml_beli . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_beli->nominal_beli, '0'), 2, ',', '.') . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td colspan="7"><span style="font-weight:bold">' . 'Total Pembelian' . '</span></td>';
            echo '<td><span style="font-weight:bold">' . number_format(empty_string($mutasi_pembelian->nominal_beli, '0'), 2, ',', '.') . '</span></td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td colspan=\'19\'>Maaf tidak ada data yang ditampilkan!</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
<div>
    <H3 style="text-align:center">Mutasi Retur Pembelian</H3>
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
            <td>Nominal Pembelian</td>
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