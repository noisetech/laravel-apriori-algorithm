<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class EliminasiItemset2Export implements FromCollection
{
    protected $itemset2;

    public function __construct($itemset2)
    {
        $this->itemset2 = $itemset2;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->itemset2 as $item => $itemData) {
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
