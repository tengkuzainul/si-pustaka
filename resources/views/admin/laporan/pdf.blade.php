<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/image/Logo-PustakaConnect.png') }}" type="image/x-icon">
    <title>PustakaConnect | Laporan</title>

    <style>
        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
        }

        * {
            box-sizing: inherit;
        }

        header {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .logo {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto 10px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }

        section {
            margin: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #edeaea;
            text-align: center;
        }

        .success {
            background-color: #059212;
            color: #FDFDFD;
            padding: 6px 12px;
            border-radius: 5px;
        }

        .waiting {
            background-color: #FFDB00;
            color: #373A40;
            padding: 6px 12px;
            border-radius: 5px;
        }

        @media (max-width: 600px) {
            .title {
                font-size: 18px;
            }

            th,
            td {
                font-size: 12px;
                padding: 6px;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1 class="title">Borrowing And Return Book Report</h1>
    </header>

    <section>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Member Name</th>
                    <th>Borrowing Date</th>
                    <th>Early Return Date</th>
                    <th>Return Date</th>
                    <th>Charge</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $d)
                    <tr>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td>{{ $d->member->nama_member }}</td>
                        <td>{{ date('d F Y', strtotime($d->lend_date)) }}</td>
                        <td>{{ date('d F Y', strtotime($d->return_date)) }}</td>
                        <td>
                            {{ optional($d->pengembalian)->tanggal_pengembalian ? date('d F Y', strtotime($d->pengembalian->tanggal_pengembalian)) : 'Belum Mengembalikan' }}
                        </td>
                        <td>Rp. {{ number_format($d->pengembalian->denda ?? 0) }}</td>
                        <td style="text-align: center">
                            <span
                                class="{{ $d->status == 'Belum' ? 'waiting' : 'success ' }}">{{ $d->status }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; font-weight: 600 ">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</body>

</html>
