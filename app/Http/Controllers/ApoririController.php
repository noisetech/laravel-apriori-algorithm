<?php

namespace App\Http\Controllers;

use App\Exports\ElimasiITemSet1;
use App\Exports\EliminasiItemset1;
use App\Exports\EliminasiItemset2Export;
use App\Exports\Itemset1Export;
use App\Exports\Itemset2Export;
use App\Exports\Itemset3Export;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Phpml\Association\Apriori;


class ApoririController extends Controller
{

    public function form()
    {
        return view('pages.be.aproriri.form');
    }

    public function proses_aporiri(Request $request)
    {

        $inputSupport = $request->input('support');
        $minimumConfidence = $request->input('confidence');

        $transactions = Transaksi::select('item')->get();
        $transactionTotal = Transaksi::count();

        $itemSets = [];
        $nonitemSets = [];
        $associationRules = [];
        $unfilteredAssociationRules = [];

        for ($itemsetSize = 1; $itemsetSize <= 4; $itemsetSize++) {
            $itemSets[$itemsetSize] = [];
            $nonitemSets[$itemsetSize] = [];

            foreach ($transactions as $transaction) {
                $items = explode(',', $transaction->item);
                $combinations = $this->generateCombinations($items, $itemsetSize);
                $this->countItemsetFrequency($combinations, $nonitemSets[$itemsetSize], $transactionTotal);
            }

            $itemSets[$itemsetSize] = array_filter($nonitemSets[$itemsetSize], function ($data) use ($inputSupport, $transactionTotal) {
                $data['support'] = $data['frequency'] / $transactionTotal;
                return $data['support'] >= $inputSupport;
            });

            if ($itemsetSize > 1) {
                $this->generateAssociationRules($itemSets, $itemsetSize, $minimumConfidence, $associationRules, $unfilteredAssociationRules);
            }
        }

        // dd($unfilteredAssociationRules);
        return view('pages.be.aproriri.result', compact('itemSets', 'nonitemSets', 'associationRules', 'inputSupport', 'minimumConfidence', 'unfilteredAssociationRules'));
    }


    private function generateCombinations($items, $size)
    {
        $combinations = [];
        $this->generateCombinationsRecursive($items, $combinations, $size, 0, [], 0);
        return $combinations;
    }


    private function generateCombinationsRecursive($items, &$combinations, $size, $currentIndex, $currentCombination, $start)
    {
        if (count($currentCombination) == $size) {
            $combinations[] = $currentCombination;
            return;
        }

        for ($i = $start; $i < count($items); $i++) {
            $newCombination = $currentCombination;
            $newCombination[] = $items[$i];
            $this->generateCombinationsRecursive($items, $combinations, $size, $currentIndex + 1, $newCombination, $i + 1);
        }
    }

    private function generateAssociationRules(&$itemSets, $itemsetSize, $minimumConfidence, &$associationRules, &$unfilteredAssociationRules)
    {
        for ($i = 1; $i <= $itemsetSize - 1; $i++) {
            foreach ($itemSets[$itemsetSize] as $itemset => $data) {
                $items = explode(',', $itemset);
                $combinations = $this->generateCombinations($items, $i);

                foreach ($combinations as $combination) {
                    $subset = implode(',', $combination);
                    $confidence = $data['frequency'] / $itemSets[$i][$subset]['frequency'];



                    $unfilteredAssociationRules[] = [
                        'if_buy' => $subset,
                        'then_buy' => implode(',', array_diff($items, $combination)),
                        'confidence' => $confidence,
                    ];


                    if ($confidence >= $minimumConfidence) {
                        $associationRules[] = [
                            'if_buy' => $subset,
                            'then_buy' => implode(',', array_diff($items, $combination)),
                            'confidence' => $confidence,
                        ];
                    }
                }
            }
        }

        // dd($unfilteredAssociationRules);
    }

    private function countItemsetFrequency($combinations, &$itemsetContainer, $transactionTotal)
    {
        foreach ($combinations as $combination) {
            $itemset = implode(',', $combination);
            if (!isset($itemsetContainer[$itemset])) {
                $itemsetContainer[$itemset] = [
                    'frequency' => 1,
                    'support' => 1 / $transactionTotal, // Calculate and store support
                ];
            } else {
                $itemsetContainer[$itemset]['frequency']++;
                $itemsetContainer[$itemset]['support'] = $itemsetContainer[$itemset]['frequency'] / $transactionTotal; // Update support
            }
        }
    }

    public function exportItemset1()
    {
        $transactions = Transaksi::select('item')->get();
        $transactionTotal = Transaksi::count();

        $itemSets = [];
        $nonitemSets = [];

        for ($itemsetSize = 1; $itemsetSize <= 4; $itemsetSize++) {
            $itemSets[$itemsetSize] = [];
            $nonitemSets[$itemsetSize] = [];

            foreach ($transactions as $transaction) {
                $items = explode(',', $transaction->item);
                $combinations = $this->generateCombinations($items, $itemsetSize);
                $this->countItemsetFrequency($combinations, $nonitemSets[$itemsetSize], $transactionTotal);
            }
        }

        $nonitemSets = $nonitemSets[1];

        return Excel::download(new Itemset1Export($nonitemSets), 'itemset1-fix.xlsx');
    }


