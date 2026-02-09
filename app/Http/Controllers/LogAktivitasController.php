<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logAktivitas = LogAktivitas::with('user')
            ->orderBy('tanggal_aktivitas', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('log-aktivitas.index', compact('logAktivitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogAktivitas $log_aktivitas)
    {
        $users = User::orderBy('name')->get();
        
        return view('log-aktivitas.edit', compact('log_aktivitas', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogAktivitas $log_aktivitas)
    {
        $validated = $request->validate([
            'deskripsi' => 'required|string|max:255',
            'id_user' => 'required|exists:users,id',
            'jenis_aktivitas' => 'required|string|max:255',
            'tanggal_aktivitas' => 'required|date',
        ]);

        $log_aktivitas->update($validated);

        return redirect()
            ->route('log-aktivitas.index')
            ->with('success', 'Log aktivitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogAktivitas $log_aktivitas)
    {
        $log_aktivitas->delete();

        return redirect()
            ->route('log-aktivitas.index')
            ->with('success', 'Log aktivitas berhasil dihapus.');
    }
}
