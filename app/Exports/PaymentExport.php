<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PaymentExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Payment::with(['denda.pengembalian.peminjaman.user', 'denda.user'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama User',
            'Kategori Denda',
            'Total Denda',
            'Nominal Pembayaran',
            'Tanggal Pembayaran',
            'Status',
        ];
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $row->denda->pengembalian->peminjaman->user->name,
            $row->denda->nama_kategori,
            'Rp ' . number_format($row->denda->total_denda, 0, ',', '.'),
            'Rp ' . number_format($row->nominal, 0, ',', '.'),
            $row->created_at->format('d/m/Y H:i'),
            ucfirst($row->status),
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Laporan Pembayaran';
    }
}
