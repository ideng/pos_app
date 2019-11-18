<div>
    <H3 style="text-align:center">Mutasi Data Penjualan Berdasar Faktur</H3>
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
        if (!empty($mutasi_jual_fakturs)) {
            $no = 0;
            foreach ($mutasi_jual_fakturs as $mutasi_jual_faktur) {
                $no++;
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $mutasi_jual_faktur->tanggal . '</td>';
                echo '<td>' . $mutasi_jual_faktur->faktur_penjualan . '</td>';
                echo '<td>' . $mutasi_jual_faktur->nama_pasien . '</td>';
                echo '<td>' . $mutasi_jual_faktur->nama_obat . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_jual_faktur->harga_jual, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . $mutasi_jual_faktur->jml_jual . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_jual_faktur->nominal_jual, '0'), 2, ',', '.') . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td colspan="7"><span style="font-weight:bold">' . 'Total Penjualan' . '</span></td>';
            echo '<td><span style="font-weight:bold">' . number_format(empty_string($mutasi_jual_sum_faktur->nominal_jual, '0'), 2, ',', '.') . '</span></td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td colspan=\'19\'>Maaf tidak ada data yang ditampilkan!</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>