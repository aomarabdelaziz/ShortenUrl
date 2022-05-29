@extends('layouts.main')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard v2</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="col-lg-12 col-12">

            <div class="card">


                <div class="card-header">
                    <h3 class="card-title">ShortUrl Statistics</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>



                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">LONG URl</label>
                        <input type="text" class="form-control " name="sql_host" value="{{ $longUrl }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">URL KEY</label>
                        <input type="text" class="form-control " name="sql_host" value="{{ $urlKey }}" disabled>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="chart-div"></div>
                            <?= \Lava::render('GeoChart', 'TOPCOUNTRIES','chart-div'); ?>

                        </div>
                        <div class="col-md-6">
                            <div id="chart-div2" ></div>
                            <?= \Lava::render('PieChart', 'TOPREFERERS','chart-div2'); ?>
                        </div>
                        <div class="offset-lg-4">
                            <div class="col-md-12">
                                <div id="chart-div3" ></div>
                                <?= \Lava::render('PieChart', 'TOPBROWSERS','chart-div3'); ?>
                            </div>
                        </div>
                    </div>




                </div>







            </div>

        </div>

    </div>


@endsection
