<?php

namespace App\Http\Controllers;

use App\Models\AllShortenLinks;
use App\Models\GuestShortenLink;
use App\Models\ShortUrl;
use Illuminate\Http\Request;

class GuestUrlClicks extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request , string $shortUrl = null)
    {

        $request->validate(
            [
                'url_short' => 'sometimes|string|url'
            ]);


        $isSourceOrUrlKey =  $request->whenFilled('url_short' , function ($input)  {
             return true;
        } , function ()
        {
           return false;
        });



       if($isSourceOrUrlKey)
       {
            $shortUrl ??= @end((explode("/" , $request->url_short)));
       }

        $source = AllShortenLinks::where('url_key' , $shortUrl)->select('source')->first()->source ?? '';
        if( $source === (string) GuestShortenLink::class && !is_null($source))
        {
            $clicks = GuestShortenLink::GetTotalClicks($shortUrl);
            return view('gust-link-clicks' , compact('clicks'));
        }

        return redirect()->route('main');
    }
}
