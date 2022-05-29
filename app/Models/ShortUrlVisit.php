<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Location;

class ShortUrlVisit extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';


    /**
     *
     */
    const DEVICE_TYPE_MOBILE = 'mobile';

    /**
     *
     */
    const DEVICE_TYPE_DESKTOP = 'desktop';

    /**
     *
     */
    const DEVICE_TYPE_TABLET = 'tablet';

    /**
     *
     */
    const DEVICE_TYPE_ROBOT = 'robot';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'short_url_id',
        'country',
        'ip_address',
        'operating_system',
        'operating_system_version',
        'browser',
        'browser_version',
        'visited_at',
        'referer_url',
        'device_type',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'visited_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'short_url_id' => 'integer',
    ];

    /**
     * A URL visit belongs to one specific shortened URL.
*
* @return BelongsTo
*/
    public function short_url(): BelongsTo
    {
        return $this->belongsTo(ShortURL::class, 'short_url_id', 'id');
    }

    /**
     * A URL visit belongs to one specific shortened URL.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder $builder
     * @return string
     */
    public function scopeGetTopReferer(Builder $builder) : string
    {
        return $builder->with('user')
            ->select('referer_url')
            ->groupBy('referer_url')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->first()->referer_url ?? '';

    }

    /**
     * @param Builder $builder
     * @return string
     */
    public function scopeGetTopCountry(Builder $builder) : string
    {
        return $builder->with('user')
            ->select('country')
            ->groupBy('country')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->first()->country ?? 'N/A';


    }



    public function scopeGetTopCountries(Builder $builder , int $limit = 3 , int $shortUrlId = 0 ) : Collection
    {
        return $builder->with('user')
            ->select('country')
            ->groupBy('country')
            ->orderByRaw('COUNT(*) DESC')
            ->whereNotNull('country')
            ->where('short_url_id' , $shortUrlId )
            ->Where('country' , '!=' , 'N/A')
            ->limit($limit)
            ->pluck('country');


    }
    public function scopeGetTopReferers(Builder $builder , int $limit = 3 , int $shortUrlId = 0) : Collection
    {
        return $builder->with('user')
            ->select('referer_url')
            ->groupBy('referer_url')
            ->orderByRaw('COUNT(*) DESC')
            ->whereNotNull('referer_url')
            ->where('short_url_id' , $shortUrlId )
            ->limit($limit)
            ->pluck('referer_url');


    }
    public function scopeGetTopBrowsers(Builder $builder , int $limit = 3 , int $shortUrlId = 0) : Collection
    {

        return $builder->with('user')
            ->select('browser')
            ->groupBy('browser')
            ->orderByRaw('COUNT(*) DESC')
            ->whereNotNull('browser')
            ->where('short_url_id' , $shortUrlId )
            ->limit($limit)
            ->pluck('browser');



    }
}
