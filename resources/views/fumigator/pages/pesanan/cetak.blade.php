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
                <th>Container</th>
                <th>Tanggal Masuk Pesan</th>
                <th>Deadline Pesanan</th>
                <th>Status Pesanan</th>
            </tr>
            @foreach ($dbcetakpesanan as $item)
                <tr>
                    
                    <td>{{ $item->id}}</td>
                    <td>{{ $item->nama_perusahaan }}</td>
                    <td>{{ $item->container }}</td>
                    <td>{{ date('d-m-y', strtotime($item->tanggal_masuk)) }}</td>
                    <td>{{ date('d-m-y', strtotime($item->tanggal_akhir)) }}</td>
                    <td>
                        <label>{{ ($item->status_pesanan == 1) ? 'Selesai' : 'Proses Pengerjaan'}}</label>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        window.print();

    </script>
</body>
</html>