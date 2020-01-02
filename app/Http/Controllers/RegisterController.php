<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use Session;
use Alert;


class RegisterController extends Controller{

    public function test(){
        return view('admin/testing');
    }

    public function cobaView(){
            return view('admin/coba');
    }

    public function logoutssoView(){
        return view('admin/logoutsso');
    }

	public function login(){
        return view('admin/login');
    }

    public function features_detail(){
        return view('admin/features_detail');
    }


    public function detailFiturView($id_fitur){
    $url = env('SERVICE').'registration/subfeature';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
        'feature_id' => $id_fitur
        ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);

    return view('admin/features_detail', ['data' => $json['data'], 'idfitur'=> $id_fitur ]);
    }        


// FORM REGISTRATION-1
    public function registerAdminView(){
        
    if(Session::has('data_regis1show')){

    $ses1 = Session::get('data_regis1show');
    $jsx = json_decode($ses1, true);
    $arr = [];

    array_push($arr, $jsx);
    return view('admin/register', ['regis1' => $arr]);

    }else{
        return view('admin/register');
    }   
    }


    public function registerInputView(){
        return view('admin/registerinput');
    }   

    public function registerfirst(Request $request) {

    if (Session::has('data_regis1show')){
    $validimg = '';

    }else{
    $validimg = 'required|dimensions:max_width=300,max_height=300';

    }

        $validator = $request->validate([
            'name_com' => 'required|min:3',
            'descrip_com' => 'required|min:10',
            'type_com' => 'required|not_in:0',
            'range_member' => 'required|not_in:0',
            'other_type_com' => 'required_if:type_com,==,1|nullable',
            'icon_com' => $validimg,
        ]);

///UPLOAD IMAGE KE BACK-EN
        $req = new RequestController; 
        $filelogo = "";

        if ($request->hasFile('icon_com')) {
            $imgku = file_get_contents($request->file('icon_com')->getRealPath());
            $filnam = $request->file('icon_com')->getClientOriginalName();
                
            $imageRequest = [
                "directory" => 'baru',
                "image" => $imgku,
                "filename" => $filnam
            ];

            $url =env('SERVICE').'registration/uploadcomm';

            $responseImage = $req->sendImage($imageRequest,$url);

            // dd($responseImage);
            if ($responseImage['success'] != true) {
                return back()->with('response', [
                    'status'   => 'error',
                    'messages' => [
                        'title'   => 'Insert Image',
                        'messages' => $responseImage['message']
                    ]
                ]);
            }else{
                $reshasil = $responseImage['data'];
                $filelogo = $reshasil['directory'];
            }
        }else{
            
            $ses1 = Session::get('data_regis1');
            $filelogo = $ses1['logo'];
        } //END  UPLOAD-IMAGE 


        $input = $request->all(); // getdata form by name
        $data = [
                "name"            => $input['name_com'],
                "logo"            => $filelogo,
                "description"     => $input['descrip_com'],
                "jenis_comm_id"   => $input['type_com'],
                "range_member"    => $input['range_member'],
                "cust_jenis_comm" => $input['other_type_com']
        ];

        $dataSend = json_encode($data);

        Session::put('data_regis1', $data);
        Session::put('data_regis1show', $dataSend);

      return redirect('admin/register2')->withErrors($validator, 'admin/register');
    }


    public function get_jenis_com(){
    $url = env('SERVICE').'registration/jeniscomm';

    $client = new \GuzzleHttp\Client();
    $request = $client->post($url);
    $response = $request->getBody();
    $json = json_decode($response, true);
   
    return($json);
    }


