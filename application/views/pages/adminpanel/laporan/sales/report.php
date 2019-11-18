<?php
defined('BASEPATH') or exit('No direct script access allowed!');
?>
<div>
    <h3 style="text-align:center">Detail Transaksi Tanggal <?php echo $this->input->get('start') . ' s/d ' . $this->input->get('end'); ?></h1>
</div>
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
            <td>Nama Supplier</td>
            <td>Harga</td>
            <td>Jumlah</td>
            <td>Nominal Pembelian</td>
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
                echo '<td>' . number_format(empty_string($mutasi_jual->harga_jual, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . $mutasi_jual->jml_jual . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_jual->nominal_jual, '0'), 2, ',', '.') . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td colspan="7"><span style="font-weight:bold">' . 'Total Penjualan' . '</span></td>';
            echo '<td><span style="font-weight:bold">' . number_format(empty_string($mutasi_penjualan->nominal_jual, '0'), 2, ',', '.') . '</span></td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td colspan=\'19\'>Maaf tidak ada data yang ditampilkan!</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>