<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TamuExport;
use Illuminate\Support\Facades\DB;

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

        $tamus = $query->orderBy('tanggal_berkunjung', 'desc')->get();

        $bulanList = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $tahunList = Tamu::selectRaw('YEAR(tanggal_berkunjung) AS tahun')
                        ->distinct()
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun');

        return view('daftar-tamu', compact('tamus', 'bulanList', 'tahunList'))
            ->with('search', $request->search)
            ->with('bulan', $request->bulan)
            ->with('tahun', $request->tahun);
    }

    // ============================
    // EXPORT EXCEL
    // ============================
    public function export(Request $request)
    {
        $query = Tamu::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('no_telp', 'like', '%' . $request->search . '%')
                  ->orWhere('tujuan', 'like', '%' . $request->search . '%')
                  ->orWhere('sub_tujuan', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->bulan) {
            $query->whereMonth('tanggal_berkunjung', $request->bulan);
        }

        if ($request->tahun) {
            $query->whereYear('tanggal_berkunjung', $request->tahun);
        }

        $data = $query->orderBy('tanggal_berkunjung', 'desc')->get();

        return Excel::download(new TamuExport($data), 'daftar-tamu.xlsx');
    }

    // ============================
    // DASHBOARD
    // ============================
    public function dashboard()
    {
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = Tamu::whereMonth('tanggal_berkunjung', $i)
                ->whereYear('tanggal_berkunjung', date('Y'))
                ->count();
        }

        $labels = ["Januari","Februari","Maret","April","Mei","Juni",
                   "Juli","Agustus","September","Oktober","November","Desember"];

        return view('home', [
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
            'tujuan' => 'required|string|max:255',
            'sub_tujuan' => 'nullable|string|max:255',
            'tanggal_berkunjung' => 'required|date'
        ]);

        $tamu = Tamu::create([
            'tanggal_berkunjung' => $request->tanggal_berkunjung,
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'tujuan' => $request->tujuan,
            'sub_tujuan' => $request->sub_tujuan
        ]);

        return redirect()->route('tamu.success')->with('data', $tamu);
    }

    // ============================
    // HALAMAN SUKSES
    // ============================
    public function success()
    {
        return view('success', [
            'data' => session('data')
        ]);
    }

    // ============================
    // STATISTIK GRAFIK
    // ============================
    public function statistik()
    {
        $labels = [];
        $jumlah = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = date("F", mktime(0, 0, 0, $i, 1));

            $jumlah[] = DB::table('tamu')
                ->whereMonth('tanggal_berkunjung', $i)
                ->whereYear('tanggal_berkunjung', date('Y'))
                ->count();
        }

        return view('statistik', compact('labels', 'jumlah'));
    }

    // ============================
    // HOME ADMIN
    // ============================
    public function home()
    {
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = Tamu::whereMonth('created_at', $i)
                ->whereYear('created_at', date('Y'))
                ->count();
        }

        $labels = ["Januari","Februari","Maret","April","Mei","Juni",
                   "Juli","Agustus","September","Oktober","November","Desember"];

        return view('pages.home', [
            'labels' => $labels,
            'jumlah' => array_values($monthlyData)
        ]);
    }
}
