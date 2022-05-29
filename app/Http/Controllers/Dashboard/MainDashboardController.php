<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\DashboardDatatTable;
use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use App\Models\ShortUrlVisit;
use App\Models\User;
use App\Services\ChartsServices;
use App\Services\ShortUrlBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;

class MainDashboardController extends Controller
{
    /**
     * @var int|null
     */
    private ?int $total = 0;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DashboardDatatTable $dataTable)
    {

        $data = User::with(['short_url' , 'visits'])->where('id',auth()->user()->id)->get();
        $totalReferers  = ShortUrlVisit::GetTopReferer();
        $countryName  = ShortUrlVisit::GetTopCountry();
        return $dataTable->render('dashboard.index', compact('data' , 'totalReferers' , 'countryName' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
               'long_url' => ['required' , 'string' , 'url'],
               'activated_at' => ['nullable'],
               'activated_at' => ['nullable']
            ]);


        (new ShortUrlBuilder())
            ->destinationUrl($request->long_url)
            ->singleUse((bool) $request->single_use)
            ->trackVisits((bool) $request->track_visits)
            ->trackIPAddress((bool) $request->track_ip_address)
            ->trackOperatingSystem((bool) $request->track_operating_system)
            ->trackOperatingSystemVersion((bool) $request->track_operating_system_version)
            ->trackBrowser((bool) $request->track_browser)
            ->trackBrowserVersion((bool) $request->track_browser_version)
            ->trackRefererURL((bool) $request->track_referer_url)
            ->trackDeviceType((bool) $request->track_device_type)
            ->activateAt( $request->activated_at != null ? Carbon::parse($request->activated_at) : null )
            ->deactivateAt( $request->activated_at != null ? Carbon::parse($request->deactivated_at) : null)
            ->make();


        session()->flash('success', 'Shortenlink has been added');
        return redirect()->route('dashboard.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $urlKey)
    {


        $longUrl = ShortUrl::where('url_key' , $urlKey)->select('destination_url')->first()->destination_url;
        ChartsServices::generateCharts(urlKey: $urlKey);
        return view('dashboard.show' , compact('longUrl' , 'urlKey'  ));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,  ShortUrl $urlKey)
    {

        //dd($urlKey->activated_at);
        return view('dashboard.edit' , compact('urlKey'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShortUrl $urlKey)
    {
        $request->validate(
            [
                'long_url' => ['required' , 'string' , 'url'],
                'activated_at' => ['nullable'],
                'activated_at' => ['nullable']
            ]);

        $urlKey->update([

            'destination_url' => $request->long_url,
            'single_use' => (bool)$request->single_use,
            'track_visits' =>  (bool)$request->track_visits,
            'track_ip_address' =>  (bool)$request->track_ip_address,
            'track_operating_system' =>  (bool)$request->track_operating_system,
            'track_operating_system_version' =>  (bool)$request->track_operating_system_version,
            'track_browser' =>  (bool)$request->track_browser,
            'track_browser_version' =>  (bool)$request->track_browser_version,
            'track_referer_url' =>  (bool)$request->track_referer_url,
            'track_device_type' => (bool)$request->track_device_type,
            'activated_at' => $request->activated_at,
            'deactivated_at' =>  $request->deactivated_at,

        ]);

        session()->flash('success', 'Shortenlink has been added');
        return redirect()->route('dashboard.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShortUrl $urlKey)
    {



        return  $urlKey->delete();


    }
}
