<?php

namespace App\Http\Controllers;

use App\Models\AllShortenLinks;
use App\Models\GuestShortenLink;
use App\Services\Resolver;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortUrlController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request , Resolver $resolver , string $shortUrlKey)
    {

        $source = AllShortenLinks::where('url_key' ,$shortUrlKey )->select('source')->first()->source;

        $shortURL =  $source === (string) ShortUrl::class ? ShortUrl::where('url_key', $shortUrlKey)->firstOrFail() : GuestShortenLink::where('url_key', $shortUrlKey)->firstOrFail();
        $resolver->handleVisit(request() , $shortURL , $source);
        return redirect($shortURL->destination_url , 302);


    }
}