// FORM REGISTRATION-2 
    public function register2View(){
    return view('admin/register2');
    }

    public function registersecond(Request $request) {

        $validator = $request->validate([
            'name_admin' => 'required|min:3',
            'phone_admin' => 'required|min:10|numeric',
            'email_admin' => 'required|email:rfc',
            'alamat_admin' => 'required|min:5',
            'username_admin' => 'required|min:6|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/', ///angka huruf
            'password_admin' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/',
        ]);

        $input = $request->all(); // getdata form by name
        $data = [
            'full_name' =>  $input['name_admin'], 
            'notelp' => $input['phone_admin'], 
            'email' => $input['email_admin'], 
            'alamat' => $input['alamat_admin'], 
            'user_name' => $input['username_admin'], 
            'password' => $input['password_admin'],
            "sso_type"        => $input['sso_type'],
            "sso_token"       => $input['sso_token']
        ];

        $dataSend = json_encode($data);

        Session::put('data_regis2', $data);

        return redirect('admin/pricing')->withErrors($validator, 'admin/register2');
    }


     public function cekusername_admin(Request $request){
     $in_username = $request['user_name'];

    $url = env('SERVICE').'registration/cekusernameadm';

    $client = new \GuzzleHttp\Client();
    try {
        $response = $client->request('POST',$url, [
            'form_params' => [
                'user_name' => $in_username
            ]
        ]);
    } catch (RequestException $exception) {
        $response = $exception->getResponse();
    }
    
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json;
    



    } 

     public function cektelfon_admin(Request $request){
     $in_username = $request['notelp'];

    $url = env('SERVICE').'registration/ceknotelpadm';

    $client = new \GuzzleHttp\Client();
    try {
        $response = $client->request('POST',$url, [
            'form_params' => [
                'notelp' => $in_username
            ]
        ]);
    } catch (RequestException $exception) {
        $response = $exception->getResponse();
    }
    
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
   
    return $json;
    } 


    public function cekemail_admin(Request $request){
     $in = $request['email'];

    $url = env('SERVICE').'registration/cekemailadm';

    $client = new \GuzzleHttp\Client();
    try {
        $response = $client->request('POST',$url, [
            'form_params' => [
                'email' => $in
            ]
        ]);
    } catch (RequestException $exception) {
        $response = $exception->getResponse();
    }
    
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
   
    return $json;
    } 


    /// PRICING - REGISTRASION ADMIN COMMUNITY
    public function pricingView(){
        return view('admin/pricing');
    }


    public function get_pricing_com(){
    $url = env('SERVICE').'registration/pricing';

    $client = new \GuzzleHttp\Client();
    $request = $client->post($url);
    $response = $request->getBody();
    $json = json_decode($response, true);

    return($json);
    }



    public function pricingkefitur(Request $request){
    $idfitur = $request['feature_type_id'];
    $paytime = $request['payment_time'];
    $idprice = $request['idprice'];

    $data = ['pricing_id'   => $idprice,
             'payment_time' => $paytime];

    $arr = json_encode($data);
    Session::put('data_pricing', $data);
    Session::put('fiturpilih', $idfitur);

    //get data pricing untuk fitur
    $url = env('SERVICE').'registration/feature';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
            'feature_type_id' => $idfitur
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    $isidata = $json['data'];

     return redirect('admin/features')->with('datafitur',$isidata);
    }



    // public function pricingkefitur(Request $request){
    // $idfitur = $request['feature_type_id'];
    // $paytime = $request['payment_time'];
    // $idprice = $request['idprice'];

    // $data = ['pricing_id'   => $idprice,
    //          'payment_time' => $paytime];

    // $arr = json_encode($data);
    // Session::put('data_pricing', $data);
    // Session::put('fiturpilih', $idfitur);

    // //get data pricing untuk fitur
    // $url = env('SERVICE').'registration/feature';

    // $client = new \GuzzleHttp\Client();
    // $response = $client->request('POST',$url, [
    //     'form_params' => [
    //         'feature_type_id' => $idfitur
    //     ]
    // ]);
    // $response = $response->getBody()->getContents();
    // $json = json_decode($response, true);
    //  return view('admin/features', ['data' => $json['data']]);
    // }


    public function getSelectedFitur(Request $request){
    $idpilih = $request['id'];

    $url = env('SERVICE').'registration/featureselected';
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
            'id' => $idpilih
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);

    return $json;
    }


     public function session_register1(Request $request){
    $idpilih = $request['id'];

    $url = env('SERVICE').'registration/featureselected';
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
            'id' => $idpilih
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);

    return $json;
    }


    public function getSelectedPrice(Request $request){
    $idpilih = $request['id'];

    $url = env('SERVICE').'registration/pricingbyid';
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
            'id' => $idpilih
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);

    return $json;
    }



    public function getSelectedPayment(Request $request){
    $idpilih = $request['id'];

    $url = env('SERVICE').'registration/paymentmethodbyid';
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
            'id' => $idpilih
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);

    return $json;
    }



    /// FEATURES - REGISTRASION 
    public function sendfeature(Request $request){
        $id = $request['feature_id'];
        $arry = [];
        
        foreach ($id as $idk) {
             $ar = array(
                    'feature_id' =>  $idk
                );
             $data =  json_decode(json_encode($ar));
             array_push($arry, $data);
        }

        //session ambil data fitur multiple check
        Session::put('data_fitur', $arry);
        Session::put('listfitur', $id);

         $url = env('SERVICE').'registration/paymenttype';

            $client = new \GuzzleHttp\Client();
            $request = $client->post($url);
            $response = $request->getBody();
            $json = json_decode($response, true);
            // dd($json['data']);

     return redirect('admin/testing')->with('pay_type', $json['data']);

        // return redirect('admin/testing')->with('fixfitur', $arry);
    }

    //   public function sendfeature(Request $request){
    //     $id = $request['feature_id'];
    //     $arry = [];
        
    //     foreach ($id as $idk) {
    //          $ar = array(
    //                 'feature_id' =>  $idk
    //             );
    //          $data =  json_decode(json_encode($ar));
    //          array_push($arry, $data);
    //     }

    //     //session ambil data fitur multiple check
    //     Session::put('data_fitur', $arry);
    //     Session::put('listfitur', $id);


    //     return redirect('admin/payment')->with('fixfitur', $arry);
    // }

     public function getsubfitur(Request $request){
     $idku = $request['feature_id'];

    $url = env('SERVICE').'registration/subfeature';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
        'feature_id' => $idku
        ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json;
    }



    public function requestOTP(Request $request){
    $data_lupapass =  [
        'email'        => $request['emailforgetadmin'],
        'community_id' => "104"
        ];

    Session::put('data_forgetpass_admin', $data_lupapass);

    try{ 
    $request->validate([
            'emailforgetadmin' => 'required|email'
    ]);

    $email = $request['emailforgetadmin'];
    $url = env('SERVICE').'auth/sendotp';
    
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params'  => [
        'email'        => $email,
        'community_id' => "104"
        ]
    ]);

    Session::put('data_forgetpass_admin', $idpay);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);

    if ($json['success'] == true) {
    Alert::success('We have sent an authentication Code to your email, please check your authentication code.', 'Authentication Code has been sent')->autoclose(4500)->persistent('Done');
      return view('admin/otp_admin');
    }
    }
    catch(ClientException $exception) {
    $status_error = $exception->getCode();

    if( $status_error == 400){
    Alert::warning('You have reached the maximum OTP sending limit, wait for 5 Minutes to send OTP again', 'You have sending OTP 3 Times!')->autoclose(4500)->persistent('Done');
    return back()->withInput();
    }else{
    Alert::error('Please check your email address again or make sure you have registered on Comjuction !', 'Email Address Not Found')->autoclose(4500)->persistent('Done');
    return back()->withInput();
    }
    
    } //end-try catch
    } //end-function



    public function NewPass_admin(Request $request){
    try{ //try-cath
    $request->validate([
    'newpass_admin' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/|required_with:confirm_newpass|same:confirm_newpass',
    'confirm_newpass' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/',
    'digit-1' => 'required|numeric', 
    'digit-2' => 'required|numeric', 
    'digit-3' => 'required|numeric', 
    'digit-4' => 'required|numeric', 
    'digit-5' => 'required|numeric', 
    'digit-6' => 'required|numeric', 
    ]);

    $otp_six = $request['digit-1'].$request['digit-2'].$request['digit-3'].$request['digit-4'].$request['digit-5'].$request['digit-6'];

    $url = env('SERVICE').'auth/forgotpassword';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
        'otp' => $otp_six,
        'password' => $request['newpass_admin'],
        ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    Alert::success('Your password has been reset. Login using New Password.', 'Forgot Password Successful')->autoclose(4500)->persistent('Done');
      return view('admin/');

    }catch(ClientException $exception) {
    $status_error = $exception->getCode();

    if( $status_error == 400){
    Alert::error('Use the resend feature to send a new OTP', 'Your OTP is no longer valid !')->autoclose(4500)->persistent('Done');
    return back()->withInput();
    } //end-if
    } //end-catch
    } //end-function


  public function session_resendotp(){
    if(Session::has('data_forgetpass_admin')){
    $dt_resend = Session::get('data_forgetpass_admin');
    return $dt_resend;
    }
   }





    /// PAYMENT - ADMIN COMMUNITY REGISTRATION 
    public function paymentView(){
        return view('admin/payment');
    }

    public function getpayment_method(Request $request){
    $idpay = $request['payment_type_id'];

    $url = env('SERVICE').'registration/paymentmethod';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
        'payment_type_id' => $idpay
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json;
    }

    public function getDetailPay(Request $request){
     $idpay = $request['payment_id'];

    $url = env('SERVICE').'registration/paymentdetail';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
        'payment_id' => $idpay
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json;
    }




