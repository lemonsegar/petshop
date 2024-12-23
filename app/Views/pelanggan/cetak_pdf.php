<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Pelanggan</title>
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

    <h3 style="text-align: center;">LAPORAN DATA PELANGGAN</h3>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama Pelanggan</th>
                <th width="40%">Alamat</th>
                <th width="25%">No. Telepon</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($pelanggan as $row) : ?>
                <tr>
                    <td style="text-align: center;"><?= $no++ ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['no_telfon'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
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