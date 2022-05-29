<?php

namespace App\Models;

use App\Observers\GuestShortenLinkObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestShortenLink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'destination_url',
        'url_key',
        'clicks'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function scopeGetTotalClicks(Builder $query  , string $urlKey)
    {
        return $query->where('url_key' ,  $urlKey)->select('clicks')->first()->clicks ?? 0;
    }


    protected static function boot()
    {
        parent::boot();
        GuestShortenLink::observe(GuestShortenLinkObserver::class);
    }
}
