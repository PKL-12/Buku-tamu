<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil jumlah tamu per bulan
        $data = Tamu::selectRaw('YEAR(tanggal_berkunjung) as tahun, MONTH(tanggal_berkunjung) as bulan, COUNT(*) as jumlah')
                    ->groupBy('tahun','bulan')
                    ->orderBy('tahun','asc')
                    ->orderBy('bulan','asc')
                    ->get();

        // Tentukan range bulan dari bulan pertama sampai terakhir ada data, atau default tahun ini
        $startMonth = $data->first() 
            ? Carbon::create($data->first()->tahun, $data->first()->bulan, 1) 
            : Carbon::now()->startOfYear();

        $endMonth = $data->last() 
            ? Carbon::create($data->last()->tahun, $data->last()->bulan, 1) 
            : Carbon::now()->endOfYear();

        // Buat array bulan lengkap
        $period = [];
        $current = $startMonth->copy();
        while($current <= $endMonth){
            $period[] = $current->format('Y-m');
            $current->addMonth();
        }

        // Siapkan label & jumlah tamu
        $labels = [];
        $jumlah = [];
        foreach($period as $month){
            [$y, $m] = explode('-', $month);
            $labels[] = Carbon::createFromDate($y, $m, 1)->format('F Y');
            $item = $data->firstWhere(fn($d) => $d->tahun == $y && $d->bulan == $m);
            $jumlah[] = $item ? $item->jumlah : 0;
        }

        return view('pages.home', compact('labels','jumlah'));
    }
}
