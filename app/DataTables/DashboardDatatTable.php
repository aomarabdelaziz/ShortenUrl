<?php

namespace App\DataTables;

use App\Models\ShortUrl;
use App\Models\ShortUrlVisit;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DashboardDatatTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('destination_url' , function (ShortUrl $data) {

                return "<a href='$data->destination_url'  target='_blank'>$data->destination_url</a>";
            })
            ->addColumn('url_key' , function ($data) {

                return $this->getUrlKey($data);

            })
            ->addColumn('total_visits' , function (ShortUrl $data) {

              return $this->getTotalVisits($data);

            })
            ->addColumn('actions', function(ShortUrl $data){

              return $this->getActionColumns($data);

            })
            ->rawColumns(['actions' ,'destination_url' ,'url_key']);




    }

    /**
     * @param ShortUrl $data
     * @return string
     */
    public function getUrlKey(ShortUrl $data) : string
    {
        $shortUrl = env("APP_URL") . 'short/' . $data->url_key;
        return "<a href=' $shortUrl'  target='_blank'> $shortUrl</a>";
    }

    /**
     * @param ShortUrl $data
     * @return int
     */
    public function getTotalVisits(ShortUrl $data) : int
    {
        $id = ShortUrl::where('url_key' , $data->url_key)->select('id')->first()->id;
        return  ShortUrlVisit::where('short_url_id' , $id)->count();
    }

    /**
     * @param ShortUrl $data
     * @return string
     */
    public function getActionColumns(ShortUrl $data) : string
    {
        $viewRoute = route('dashboard.show' , $data->url_key);
        $editRoute = route('dashboard.edit' , $data->url_key);
        $deleteRoute = route('dashboard.destroy' , $data->url_key);
        $btn =  "<a href='$viewRoute' class='view btn btn-info btn-sm mr-1'>View</a>";
        $btn = $btn .   "<a href='$editRoute' class='edit btn btn-primary btn-sm mr-1'>Edit</a>";
        $btn = $btn .  '<a href="javascript:void(0)" class="btn-delete btn btn-danger btn-sm" data-remote="' . $deleteRoute . '">Delete</button>';

        return $btn;
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {


        $query = ShortUrl::with(['user'])
            ->with('visits')
            ->get();
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('test-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            [
                'id' => 'destination_url',
                'data' => 'destination_url',
                'title' => 'Destination URL',
                'footer' => 'Destination URL',
                'searchable' => true,
                'orderable' => true,
                'exportable' => true,
                'printable' => true,
                'class' => 'text-center'
            ],

            [
                'id' => 'url_key',
                'data' => 'url_key',
                'title' => 'Short Url',
                'footer' => 'Short Url',
                'searchable' => true,
                'orderable' => true,
                'exportable' => true,
                'printable' => true,
                'width' => '180',
                'class' => 'text-center'
            ],


            [
                'id' => 'total_visits',
                'data' => 'total_visits',
                'title' => 'Total Visits',
                'footer' => 'Total Visits',
                'searchable' => true,
                'orderable' => true,
                'exportable' => true,
                'printable' => true,
                'width' => '80',
                'class' => 'text-center'
            ],
            [
                'id' => 'actions',
                'data' => 'actions',
                'title' => 'Actions',
                'footer' => 'Actions',
                'searchable' => false,
                'orderable' => false,
                'exportable' => false,
                'printable' => false,
                'class' => 'text-center',
                'width' => '200'
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Test_' . date('YmdHis');
    }
}
