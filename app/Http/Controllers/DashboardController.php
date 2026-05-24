<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordenes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DashboardExport;
use App\Models\ConversionGoogleAds;

class DashboardController extends BasicController
{
  public $model = ConversionGoogleAds::class;
  public $reactView = 'Admin/Dashboard';
  public $prefix4filter = 'conversion_google_ads';

  public function setPaginationInstance(string $model)
  {

    // return $model::where("status", "=", true)->where('parent_id', '=', null)->
    return $model::select([
      'conversion_google_ads.*',
    ]);
  }
}
