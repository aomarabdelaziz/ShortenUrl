<?php

namespace App\Models;

use App\Observers\ShortUrlObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 *
 */
class ShortUrl extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    //protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'destination_url',
        'url_key',
        'single_use',
        'track_visits',
        'track_ip_address',
        'track_operating_system',
        'track_operating_system_version',
        'track_browser',
        'track_browser_version',
        'track_referer_url',
        'track_device_type',
        'activated_at',
        'deactivated_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'activated_at',
        'deactivated_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'single_use' => 'boolean',
        'track_visits' => 'boolean',
        'track_ip_address' => 'boolean',
        'track_operating_system' => 'boolean',
        'track_operating_system_version' => 'boolean',
        'track_browser' => 'boolean',
        'track_browser_version' => 'boolean',
        'track_referer_url' => 'boolean',
        'track_device_type' => 'boolean',

    ];

    /**
     * @param $value
     * @return string
     */
    public function getActivatedAtAttribute($value)
    {
       if(!is_null($value)) {
           return  Carbon::parse($value)->format('m/d/Y g:i A');
       }

    }

    /**
     * @param $value
     * @return string
     */
    public function getDeactivatedAtAttribute($value)
    {

        if(!is_null($value)){
            return  Carbon::parse($value)->format('m/d/Y g:i A');
        }


    }


    /**
     * @param Builder $query
     * @param string $key
     * @return $this
     */
    public function scopeFindByKey(Builder $query, string $key): self
    {
        return $query->where('url_key', $key)->first();
    }

    /**
     * @param Builder $query
     * @param string $url
     * @return $this
     */
    public function scopeFindByDestinationURL(Builder $query, string $url): self
    {
        return $query->where('destination_url', $url)->get();
    }

    /**
     * @return bool
     */
    public function scopeisTrackingEnabled(): bool
    {
        return $this->track_visits;
    }

    /**
     * @return HasMany
     */
    public function visits(): HasMany
    {
        return static::hasMany(ShortUrlVisit::class, 'user_id' );
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    protected static function boot(): void
    {
        parent::boot();
        static::observe(ShortUrlObserver::class);

    }

    /**
     * @return string
     */
    public function getRouteKeyName() : string
    {
        return 'url_key';
    }



}
