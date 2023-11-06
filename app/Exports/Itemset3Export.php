<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class Itemset3Export implements FromCollection
{
    protected $nonitemSets3;

    public function __construct($nonitemSets3)
    {
        $this->nonitemSets3 = $nonitemSets3;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->nonitemSets3 as $item => $itemData) {
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
