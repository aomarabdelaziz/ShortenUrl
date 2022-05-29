@extends('layouts.app')
@section('content')
    <header>
        <div id="top">
            <div id="logo"><a href="{{ route('main') }}" class="logo">Short URL</a></div>
        </div>
    </header>
    <main>
        <section id="content">
            <h1>Your shortened URL</h1>
            <p>Copy the shortened link and share it in messages, texts, posts, websites and other locations.</p>
        </section>
        <script type="text/javascript">
            var clipboard = new Clipboard('.copy');
        </script>
        <script type="text/javascript">
            function toggle_visibility(id) {
                var e = document.getElementById(id);
                if(e.style.display == "none")
                    e.style.display = "table";
                //else
                //e.style.display = "none";
            }
        </script>
        <section id="urlbox">
            <br><br>
            <div id="formurl" style="max-width: 400px;">
                <input id="shortenurl" type="text" value="{{ $shortUrl }}" onclick="if (!window.__cfRLUnblockHandlers) return false; this.select();">
                <div id="formbutton">
                    <input type="button" data-clipboard-target="#shortenurl" class="copy" value="Copy URL" onclick="if (!window.__cfRLUnblockHandlers) return false; toggle_visibility('balloon');">
                </div>
            </div>
            <div id="formurl" style="max-width: 400px; display: block;">
                <div id="balloon" style="display: none;">URL Copied</div>
            </div>
            <p class="boxtextleft">Long URL: <a href="{{ $longUrl }}" target="_blank">{{ $longUrl }}</a><br><br>

                Track <a href="{{ route('total-clicks' , $shortKey) }}">the total of clicks</a> in real-time from your shortened URL.<br>
                Create other <a href="{{ route('main') }}">shortened URL</a>.
            </p>
        </section>
        <section id="content">
            <h2>Share URL</h2>
            <div class="socialnetworkbox">
                <p>
                    <a class="snb snbfacebook" href="#" onclick="if (!window.__cfRLUnblockHandlers) return false; window.open('https://www.facebook.com/sharer/sharer.php?u=shorturl.at/jvJW0', 'facebook', 'width=800, height=600, resizable, scrollbars=yes, status=1'); return false;">Facebook</a>
                    <a class="snb snbtwitter" href="#" onclick="if (!window.__cfRLUnblockHandlers) return false; window.open('https://twitter.com/share?url=shorturl.at/jvJW0', 'twitter', 'width=800, height=600, resizable, scrollbars=yes, status=1'); return false;">Twitter</a>
                    <a class="snb snbpinterest" href="#" onclick="if (!window.__cfRLUnblockHandlers) return false; window.open('https://pinterest.com/pin/create/link/?url=shorturl.at/jvJW0', 'pinterest', 'width=800, height=600, resizable, scrollbars=yes, status=1'); return false;">Pinterest</a>
                    <a class="snb snbtumblr" href="#" onclick="if (!window.__cfRLUnblockHandlers) return false; window.open('https://www.tumblr.com/share/link?url=shorturl.at/jvJW0', 'tumblr', 'width=800, height=600, resizable, scrollbars=yes, status=1'); return false;">Tumblr</a>
                    <a class="snb snbwhatsapp" href="whatsapp://send?text=shorturl.at/jvJW0">WhatsApp</a>
                </p>
            </div>
        </section>
    </main>
@endsection
