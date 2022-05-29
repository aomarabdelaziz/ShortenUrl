<?php

namespace App\Observers;

use App\Models\AllShortenLinks;
use App\Models\ShortUrl;


class ShortUrlObserver
{
    /**
     * @param ShortUrl $builder
     */
    public function created(ShortUrl $builder)
    {
        AllShortenLinks::create(
            [
                'url_key' => $builder->url_key,
                'source'  => get_class($builder),
            ]);
    }

    public function deleted(ShortUrl $builder)
    {
        AllShortenLinks::where('url_key' , $builder->url_key)->delete();
    }
}
