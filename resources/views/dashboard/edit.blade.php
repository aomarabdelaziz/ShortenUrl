@extends('layouts.main')
@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
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
        <div class="col-lg-6 col-6">

            <div class="card">


                <div class="card-header">
                    <h3 class="card-title">Create ShortenLink</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>



                </div>

                <form method="post" action="{{route('dashboard.update' , $urlKey)}} ">
                    @csrf
                    @method('PUT')
                    <div class="card-body">



                        <div class="form-group">
                            <label for="exampleInputPassword1">LONG URl</label>
                            <input type="text" class="form-control " name="long_url" value="{{ old('destination_url' , $urlKey->destination_url) }}" >
                            @error('long_url')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message  }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Single Use</label>

                                    <br>
                                    <input type="checkbox" name="single_use" {{ ($urlKey->single_use === true ? 'checked' : '') }}  data-toggle="toggle">
                                </div>
                                <div class="form-group">
                                    <label>Track Visits</label>
                                    <br>
                                    <input type="checkbox" name="track_visits"  {{ ($urlKey->track_visits === true ? 'checked' : '') }} data-toggle="toggle">
                                </div>
                                <div class="form-group">
                                    <label>Track Ip Address</label>
                                    <br>
                                    <input type="checkbox" name="track_ip_address" {{ ($urlKey->track_ip_address === true ? 'checked' : '') }} data-toggle="toggle">
                                </div>
                                <div class="form-group">
                                    <label>Track Operating System</label>
                                    <br>
                                    <input type="checkbox" name="track_operating_system" {{ ($urlKey->track_operating_system === true ? 'checked' : '') }} data-toggle="toggle">
                                </div>
                                <div class="form-group">
                                    <label>Track Device Type</label>
                                    <br>
                                    <input type="checkbox" name="track_device_type" {{ ($urlKey->track_device_type === true ? 'checked' : '') }} data-toggle="toggle">
                                </div>
                                <div class="form-group">
                                    <label>ShortenLink Deactivated Date</label>

                                    <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
                                        <input type="text" name="deactivated_at" value="{{ $urlKey->deactivated_at }}" class="form-control datetimepicker-input" data-target="#datetimepicker8"/>
                                        <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Track Operating System Version</label>
                                    <br>
                                    <input type="checkbox" name="track_operating_system_version" {{ ($urlKey->track_operating_system_version === true ? 'checked' : '') }} data-toggle="toggle">
                                </div>
                                <div class="form-group">
                                    <label>Track Browser</label>
                                    <br>
                                    <input type="checkbox" name="track_browser" {{ ($urlKey->track_browser === true ? 'checked' : '') }} data-toggle="toggle">
                                </div>
                                <div class="form-group">
                                    <label>Track Browser Version</label>
                                    <br>
                                    <input type="checkbox" name="track_browser_version" {{ ($urlKey->track_browser_version === true ? 'checked' : '') }} data-toggle="toggle">
                                </div>
                                <div class="form-group">
                                    <label>Track Referer Url</label>
                                    <br>
                                    <input type="checkbox" name="track_referer_url" {{ ($urlKey->track_referer_url === true ? 'checked' : '') }} data-toggle="toggle">
                                </div>


                                <div class="form-group">
                                    <label>ShortenLink Activated Date</label>
                                    <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                                        <input type="text" name="activated_at" value="{{ $urlKey->activated_at }}" class="form-control datetimepicker-input" data-target="#datetimepicker7"/>
                                        <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>










                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </form>






            </div>

        </div>

    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script type="text/javascript">
        $(function () {
            $('#datetimepicker7').datetimepicker();
            $('#datetimepicker8').datetimepicker({
                useCurrent: false
            });
            $("#datetimepicker7").on("change.datetimepicker", function (e) {
                $('#datetimepicker8').datetimepicker('minDate', e.date);
                console.log('ss');
            });
            $("#datetimepicker8").on("change.datetimepicker", function (e) {
                $('#datetimepicker7').datetimepicker('maxDate', e.date);
            });
        });
    </script>
@endpush
