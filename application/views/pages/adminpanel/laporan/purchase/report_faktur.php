<div>
    <H3 style="text-align:center">Laporan Data Pembelian Berdasar Faktur</H3>
</div>
<table class="table table-bordered table-striped hover">
    <thead>
        <tr>
            <td>No</td>
            <td>Tanggal</td>
            <td>No Faktur</td>
            <td>Nama Suplier</td>
            <td>Nama Barang</td>
            <td>Harga</td>
            <td>Jumlah</td>
            <td>Nominal Pembelian</td>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($mutasi_beli_fakturs)) {
            $no = 0;
            foreach ($mutasi_beli_fakturs as $mutasi_beli_faktur) {
                $no++;
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $mutasi_beli_faktur->tanggal . '</td>';
                echo '<td>' . $mutasi_beli_faktur->faktur_pembelian . '</td>';
                echo '<td>' . $mutasi_beli_faktur->supplier_name . '</td>';
                echo '<td>' . $mutasi_beli_faktur->nama_obat . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_beli_faktur->harga_beli, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . $mutasi_beli_faktur->jml_beli . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_beli_faktur->nominal_beli, '0'), 2, ',', '.') . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td colspan="7"><span style="font-weight:bold">' . 'Total Pembelian' . '</span></td>';
            echo '<td><span style="font-weight:bold">' . number_format(empty_string($mutasi_beli_sum_faktur->nominal_beli, '0'), 2, ',', '.') . '</span></td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td colspan=\'19\'>Maaf tidak ada data yang ditampilkan!</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>