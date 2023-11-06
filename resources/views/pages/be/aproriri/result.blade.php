@extends('layouts.be')

@section('title', 'Hasil Aproriri')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Hasil Aporiri</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Transaksi</a></div>
            </div>
        </div>

        <a href="{{ route('exportItemset1') }}" class="btn btn-sm btn-primary my-4">Export Itemset 1</a>
        <a href="{{ route('exportElminasiItemset1', $inputSupport) }}" class="btn btn-sm btn-primary my-4">Export Eliminasi
            Itemset 1</a>
        <a href="{{ route('export-itemset-2') }}" class="btn btn-sm btn-primary my-4">Export Itemset 2</a>
        <a href="{{ route('exportElminasiItemset2', $inputSupport) }}" class="btn btn-sm btn-primary my-4">Export Eliminasi
            Itemset 2</a>
        <a href="{{ route('export-itemset-3') }}" class="btn btn-sm btn-primary my-4">Export Itemset 3</a>
        <a href="{{ route('export-itemset-4') }}" class="btn btn-sm btn-primary my-4">Export Itemset 4</a>


        <div class="row">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        Minimum Suport : {{ $inputSupport }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        Minimum Confidence : {{ $minimumConfidence }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header">
                Itemset 1
            </div>
            <div class="card-body">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Frekuensi</th>
                            <th>Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nonitemSets[1] as $key_nonitemSets => $data_nonitemSets)
                            <tr>
                                <td>{{ $key_nonitemSets }}</td>
                                <td>{{ $data_nonitemSets['frequency'] }}</td>
                                <td>{{ $data_nonitemSets['support'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header">
                Itemset 1, Hasil eliminasi sesuai batas support
            </div>
            <div class="card-body">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Frekuensi</th>
                            <th>Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemSets[1] as $itemset => $data)
                            <tr>
                                <td>{{ $itemset }}</td>
                                <td>{{ $data['frequency'] }}</td>
                                <td>{{ $data['support'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header">
                Itemset 2
            </div>
            <div class="card-body">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Frekuensi</th>
                            <th>Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nonitemSets[2] as $key_nonitemSets2 => $data_nonitemSets2)
                            <tr>
                                <td>{{ $key_nonitemSets2 }}</td>
                                <td>{{ $data_nonitemSets2['frequency'] }}</td>
                                <td>{{ $data_nonitemSets2['support'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header">
                Itemset 2, Hasil eliminasi sesuai batas support
            </div>
            <div class="card-body">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Frekuensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemSets[2] as $itemset => $data)
                            <tr>
                                <td>{{ $itemset }}</td>
                                <td>{{ $data['frequency'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header">
                Itemset 3
            </div>
            <div class="card-body">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Frekuensi</th>
                            <th>Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nonitemSets[3] as $key_nonitemSets3 => $data_nonitemSets3)
                            <tr>
                                <td>{{ $key_nonitemSets3 }}</td>
                                <td>{{ $data_nonitemSets3['frequency'] }}</td>
                                <td>{{ $data_nonitemSets3['support'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header">
                Itemset 3, Hasil eliminasi sesuai batas support
            </div>
            <div class="card-body">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Frekuensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemSets[3] as $itemset => $data)
                            <tr>
                                <td>{{ $itemset }}</td>
                                <td>{{ $data['frequency'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header">
                Itemset 4, Hasil eliminasi sesuai batas support
            </div>
            <div class="card-body">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Frekuensi</th>
                            <th>Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nonitemSets[4] as $key_nonitemSets4 => $data_nonitemSets4)
                            <tr>
                                <td>{{ $key_nonitemSets4 }}</td>
                                <td>{{ $data_nonitemSets4['frequency'] }}</td>
                                <td>{{ $data_nonitemSets4['support'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header">
                Itemset 4, Hasil eliminasi sesuai batas support
            </div>
            <div class="card-body">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Frekuensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemSets[4] as $itemset => $data)
                            <tr>
                                <td>{{ $itemset }}</td>
                                <td>{{ $data['frequency'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="card shadow">
            <div class="card-header">
                Hasil Assocation Rule Tanpa Filter Minimum Confident
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>If Buy</th>
                            <th>Then Buy</th>
                            <th>Confidence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unfilteredAssociationRules as $rule)
                            <tr>
                                <td>{{ $rule['if_buy'] }}</td>
                                <td>{{ $rule['then_buy'] }}</td>
                                <td>{{ $rule['confidence'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header">
                Hasil Assocation Rule Filter Sesuai Minimum Confident
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>If Buy</th>
                            <th>Then Buy</th>
                            <th>Confidence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($associationRules as $rule)
                            <tr>
                                <td>{{ $rule['if_buy'] }}</td>
                                <td>{{ $rule['then_buy'] }}</td>
                                <td>{{ $rule['confidence'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>


@endsection
