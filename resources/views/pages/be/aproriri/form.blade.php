@extends('layouts.be')

@section('title', 'Transaksi')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Transaksi</a></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('aporiri.proses') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">Min Support:</label>
                                <input type="text" name="support" class="form-control" placeholder="Masukan min support">
                            </div>

                            <div class="form-group">
                                <label for="">Min Cofidence:</label>
                                <input type="text" name="confidence" class="form-control"
                                    placeholder="Masukan min support">
                            </div>

                            <button class="btn btn-sm btn-primary" type="submit">
                                Proses
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
