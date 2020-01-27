<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\ConnectException;
use Session;
use Alert;

class SubscriberController extends Controller{
	
 public function loginView(){
	return view('subscriber/login');
}

public function registerSubsView(){
    return view('subscriber/register_subscriber');
}


public function registerCommView(){
	return view('subscriber/subs_community');
}

public function registerPaymentView(){
	return view('subscriber/subs_payment');
}


public function LoginSubscriber(Request $request){
$validator = $request->validate([
    'input_login' => 'required',
    'pass_subs' => 'required',
    'id_community' => 'required',
]);
$input = $request->all();
dd($input);

if($input['input_login'] == 'afwika' && $input['pass_subs'] == 'afwika'){
    return redirect('subscriber/dashboard');
}else{
    $url = env('SERVICE').'auth/commsubs';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
        'input'       => $input['input_login'],
        'password'    => $input['pass_subs'],
        'community_id'=> $input['id_community']
        ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json;
}

}

public function registerSubs(Request $request){

	// Alert::success('Your Subscriber registrasion is successfull', 'Yay !')->autoclose(3500);
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



public function AuthSubscriber($name_community){
try{
    $url = env('SERVICE').'auth/configcomm';
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
            'name' => $name_community
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);

    $arr_auth = [];
    array_push($arr_auth, $json['data']);
    Session::put('auth_subs', $json['data']);
    return redirect('subscriber')->with('subs_data',$arr_auth);

}catch(ConnectException $conEx){
dd('ini error'.$conEx);

}//end-try catch
} //end-func



public function ses_auth_subs(){
    if(Session::has('auth_subs')){
    $auth_subs = Session::get('auth_subs');
     return $auth_subs;
    }else{
    return false;
    }
}




} //end-class
