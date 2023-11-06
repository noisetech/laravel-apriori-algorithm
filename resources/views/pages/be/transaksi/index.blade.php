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
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="#" method="POST" id="form_import" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="">File:</label>
                                <input type="file" class="form-control" name="excel">
                            </div>

                            <button class="btn btn-sm btn-primary" type="submit">
                                Proses
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Tanggal Transaksi</th>
                                        <th>Pelanggan</th>
                                        <th>Barang</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('script')
    <script>
        $('#dataTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength: 10,
            lengthMenu: [
                [10, 50, 200, -1],
                [10, 50, 200, "50"]
            ],

            order: [],
            ajax: {
                url: "{{ route('transaksi.data') }}",
            },
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal'
                }, {
                    data: 'pelanggan',
                    name: 'pelanggan'
                },
                {
                    data: 'item',
                    name: 'item'
                },
            ]
        });


        $(document).ready(function() {
            $("#form_import").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);

                $.ajax({
                    url: '{{ route('transaksi.import') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },

                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: data.status,
                                text: data.message,
                                title: data.title,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.reload();
                                $('#dataTable').DataTable().ajax.reload();
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
