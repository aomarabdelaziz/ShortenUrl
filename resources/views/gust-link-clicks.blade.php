@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <header>
                    <div id="top">
                        <div id="logo"><a href="{{ route('main') }}" class="logo">Short URL</a></div>
                    </div>
                </header>
                <main>
                    <section id="content">
                        <h1>Total URL Clicks</h1>
                        <p>The total number of clicks that your link has received so far.</p>
                        <div class="squarebox"><b>{{ $clicks }}</b></div>
                        <p>Our tool will count each click as one hit to the long URL, even if there are multiple clicks from the same person or device. Check <a href="{{ route('url-counter') }}">the total number of clicks</a> from other URL.<br>
                        </p><p><a href="{{ route('main') }}" class="colorbutton">Create other shortened URL</a></p>
                    </section>
                </main>

            </div>
        </div>
    </div>
@endsection
