@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


                <header class="text-center">
                    <div id="logo"><a href="{{ route('main') }}" class="logo">Short URL</a></div>
                </header>
                <section id="urlbox">

                    <h1>Paste the URL to be shortened</h1>
                    @error('destination_url')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror


                    <form action="{{ route('guest_shorturl') }}" method="post">

                        @csrf
                        <div id="formurl">

                            <input type="text" name="destination_url" placeholder="Enter the link here">
                            <div id="formbutton">
                                <input type="submit" value="Shorten URL">
                            </div>
                        </div>
                    </form>
                    <p class="boxtextcenter">ShortURL.at is a free tool to shorten a URL or reduce a link<br>Use our URL Shortener to create a shortened link making it easy to remember</p>
                </section>
                <section id="emailbox">
                    <h2>Want More? Try Premium Features!</h2>
                    <p class="boxtextcenter" style="margin: 0 auto 20px auto;">Custom short links, powerful dashboard, detailed analytics, API, UTM builder, QR codes, browser extension, 50+ app integrations and support. Only $9/month.</p>
                    <a href="{{ route('dashboard.index') }}" class="colorbutton">Go Premium</a>
                    <p class="boxtextcenter"><span class="textsmall aligncenter"><a href="{{ route('register') }}" class="textsmall">Sign up free at <img src="https://www.shorturl.at/img/rebrandly-logo.svg" width="80" alt="URL Shortener"></a></span></p>
                </section>
                <section id="content">
                    <h2>Simple and fast URL shortener!</h2>
                    <p>ShortURL allows to reduce long links from <a href="https://www.instagram.com/" target="_blank">Instagram</a>, <a href="https://www.facebook.com/" target="_blank">Facebook</a>, <a href="https://www.youtube.com/" target="_blank">YouTube</a>, <a href="https://www.twitter.com/" target="_blank">Twitter</a>, <a href="https://www.linkedin.com/" target="_blank">Linked In</a> and top sites on the Internet, just paste the long URL and click the Shorten URL button. On the next screen, copy the shortened URL and share it on websites, chat and e-mail. After shortening the URL, check <a href="url-click-counter.php">how many clicks it received</a>.</p>
                    <h2>Shorten, share and track</h2>
                    <p>Your shortened URLs can be used in publications, documents, advertisements, blogs, forums, instant messages, and other locations. Track statistics for your business and projects by monitoring the number of hits from your URL with the click counter, you do not have to register.</p>
                </section>
            <div id="box">
                <div id="row">
                    <div id="column">
                        <div class="icon"><img src="https://www.shorturl.at/img/icon-like.png"></div>
                        <h3 class="aligncenter">Easy</h3>
                        <p class="aligncenter">ShortURL is easy and fast, enter the long link to get your shortened link</p>
                    </div>
                    <div id="column">
                        <div class="icon"><img src="https://www.shorturl.at/img/icon-url.png"></div>
                        <h3 class="aligncenter">Shortened</h3>
                        <p class="aligncenter">Use any link, no matter what size, ShortURL always shortens</p>
                    </div>
                    <div id="column">
                        <div class="icon"><img src="https://www.shorturl.at/img/icon-secure.png"></div>
                        <h3 class="aligncenter">Secure</h3>
                        <p class="aligncenter">It is fast and secure, our service have HTTPS protocol and data encryption</p>
                    </div>
                    <div id="column">
                        <div class="icon"><img src="https://www.shorturl.at/img/icon-statistics.png"></div>
                        <h3 class="aligncenter">Statistics</h3>
                        <p class="aligncenter">Check the amount of clicks that your shortened url received</p>
                    </div>
                    <div id="column">
                        <div class="icon"><img src="https://www.shorturl.at/img/icon-unique.png"></div>
                        <h3 class="aligncenter">Reliable</h3>
                        <p class="aligncenter">All links that try to disseminate spam, viruses and malware are deleted</p>
                    </div>
                    <div id="column">
                        <div class="icon"><img src="https://www.shorturl.at/img/icon-responsive.png"></div>
                        <h3 class="aligncenter">Devices</h3>
                        <p class="aligncenter">Compatible with smartphones, tablets and desktop</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
