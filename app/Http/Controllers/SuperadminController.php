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

    public function loginSuperadmin(){
        return view('superadmin/login_superadmin');
    }

    public function registerSuperView(){
        return view('superadmin/register_superadmin');
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


} //endclas
