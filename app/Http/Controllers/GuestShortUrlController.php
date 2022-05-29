<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestShortenUrlRequest;
use App\Models\GuestShortenLink;
use App\Models\ShortUrl;
use App\Services\KeyGenerator;
use App\Services\ShortUrlBuilder;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestShortUrlController extends Controller
{
    public function index(GuestShortenUrlRequest $request)
    {


        $request->validate([
            'destination_url' => 'string|url'
        ]);

        $key = $this->getUniqueUrlKey();            

        GuestShortenLink::create(
            [
                'destination_url' => $request->destination_url,
                'url_key' => $key
            ]);

        return view('shortener',
            [
                'shortUrl' => env('APP_URL') . 'short/' . $key,
                'longUrl' =>  $request->destination_url,
                'shortKey' => $key
            ]);

    }

    private function getUniqueUrlKey(): string
    {
        return (new KeyGenerator())->generateRandom();
    }
}
