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
        } elseif(auth()->user()->isPetugas()) {
            $firstSummary = \App\Models\Peminjaman::where('status', 'dipinjam')->count();
            $secondSummary = \App\Models\Pengembalian::where('status', 'dikembalikan')->count();
            $thirdSummary = \App\Models\Denda::where('status', 'belum lunas')->count();   
            $firstTitle = 'Peminjaman Aktif';
            $secondTitle = 'Pengembalian';
            $thirdTitle = 'Denda Belum Lunas';
        } elseif(auth()->user()->isPeminjam()) {
            $firstSummary = \App\Models\Peminjaman::where('user_id', auth()->id())->count();
            $secondSummary = \App\Models\Pengembalian::where('user_id', auth()->id())->count();
            $thirdSummary = \App\Models\Denda::where('user_id', auth()->id())->where('status', 'belum lunas')->count();   
            $firstTitle = 'Peminjaman Saya';
            $secondTitle = 'Pengembalian Saya';
            $thirdTitle = 'Denda Saya';
        }
        return view('dashboard', compact('firstSummary', 'secondSummary', 'thirdSummary', 'firstTitle', 'secondTitle', 'thirdTitle'));
    }
}
