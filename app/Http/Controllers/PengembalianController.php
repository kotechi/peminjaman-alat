<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Denda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengembalian = Pengembalian::with(['peminjaman.user', 'peminjaman.alat.kategori', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('pengembalian.index', compact('pengembalian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peminjaman = Peminjaman::with(['user', 'alat.kategori'])
            ->where('status', 'disetujui')
            ->whereDoesntHave('pengembalian')
            ->orderBy('created_at', 'desc')
            ->get();

        $users = User::orderBy('name')->get();

        return view('pengembalian.create', compact('peminjaman', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_peminjaman' => 'required|exists:peminjaman,id',
            'tanggal_kembali_realisasi' => 'required|date',
            'id_user' => 'required|exists:users,id',
        ]);

        // Check if peminjaman already has pengembalian
        $existingPengembalian = Pengembalian::where('id_peminjaman', $validated['id_peminjaman'])->first();
        if ($existingPengembalian) {
            return back()
                ->withInput()
                ->withErrors(['id_peminjaman' => 'Peminjaman ini sudah memiliki pengembalian.']);
        }

        $peminjaman = Peminjaman::find($validated['id_peminjaman']);
        $tanggalPengembalian = Carbon::parse($peminjaman->tanggal_pengembalian);
        $tanggalKembaliRealisasi = Carbon::parse($validated['tanggal_kembali_realisasi']);

        $hariTerlambat = $tanggalKembaliRealisasi->diffInDays($tanggalPengembalian, false);
        $hariTerlambat = max(0, $hariTerlambat);

        $validated['hari_terlambat'] = $hariTerlambat;

        $pengembalian = Pengembalian::create($validated);

        // Create denda if late
        if ($hariTerlambat > 0) {
            Denda::create([
                'id_pengembalian' => $pengembalian->id,
                'id_user' => $validated['id_user'],
                'nama_kategori' => $peminjaman->alat->kategori->nama_kategori,
                'total_denda' => $hariTerlambat * 5000, // Assuming 5000 per day
                'status' => 'menunggu',
            ]);
        }

        // Update peminjaman status
        $peminjaman->update(['status' => 'dikembalikan']);

        // Update alat status to tersedia
        $peminjaman->alat->update(['status' => 'tersedia']);

        return redirect()
            ->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengembalian $pengembalian)
    {
        $peminjaman = Peminjaman::with(['user', 'alat.kategori'])->get();
        $users = User::orderBy('name')->get();

        return view('pengembalian.edit', compact('pengembalian', 'peminjaman', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        $validated = $request->validate([
            'id_peminjaman' => 'required|exists:peminjaman,id',
            'tanggal_kembali_realisasi' => 'required|date',
            'id_user' => 'required|exists:users,id',
            'status' => 'required|in:menunggu,disetujui,ditolak,selesai',
            'hari_terlambat' => 'required|integer|min:0',
        ]);

        $pengembalian->update($validated);

        return redirect()
            ->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil diperbarui.');
    }

    /**
     * Confirm pengembalian (approve/reject).
     */
    public function confirm(Request $request, Pengembalian $pengembalian)
    {
        $validated = $request->validate([
            'status' => 'required|in:disetujui,ditolak,selesai',
        ]);

        $pengembalian->update(['status' => $validated['status']]);

        $message = match($validated['status']) {
            'disetujui' => 'Pengembalian berhasil disetujui.',
            'ditolak' => 'Pengembalian berhasil ditolak.',
            'selesai' => 'Pengembalian berhasil diselesaikan.',
        };

        return redirect()
            ->route('pengembalian.index')
            ->with('success', $message);
    }
}
