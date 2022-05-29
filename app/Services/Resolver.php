<?php

namespace App\Services;

use App\Models\GuestShortenLink;
use App\Models\ShortUrl;
use App\Models\ShortUrlVisit;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class Resolver
{

    /**
     * @var Agent
     */
    private Agent $agent;

    /**
     * @param Agent|null $agent
     */
    public function __construct(Agent $agent = null)
    {
        $this->agent = $agent ?? new Agent();
    }

    /**
     * @param Request $request
     * @param ShortUrl $shortUrl
     * @return bool
     */
    public function handleVisit(Request $request , ShortUrl|GuestShortenLink $shortUrl , string $source = null) : bool
    {

        if($source === (string) GuestShortenLink::class) {
             return GuestShortenLink::where('url_key' , $shortUrl->url_key)->increment('clicks');
        }

        if (! $this->shouldAllowAccess($shortUrl)) {
            abort(404);
        }
        $visit = $this->recordVisit($request, $shortUrl);

        return true;
    }

    /**
     * @param ShortUrl $shortUrl
     * @return bool
     */
    private function shouldAllowAccess(ShortUrl $shortUrl) : bool
    {
        if ($shortUrl->single_use && $shortUrl->visits()->count()) {

            return false;
        }

        if (now()->isBefore($shortUrl->activated_at)) {

            return false;
        }

        if ($shortUrl->deactivated_at && now()->isAfter($shortUrl->deactivated_at)) {

            return false;
        }


        return true;
    }

    /**
     * @param Request $request
     * @param ShortUrl $shortUrl
     * @return ShortUrlVisit
     */
    private function recordVisit(Request $request , ShortUrl $shortUrl) : ShortUrlVisit
    {
        $visit = new ShortURLVisit();

        $visit->user_id = $shortUrl->user_id;
        $visit->short_url_id = $shortUrl->id;
        $visit->visited_at = now();


        if ($shortUrl->track_visits) {
            $this->trackVisit($shortUrl, $visit, $request);
        }

        $visit->save();

        return $visit;
    }

    /**
     * @param ShortUrl $shortUrl
     * @param ShortUrlVisit $shortUrlVisit
     * @param Request $request
     */
    private function trackVisit(ShortUrl $shortUrl , ShortUrlVisit $shortUrlVisit , Request $request) : void
    {

        if ($shortUrl->track_ip_address) {
            $shortUrlVisit->ip_address = $request->ip();
            $shortUrlVisit->country = Location::get($request->ip())->countryName ?? 'N/A';
        }

        if ($shortUrl->track_operating_system) {
            $shortUrlVisit->operating_system = $this->agent->platform();
        }

        if ($shortUrl->track_operating_system_version) {
            $shortUrlVisit->operating_system_version = $this->agent->version($this->agent->platform());
        }

        if ($shortUrl->track_browser) {
            $shortUrlVisit->browser = $this->agent->browser();
        }

        if ($shortUrl->track_browser_version) {
            $shortUrlVisit->browser_version = $this->agent->version($this->agent->browser());
        }

        if ($shortUrl->track_referer_url) {
            $shortUrlVisit->referer_url = $request->headers->get('referer');
        }

        if ($shortUrl->track_device_type) {
            $shortUrlVisit->device_type = $this->guessDeviceType();
        }


    }

    /**
     * @return string
     */
    protected function guessDeviceType(): string
    {

        if ($this->agent->isDesktop()) {
            return ShortURLVisit::DEVICE_TYPE_DESKTOP;
        }

        if ($this->agent->isMobile()) {
            return ShortURLVisit::DEVICE_TYPE_MOBILE;
        }

        if ($this->agent->isTablet()) {
            return ShortURLVisit::DEVICE_TYPE_TABLET;
        }

        if ($this->agent->isRobot()) {
            return ShortURLVisit::DEVICE_TYPE_ROBOT;
        }

        return '';
    }

}
