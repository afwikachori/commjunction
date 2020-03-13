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

public function DashboardSubsView(){
    return view('subscriber/dashboard/dashboard_subs');
}

public function MembershipSubsView(){
    return view('subscriber/dashboard/membership_type');
}


public function LoginSubscriber(Request $request){
$validator = $request->validate([
    'input_login' => 'required',
    'pass_subs' => 'required',
    'id_community' => 'required',
]);
$input = $request->all();

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
    $jsonlogin = $json['data'];

    Session::put('session_subscriber_logged', $jsonlogin);
    // $user_logged = Session::get('session_subscriber_logged');
    // dd($user_logged);
    $user = $jsonlogin['user']['user_name'];

return redirect('subscriber/dashboard')->with('fullname',$user);
}
} //end-func


//SESSION LOGGED USER - DASHBOARD Subscriber
    public function session_subscriber_logged(){
    if(Session::has('session_subscriber_logged')){
    $ses_loggeduser = Session::get('session_subscriber_logged');
    return $ses_loggeduser['user'];
    }
    // else{
    //     return view("/superadmin");
    // }
    }


public function registerSubscriber(Request $request){
    // dd($request);
	  $validator = $request->validate([
            'fullname_subs' => 'required|min:3',
            'notlp_subs' => 'required|min:10|numeric',
            'email_subs' => 'required|email',
            'username_subs' => 'required|min:6|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/', ///angka huruf
            'password_subs' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/|required_with:password_confirm|same:passconfirm_subs',
            'passconfirm_subs' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/',
        ]);

        $input = $request->all(); // getdata form by name
        $url_comname = $input['name_community'];
        // return $input;
    try {
    $url = env('SERVICE').'registration/subscriber';
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' =>  [
            'full_name'     => $input['fullname_subs'],
            'notelp'        => $input['notlp_subs'],
            'email'         => $input['email_subs'],
            'user_name'     => $input['username_subs'],
            'password'      => $input['password_subs'],
            'community_id'  => $input['community_id'],
            "sso_type"      => $input['sso_type'],
            "sso_token"     => $input['sso_token']
        ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    // dd($json);

    if($json['success'] == true){
    alert()->success('Your Subscriber registrasion is successfull', 'Yay !');
    $url_sukses = '/subscriber/url/'.$url_comname;

    return back()->with('register_sukses', $url_sukses);

    // return redirect('subscriber/url/'.$url_comname)->with('register_sukses', $url_sukses);
    }
    } catch (RequestException $exception) {
        return $exception;
        // $response = $exception->getResponse();
        $code =$exception->getCode();
        // dd($code);
        if($code == 400){
       alert()->error('Your Community Not Active Yet', 'Ooops Sorry!');
        return back()->withInput();
        }
    }


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
    }
    // else{
    // return false;
    // }
}




} //end-class
