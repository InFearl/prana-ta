<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table.static{
            position: relative;
            border: 1px solid #554433
        }
    </style>
    <title>Cetak Data Pemasukan</title>
</head>
<body>
    <div>
        <p align="center"><b>Laporan Data Pemasukan</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%">
            <tr>
                <th>Id</th>
                <th>Nama Persediaan</th>
                <th>Jumlah Pemasukan</th>
                <th>Tanggal Masuk Persediaan</th>
            </tr>
            @foreach ($dbcetakpemasukan as $item)
                <tr>
                    <td>{{ $item->id}}</td>
                    <td>{{ $item->persediaan->nama_persediaan ?? 'kosong'}}</td>
                    <td>{{ $item->jumlah_pemasukan}}</td>
                    <td>{{ date('d-m-y', strtotime($item->pemasukan->tanggal_pemasukan)) }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        window.print();

    </script>
</body>
</html>