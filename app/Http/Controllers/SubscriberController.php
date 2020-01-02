<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Session;
use Alert;

class SubscriberController extends Controller{
	
 public function loginView(){
	return view('subscriber/login');
}

public function registerPersonalView(){
	return view('subscriber/subs_personal');
}

public function registerCommView(){
	return view('subscriber/subs_community');
}

public function registerPaymentView(){
	return view('subscriber/subs_payment');
}


public function url_subscriber(Request $request){
    $urlname = $request['name'];

    $url = env('SERVICE').'auth/configcomm';
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
            'name' => $urlname
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);

    return $json;
}

public function registerSubs(Request $request){

	Alert::success('Your Subscriber registrasion is successfull', 'Yay !')->autoclose(3500);
	// ->persistent('Close');
	// ->autoclose(4000);

	  $validator = $request->validate([
            'fullname_subs' => 'required|min:3',
            'notlp_subs' => 'required|min:10|numeric',
            'email_subs' => 'required|email:rfc',
            'username_subs' => 'required|min:6|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/', ///angka huruf
            'password_subs' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/|required_with:password_confirm|same:passconfirm_subs',
            'passconfirm_subs' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/',
        ]);

        $input = $request->all(); // getdata form by name
        $data = [
            'full_name'  	=> $input['fullname_subs'], 
            'notelp' 	 	=> $input['notlp_subs'], 
            'email' 	 	=> $input['email_subs'], 
            'user_name' 	=> $input['username_subs'], 
            'password'      => $input['password_subs'],
            'community_id'	=> $input['community_id'],
            "sso_type"     	=> $input['sso_type'],
            "sso_token"  	=> $input['sso_token']
        ];

        // dd($data);
        
    $url = env('SERVICE').'registration/subscriber';
    $client = new \GuzzleHttp\Client();
    try {
        $response = $client->request('POST',$url, [
            'form_params' => $data
        ]);
    } catch (RequestException $exception) {
        $response = $exception->getResponse();
    }
    
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);

    Alert::success('Your Subscriber registrasion is successfull', 'Yay !');
    return view('subscriber/subs_personal');
}





} //end-class
