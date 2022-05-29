@extends('layouts.main')
@push('css')
    <link rel="stylesheet" href="{{ asset('dist/css/datatables.css') }}">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    @foreach($data as $d)
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">SHORT URLS CREATED</span>
                        <span class="info-box-number">
                      {{ $d->short_url->count() }}
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">TOTAL VISTORS</span>
                        <span class="info-box-number">   {{ $d->visits->count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">TOP REFERER URL</span>
                        <span class="info-box-number"> {{ $totalReferers }}</span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">TOP COUNTRY</span>
                        <span class="info-box-number">{{ $countryName }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

            </div>
            <!-- /.col -->

        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong >Holy guacamole!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            {!! $dataTable->table(['class' => 'table table-hover table-bordered table-striped w-100'], true) !!}

        </div>


        </div>
    @endforeach
@endsection

@push('js')
    <script src="{{ asset('dist/js/datatables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <script defer="defer">


        $('#test-table').on('click', '.btn-delete[data-remote]', function (e) {

            var url = $(this).data('remote');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed)
                {
                    $.ajax(
                        {
                            url: url,
                            type: 'delete', // replaced from put
                            dataType: "JSON",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (response)
                            {
                                var td = e.target.parentNode;
                                var tr = td.parentNode; // the row to be removed
                                tr.parentNode.removeChild(tr);
                                Swal.fire(
                                    'Deleted!',
                                    'Your url link has been deleted.',
                                    'success'
                                )
                                document.querySelector('.dt-buttons .buttons-reload').click()
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText); // this line will save you tons of hours while debugging
                                // do something here because of error
                            }
                        });


                }
            })
        });




    </script>

    {!! $dataTable->scripts() !!}
@endpush
