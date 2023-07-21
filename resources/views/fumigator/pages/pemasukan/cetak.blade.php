<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style type="text/css">
        table {
            border-style: double;
            border-width: 3px;
            border-color: white;
        }

        table tr .text2 {
            text-align: right;
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 13px;
        }

        table tr td {
            font-size: 13px;
        }
    </style>
    <title>Cetak Data Pemasukan</title>
</head>
<body>
    <center>
        <table width="100%">
            <tr>
                <td><img src="{{asset('template/img/logo_prana.png')}}" width="100%" height="130"></td>
                <td style="padding-right: 4rem;">
                    <center>
                        <font size="6"><b>PT Prana Argentum Corporation </b></font><br>
                        <font size="3">Jl. Ikan Mungsing V No.75, RT.015/RW.04, Perak Bar., Kec. Krembangan, Surabaya, Jawa Timur 60177
                        </font>
                    </center>
                </td>
                {{-- <td></td> --}}
            </tr>
        </table>
        <hr>

        <table style="margin-top: 30px;">
            <tr class="text2">
                <td>Tanggal Cetak</td>
                <td>: tanggal</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>: Laporan Pemasukan</td>
            </tr>
        </table>
        <br>
        <h3>Laporan Pemasukan</h3>
    </center>
    <div>
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