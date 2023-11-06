<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class Itemset4Export implements FromCollection
{
    protected $nonitemSets4;

    public function __construct($nonitemSets4)
    {
        $this->nonitemSets4 = $nonitemSets4;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->nonitemSets4 as $item => $itemData) {
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
