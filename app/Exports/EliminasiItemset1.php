<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class EliminasiItemset1 implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $itemset1;

    public function __construct($itemset1)
    {
        $this->itemset1 = $itemset1;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->itemset1 as $item => $itemData) {
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
