<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            padding: 3px;
            font-size: 0.8em;
        }

        td.qty,
        th.qty {
            width: 15px;
            max-width: 15px;
        }

        td.keterangan,
        th.keterangan {
            width: 75px;
            max-width: 75px;
            word-break: break-all;
        }

        td.harga,
        th.harga {
            width: 60px;
            max-width: 60px;
            word-break: break-all;
        }

        td.jumlah,
        th.jumlah {
            width: 70px;
            max-width: 70px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .align-right {
            text-align: right;
        }

        .ticket {
            width: 155px;
            max-width: 155px;
        }

        .font {
            font-size: 0.9em;
            font-weight: bold;
            margin-top: -5%;
        }

        .font-isi {
            font-size: 0.8em;
            font-weight: bold;
        }

        .flex {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-right: 4%;
            margin-left: 2%;
            margin-top: 3%;

        }

        .size {
            font-size: 1em;
        }

        @media print {

            @page {
                margin: 0;
            }

        }
    </style>
    <title>Print Struk || Ikan Bakar Buk'Tut</title>
</head>

<body>
    <div class="ticket">
        <p class="centered" style="font-weight: bold;">Ikan Bakar Buk'Tut<br>
        <div class="font centered">
            Jl. Kendedes, Br. Langui Ungasan, Desa Ungasan, Badung, Bali.
        </div><br>
        <div class="font centered">
            Telp: -
        </div>
        </p>
        <h2 class="centered">
            Invoice : {{ $transaction->code }}
        </h2>
        <table>
            <thead>
                <tr>
                    <th class="keterangan">Ket.</th>
                    <th class="qty">Qty</th>
                    <th class="harga">Rp.</th>
                    <th class="harga">Jml</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($transaction->menus as $menu)
                    <tr>
                        <td class="keterangan size">{{ $menu->name }}</td>
                        <td class="qty centered size">{{ $menu->pivot->qty }}</td>
                        <td class="qty centered size">{{ $menu->price }}</td>
                        <td class="harga  centered size">{{ ( $menu->pivot->qty * $menu->price )}}</td>
                    </tr>       
            @endforeach

            @foreach ($transaction->pakets as $paket)
            <tr>
                <td class="keterangan size">{{ $paket->name }}</td>
                <td class="qty centered size">{{ $paket->pivot->qty }}</td>
                <td class="qty centered size">{{ $paket->price }}</td>
                <td class="harga  centered size">{{ ( $paket->pivot->qty * $paket->price )}}</td>
            </tr>       
            @endforeach
            </tbody>
        </table>
        <div style="border-top: 1px solid black;">
            <div class="flex">
                <div class="font-isi">
                    TOTAL
                </div>
                <div class="font-isi">
                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                </div>
            </div>
                <div class="flex">
                    <div class="font-isi">
                        TUNAI
                    </div>
                    <div class="font-isi">
                        Rp {{ number_format($transaction->pay, 0, ',', '.') }}
                    </div>
                </div>
        </div>
        <div style="border-top: 1px solid black;">
                <div class="flex">
                    <div class="font-isi">
                        KEMBALIAN
                    </div>
                    <div class="font-isi">
                        Rp {{ number_format($kembalian, 0, ',', '.') }}
                    </div>
                </div>
        </div>

        <br>
        <div>
            <span>Keterangan :
                    Cash
            </span>
        </div>
        <hr>

        <div class="centered">
            <span>Tanggal :
                {{ Carbon\Carbon::parse($transaction->created_at)->isoFormat('DD-MM-YYYY') . ' ' . Carbon\Carbon::parse($transaction->created_at)->toTimeString() }}
            </span>
        </div>
        <p class="centered" style="font-size: 0.9em;">* TerimaKasih Telah Berbelanja *
            <br>* Ikan Bakar Buk'Tut *
        </p>
        <div style="border-bottom:2px dashed rgb(0, 0, 0);"></div>
    </div>
    {{-- <button id="btnPrint" class="hidden-print">Print</button> --}}
    <script type="text/javascript">
        window.print();
        // window.onafterprint = back;
        // window.onbeforeprint = back;
        var beforePrint = function() {
            console.log('Functionality to run before printing.');
        };

        var afterPrint = function() {
            // window.history.back();
            location.href = "{{ route('transaction.index') }}";

        };

        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (mql.matches) {
                    beforePrint();
                } else {
                    afterPrint();
                }
            });
        }

        window.onbeforeprint = beforePrint;
        window.onafterprint = afterPrint;
    </script>
</body>

</html>
