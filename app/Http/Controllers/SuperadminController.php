<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Session;
use Alert;

class SuperadminController extends Controller
{

	public function dashboarSuperView(){
	    return view('superadmin/dashboard_superadmin');
	}

    public function loginSuperadminView(){
        return view('superadmin/login_superadmin');
    }

     public function UserSuperView(){
        return view('superadmin/user_superadmin');
    }

    public function postAddUser(Request $request) {

    dd($request);
    
        $request->validate([
            'name_superadmin' => 'required|min:3',
        ]);
           return 'passing validate!';
    }


    //LOGIN SUPERADMIN
     public function loginSuperadmin(Request $request) {
        // dd($request);

        $validator = $request->validate([
            'username_superadmin'   => 'required',
            'pass_superadmin' => 'required',
        ]);

        $input = $request->all();
        $url = env('SERVICE').'auth/superadmin';

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST',$url, [
            'form_params' => [
            'user_name'   => $input['username_superadmin'],
            'password'    => $input['pass_superadmin']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        $jsonlogin = $json['data'];

        Session::put('ses_user_logged', $jsonlogin);
        $user_logged = Session::get('ses_user_logged');
        
        $user = $user_logged['user']['full_name'];
        // $user = $jsonlogin['user'];
        return redirect('superadmin/dashboard')->with('fullname',$user);
    }


    //SESSION LOGGED USER - DASHBOARD SUPERADMIN
    public function session_logged_dashboard(){
    if(Session::has('ses_user_logged')){
    $ses_loggeduser = Session::get('ses_user_logged');
    return $ses_loggeduser;
    }
    else{
        return view("/superadmin");
    }
    }


} //endclas
