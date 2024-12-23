<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            padding: 0;
        }

        .header .alamat {
            margin: 5px 0;
            font-size: 11px;
        }

        .tanggal {
            text-align: right;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 5px;
        }

        table th {
            background-color: #f0f0f0;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            margin-top: 50px;
        }

        .ttd {
            float: right;
            width: 200px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>PETSHOP</h1>
        <div class="alamat">
            Jl. Contoh No. 123, Kota, Provinsi<br>
            Telp: (021) 1234567, Email: info@example.com
        </div>
        <hr style="border: 1px solid #000;">
    </div>

    <div class="tanggal">
        Tanggal Cetak: <?= $tanggal ?>
    </div>

    <h3 style="text-align: center;">LAPORAN DATA PRODUK</h3>

    <div style="text-align: center; margin-bottom: 20px;">
        <small>Filter ID Produk: <?= $dari ?> s/d <?= $sampai ?></small>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">ID Produk</th>
                <th width="30%">Nama Produk</th>
                <th width="20%">Kategori</th>
                <th width="15%">Stok</th>
                <th width="15%">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $totalStok = 0;
            foreach ($produk as $row) :
                $totalStok += $row['stok'];
            ?>
                <tr>
                    <td style="text-align: center;"><?= $no++ ?></td>
                    <td><?= $row['id_produk'] ?></td>
                    <td><?= $row['nama_produk'] ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td class="text-right"><?= number_format($row['stok'], 0, ',', '.') ?></td>
                    <td class="text-right">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total Stok</th>
                <th class="text-right"><?= number_format($totalStok, 0, ',', '.') ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>

    <div class="ttd">
        <p>
            ..........., <?= $tanggal ?><br>
            Mengetahui,<br><br><br><br>
            _________________<br>
            Nama Pimpinan<br>
            NIP. 123456789
        </p>
    </div>

    <div class="footer">
        Dicetak pada: <?= date('d/m/Y H:i:s') ?>
    </div>
</body>

</html>