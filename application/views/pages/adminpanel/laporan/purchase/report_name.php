<div>
    <H3 style="text-align:center">Laporan Data Pembelian Berdasar Nama</H3>
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
        if (!empty($mutasi_beli_names)) {
            $no = 0;
            foreach ($mutasi_beli_names as $mutasi_beli_name) {
                $no++;
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $mutasi_beli_name->tanggal . '</td>';
                echo '<td>' . $mutasi_beli_name->faktur_pembelian . '</td>';
                echo '<td>' . $mutasi_beli_name->supplier_name . '</td>';
                echo '<td>' . $mutasi_beli_name->nama_obat . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_beli_name->harga_beli, '0'), 2, ',', '.') . '</td>';
                echo '<td>' . $mutasi_beli_name->jml_beli . '</td>';
                echo '<td>' . number_format(empty_string($mutasi_beli_name->nominal_beli, '0'), 2, ',', '.') . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td colspan="7"><span style="font-weight:bold">' . 'Total Pembelian' . '</span></td>';
            echo '<td><span style="font-weight:bold">' . number_format(empty_string($mutasi_beli_sum_name->nominal_beli, '0'), 2, ',', '.') . '</span></td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td colspan=\'19\'>Maaf tidak ada data yang ditampilkan!</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>