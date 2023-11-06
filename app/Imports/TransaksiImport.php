<?php

namespace App\Imports;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TransaksiImport implements ToModel, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $r)
    {

        $import_data_excel = Carbon::createFromDate(1900, 1, 1)->addDays($r[0] - 2);
        $tanggal = Carbon::parse($import_data_excel)->format('Y-m-d');

        $transaksi = new Transaksi();
        $transaksi->pelanggan = $r[1];
        $transaksi->tanggal = $tanggal;
        $transaksi->item = $r[2];
        $transaksi->save();
    }

    public function startRow(): int
    {
        return 2;
    }
}
