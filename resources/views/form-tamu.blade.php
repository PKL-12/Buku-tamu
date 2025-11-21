<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">Form Buku Tamu</h3>

            <form action="{{ route('tamu.store') }}" method="POST">
                @csrf

                <!-- Tanggal Berkunjung -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Berkunjung</label>
                    <input type="date" name="tanggal_berkunjung" class="form-control" required>
                </div>

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" maxlength="100" class="form-control" required>
                </div>

                <!-- No Telp -->
                <div class="mb-3">
                    <label class="form-label">No Telp</label>
                    <input type="text" name="no_telp" maxlength="20" class="form-control" required>
                </div>

                <!-- Tujuan -->
                <div class="mb-3">
                    <label class="form-label">Tujuan</label>
                    <select name="tujuan" class="form-select" required>
                        <option value="">-- Pilih Tujuan --</option>
                        <option value="pendaftaran mahasiswa baru">Pendaftaran Mahasiswa Baru</option>
                        <option value="informasi">Informasi</option>
                        <option value="tamu pimpinan">Tamu Pimpinan</option>
                    </select>
                </div>

                <!-- Sub Tujuan -->
                <div class="mb-3">
                    <label class="form-label">Informasi</label>
                    <select name="sub_tujuan" class="form-select">
                        <option value="tidak ada">Tidak Ada</option>
                        <option value="ujian">Ujian</option>
                        <option value="pembelajaran">Pembelajaran</option>
                        <option value="konsultasi pembimbing akademik">Konsultasi Pembimbing Akademik</option>
                        <option value="surat keterangan">Surat Keterangan</option>
                        <option value="legalisir ijazah">Legalisir Ijazah</option>
                        <option value="pengambilan ijazah">Pengambilan Ijazah</option>
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Kirim
                    </button>
                </div>
            </form>

            <!-- Pesan sukses -->
            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>

</body>
</html>
