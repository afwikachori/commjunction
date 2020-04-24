<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Session;
use Alert;


class RegisterController extends Controller
{


    public function ReviewAdminView()
    {
        return view('admin/final_review_admin');
    }


    public function FeatureListRegisterView()
    {
        return view('admin/featurelist');
    }

    public function featuresView()
    {
        return view('admin/features');
    }


    public function logoutssoView()
    {
        return view('admin/logoutsso');
    }

    public function features_detail()
    {
        return view('admin/features_detail');
    }

    public function paymentView()
    {
        return view('admin/payment');
    }

    public function paymentMethodRegisView()
    {
        return view('admin/payment_method');
    }

    public function ReviewRegisView()
    {
        return view('admin/final_review_regis');
    }




    public function detailFiturView($id_fitur)
    {
        $url = env('SERVICE') . 'registration/subfeature';

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'feature_id' => $id_fitur
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        // return $json['data'];

        return view('admin/features_detail', ['data' => $json['data'], 'idfitur' => $id_fitur]);
    }


    // FORM REGISTRATION-1
    public function registerAdminView()
    {

        if (session()->has('data_regis1show')) {

            $ses1 = session()->get('data_regis1show');
            $jsx = json_decode($ses1, true);
            $arr = [];

            array_push($arr, $jsx);
            return view('admin/register', ['regis1' => $arr]);
        } else {
            return view('admin/register');
        }
    }


    public function registerInputView()
    {
        return view('admin/registerinput');
    }

