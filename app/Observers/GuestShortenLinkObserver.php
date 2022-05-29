<?php

namespace App\Observers;

use App\Models\AllShortenLinks;
use App\Models\GuestShortenLink;

class GuestShortenLinkObserver
{
    /**
     * @param GuestShortenLink $builder
     */
    public function created(GuestShortenLink $builder)
    {

        AllShortenLinks::create(
            [
                'url_key' => $builder->url_key,
                'source'  => get_class($builder),
            ]);
    }


}
