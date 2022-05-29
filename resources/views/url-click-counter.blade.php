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
                        <h1>URL Click Counter</h1>
                        <p>Enter the URL to find out how many clicks it has received so far.</p>
                    </section>
                    <section id="urlbox">
                        <br><br>
                        <form action="{{ route('total-clicks') }}" method="get">
                            <div id="formurl">
                                <input type="text" name="url_short" placeholder="Enter here your shortened URL">
                                <div id="formbutton">
                                    <input type="submit" value="Track Clicks">
                                </div>
                            </div>
                        </form>
                        <p style="padding: 0 50px;">Example: shorturl.at/AbCdE</p>
                    </section>
                    <section id="content">
                        <p>* Track the total hits of the shortened URL in real time, you do not have to register.</p>
                    </section>
                </main>

            </div>
        </div>
    </div>
@endsection
