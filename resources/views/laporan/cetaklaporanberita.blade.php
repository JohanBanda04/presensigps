<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        .overflowtes td {
            border: 1px solid black;
            word-wrap: break-word;
        }
        .sheet {
            overflow: visible;
            height: auto !important;
        }
    </style>
    <style>@page {
            size: A4 landscape;
        }

        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        .tabeldatakaryawan {
            margin-top: 40px;
        }

        .tabeldatakaryawan tr td {
            padding: 5px;
        }

        .tabelpresensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tabelpresensi tr th {
            border: 1px solid #000000;
            padding: 8px;
            background: #cccaca;
        }

        .tabelpresensi tr td {
            border: 1px solid #000000;
            padding: 5px;
            font-size: 12px;
        }

        .foto {
            width: 40px;
            height: 30px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape">

@php
    function selisih($jam_masuk, $jam_keluar)
           {
               list($h, $m, $s) = explode(":", $jam_masuk);
               $dtAwal = mktime($h, $m, $s, "1", "1", "1");
               list($h, $m, $s) = explode(":", $jam_keluar);
               $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
               $dtSelisih = $dtAkhir - $dtAwal;
               $totalmenit = $dtSelisih / 60;
               $jam = explode(".", $totalmenit / 60);
               $sisamenit = ($totalmenit / 60) - $jam[0];
               $sisamenit2 = $sisamenit * 60;
               $jml_jam = $jam[0];
               return $jml_jam . ":" . round($sisamenit2);
           }
@endphp

<!-- Each sheet element should have the class "sheet" -->
<!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
<section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                {{--<img src="{{ asset('assets/img/logopresensi.png') }}" width="70" height="70" alt="">--}}
            </td>
            <td>
                <center>
                    <span id="title">
                    LAPORAN LINK BERITA SOSIAL MEDIA {{ $satker_name }} <br>
                    PERIODE {{ $tgl_dari }} {{ strtoupper($namabulan[$bulan_dari]) }} {{ $tahun_dari }} s.d. {{ $tgl_sampai }} {{ strtoupper($namabulan[$bulan_sampai]) }} {{ $tahun_sampai }}
                        <br>
                    <br>
                </span>
                    <span hidden><i>Jl. Majapahit No.44, Kekalik Jaya, Kec. Sekarbela, Kota Mataram, Nusa Tenggara Barat. 83115</i></span>
                </center>

            </td>
        </tr>
    </table>
    <table class="tabeldatakaryawan">






    </table>
    <table class="tabelpresensi" style="border-spacing: 0px;
            table-layout: fixed;
            margin-left: auto;
            margin-right: auto;">
        <tr>
            <th style="width: 20px">No.</th>
            <th>Tanggal</th>
            <th style="width: max-content">Website</th>
            <th>Facebook</th>
            <th>Instagram</th>
            <th>Twitter</th>
            <th>Tiktok</th>
            <th>SIPPN</th>
            <th>Youtube</th>
        </tr>
        @foreach($getberita as $d)

            <tr class="overflowtes">
                <td>{{ $loop->iteration }}</td>
                <td >{{ date("d-m-Y",strtotime($d->tgl_input)) }}</td>
                <td >{{ $d->website }}</td>
                <td >{{ $d->facebook }}</td>
                <td >{{ $d->instagram }}</td>
                <td >{{ $d->twitter }}</td>
                <td >{{ $d->tiktok }}</td>
                <td >{{ $d->sippn }}</td>
                <td >{{ $d->youtube }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" align="center" style="font-weight: bold; background: #cccaca; font-size: 15px">Jumlah</td>
            <td align="center" style="font-weight: bold; background: #cccaca;">{{ $total_website[0]->jml_website }}</td>
            <td align="center" style="font-weight: bold; background: #cccaca;">{{ $total_facebook[0]->jml_facebook }}</td>
            <td align="center" style="font-weight: bold; background: #cccaca;">{{ $total_instagram[0]->jml_instagram }}</td>
            <td align="center" style="font-weight: bold; background: #cccaca;">{{ $total_twitter[0]->jml_twitter }}</td>
            <td align="center" style="font-weight: bold; background: #cccaca;">{{ $total_tiktok[0]->jml_tiktok }}</td>
            <td align="center" style="font-weight: bold; background: #cccaca;">{{ $total_sippn[0]->jml_sippn }}</td>
            <td align="center" style="font-weight: bold; background: #cccaca;">{{ $total_youtube[0]->jml_youtube }}</td>
        </tr>
    </table>
    {{--<table width="100%" style="margin-top: 100px">--}}
        {{--<tr>--}}
            {{--<td colspan="2" style="color: white;text-align: right; padding-right: 230px;">Mataram, {{ date('d-m-Y') }}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td style="color: white;text-align: center; vertical-align: bottom" height="100px" >--}}
                {{--<u>Qiana Kalila</u><br>--}}
                {{--<i><b>HRD Manager</b></i>--}}
            {{--</td>--}}
            {{--<td style="color: white;text-align: center; vertical-align: bottom; padding-right: 18px;"  >--}}
                {{--<u>Ttd Operator</u><br>--}}
                {{--<i><b>{{ auth()->user()->name }}</b></i>--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--</table>--}}
</section>

</body>

</html>