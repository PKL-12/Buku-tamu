<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tamu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        thead.table-header {
            background-color: #2e6bf0 !important;
            color: white !important;
        }

        tbody tr:nth-child(odd) { background-color: white !important; }
        tbody tr:nth-child(even) { background-color: #f4f6fc !important; }
        tbody tr:hover { background-color: #d9e3ff !important; }

        .table-bordered td, .table-bordered th {
            border: 1px solid #d0d7e6 !important;
        }

        h4 {
            color: #1f38c3;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-4">

    {{-- FILTER BAR + SEARCH FORM --}}
    <form method="GET" action="{{ route('tamu.index') }}">
        <div class="d-flex align-items-center gap-2 mb-3">

            {{-- Search --}}
            <input type="text" name="search" class="form-control"
                   style="max-width: 250px" placeholder="Search..."
                   value="{{ request('search') }}">

            <button type="submit" class="btn btn-primary px-3">
                <i class="fas fa-search text-white"></i>
            </button>

            {{-- Dropdown Bulan --}}
            <select name="bulan" class="form-select" style="max-width: 150px;">
                <option value="">Bulan</option>
                @foreach($bulanList as $angka => $nama)
                    <option value="{{ $angka }}" 
                        {{ request('bulan') == $angka ? 'selected' : '' }}>
                        {{ $nama }}
                    </option>
                @endforeach
            </select>

            {{-- Dropdown Tahun --}}
            <select name="tahun" class="form-select" style="max-width: 150px;">
                <option value="">Tahun</option>
                @foreach($tahunList as $th)
                    <option value="{{ $th }}" 
                        {{ request('tahun') == $th ? 'selected' : '' }}>
                        {{ $th }}
                    </option>
                @endforeach
            </select>

            {{-- Tampilkan --}}
            <button type="submit" class="btn btn-primary">Tampilkan</button>

            {{-- Export Excel (ikut filter search / bulan / tahun) --}}
            <a href="{{ route('tamu.export', request()->query()) }}" 
               class="btn btn-success">
                Export Excel
            </a>

        </div>
    </form>


    {{-- CARD --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h4 class="mb-3">Daftar Tamu</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-header">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Tujuan</th>
                            <th>Sub Tujuan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tamus as $tamu)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tamu->tanggal_berkunjung }}</td>
                            <td>{{ $tamu->nama }}</td>
                            <td>{{ $tamu->no_telp }}</td>
                            <td>{{ $tamu->tujuan }}</td>
                            <td>{{ $tamu->sub_tujuan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Back</a>

        </div>

    </div>

</div>

</body>
</html>
