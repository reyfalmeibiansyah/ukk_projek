<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
{
    // Ambil seluruh penjualan (seluruh data, bukan hanya hari ini)
    $penjualans = Penjualan::with('detailPenjualan.produk')->get();

    // Total penjualan produk
    $produkSales = [];
    foreach ($penjualans as $penjualan) {
        foreach ($penjualan->detailPenjualan as $detail) {
            $produkName = $detail->produk->title;
            $produkSales[$produkName] = ($produkSales[$produkName] ?? 0) + $detail->qty;
        }
    }

    // Persentase penjualan per produk
    $produkPercentages = [];
    $totalSales = array_sum($produkSales);
    foreach ($produkSales as $produkName => $sales) {
        $produkPercentages[$produkName] = ($sales / $totalSales) * 100;
    }

    // Data untuk chart total penjualan produk per tanggal (seluruh waktu)
    $salesByDate = [];
    foreach ($penjualans as $penjualan) {
        foreach ($penjualan->detailPenjualan as $detail) {
            $date = Carbon::parse($penjualan->created_at)->format('d F Y');
            $salesByDate[$date] = ($salesByDate[$date] ?? 0) + $detail->qty;
        }
    }

    $salesData = [
        'dates' => array_keys($salesByDate),
        'sales' => array_values($salesByDate),
    ];

    return view('admin.dashboard', compact('salesData', 'produkPercentages', 'produkSales'));
}




    public function dashboardpetugas()
    {
        // Ambil total kuantitas produk yang terjual hari ini
        $produkTerjualHariIni = 0;

        $penjualansHariIni = Penjualan::whereDate('created_at', Carbon::today())->with('detailPenjualan')->get();

        // Hitung total qty produk yang terjual hari ini
        foreach ($penjualansHariIni as $penjualan) {
            foreach ($penjualan->detailPenjualan as $detail) {
                $produkTerjualHariIni += $detail->qty;
            }
        }

        // Data penjualan untuk grafik (sesuaikan dengan data penjualan yang diperlukan)
        $salesData = [
            'dates' => ['08 February 2025', '09 February 2025', '10 February 2025', '11 February 2025', '12 February 2025', '13 February 2025', '14 February 2025'],
            'sales' => [0, 10, 30, 70, 20, 10, 60]
        ];

        return view('petugas.dashboardpetugas', compact('salesData', 'produkTerjualHariIni'));
    }
}
