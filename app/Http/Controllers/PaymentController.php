<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment = Payment::with(['denda.pengembalian.peminjaman.user', 'denda.pengembalian.peminjaman.alat'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('payment.index', compact('payment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $denda = Denda::with(['pengembalian.peminjaman.user', 'pengembalian.peminjaman.alat'])
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('payment.create', compact('denda'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_denda' => 'required|exists:denda,id',
            'nominal' => 'required|integer|min:0',
            'proof_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        // Handle file upload
        if ($request->hasFile('proof_img')) {
            $file = $request->file('proof_img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('proof_images', $filename, 'public');
            $validated['proof_img'] = $path;
        }

        Payment::create($validated);

        return redirect()
            ->route('payment.index')
            ->with('success', 'Pembayaran berhasil dibuat.');
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
    public function edit(Payment $payment)
    {
        $denda = Denda::with(['pengembalian.peminjaman.user', 'pengembalian.peminjaman.alat'])->get();

        return view('payment.edit', compact('payment', 'denda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'id_denda' => 'required|exists:denda,id',
            'status' => 'required|in:menunggu,disetujui,ditolak',
            'nominal' => 'required|integer|min:0',
            'proof_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload if new file provided
        if ($request->hasFile('proof_img')) {
            // Delete old file
            if ($payment->proof_img && Storage::disk('public')->exists($payment->proof_img)) {
                Storage::disk('public')->delete($payment->proof_img);
            }

            $file = $request->file('proof_img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('proof_images', $filename, 'public');
            $validated['proof_img'] = $path;
        }

        $payment->update($validated);

        return redirect()
            ->route('payment.index')
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    /**
     * Confirm payment (approve/reject).
     */
    public function confirm(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $payment->update(['status' => $validated['status']]);

        // Update denda status if payment approved
        if ($validated['status'] === 'disetujui') {
            $payment->denda->update(['status' => 'selesai']);
        }

        $message = $validated['status'] === 'disetujui'
            ? 'Pembayaran berhasil disetujui.'
            : 'Pembayaran berhasil ditolak.';

        return redirect()
            ->route('payment.index')
            ->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        // Delete proof image file
        if ($payment->proof_img && Storage::disk('public')->exists($payment->proof_img)) {
            Storage::disk('public')->delete($payment->proof_img);
        }

        $payment->delete();

        return redirect()
            ->route('payment.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}
