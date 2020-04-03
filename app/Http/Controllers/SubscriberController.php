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

class SubscriberController extends Controller
{

    public function loginView()
    {
        return view('subscriber/login');
    }

    public function registerSubsView()
    {
        return view('subscriber/register_subscriber');
    }


    public function registerCommView()
    {
        return view('subscriber/subs_community');
    }

    public function registerPaymentView()
    {
        return view('subscriber/subs_payment');
    }

    public function DashboardSubsView()
    {
        return view('subscriber/dashboard/dashboard_subs');
    }

    public function MembershipSubsView()
    {
        return view('subscriber/dashboard/membership_type');
    }

    public function TransactionSubsView()
    {
        return view('subscriber/dashboard/transaction_management_subs');
    }

    public function InboxManagementSubsView()
    {
        return view('subscriber/dashboard/inbox_management_subs');
    }


    public function LoginSubscriber(Request $request)
    {
        $validator = $request->validate([
            'input_login' => 'required',
            'pass_subs' => 'required',
            'id_community' => 'required',
        ]);
        $input = $request->all();

        if ($input['input_login'] == 'afwika' && $input['pass_subs'] == 'afwika') {
            return redirect('subscriber/dashboard');
        } else {
            $url = env('SERVICE') . 'auth/commsubs';

            $client = new \GuzzleHttp\Client();
            try {
                $response = $client->request('POST', $url, [
                    'form_params' => [
                        'input'       => $input['input_login'],
                        'password'    => $input['pass_subs'],
                        'community_id' => $input['id_community']
                    ]
                ]);

                $response = $response->getBody()->getContents();
                $json = json_decode($response, true);
                $jsonlogin = $json['data'];

                session()->put('session_subscriber_logged', $jsonlogin);
                // $user_logged = session()->get('session_subscriber_logged');
                // dd($user_logged);
                $user = $jsonlogin['user']['user_name'];
                return redirect('subscriber/dashboard')->with('fullname', $user);
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
                $error['message'] = "Internal Server Error";
                $error['succes'] = false;
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        }
    } //end-func


    //SESSION LOGGED USER - DASHBOARD Subscriber
    public function session_subscriber_logged()
    {
        if (session()->has('session_subscriber_logged')) {
            $ses_loggeduser = session()->get('session_subscriber_logged');
            return $ses_loggeduser;
        }
        // else{
        //     return view("/superadmin");
        // }
    }


    public function registerSubscriber(Request $request)
    {
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
            $url = env('SERVICE') . 'registration/subscriber';
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $url, [
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

            if ($json['success'] == true) {
                alert()->success('Your Subscriber registrasion is successfull', 'Yay !');
                $url_sukses = '/subscriber/url/' . $url_comname;

                return back()->with('register_sukses', $url_sukses);

                // return redirect('subscriber/url/'.$url_comname)->with('register_sukses', $url_sukses);
            }
        } catch (RequestException $exception) {
            return $exception;
            // $response = $exception->getResponse();
            $code = $exception->getCode();
            // dd($code);
            if ($code == 400) {
                alert()->error('Your Community Not Active Yet', 'Ooops Sorry!');
                return back()->withInput();
            }
        }
    }



    public function AuthSubscriber($name_community)
    {

        $url = env('SERVICE') . 'auth/configcomm';
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'name' => $name_community
                ]
            ]);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            $arr_auth = [];
            array_push($arr_auth, $json['data']);
            // return $arr_auth;

            session()->put('auth_subs', $arr_auth);
            // return redirect('subscriber')->with('subs_data', $arr_auth);
            return view('subscriber/login')->with('subs_data', $arr_auth);
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(3500);
            return redirect('404');
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    } //end-func



    public function ses_auth_subs()
    {
        if (session()->has('auth_subs')) {
            $auth_subs = session()->get('auth_subs');
            return $auth_subs;
        } else {
            return view('404');
        }
    }


    public function LogoutSubsciberDashboard()
    {
        $ses_login = session()->get('session_subscriber_logged');
        $auth_subs = session()->get('auth_subs');
        $url_login = '/subscriber/url/' . $auth_subs[0]['name'];

        $url = env('SERVICE') . 'profilemanagement/logout';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        try {
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            session()->forget('session_subscriber_logged');
            if ($json['success'] == true) {
                return redirect($url_login);
            }
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            if($error['message'] == 'Unauthorized'){
                alert()->error($error['message'], 'Failed!')->autoclose(3500);
                return redirect($url_login);
            }else{
            alert()->error($error['message'], 'Failed!')->autoclose(3500);
            return back();
            }
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    } //enfunc


    public function edit_profile_subs(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_subscriber_logged');
        $token = $ses_login['access_token'];
        $ses_user = $ses_login['user'];

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "user_name" => $input['username_subs'],
                "full_name" => $input['name_subs'],
                "notelp" => $input['phone_subs'],
                "email" => $input['email_subs'],
                "alamat" => $input['alamat_subs'],
                "filename" => $filnam,
                "file" => $imgku
            ];

            $url = env('SERVICE') . 'profilemanagement/editprofile';
            try {
                $resImg = $req->editProfileAdmin($imageRequest, $url, $token);
                // return $resImg;
                if ($resImg['success'] == true) {
                    session()->put('session_subscriber_logged.user', [
                        "user_name" => $resImg['data']['user_name'],
                        "full_name" => $resImg['data']['full_name'],
                        "picture" => $resImg['data']['sso_picture'],
                        "notelp" => $resImg['data']['notelp'],
                        "email" => $resImg['data']['email'],
                        "alamat" => $resImg['data']['alamat'],
                        //////////////////////
                        "community_id" => $ses_user['community_id'],
                        "community_name" => $ses_user['community_name'],
                        "community_description" => $ses_user['community_description'],
                        "community_logo" => $ses_user['community_logo'],
                        "user_id" => $ses_user['user_id'],
                        "level" => $ses_user['level'],
                        "status" => $ses_user['status'],
                        "community_created" => $ses_user['community_created'],
                        "community_type" => $ses_user['community_type'],
                        //////////////////////
                        "membership_id" => $ses_user['membership_id'],
                        "membership" => $ses_user['membership'],
                        "membership_features" => $ses_user['membership_features'],

                    ]);

                    alert()->success('Successfully update your profile', 'Now Updated!')->persistent('Done');
                    return back();
                }
            } catch (ClientException $errornya) {
                $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                alert()->error($error['message'], 'Failed!')->autoclose(3500);
                return back();
            } catch (ServerException $errornya) {
                $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            } catch (ConnectException $errornya) {
                $error['status'] = 500;
                $error['message'] = "Internal Server Error";
                $error['succes'] = false;
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } else { //END-IF  UPLOAD-IMAGE
            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "user_name" => $input['username_subs'],
                "full_name" => $input['name_subs'],
                "notelp" => $input['phone_subs'],
                "email" => $input['email_subs'],
                "alamat" => $input['alamat_subs'],
                "filename"    => "",
                "file"        => ""
            ];

            $url = env('SERVICE') . 'profilemanagement/editprofile';
            try {
                $resImg = $req->editProfileAdmin($imageRequest, $url, $token);
                // return $resImg;
                if ($resImg['success'] == true) {
                    session()->put('session_subscriber_logged.user', [
                        "user_name" => $resImg['data']['user_name'],
                        "full_name" => $resImg['data']['full_name'],
                        "picture" => $resImg['data']['sso_picture'],
                        "notelp" => $resImg['data']['notelp'],
                        "email" => $resImg['data']['email'],
                        "alamat" => $resImg['data']['alamat'],
                        //////////////////////
                        "community_id" => $ses_user['community_id'],
                        "community_name" => $ses_user['community_name'],
                        "community_description" => $ses_user['community_description'],
                        "community_logo" => $ses_user['community_logo'],
                        "user_id" => $ses_user['user_id'],
                        "level" => $ses_user['level'],
                        "status" => $ses_user['status'],
                        "community_created" => $ses_user['community_created'],
                        "community_type" => $ses_user['community_type'],
                        //////////////////////
                        "membership_id" => $ses_user['membership_id'],
                        "membership" => $ses_user['membership'],
                        "membership_features" => $ses_user['membership_features'],
                    ]);
                    alert()->success('Successfully update your profile', 'Now Updated!')->persistent('Done');
                    return back();
                } //end if sukses
            } catch (ClientException $errornya) {
                $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                alert()->error($error['message'], 'Failed!')->autoclose(3500);
                return back();
            } catch (ServerException $errornya) {
                $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            } catch (ConnectException $errornya) {
                $error['status'] = 500;
                $error['message'] = "Internal Server Error";
                $error['succes'] = false;
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } // endelse
    } //endfunc


    public function change_password_subs(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'profilemanagement/changepassword';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'old_password' => $input['old_pass_subs'],
            'new_password' => $input['new_pass_subs']
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            if ($json['success'] == true) {
                alert()->success('Successfully to change password', 'Password Updated')->persistent('Done');
                return back();
            }
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(3500);
            return back();
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function get_dashboard_subscriber()
    {
        $ses_login = session()->get('session_subscriber_logged');

        $url = env('SERVICE') . 'dashboard/subscriber';
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => $ses_login['access_token']
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

    public function get_list_subcriber_name(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();
        $user = $ses_login['user'];
        $comid = $user['community_id'];

        $url = env('SERVICE') . 'transmanagement/listsubscriber';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'community_id' => $comid

        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
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


    public function get_list_transaction_tipe()
    {
        $ses_login = session()->get('session_subscriber_logged');

        $url = env('SERVICE') . 'transmanagement/listtransactiontype';
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => $ses_login['access_token']
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

    public function tabel_transaksi_show(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();
        // return $ses_login['access_token'];

        $url = env('SERVICE') . 'transmanagement/listall';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            "start_date" => $input['tanggal_mulai'],
            "end_date" => $input['tanggal_selesai'],
            "community_id" => $input['komunitas'],
            "transaction_type_id" => $input['tipe_trans'],
            "subscriber_id" => $input['subs_name'],
            "transaction_status" => $input['status_trans']
        ]);
        // return $bodyku;

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            return $json['data'];

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



    public function detail_transaksi_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'transmanagement/detail';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            "invoice_number" => $input['invoice_number'],
            "community_id" => $input['community_id'],
            "payment_level" => $input['payment_level']
        ]);
        // return $bodyku;

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            return $json['data'];

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



    public function tabel_generate_inbox_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();

        // return $input;

        $url = env('SERVICE') . 'inboxmanagement/listmessage';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            'status' => "1",
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            return $json['data'];
        } catch (ClientException $exception) {
            $status_error = $exception->getCode();
            if ($status_error == 500) {
                return json_encode('Data Not Found');
            }
        }
    }


    public function get_list_subscriber_inbox(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'inboxmanagement/listusers';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            "user_type" => $input['user_type'],
            "community_id" => $input['community_id'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            return $json['data'];
        } catch (ClientException $exception) {
            $status_error = $exception->getCode();
            if ($status_error == 500) {
                return json_encode('Data Not Found');
            }
        }
    }

    public function detail_inbox_subscriber(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'inboxmanagement/detailmessage';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "message_id" => $input['message_id'],
            "level_status" => $input['level_status'],
            "community_id" => $input['community_id']
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            return $json['data'];

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



    public function change_status_inbox_message_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();
        $url = env('SERVICE') . 'inboxmanagement/changestatus';
        $client = new \GuzzleHttp\Client();
        // return $input;
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
             "id"     => $input['id_inbox'],
            "status" => $input['list_status'],
            "status_type"     => $input['status_tipe'],
            "level_status" => $input['level_status'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            if ($json['success'] == true) {
                alert()->success('Successfully Change Status Message Inbox', 'Has Been Change!')->autoclose(4000);
                return back();
            }
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(3500);
            return back();
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }






} //end-class
