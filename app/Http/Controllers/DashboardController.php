<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $firstSummary = 0;
        $secondSummary = 0;
        $thirdSummary = 0;
        $firstTitle = '';
        $secondTitle = '';
        $thirdTitle = '';

        if(auth()->user()->isAdmin()) {
            $firstSummary = \App\Models\User::count();
            $secondSummary = \App\Models\Alat::count();
            $thirdSummary = \App\Models\Peminjaman::where('status', 'dipinjam')->count();
            $firstTitle = 'Total Users';
            $secondTitle = 'Total Alat';
            $thirdTitle = 'Peminjaman Aktif';
            $latestActivity = \App\Models\LogAktivitas::with('user')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        } elseif(auth()->user()->isPetugas()) {
            $firstSummary = \App\Models\Peminjaman::where('status', 'menunggu')->count();
            $secondSummary = \App\Models\Pengembalian::where('status', 'menunggu')->count();
            $thirdSummary = \App\Models\Denda::where('status', 'menunggu')->count();   
            $firstTitle = 'Peminjaman Pending';
            $secondTitle = 'Pengembalian Pending';
            $thirdTitle = 'Denda Belum Lunas';
            $latestActivity = \App\Models\LogAktivitas::with('user')
                ->where('id_user', auth()->id())
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        } elseif(auth()->user()->isPeminjam()) {
            $firstSummary = \App\Models\Peminjaman::where('id_user', auth()->id())->count();
            $secondSummary = \App\Models\Pengembalian::where('id_user', auth()->id())->count();
            $nominalDenda = \App\Models\Denda::where('id_user', auth()->id())
                ->where('status', 'menunggu')
                ->sum('total_denda') ?? 0;
            $formatDenda = number_format($nominalDenda, 0, ',', '.');
            $thirdSummary = 'Rp ' . $formatDenda;
            $firstTitle = 'Peminjaman Saya';
            $secondTitle = 'Pengembalian Saya';
            $thirdTitle = 'Denda Saya';
            $latestActivity = \App\Models\LogAktivitas::with('user')
                ->where('id_user', auth()->id())
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        }
        return view('dashboard', compact('firstSummary', 'secondSummary', 'thirdSummary', 'firstTitle', 'secondTitle', 'thirdTitle', 'latestActivity'));
    }
}
