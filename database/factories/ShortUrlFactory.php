<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShortUrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'user_id' => auth()->user()->id,
            'destination_url' => 'https://soundcloud.com/discover',
            'url_key' =>  'MVwne',
            'single_use'  =>  '0',
            'track_visits' =>  '1',
            'track_ip_address' =>  '1',
            'track_operating_system' =>  '1',
            'track_operating_system_version' =>  '1',
            'track_browser' =>  '1',
            'track_browser_version' =>  '1',
            'track_referer_url' =>  '1',
            'track_device_type' =>  '1',
            'activated_at' =>  now(),
            'deactivated_at' =>  null,

        ];
    }
}
