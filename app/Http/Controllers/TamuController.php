<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TamuExport;


class TamuController extends Controller
{
    // ============================
    // HALAMAN DAFTAR TAMU (ADMIN)
    // ============================
    public function index(Request $request)
{
    $query = Tamu::query();

    // Search
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('no_telp', 'like', '%' . $request->search . '%')
              ->orWhere('tujuan', 'like', '%' . $request->search . '%')
              ->orWhere('sub_tujuan', 'like', '%' . $request->search . '%');
        });
    }

    // Filter Bulan
    if ($request->bulan) {
        $query->whereMonth('tanggal_berkunjung', $request->bulan);
    }

    // Filter Tahun
    if ($request->tahun) {
        $query->whereYear('tanggal_berkunjung', $request->tahun);
    }

    // Data tamu
    $tamus = $query->orderBy('tanggal_berkunjung', 'desc')->get();

    // **Dropdown bulan**
    $bulanList = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    // **Dropdown tahun (ambil dari DB)**
    $tahunList = Tamu::selectRaw('YEAR(tanggal_berkunjung) AS tahun')
                    ->distinct()
                    ->orderBy('tahun', 'desc')
                    ->pluck('tahun');

    return view('daftar-tamu', [
        'tamus' => $tamus,
        'search' => $request->search,
        'bulan' => $request->bulan,
        'tahun' => $request->tahun,
        'bulanList' => $bulanList,
        'tahunList' => $tahunList
    ]);
}

public function export(Request $request)
{
    $query = Tamu::query();

    // Search
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('no_telp', 'like', '%' . $request->search . '%')
              ->orWhere('tujuan', 'like', '%' . $request->search . '%')
              ->orWhere('sub_tujuan', 'like', '%' . $request->search . '%');
        });
    }

    // Filter Bulan
    if ($request->bulan) {
        $query->whereMonth('tanggal_berkunjung', $request->bulan);
    }

    // Filter Tahun
    if ($request->tahun) {
        $query->whereYear('tanggal_berkunjung', $request->tahun);
    }

    $data = $query->orderBy('tanggal_berkunjung', 'desc')->get();

    return Excel::download(new TamuExport($data), 'daftar-tamu.xlsx');
}



    // ============================
    // HALAMAN DASHBOARD
    // ============================
    public function dashboard()
    {
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = Tamu::whereMonth('created_at', $i)
                ->whereYear('created_at', date('Y'))
                ->count();
        }

        $labels = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];

        return view('pages.partials.dashboard-widgets', [
            'labels' => $labels,
            'jumlah' => array_values($monthlyData)
        ]);
    }

    // ============================
    // FORM TAMU
    // ============================
    public function create()
    {
        return view('form-tamu');
    }

    // ============================
    // SIMPAN DATA TAMU
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_telp' => 'required|string|max:20',
            'tujuan' => 'required|in:pendaftaran mahasiswa baru,informasi,tamu pimpinan',
            'sub_tujuan' => 'nullable|in:ujian,pembelajaran,konsultasi pembimbing akademik,surat keterangan,legalisir ijazah,pengambilan ijazah,tidak ada',
        ]);

        Tamu::create([
            'tanggal_berkunjung' => $request->tanggal_berkunjung,
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'tujuan' => $request->tujuan,
            'sub_tujuan' => $request->sub_tujuan
        ]);

        return redirect()->back()->with('success', 'Tamu berhasil ditambahkan!');
    }

    // ============================
    // STATISTIK
    // ============================
    public function statistik()
    {
        $data = Tamu::selectRaw('YEAR(created_at) as tahun, COUNT(*) as jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        return view('statistik-tamu', compact('data'));
    }

    // ============================
    // HOME DASHBOARD
    // ============================
    public function home()
    {
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = Tamu::whereMonth('created_at', $i)
                ->whereYear('created_at', date('Y'))
                ->count();
        }

        $labels = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];

        return view('pages.home', [
            'labels' => $labels,
            'jumlah' => array_values($monthlyData)
        ]);
    }
}
