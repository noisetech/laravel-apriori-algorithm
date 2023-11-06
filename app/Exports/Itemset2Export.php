<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class Itemset2Export implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $nonitemSets2;

    public function __construct($nonitemSets)
    {
        $this->nonitemSets2 = $nonitemSets;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->nonitemSets2 as $item => $itemData) {
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
