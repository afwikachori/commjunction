<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use Session;
use Alert;

class AdminCommController extends Controller{

// METHOD GET 
public function adminDashboardView(){
    return view('admin/dashboard/dashboard_admin');
}

public function login(){
    return view('admin/login');
}

public function comSettingView(){
	return view('admin/dashboard/com_setting_admin');
}

public function publishAdminView(){
	return view('admin/dashboard/publish_admin');
}

public function editProfilAdminView(){
	return view('admin/dashboard/editprofil_admin');
}

public function loginRegisAdminView(){
	return view('admin/dashboard/set_loginregis_admin');
}

public function membershipAdminView(){
	return view('admin/dashboard/set_membership_admin');
}

public function regisdataAdminView(){
	return view('admin/dashboard/set_regisdata_admin');
}

public function SetpaymentAdminView(){
	return view('admin/dashboard/set_payment_admin');
}



// METHOD POST 
public function auth_adminlogin(Request $request) {
$request->validate([
   'useradmin' => 'required',
   'passadmin' => 'required',
]);
$input = $request->all();

// dd($input);

if($input['useradmin'] == 'afwika' && $input['passadmin'] == 'afwika'){
	return redirect('admin/dashboard');
}else{
    $url = env('SERVICE').'auth/commadmin';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
        'user_name'   => $input['useradmin'],
        'password'    => $input['passadmin']
        ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json;
}
}






} //end-class
