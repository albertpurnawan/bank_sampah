<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 90%;
            margin: auto;
            border: 2px solid #607D8B;
            padding: 10px;
            max-width: 900px;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #607D8B;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
        }

        .left {
            width: 30%;
            height: 400px;
            padding-right: 10px;
            box-sizing: border-box;
            float: left;
            border-right: 2px solid #607D8B;
            position: relative;
        }
        .right {
            width: 60%;
            padding: 10px;
            box-sizing: border-box;
            float: left;
            position: relative;
        }
        .clear {
            clear: both;
        }
        .section {
            border-bottom: 1px dotted #000;
            margin-bottom: 10px;
        }
        .section p {
            margin: 0;
        }
        .ttd {
            float: right;
            display: flex;
            flex-direction: column;
            justify-content: center; 
            align-items: center;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="section">
                <p>No: {{ $data->id_keuangan }}</p>
            </div>
            <div class="section">
                <p>Tanggal: {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</p>
            </div>
            <div class="section">
                <p>Terima Dari:</p>
                <p>Bank Sampah Local Recycle</p>
            </div>
            <div class="section">
                <p>Jumlah:</p>
                <p>Rp {{ $data->saldo }}</p>
            </div>
            <div class="section">
                <p>Untuk Pembayaran:</p>
                <p>Penarikan Saldo Bank Sampah</p>
            </div>
        </div>
        <div class="right">
            <div class="header">
                <h2>KWITANSI PEMBAYARAN</h2>
            </div>
            <div class="section">
                <p>No: {{ $data->id_keuangan }} Tanggal: {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</p>
            </div>
            <div class="section">
                <p>Terima Dari: Bank Sampah Local Recycle</p>
            </div>
            <div class="section">
                <p>Terbilang: {{ $data->terbilang }} rupiah</p>
            </div>
            <div class="section">
                <p>Untuk Pembayaran: Penarikan Saldo Bank Sampah</p>
            </div>
            <div class="section">
                <p>..........................</p>
                <p>..........................</p>
            </div>
            <div class="ttd" style="float: left;">
                <p style="text-align: center;">TTD</p>
                <p style="text-align: center; padding-top: 100px;">Pengurus Bank Sampah</p>
            </div>
            <div class="ttd" style="float: right;">
                <p style="text-align: center;">TTD</p>
                <p style="text-align: center; padding-top: 100px;">Penerima {{ $data->nama_lengkap_rekening }}</p>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</body>
</html>
