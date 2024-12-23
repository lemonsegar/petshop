<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Masuk</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
        }

        th {
            background-color: #f5f5f5;
        }

        .header {
            margin-bottom: 20px;
        }

        .header h3,
        .header p {
            margin: 2px;
        }

        .periode {
            margin: 10px 0;
            font-style: italic;
        }

        .total-row {
            font-weight: bold;
            background-color: #f5f5f5;
        }

        hr {
            border-top: 2px solid #000;
            margin: 10px 0;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header text-center">
        <h3>LAPORAN BARANG MASUK</h3>
        <p>PET SHOP</p>
        <p></p>Jl. Contoh No. 123, Kota, Provinsi</p>
        <p>Telp: (021) 1234567, Email: info@example.com</p>
    </div>

    <hr>

    <div class="periode">
        <?= $periode ?>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">Tanggal</th>
                <th width="15%">No Faktur</th>
                <th width="30%">Produk</th>
                <th width="10%">Jumlah</th>
                <th width="15%">Harga</th>
                <th width="15%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total = 0;
            foreach ($barang_masuk as $row) :
                $total += $row['subtotal'];
            ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                    <td><?= $row['no_faktur'] ?></td>
                    <td><?= $row['nama_produk'] ?></td>
                    <td class="text-right"><?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                    <td class="text-right">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td class="text-right">Rp <?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="6" class="text-right">Total</td>
                <td class="text-right">Rp <?= number_format($total, 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>.............., <?= date('d/m/Y') ?></p>
        <br><br><br>
        <p>( _________________ )</p>
        <p>Admin</p>
    </div>
</body>

</html>