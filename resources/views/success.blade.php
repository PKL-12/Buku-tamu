<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
  <title>Pendaftaran Berhasil</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* pop animation for the check */
    @keyframes pop {
      0% { transform: scale(0); opacity: 0; }
      70% { transform: scale(1.15); opacity: 1; }
      100% { transform: scale(1); opacity: 1; }
    }

    /* subtle card appear */
    @keyframes cardIn {
      from { transform: translateY(8px); opacity: 0; }
      to   { transform: translateY(0); opacity: 1; }
    }

    .pop {
      animation: pop 360ms cubic-bezier(.2,.9,.3,1);
    }

    .cardIn {
      animation: cardIn 360ms ease-out;
    }

    /* make link-like secondary button accessible */
    .link-btn {
      -webkit-tap-highlight-color: transparent;
      -webkit-user-select: none;
      user-select: none;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-sm">
    <div class="bg-white shadow-lg rounded-2xl p-6 cardIn">
      <!-- icon area -->
      <div class="flex justify-center mb-4">
        <div class="bg-green-100 text-green-600 w-20 h-20 flex items-center justify-center rounded-full text-4xl font-bold pop" role="img" aria-label="sukses">
          ✓
        </div>
      </div>

      <h1 class="text-center text-2xl font-semibold text-gray-800 mb-1">Pendaftaran Berhasil!</h1>
      <p class="text-center text-sm text-gray-600 mb-4">Terima kasih. Data kunjungan Anda telah tersimpan.</p>

      <!-- data card -->
      <div class="bg-gray-50 border border-gray-100 rounded-xl p-4 text-sm text-gray-700 mb-4">
        <div class="mb-2">
          <div class="text-xs text-gray-500">Nama</div>
          <div class="font-medium text-gray-800 truncate">{{ $data->nama ?? '-' }}</div>
        </div>

        <div class="mb-2">
          <div class="text-xs text-gray-500">No Telepon</div>
          <div class="text-gray-800">{{ $data->no_telp ?? '-' }}</div>
        </div>

        <div>
          <div class="text-xs text-gray-500">Tujuan</div>
          <div class="text-gray-800">{{ $data->tujuan ?? '-' }}</div>
        </div>
      </div>

      <!-- buttons -->
      <div class="space-y-3">
        <!-- primary: Tambah Tamu Baru (touch target large) -->
        <a href="{{ route('tamu.form') }}"
           class="block w-full text-center bg-blue-600 hover:bg-blue-700 active:scale-[.99] transition-transform duration-150 text-white font-semibold py-3 rounded-lg shadow-md"
           role="button" aria-label="Isi Data Tamu Lagi">
          Tambah Tamu Baru
        </a>
      </div>
    </div>
  </div>

</body>
</html>
