<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alat = Alat::with('kategori')->paginate(15);
        return view('alat.index', compact('alat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();
        return view('alat.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori,id',
            'nama_alat' => 'required|string|max:255',
            'status' => 'required|in:tersedia,tidak_tersedia',
        ]);

        Alat::create($validated);

        return redirect()
            ->route('alat.index')
            ->with('success', 'Alat berhasil ditambahkan.');
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
    public function edit(Alat $alat)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();
        return view('alat.edit', compact('alat', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alat $alat)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori,id',
            'nama_alat' => 'required|string|max:255',
            'status' => 'required|in:tersedia,tidak_tersedia',
        ]);

        $alat->update($validated);

        return redirect()
            ->route('alat.index')
            ->with('success', 'Alat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $alat)
    {
        $alat->delete();

        return redirect()
            ->route('alat.index')
            ->with('success', 'Alat berhasil dihapus.');
    }

    /**
     * Search for alat.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $alat = Alat::with('kategori')
            ->where('nama_alat', 'like', '%' . $query . '%')
            ->orWhereHas('kategori', function ($q) use ($query) {
                $q->where('nama_kategori', 'like', '%' . $query . '%');
            })
            ->paginate(15);

        return view('alat.index', compact('alat', 'query'));
    }
}