    public function exportElminasiItemset1($suport)
    {
        $inputSupport = $suport;

        $transactions = Transaksi::select('item')->get();
        $transactionTotal = Transaksi::count();

        $itemSets = [];
        $nonitemSets = [];

        for ($itemsetSize = 1; $itemsetSize <= 4; $itemsetSize++) {
            $itemSets[$itemsetSize] = [];
            $nonitemSets[$itemsetSize] = [];

            foreach ($transactions as $transaction) {
                $items = explode(',', $transaction->item);
                $combinations = $this->generateCombinations($items, $itemsetSize);
                $this->countItemsetFrequency($combinations, $nonitemSets[$itemsetSize], $transactionTotal);
            }

            $itemSets[$itemsetSize] = array_filter($nonitemSets[$itemsetSize], function ($data) use ($inputSupport, $transactionTotal) {
                $data['support'] = $data['frequency'] / $transactionTotal;
                return $data['support'] >= $inputSupport;
            });
        }

        $itemSets = $itemSets[1];

        return Excel::download(new EliminasiItemset1($itemSets), 'Eliminasiitemset1-fix.xlsx');
    }


    public function exportItemset2()
    {
        $transactions = Transaksi::select('item')->get();
        $transactionTotal = Transaksi::count();

        $itemSets = [];
        $nonitemSets = [];

        for ($itemsetSize = 1; $itemsetSize <= 4; $itemsetSize++) {
            $itemSets[$itemsetSize] = [];
            $nonitemSets[$itemsetSize] = [];

            foreach ($transactions as $transaction) {
                $items = explode(',', $transaction->item);
                $combinations = $this->generateCombinations($items, $itemsetSize);
                $this->countItemsetFrequency($combinations, $nonitemSets[$itemsetSize], $transactionTotal);
            }
        }

        $nonitemSets2 = $nonitemSets[2];

        return Excel::download(new Itemset2Export($nonitemSets2), 'itemset2-fix.xlsx');
    }

    public function exportElminasiItemset2($suport)
    {
        $inputSupport = $suport;

        $transactions = Transaksi::select('item')->get();
        $transactionTotal = Transaksi::count();

        $itemSets = [];
        $nonitemSets = [];

        for ($itemsetSize = 1; $itemsetSize <= 4; $itemsetSize++) {
            $itemSets[$itemsetSize] = [];
            $nonitemSets[$itemsetSize] = [];

            foreach ($transactions as $transaction) {
                $items = explode(',', $transaction->item);
                $combinations = $this->generateCombinations($items, $itemsetSize);
                $this->countItemsetFrequency($combinations, $nonitemSets[$itemsetSize], $transactionTotal);
            }

            $itemSets[$itemsetSize] = array_filter($nonitemSets[$itemsetSize], function ($data) use ($inputSupport, $transactionTotal) {
                $data['support'] = $data['frequency'] / $transactionTotal;
                return $data['support'] >= $inputSupport;
            });
        }

        $itemSets2 = $itemSets[2];

        return Excel::download(new EliminasiItemset2Export($itemSets2), 'Eliminasiitemset2-fix.xlsx');
    }

    public function exportItemset3()
    {
        $transactions = Transaksi::select('item')->get();
        $transactionTotal = Transaksi::count();

        $itemSets = [];
        $nonitemSets = [];

        for ($itemsetSize = 1; $itemsetSize <= 4; $itemsetSize++) {
            $itemSets[$itemsetSize] = [];
            $nonitemSets[$itemsetSize] = [];

            foreach ($transactions as $transaction) {
                $items = explode(',', $transaction->item);
                $combinations = $this->generateCombinations($items, $itemsetSize);
                $this->countItemsetFrequency($combinations, $nonitemSets[$itemsetSize], $transactionTotal);
            }
        }

        $nonitemSets2 = $nonitemSets[3];

        return Excel::download(new Itemset3Export($nonitemSets2), 'itemset3-fix.xlsx');
    }

    public function exportElminasiItemset3($suport)
    {
        $inputSupport = $suport;

        $transactions = Transaksi::select('item')->get();
        $transactionTotal = Transaksi::count();

        $itemSets = [];
        $nonitemSets = [];

        for ($itemsetSize = 1; $itemsetSize <= 4; $itemsetSize++) {
            $itemSets[$itemsetSize] = [];
            $nonitemSets[$itemsetSize] = [];

            foreach ($transactions as $transaction) {
                $items = explode(',', $transaction->item);
                $combinations = $this->generateCombinations($items, $itemsetSize);
                $this->countItemsetFrequency($combinations, $nonitemSets[$itemsetSize], $transactionTotal);
            }

            $itemSets[$itemsetSize] = array_filter($nonitemSets[$itemsetSize], function ($data) use ($inputSupport, $transactionTotal) {
                $data['support'] = $data['frequency'] / $transactionTotal;
                return $data['support'] >= $inputSupport;
            });
        }

        $itemSets3 = $itemSets[3];

        return Excel::download(new EliminasiItemset2Export($itemSets3), 'Eliminasiitemset3-fix.xlsx');
    }


    public function exportItemset4()
    {
        $transactions = Transaksi::select('item')->get();
        $transactionTotal = Transaksi::count();

        $itemSets = [];
        $nonitemSets = [];

        for ($itemsetSize = 1; $itemsetSize <= 4; $itemsetSize++) {
            $itemSets[$itemsetSize] = [];
            $nonitemSets[$itemsetSize] = [];

            foreach ($transactions as $transaction) {
                $items = explode(',', $transaction->item);
                $combinations = $this->generateCombinations($items, $itemsetSize);
                $this->countItemsetFrequency($combinations, $nonitemSets[$itemsetSize], $transactionTotal);
            }
        }

        $nonitemSets4 = $nonitemSets[4];

        return Excel::download(new Itemset3Export($nonitemSets4), 'itemset4-fix.xlsx');
    }
}