    public function registerfirst(Request $request)
    {
        // dd($request);
        if (session()->has('data_regis1show')) {
            $validimg = '';
        } else {
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

            $url = env('SERVICE') . 'registration/uploadcomm';

            $responseImage = $req->sendImage($imageRequest, $url);

            // dd($responseImage);
            if ($responseImage['success'] != true) {
                return back()->with('response', [
                    'status'   => 'error',
                    'messages' => [
                        'title'   => 'Insert Image',
                        'messages' => $responseImage['message']
                    ]
                ]);
            } else {
                $reshasil = $responseImage['data'];
                $filelogo = $reshasil['directory'];
            }
        } else {

            $ses1 = session()->get('data_regis1');
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

        session()->put('data_regis1', $data);
        session()->put('data_regis1show', $dataSend);

        return redirect('admin/register2')->withErrors($validator, 'admin/register');
    }


    public function get_jenis_com()
    {
        $url = env('SERVICE') . 'registration/jeniscomm';

        $client = new \GuzzleHttp\Client();
        try {
            $request = $client->post($url);
            $response = $request->getBody();
            $json = json_decode($response, true);
            if ($json['success'] == true) {
                return $json['data'];
            }
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            return $error;
        }
    }


    // FORM REGISTRATION-2
    public function register2View()
    {
        return view('admin/register2');
    }

    public function registersecond(Request $request)
    {

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

        session()->put('data_regis2', $data);

        return redirect('admin/pricing')->withErrors($validator, 'admin/register2');
    }


    public function cekusername_admin(Request $request)
    {
        $in_username = $request['user_name'];

        $url = env('SERVICE') . 'registration/cekusernameadm';

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'user_name' => $in_username
                ]
            ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json;
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            return $error;
        }
    }

    public function cektelfon_admin(Request $request)
    {
        $in_username = $request['notelp'];

        $url = env('SERVICE') . 'registration/ceknotelpadm';

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'notelp' => $in_username
                ]
            ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        return $json;
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            return $error;
        }
    }


    public function cekemail_admin(Request $request)
    {
        $in = $request['email'];

        $url = env('SERVICE') . 'registration/cekemailadm';

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'email' => $in
                ]
            ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        return $json;
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            return $error;
        }
    }


    /// PRICING - REGISTRASION ADMIN COMMUNITY
    public function pricingView()
    {
        return view('admin/pricing');
    }


    public function get_pricing_com()
    {
        $url = env('SERVICE') . 'registration/pricing';

        $client = new \GuzzleHttp\Client();
        $request = $client->post($url);
        $response = $request->getBody();
        $json = json_decode($response, true);

        return ($json);
    }



    public function pricingkefitur(Request $request)
    {
        $input = $request->all();
        $paytime = $input['payment_time'];
        $idprice = $input['idprice'];
        // return $input;

        $data = [
            'pricing_id'   => $idprice,
            'payment_time' => $paytime,
            'price'        => $input['harganya']
        ];

        $arr = json_encode($data);
        session()->put('data_pricing', $data);

        return redirect('/admin/features');
    }

    public function get_list_feature_regis()
    {
        if (session()->has('data_pricing')) {
            $dt_pricing = session()->get('data_pricing');
        } else {
            $error['succes'] = false;
            $error['message'] = "pricing null";
            return $error;
        }

        // return $dt_pricing;

        $url = env('SERVICE') . 'registration/feature';
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'pricing_id' => $dt_pricing['pricing_id']
                ]
            ]);

            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            return $json['data'];
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            return $error;
        }
    }


    public function getSelectedFitur(Request $request)
    {
        $idpilih = $request['id'];
        // return $idpilih;

        $url = env('SERVICE') . 'registration/featureselected';
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'id' => $idpilih
            ]
        ]);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        return $json;
    }


    public function session_register1(Request $request)
    {
        $idpilih = $request['id'];

        $url = env('SERVICE') . 'registration/featureselected';
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'id' => $idpilih
            ]
        ]);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        return $json;
    }


    public function getSelectedPrice(Request $request)
    {
        $idpilih = $request['id'];

        $url = env('SERVICE') . 'registration/pricingbyid';
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'id' => $idpilih
            ]
        ]);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        return $json;
    }



    public function getSelectedPayment(Request $request)
    {
        $idpilih = $request['id'];

        $url = env('SERVICE') . 'registration/paymentmethodbyid';
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'id' => $idpilih
            ]
        ]);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        return $json;
    }



    /// FEATURES - REGISTRASION
    public function sendfeature(Request $request)
    {
        $id = $request['feature_id'];
        $arry = [];

        foreach ($id as $idk) {
            $ar = array(
                'feature_id' =>  $idk
            );
            $data =  json_decode(json_encode($ar));
            array_push($arry, $data);
        }
        session()->put('data_fitur', $arry);
        session()->put('listfitur', $id);

        $ses3  = session()->get('data_pricing');

        if ($ses3['price'] == "0") {
            session()->put('data_idpay', 0);
            return redirect('admin/review');
        } else {
            return redirect('admin/payment');
        }
    }



    public function get_payment_method_regis()
    {
        $url = env('SERVICE') . 'registration/paymenttype';

        $client = new \GuzzleHttp\Client();
        try {
            $request = $client->post($url);
            $response = $request->getBody();
            $json = json_decode($response, true);
            return $json['data'];
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            return $error;
        }
    }

    public function getsubfitur(Request $request)
    {
        $idku = $request['feature_id'];

        $url = env('SERVICE') . 'registration/subfeature';

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'feature_id' => $idku
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json;
    }





    public function requestOTP(Request $request)
    {
        $auth_subs = session()->get('auth_subs');
        $id_komunitas = $auth_subs[0]['id'];
        $data_lupapass =  [
            'email'        => $request['emailforgetadmin'],
            'community_id' => $id_komunitas,
        ];

        session()->put('data_forgetpass_admin', $data_lupapass);


        $request->validate([
            'emailforgetadmin' => 'required|email'
        ]);

        try {
            $email = $request['emailforgetadmin'];
            $url = env('SERVICE') . 'auth/sendotp';

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $url, [
                'form_params'  => [
                    'email'        => $email,
                    'community_id' => $id_komunitas
                ]
            ]);

            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);


            if ($json['success'] == true) {
                alert()->success('We have sent an authentication Code to your email, please check your authentication code.', 'Authentication Code has been sent')->autoclose(4500)->persistent('Done');
                return view('admin/otp_admin');
            }
        } catch (ClientException $exception) {

            $status_error = $exception->getCode();
            if ($status_error == 400) {
                alert()->warning('You have reached the maximum OTP sending limit, wait for 5 Minutes to send OTP again', 'You have sending OTP 3 Times!')->autoclose(4500)->persistent('Done');
                return back()->withInput();
            } else {
                alert()->error('Please check your email address again or make sure you have registered on Comjuction !', 'Email Address Not Found')->autoclose(4500)->persistent('Done');
                return back()->withInput();
            }
        } //end-try catch
    } //end-function



    public function NewPass_admin(Request $request)
    {
        //     dd($request);

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

        $ses_login = session()->get('session_subscriber_logged');
        $subs = $ses_login['user'];
        $url_comname = $subs['community_name'];


        try { //try-cath
            $otp_six = $request['digit-1'] . $request['digit-2'] . $request['digit-3'] . $request['digit-4'] . $request['digit-5'] . $request['digit-6'];

            $url = env('SERVICE') . 'auth/forgotpassword';

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'otp' => $otp_six,
                    'password' => $request['newpass_admin'],
                ]
            ]);

            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            if ($json['success'] == true) {
                alert()->success('Your password has been reset. Login using New Password.', 'Forgot Password Successful')->autoclose(4500)->persistent('Done');
                // return view('admin/login');
                return redirect('subscriber/url/'.$url_comname);
            }
        } catch (ClientException $exception) {
            $status_error = $exception->getCode();

            if ($status_error == 400) {
                // dd('back 400');
                alert()->error('Use the resend feature to send a new OTP', 'Your OTP is no longer valid !')->autoclose(4500)->persistent('Done');
                return view('admin/otp_admin');
            } //end-if
        } //end-catch
    } //end-function





    public function session_resendotp()
    {
        if (session()->has('data_forgetpass_admin')) {
            $dt_resend = session()->get('data_forgetpass_admin');
            // return $dt_resend;
            // dd($dt_resend);

            try {
                $url = env('SERVICE') . 'auth/sendotp';
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', $url, [
                    'form_params'  => [
                        'email'        => $dt_resend['email'],
                        'community_id' => $dt_resend['community_id']
                    ]
                ]);


                $response = $response->getBody()->getContents();
                $json = json_decode($response, true);


                if ($json['success'] == true) {
                    alert()->success('Re-send Success Please Check Your Latest Email from us', 'Authentication Code has been sent')->autoclose(4500)->persistent('Done');
                    return view('admin/otp_admin');
                }
            } catch (ClientException $exception) {

                $status_error = $exception->getCode();
                if ($status_error == 400) {
                    alert()->warning('You have reached the maximum OTP sending limit, wait for 5 Minutes to send OTP again', 'You have sending OTP 3 Times!')->autoclose(4500)->persistent('Done');
                    return view('admin/otp_admin');
                } else {
                    alert()->error('Please check your email address again or make sure you have registered on Comjuction !', 'Email Address Not Found')->autoclose(4500)->persistent('Done');
                    return view('admin/otp_admin');
                }
            } //end-try catch

        }
    }





    /// PAYMENT - ADMIN COMMUNITY REGISTRATION


    public function isi_payment()
    {
        if (session()->has('list_payment')) {
            $ses_payment = session()->get('list_payment');

            return redirect('admin/payment')->with('pay_type', $ses_payment);
        }
    }


    public function getpayment_method(Request $request)
    {
        $idpay = $request['payment_type_id'];

        $url = env('SERVICE') . 'registration/paymentmethod';

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'payment_type_id' => $idpay
            ]
        ]);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json;
    }

    public function getDetailPay(Request $request)
    {
        $idpay = $request['payment_id'];

        $url = env('SERVICE') . 'registration/paymentdetail';

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'payment_id' => $idpay
            ]
        ]);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json;
    }




    // FINAL REGISTRASION - ADMIN COMMUNITY
    public function FinalAdminRegis(Request $request)
    {
        $input = $request->all();
        $idpay = session()->get('data_idpay');
        $ses1  = session()->get('data_regis1');
        $ses2  = session()->get('data_regis2');
        $ses3  = session()->get('data_pricing');
        $ses4  = session()->get('data_fitur');
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
        // return $datafinal;

        $url = env('SERVICE') . 'registration/adcommcreate';
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'form_params' => $datafinal
            ]);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            if ($json['success'] == true) {
                session()->forget('data_regis1');
                session()->forget('data_regis1show');
                session()->forget('data_idpay');
                session()->forget('data_regis1');
                session()->forget('data_regis2');
                session()->forget('data_pricing');
                session()->forget('listfitur');
                session()->forget('pricing_id');
                session()->forget('data_idpay');
                session()->forget('datafitur');
                session()->forget('data_fitur');
                session()->forget('sesback_finalregis_admin');
                session()->forget('list_payment');
                session()->forget('data_idpay');
                session()->forget('id_pay_type');

                // return view('admin/finish');
                return view('admin/loading_creating');
            }
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Server bermasalah";
            $error['succes'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }





    ///CONFIRM PAYMENT INVOICE ADMIN
    public function confirmView()
    {
        return view('admin/confirmpay_invoice');
    }


    public function get_tipepay()
    {
        $url = env('SERVICE') . 'paymentverification/paymenttype';
        $client = new \GuzzleHttp\Client();
        $request = $client->post($url);
        $response = $request->getBody();
        $jsonku = json_decode($response, true);
        return ($jsonku);
    }


    public function get_carapay(Request $request)
    {
        $idpilih = $request['id'];

        $url = env('SERVICE') . 'paymentverification/paymentmethod';
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'payment_type_id' => $idpilih
            ]
        ]);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        return $json;
    }


    public function get_invoice_num(Request $request)
    {
        $num = $request['invoice_number'];

        $url = env('SERVICE') . 'paymentverification/getinvoice';
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'invoice_number' => $num
                ]
            ]);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            session()->put('ses_invoice_pay', $json['data']);

            return $json;
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            return $error;
        }
    }





    public function adminconfirmpay(Request $request)
    {
        $inv_pay = session()->get('ses_invoice_pay');
        // dd($inv_pay);

        $validator = $request->validate([
            'name_userpay'   => 'required',
            'invoice_number' => 'required',
            'file_payment'  => 'required|mimes:jpeg,jpg,png,pdf',
        ]);

        ///UPLOAD IMAGE KE BACK-EN
        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('file_payment')) {
            // dd(image);
            $imgku = file_get_contents($request->file('file_payment')->getRealPath());
            $filnam = $request->file('file_payment')->getClientOriginalName();

            $input = $request->all(); // getdata form by name

            $imageRequest = [
                "nama"               => $input['name_userpay'],
                "invoice_number"     => $input['invoice_number'],
                "payment_method"     => $inv_pay['payment_method_id'],
                "payment_bank_name"  => $inv_pay['payment_bank_name'],
                "payment_owner_name" => $inv_pay['payment_owner_name'],
                "nominal"            => $inv_pay['payment_total'],
                "filename"           => $filnam,
                "file"               => $imgku
            ];

            $url = env('SERVICE') . 'paymentverification/create';
            try {
                $responseImage = $req->sendImagePayConfirm($imageRequest, $url);
                // dd($responseImage);

                if ($responseImage['success'] == true) {
                    $reshasil = $responseImage['data'];
                    alert()->success('Successfully Upload', 'System will confirm your payment max 24hours, then Login');
                    session()->forget('ses_invoice_pay');
                    return view('admin/login');
                } else {
                    return back()->with('response', [
                        'status'   => 'error',
                        'messages' => [
                            'title'   => 'Insert Image',
                            'messages' => $responseImage['message']
                        ]
                    ]);
                }
            } catch (ClientException $exception) {
                $status_error = $exception->getCode();

                if ($status_error == 400) {
                    session()->forget('ses_invoice_pay');
                    alert()->warning('Anda sudah mengirim verifikasi lebih dari 3x hari ini, mohon bersabar dan tunggu', 'You have sending 3 Times!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            }
        }
    }


    public function GetAllDataRegisAdmin()
    {
        $ses1 = session()->get('data_regis1');
        $ses2 = session()->get('data_regis2');
        $ses3 = session()->get('data_pricing');
        $ses4 = session()->get('listfitur');
        $idpay = session()->get('data_idpay');

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
            'free'      => $ses3['price']
        ];
        session()->put('sesback_finalregis_admin', $datafinal);

        return $datafinal;
    }



    public function ReviewFinal(Request $request)
    {
        $idpay = $request['id_pay_method'];
        $idtipepay = $request['id_pay_type'];

        session()->put('data_idpay', $idpay);
        session()->put('id_pay_type', $idtipepay);

        return redirect('admin/review');
    }



    public function logout()
    {
        session()->forget('data_regis1');
        session()->forget('data_regis1show');
        session()->forget('data_idpay');
        session()->forget('data_regis1');
        session()->forget('data_regis2');
        session()->forget('data_pricing');
        session()->forget('listfitur');
        session()->forget('pricing_id');
        session()->forget('data_idpay');
        session()->forget('datafitur');
        session()->forget('data_fitur');
        session()->forget('sesback_finalregis_admin');
        session()->forget('list_payment');
        session()->forget('data_idpay');
        session()->forget('id_pay_type');

        if (!session()->has('data_regis1')) {
            return "signout";
        }
    }


    public function loadingcreatingView()
    {
        return view('admin/loading_creating');
    }
    public function finishView()
    {
        alert()->success('Done', 'Please Check Your Email');
        return view('admin/finish');
    }

    public function tesView()
    {
        return view('admin/tes');
    }
    public function loadingpaymentView()
    {
        return view('admin/loading_payment');
    }
    public function finishpaymentView()
    {
        return view('admin/finish_payment');
    }

    public function forgetpassAdminView()
    {
        return view('admin/forgetpass_admin');
    }

    public function otpAdminView()
    {
        return view('admin/otp_admin');
    }


    public function session_regisOne()
    {
        if (session()->has('data_regis1')) {
            $ses1 = session()->get('data_regis1');
            return $ses1;
        } else {
            exit();
        }
    }

    public function session_regisTwo()
    {
        if (session()->has('data_regis2')) {
            $ses2 = session()->get('data_regis2');
            return $ses2;
        }
    }


    public function session_pricing()
    {
        if (session()->has('data_pricing')) {
            $ses3 = session()->get('data_pricing');
            return $ses3;
        }
    }

    public function session_payadmin()
    {
        if (session()->has('data_idpay') || session()->has('id_pay_type')) {
            $sespay = session()->get('data_idpay');
            $sestipepay = session()->get('id_pay_type');

            $paramku = [
                'id_pay'  => $sespay,
                'id_tipe' => $sestipepay,
            ];
            return $paramku;
        }
    }



    public function session_fitur()
    {
        if (session()->has('listfitur')) {
            $ses4 = session()->get('listfitur');
            return $ses4;
        }
    }

    public function session_backfitur()
    {
        $ses_pricing = session()->get('data_pricing');
        $id_pricing = $ses_pricing['pricing_id'];

        $url = env('SERVICE') . 'registration/feature';

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'pricing_id' => $id_pricing
            ]
        ]);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        $isidata = $json['data'];

        $isini = [];
        foreach ($isidata as $i => $dt) {
            array_push($isini, $dt['feature']);
        }
        $count = count($isidata);
        return redirect('admin/features')->with(['datafitur' => $isini, 'sum' => $count]);
    }


    public function cek_valid_email_subs(Request $request)
    {
        $input = $request->all();
        $url = env('SERVICE') . 'registration/cekemailsubs';

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'email' => $input['email'],
                    'community_id' => $input['community_id']
                ]
            ]);

            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            return $json;
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            return $error;
        }
    }

    public function cek_valid_phone_subs(Request $request)
    {
        $input = $request->all();
        $url = env('SERVICE') . 'registration/ceknotelpsubs';

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'notelp' => $input['notelp'],
                    'community_id' => $input['community_id']
                ]
            ]);

            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            return $json;
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            return $error;
        }
    }


    public function cek_valid_username_subs(Request $request)
    {
        $input = $request->all();
        $url = env('SERVICE') . 'registration/cekusernamesubs';

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'user_name' => $input['user_name'],
                    'community_id' => $input['community_id']
                ]
            ]);

            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            return $json;
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            return $error;
        }
    }
} // END-CLASS
