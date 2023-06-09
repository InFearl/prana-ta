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
    <title>Cetak Data Penggunaan</title>
</head>
<body>
    <div>
        <p align="center"><b>Laporan Data Penggunaan</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%">
            <tr>
                <th>Id</th>
                <th>Nama Persediaan</th>
                <th>Jumlah Penggunaan</th>
                <th>Tanggal Penggunaan Persediaan</th>
            </tr>
            @foreach ($dbcetakpenggunaan as $item)
                <tr>
                    <td>{{ $item->id}}</td>
                    <td>{{ $item->persediaan->nama_persediaan ?? 'kosong'}}</td>
                    <td>{{ $item->jumlah_penggunaan}}</td>
                    <td>{{ date('d-m-y', strtotime($item->tanggal_penggunaan)) }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        window.print();

    </script>
</body>
</html>