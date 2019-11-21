<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Session;


class RegisterController extends Controller{

	public function login(){
        return view('admin/login');
    }

    public function loginSuperadmin(){
        return view('superadmin/login_superadmin');
    }

    public function registerSuperView(){
        $priviledge = Priviledge::all();
        return view('superadmin/register_superadmin', compact('priviledge'));
    }

    public function registersuper(Request $request) {
        $request->validate([
            'name_superadmin' => 'required|min:3',
        ]);
           return 'passing validate!';
    }

// FORM REGISTRATION-1
    public function registerAdminView(){
        return view('admin/register');
    }

    public function registerfirst(Request $request) {
        $validator = $request->validate([
            'name_com' => 'required|min:3',
            'descrip_com' => 'required|min:10',
            'type_com' => 'required|not_in:0',
            'range_member' => 'required|not_in:0',
            // 'other_type_com' => 'required_if:type_com,==,0|nullable',
            'icon_com' => 'required|dimensions:max_width=300,max_height=300',
        ]);




        $input = $request->all(); // getdata form by name
        $data = [
                "name"      => $input['name_com'],
                "description"   => $input['descrip_com'],
                "jenis_comm_id"      => $input['type_com'],
                "range_member"  => $input['range_member']
        ];

        $dataSend = json_encode($data);

        // Set session form data registration 1
        Session::put('data_regis1', $dataSend);

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
    public function register2Admin(){
    return view('admin/register2');
    }

    public function registersecond(Request $request) {

        $validator = $request->validate([
            'name_admin' => 'required|min:3|alpha',
            'phone_admin' => 'required|min:10|numeric',
            'email_admin' => 'required|email:rfc',
            'alamat_admin' => 'required|min:5',
            'username_admin' => 'required|min:6|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/', ///angka huruf
            'password_admin' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/',
        ]);

        $input = $request->all(); // getdata form by name
        $data = [
            'full_name' =>  $input['name_admin'], 
            'notelp' => $input['phone_admin'], 
            'email' => $input['email_admin'], 
            'alamat' => $input['alamat_admin'], 
            'user_name' => $input['username_admin'], 
            'password' => $input['password_admin']
        ];

        $dataSend = json_encode($data);
        //session data form registration 2
        Session::put('data_regis2', $dataSend);

        return redirect('admin/pricing')->withErrors($validator, 'admin/register2');
    } 

    /// PRICING - REGISTRASION ADMIN COMMUNITY

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

    $arr = [];
    $ar = array(
        'pricing_id' =>  $idfitur);
    $datacu =  json_decode(json_encode($ar));
    array_push($arr, $datacu);
    
    //session ambil data pricing
    Session::put('data_pricing', $arr);

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
     // dd($json);
     return view('admin/features', ['data' => $json['data']]);
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

        return redirect('admin/payment')->with('fixfitur', $arry);
    }



    /// PAYMENT - ADMIN COMMUNITY REGISTRATION 
    public function paymentView(){
    $url = env('SERVICE').'registration/paymentmethod';

    $client = new \GuzzleHttp\Client();
    $request = $client->post($url);
    $response = $request->getBody();
    $json = json_decode($response, true);

     return view('admin/payment', ['dt_payment' => $json['data']]);
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
     // dd($json);
    return $json;
     // return view('admin/features', ['data' => $json['data']]);
    }


    public function sendPaymentAdmin(Request $request){
    $idpay = $request['id_pay_method'];

    $ses1 = Session::get('data_regis1');
    $ses2 = Session::get('data_regis2');
    $ses3 = Session::get('data_pricing');
    $ses4 = Session::get('data_fitur');

    return $ses4;
        // return $idpay;
    }



    /// ######CONFIRM PAYMENT ADMIN
     public function confirmpayView(){
        return view('admin/confirmpay');
    }

    public function adminconfirmpay(Request $request) {

        $validator = $request->validate([
            'name_userpay' => 'required',
            'invoice_number' => 'required|numeric',
            'payment_method' => 'required',
            'bank_receiver' => 'required',
            'name_receiver' => 'required', 
            'nominal_payment' => 'required|numeric',
            'file_payment' => 'required|mimes:jpeg,jpg,png,pdf',
        ]);
         return redirect('admin/loading_payment')->withErrors($validator, 'admin/confirmpay');
    } 

///////////////////////////////////////////////////


//////////////////////////////////////////////////


    public function pricingView(){
        return view('admin/pricing');
    }
    public function featuresView(){
        return view('admin/features');
    }
    
    public function registerSixView(){
        return view('admin/register6');
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
    

     public function loginadmin(Request $request) {
        $request->validate([
            'emailadmin' => 'required|email',
            'passadmin' => 'required|password:api',
        ]);
           return 'login passing validate!';
    }




}
