<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Transaksi;
use illuminate\Contracts\view\view;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportExcel implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    public $start = "now()";
    public $end = "now()";

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = Carbon::parse($end)->addDay();
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        return Transaksi::whereBetween('date', [$this->start, $this->end])->get();
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->user->name,
            $transaksi->user->email,
            $transaksi->date,
            "IDR. " . number_format($transaksi->harga) . ",00",
            $transaksi->diskon * 100 . "%"

        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Tanggal',
            'Total Harga',
            'Diskon'
        ];
    }

    // public function view(): view
    // {
    //     return view('exceltmplt', ['transaksi' => Transaksi::all()]);
    // }
}