// FINAL REGISTRASION - ADMIN COMMUNITY
    public function FinalAdminRegis(Request $request){
        // dd($request);
    $idpay = Session::get('data_idpay');
    $ses1  = Session::get('data_regis1');
    $ses2  = Session::get('data_regis2');
    $ses3  = Session::get('data_pricing');
    $ses4  = Session::get('data_fitur');

    $dtpay = [
        'payment_title' => 'Pembayaran Pendaftaran Community',
        'pricing_id'    => $ses3['pricing_id'],
        'payment_time'  => $ses3['payment_time'],
        'payment_id'    => $idpay
    ];

    $datafinal = [
            'community' => $ses1, 
            'admin'     => $ses2, 
            'feature'  => $ses4, 
            'payment'  => $dtpay, 
    ];

        // dd($datafinal);

    $url = env('SERVICE').'registration/adcommcreate';
    $client = new \GuzzleHttp\Client();
    try {
        $response = $client->request('POST',$url, [
            'form_params' => $datafinal
        ]);
    } catch (RequestException $exception) {
        $response = $exception->getResponse();
    }
    
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);

    // dd($json);

    if ($json['success'] == true) {
      return view('admin/finish');
    }else{
    Alert::danger('Failed to submit registrasion', 'Oh Sorry!');
      return view('admin/register6');
    }
}



    /// ######CONFIRM PAYMENT ADMIN
     public function confirmpayView(){
        return view('admin/confirmpay');
    }

    public function adminconfirmpay(Request $request) {
        // dd($request);

        $validator = $request->validate([
            'name_userpay' => 'required',
            'invoice_number' => 'required|numeric',
            'payment_method' => 'required',
            'bank_receiver' => 'required',
            'name_receiver' => 'required', 
            'nominal_payment' => 'required|numeric',
            'file_payment' => 'required|mimes:jpeg,jpg,png,pdf',
        ]);

        ///UPLOAD IMAGE KE BACK-EN
        $req = new RequestController; 
        $fileimg = "";

        if ($request->hasFile('file_payment')) {
            $imgku = file_get_contents($request->file('file_payment')->getRealPath());
            $filnam = $request->file('file_payment')->getClientOriginalName();

            $input = $request->all(); // getdata form by name

            $imageRequest = [
                "nama"               => $input['name_userpay'],
                "invoice_number"     => $input['invoice_number'],
                "payment_method"     => $input['payment_method'],
                "payment_bank_name"  => $input['bank_receiver'],
                "payment_owner_name" => $input['name_receiver'],
                "nominal"            => $input['nominal_payment'],
                "filename"           => $filnam,
                "file"               => $imgku
            ];

            $url =env('SERVICE').'paymentverification/create';

            $responseImage = $req->sendImagePayConfirm($imageRequest,$url);
            dd($responseImage);

            if ($responseImage['code'] != "00") {
                return back()->with('response', [
                    'status'   => 'error',
                    'messages' => [
                        'title'   => 'Insert Image',
                        'messages' => $responseImage['message']
                    ]
                ]);
            }else{
                dd($responseImage);
                $reshasil = $responseImage['data'];
            }
        }else{
            
    
        } //END  UPLOAD-IMAGE 


        $input = $request->all(); // getdata form by name
        $data = [
                "name"            => $input['name_com'],
                "logo"            => $fileimg,
                "description"     => $input['descrip_com'],
                "jenis_comm_id"   => $input['type_com'],
                "range_member"    => $input['range_member'],
                "cust_jenis_comm" => $input['other_type_com']
        ];

        $dataSend = json_encode($data);

         return redirect('admin/loading_payment')->withErrors($validator, 'admin/confirmpay');
    } 

