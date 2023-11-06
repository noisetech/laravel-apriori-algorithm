<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class Itemset1Export implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $nonitemSets;

    public function __construct($nonitemSets)
    {
        $this->nonitemSets = $nonitemSets;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->nonitemSets as $item => $itemData) {
            $data[] = [
                'Item' => $item,
                'Frequency' => $itemData['frequency'],
                'Support' => $itemData['support'],
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Item',
            'Frequency',
            'Support',
        ];
    }
}
