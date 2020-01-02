<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use Session;
use Alert;

class AdminCommController extends Controller{

public function adminDashboardView(){
    return view('admin/dashboard/dashboard_admin');
}


}
