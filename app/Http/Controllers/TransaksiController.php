<?php

namespace App\Http\Controllers;

use App\Imports\TransaksiImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('pages.be.transaksi.index');
    }

    public function data(Request $request)
    {


        if ($request->ajax()) {
            $data = DB::table('transaksi')->select('*');

            return datatables()->of($data)
                ->toJson();
        }
    }

    public function import(Request $request)
    {
        $data =  Excel::import(new TransaksiImport, $request->file('excel'));

        return response()->json([
            'status' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data disimpan'
        ]);
    }
}
