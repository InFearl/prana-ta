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
    <title>Cetak Data Pesanan</title>
</head>
<body>
    <div>
        <p align="center"><b>Laporan Data Pesanan</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%">
            <tr>
                <th>Id Pesanan</th>
                <th>Nama Perusahaan</th>
                <th>20ft</th>
                <th>40ft</th>
                <th>Tanggal Masuk Pesanan</th>
                <th>Deadline Pesanan</th>
                <th>Status Pesanan</th>
            </tr>
            @foreach ($dbcetakpesanan as $item)
                <tr>
                    
                    <td>{{ $item->id}}</td>
                    <td>{{ $item->nama_perusahaan }}</td>
                    <td>{{ $item->c20ft }}</td>
                    <td>{{ $item->c40ft }}</td>
                    <td>{{ date('d-m-y', strtotime($item->tanggal_masuk)) }}</td>
                    <td>{{ date('d-m-y', strtotime($item->tanggal_akhir)) }}</td>
                    <td>{{ $item->status_pesanan }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        window.print();

    </script>
</body>
</html>