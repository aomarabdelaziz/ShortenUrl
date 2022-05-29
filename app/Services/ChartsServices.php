<?php

namespace App\Services;

use App\Models\ShortUrl;
use App\Models\ShortUrlVisit;

class ChartsServices
{
    private static ?int $total = 0;
    /**
     * @param string $urlKey
     */
    private static function generateTopCountriesGeoChart(string $urlKey) : void
    {
        $shortUrlId = ShortUrl::where('url_key' , $urlKey)->select('id')->first()->id;
        $topCountries = ShortUrlVisit::GetTopCountries(limit:3, shortUrlId: $shortUrlId);

        $datatable = \Lava::DataTable();

        $datatable->addStringColumn('TopCountries')->addNumberColumn('Percent');

        foreach($topCountries as $index => $country)
        {
            $count =ShortUrlVisit::where('country' , $topCountries[$index])->count();
            $datatable->addRow([$topCountries[$index] , $count]);

        }

        \Lava::GeoChart('TOPCOUNTRIES', $datatable, [
            'title'  => 'Top Countries',
            'is3D'   => true,
            'elementId' => 'chart-div1',
            'width' => 800,
            'height' => 400

        ]);
    }

    /**
     * @param string $urlKey
     */
    private static function generateTopReferersPieChart(string $urlKey) : void
    {
        self::$total = 0;
        $shortUrlId = ShortUrl::where('url_key' , $urlKey)->select('id')->first()->id;

        $topReferers = ShortUrlVisit::GetTopReferers(limit:3, shortUrlId: $shortUrlId);

        $datatable = \Lava::DataTable();

        $datatable->addStringColumn('TopReferers')->addNumberColumn('Percent');

        foreach($topReferers as $index => $referer)
        {
            $count =ShortUrlVisit::where('short_url_id' , $shortUrlId)->where('referer_url' , $topReferers[$index])->count();
            $datatable->addRow([$topReferers[$index] , $count]);
            self::$total += $count;

        }

        $totalCount = ShortUrlVisit::where('short_url_id' , $shortUrlId)->count();


        if($totalCount > 1) {
            $datatable->addRow(['Others' ,  $totalCount - self::$total ]);
        }
        \Lava::PieChart('TOPREFERERS', $datatable, [
            'title'  => 'Top Referers',
            'is3D'   => true,
            'elementId' => 'chart-div2',
            'width' => 800,
            'height' => 400

        ]);
    }

    /**
     * @param string $urlKey
     */
    private static function generateTopBrowsersPieChart(string $urlKey) : void
    {
        self::$total = 0;
        $shortUrlId = ShortUrl::where('url_key' , $urlKey)->select('id')->first()->id;

        $topBrowsers = ShortUrlVisit::GetTopBrowsers(limit:3, shortUrlId: $shortUrlId);

        $datatable = \Lava::DataTable();

        $datatable->addStringColumn('TopBrowsers')->addNumberColumn('Percent');

        foreach($topBrowsers as $index => $browser)
        {
            $count =ShortUrlVisit::where('short_url_id' , $shortUrlId)->where('browser' , $topBrowsers[$index])->count();
            $datatable->addRow([$topBrowsers[$index] , $count]);
            self::$total += $count;

        }

        $totalCount = ShortUrlVisit::where('short_url_id' , $shortUrlId)->count();

        if($totalCount > 1) {
            $datatable->addRow(['Others' ,  $totalCount - self::$total  ]);
        }
        \Lava::PieChart('TOPBROWSERS', $datatable, [
            'title'  => 'Top Browsers',
            'is3D'   => true,
            'elementId' => 'chart-div3',
            'width' => 800,
            'height' => 400

        ]);
    }

    public static function generateCharts(string $urlKey)
    {
        self::generateTopCountriesGeoChart($urlKey);
        self::generateTopReferersPieChart($urlKey);
        self::generateTopBrowsersPieChart($urlKey);
    }

}