///////////////////////////////////////////////////


//////////////////////////////////////////////////


    
    public function featuresView(){
        return view('admin/features');
    }

    public function registerSixView(){
        return view('admin/register6');
    }
    
    public function ReviewFinal(Request $request){
    $idpay = $request['id_pay_method'];
    Session::put('data_idpay', $idpay);

    $idpay = Session::get('data_idpay');
    $ses1 = Session::get('data_regis1');
    $ses2 = Session::get('data_regis2');
    $ses3 = Session::get('data_pricing');
    $ses4 = Session::get('listfitur');
    $ses5 = Session::get('fiturpilih');

    $dtpay = [
        'payment_title' => 'Pembayaran Pendaftaran Community',
        'pricing_id'    => $ses3['pricing_id'],
        'payment_time'  => $ses3['payment_time'],
        'payment_id'    => $idpay
    ];

    $datafinal = [
            'community' => $ses1, 
            'admin'     => $ses2, 
            'feature'   => $ses4, 
            'payment'   => $dtpay, 
            'fiturid'   => $ses5
        ];
    $arr = [];


    $dec = json_decode(json_encode($datafinal),true);
    array_push($arr, $dec);

    // dd($arr);
    return view('admin/register6',['fadmin'=> $arr]);
    }

    public function logout(){
     Session::forget('data_regis1');
     Session::forget('data_idpay');
     Session::forget('data_regis1');
     Session::forget('data_regis2');
     Session::forget('data_pricing');
     Session::forget('listfitur');
     Session::forget('fiturpilih');
     Session::forget('data_idpay');
     Session::forget('datafitur');

      if(!Session::has('data_regis1'))
        {
      return "signout";
        }
    }


    public function loadingcreatingView(){
        return view('admin/loading_creating');
    }
    public function finishView(){
        return view('admin/finish');
    }

    public function tesView(){
        return view('admin/tes');
    }
    public function loadingpaymentView(){
        return view('admin/loading_payment');
    }
    public function finishpaymentView(){
        return view('admin/finish_payment');
    }

    public function forgetpassAdminView(){
        return view('admin/forgetpass_admin');
    }

    public function otpAdminView(){
        return view('admin/otp_admin');
    }
    

    public function loginadmin(Request $request) {
        $request->validate([
            'emailadmin' => 'required|email',
            'passadmin' => 'required|password:api',
        ]);

        return 'login passing validate!';
    }


    public function session_regisOne(){
    if(Session::has('data_regis1')){
    $ses1 = Session::get('data_regis1');
     return $ses1;
    }else{
        exit();
    }
    }

    public function session_regisTwo(){
    if(Session::has('data_regis2')){
    $ses2 = Session::get('data_regis2');
    return $ses2;
    }
    }


    public function session_pricing(){
    if(Session::has('data_pricing')){
    $ses3 = Session::get('data_pricing');
    return $ses3;
    }
    }

    public function session_payadmin(){
    if(Session::has('data_idpay')){
    $sespay = Session::get('data_idpay');
    return $sespay;
    }
    }



    public function session_fitur(){
    if(Session::has('listfitur')){
    $ses4 = Session::get('listfitur');
    return $ses4;
    }
    }

    public function session_backfitur(){
    $ses_getfitur = Session::get('fiturpilih');


    //get data pricing untuk fitur
    $url = env('SERVICE').'registration/feature';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
            'feature_type_id' => $ses_getfitur
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    $isidata = $json['data'];

     return redirect('admin/features')->with('datafitur',$isidata);
    }




    public function addfromdetailFitur(Request $request){
    $ses_getfitur = Session::get('fiturpilih');
      $input = $request->all();  
      $idaddfitur = $input['idfituradmin'];
      
    //get data pricing untuk fitur
    $url = env('SERVICE').'registration/feature';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
            'feature_type_id' => $ses_getfitur
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    $isidata = $json['data'];

     return redirect('admin/features')->with(['datafitur'=>$isidata, 'idaddfitur'=>$idaddfitur]);
    }



    public function auth_adminlogin(Request $request) {
        $input = $request->all();
dd($input);
    $url = env('SERVICE').'auth/commadmin';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
        'user_name'   => $input['emailadmin'],
        'password'    => $input['passadmin']
        ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json;

    }



}
