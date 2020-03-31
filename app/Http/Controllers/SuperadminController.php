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

class SuperadminController extends Controller
{

    public function dashboarSuperView()
    {
        return view('superadmin/dashboard_superadmin');
    }

    public function loginSuperadminView()
    {
        return view('superadmin/login_superadmin');
    }

    public function UserSuperView()
    {
        return view('superadmin/user_superadmin');
    }


    public function paymentSuperView()
    {
        return view('superadmin/payment_superadmin');
    }

    public function ModuleManagementView()
    {
        return view('superadmin/module_management_super');
    }

    public function UserTypeView()
    {
        return view('superadmin/usertype_management_super');
    }

    public function TransactionManagementView()
    {
        return view('superadmin/transaction_management');
    }

    public function SubscriberManagementSuperView()
    {
        return view('superadmin/subscriber_management_super');
    }

    public function UserManagementSuperView()
    {
        return view('superadmin/user_management_super');
    }

    public function LogManagementSuperView()
    {
        return view('superadmin/log_management_super');
    }

    public function ModuleReportSuperView()
    {
        return view('superadmin/module_report_super');
    }

    public function PricingManageSuperView()
    {
        return view('superadmin/pricing_management_super');
    }


    public function reportManagementSuperadmin()
    {
        return view('superadmin/report_management_super');
    }

    public function paymentManagementSuperadmin()
    {
        return view("superadmin/payment_management_super");
    }

    public function NotificationManagementSuperadmin()
    {
        return view("superadmin/notification_management_super");
    }


    public function InboxManagementSuperadmin()
    {
        return view("superadmin/inbox_management_super");
    }




    public function postAddUser(Request $request)
    {

        $request->validate([
            'name_superadmin' => 'required|min:3',
            'phone_super'     => 'required|min:10|numeric',
            'email_super'     => 'required|email:rfc',
            'username_super' => 'required|min:6|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/',
            'division_super'  => 'required',
            'pilih_priv'      => 'required',
            'password_super'  => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/',
        ]);

        $input = $request->all();
        $url = env('SERVICE') . 'registration/admcreate';
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params'   => [
                'full_name'     => $input['name_superadmin'],
                'notelp'        => $input['phone_super'],
                'email'         => $input['email_super'],
                'divisi'        => $input['division_super'],
                'user_name'     => $input['username_super'],
                'password'      => $input['password_super'],
                'priviledge_id' => $input['pilih_priv']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        alert()->success('New User Has Been Added!', 'Successfully')->autoclose(4500)->persistent('Done');
        return back();
        // dd($json);
    }


    //LOGIN SUPERADMIN
    public function loginSuperadmin(Request $request)
    {
        // dd($request);

        $validator = $request->validate([
            'username_superadmin'   => 'required',
            'pass_superadmin' => 'required',
        ]);

        $input = $request->all();
        $url = env('SERVICE') . 'auth/superadmin';
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'user_name'   => $input['username_superadmin'],
                    'password'    => $input['pass_superadmin']
                ]
            ]);

            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            $jsonlogin = $json['data'];

            session()->put('session_logged_superadmin', $jsonlogin);
            $user_logged = session()->get('session_logged_superadmin');

            $user = $user_logged['user']['full_name'];
            // $user = $jsonlogin['user'];
            return redirect('superadmin/dashboard')->with('fullname', $user);
        } catch (ClientException $exception) {
            $errorq = json_decode($exception->getResponse()->getBody()->getContents(), true);

            if ($errorq['success'] == false) {
                alert()->error($errorq['message'], 'Failed!')->autoclose(4500)->persistent('Done');
                return back()->withInput();
            }
        } catch (ConnectException $errornya) {

            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;

            alert()->error($error['message'], 'Failed!')->autoclose(4500)->persistent('Done');
            return back()->withInput();
        }
    }


    //SESSION LOGGED USER - DASHBOARD SUPERADMIN
    public function session_logged_superadmin()
    {
        if (session()->has('session_logged_superadmin')) {
            $ses_loggeduser = session()->get('session_logged_superadmin');
            return $ses_loggeduser;
        } else {
            return view("/superadmin");
        }
    }


    // DROPDOWN PRIVILEDGE
    public function get_priviledge()
    {
        $url = env('SERVICE') . 'registration/priviledge';
        $client = new \GuzzleHttp\Client();

        $request = $client->post($url);
        $response = $request->getBody();
        $jsonku = json_decode($response, true);
        return $jsonku;
    }


    //DATATABLE LIST REQ VERIFY ADMINN-COMM
    public function list_req_admincomm_func()
    {
        $user_logged = session()->get('session_logged_superadmin');
        // return $user_logged['access_token'];
        // return  env('SERVICE');


        $url = env('SERVICE') . 'paymentverification/datapaymentconfirmation';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $user_logged['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }



    public function verify_admincom(Request $request)
    {
        $input = $request->all(); // getdata form by name
        // return $input;
        $validator = $request->validate([
            'invoice_num' => 'required',
            'pass_super' => 'required',
            'fileup'     => 'required',
        ]);
        // dd($request);
        $user_logged = session()->get('session_logged_superadmin');
        $token = $user_logged['access_token'];

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "invoice"     => $input['invoice_num'],
                "password"    => $input['pass_super'],
                "status"      => $input['approval'],
                "cancel_description"   =>  $input['alasan'],
                "filename"    => $filnam,
                "file"        => $imgku
            ];


            $url = env('SERVICE') . 'paymentverification/verification';
            try {
                $resImg = $req->sendImgVerify($imageRequest, $url, $token);
                // return $resImg;

                if ($resImg['success'] == true) {
                    alert()->success('Successfully to verify payment from New Admin Community', 'Verified!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                $errorq = json_decode($exception->getResponse()->getBody()->getContents(), true);

                if ($errorq['success'] == false) {
                    alert()->error($errorq['message'], 'Failed!')->autoclose(4500)->persistent('Done');
                    return back()->withInput();
                }
            } catch (ConnectException $errornya) {

                $error['status'] = 500;
                $error['message'] = "Internal Server Error";
                $error['succes'] = false;

                alert()->error($error['message'], 'Failed!')->autoclose(4500)->persistent('Done');
                return back()->withInput();
            } catch (ServerException $exception) {
                $error = json_decode($exception->getResponse()->getBody()->getContents(), true);
                return $error;
                alert()->error($error['message'], 'Failed!')->autoclose(4500)->persistent('Done');
                return back()->withInput();
            }
        } //END-IF  UPLOAD-IMAGE
    } //end-function



    public function LogoutSuperadmin()
    {
        $ses_login = session()->get('session_logged_superadmin');

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
            session()->forget('session_logged_superadmin');

            if ($json['success'] == true) {
                return redirect('superadmin');
            }
        } catch (ClientException $exception) {
            $status_error = $exception->getCode();
            if ($status_error == 401) {
                alert()->error('Over limit time, please do login again', 'Unauthorized')->persistent('Done');
                return redirect('superadmin');
            }
        }
    }

    public function get_dashboard_superadmin()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'dashboard/commjunction';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }



    public function get_all_module_list_superadmin()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'modulemanagement/allmodule';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }


    public function detail_module_all_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'modulemanagement/detailmodule';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode(['feature_id' => $input['feature_id']]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        $response = $client->post($url, $datakirim);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        return $json['data'];
    }


    public function add_create_new_module(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $token = $ses_login['access_token'];
        $input = $request->all();
        $subf = $request->except('_token', 'judul_modul', 'dekripsi_modul', 'fitur_tipe', 'fileup');

        $req = new RequestController;
        $fileimg = "";
        $url = env('SERVICE') . 'modulemanagement/addfeature';

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $imageRequest = [
                "title"             => $input['judul_modul'],
                "description"       => $input['dekripsi_modul'],
                "feature_type_id"   => $input['fitur_tipe'],
                "filename"          => $filnam,
                "file"              => $imgku
            ];
        } else {
            $imageRequest = [
                "title"             => $input['judul_modul'],
                "description"       => $input['dekripsi_modul'],
                "feature_type_id"   => $input['fitur_tipe'],
                "filename"          => "",
                "file"              => ""
            ];
        }

        try {
            $resImg = $req->upload_image_module($imageRequest, $url, $token);
            $id_fitur =  $resImg['data']['feature_id'];
            // return $resImg;

            if ($resImg['success'] == true) {

                $data = [];
                foreach ($subf as $i => $dt) {
                    $dataArray = [
                        'title'       => $dt[0],
                        'description' => $dt[1],
                        'feature_id' => $id_fitur,
                    ];
                    array_push($data, $dataArray);
                }
                // return $data ;

                $length = count($data);
                foreach ($data as $i => $isi) {
                    // dd(json_encode($isi));
                    $url = env('SERVICE') . 'modulemanagement/addsubfeature';
                    $client = new \GuzzleHttp\Client();

                    $headers = [
                        'Content-Type' => 'application/json',
                        'Authorization' => $token
                    ];

                    $bodyku = json_encode($isi);

                    $datakirim = [
                        'body' => $bodyku,
                        'headers' => $headers,
                    ];
                    $response = $client->post($url, $datakirim);
                    $response = $response->getBody()->getContents();
                    $json = json_decode($response, true);

                    if ($i == $length - 1) {
                        alert()->success('Successfully Add Module and Subfeature', 'Has been Added!')->autoclose(4500);
                        return back();
                    }
                }
            }
        } catch (ClientException $exception) {
            dd($exception->getMessage());
        }
    }


    public function tabel_usertype_superadmin()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'usertype/listusertype';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }

    public function get_listfitur_usertype_ceklist()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'usertype/listfeature';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }



    public function add_new_usertype_management(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $subftr = [];
        foreach ($input['subfitur'] as $i => $dt) {
            $dataArray = [
                'subfeature_id'       => $dt
            ];
            array_push($subftr, $dataArray);
        }

        $url = env('SERVICE') . 'usertype/create';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'title' => $input['nama_usertipe'],
            'description' => $input['dekripsi_usertipe'],
            'subfeature' => $subftr,

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
                alert()->success('Successfully Add User Type', 'Added!')->autoclose(4500);
                return back();
            }
        } catch (ClientException $exception) {
            $code = $exception->getMessage();
            if ($code == 400) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4500);
                return back();
            }
            if ($code == 404) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4500);
                return back();
            }
        }
    }

    public function edit_usertype_management(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $subftr = [];
        foreach ($input['subfitur'] as $i => $dt) {
            $dataArray = [
                'subfeature_id'       => $dt
            ];
            array_push($subftr, $dataArray);
        }

        $url = env('SERVICE') . 'usertype/edit';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'usertype_id' => $input['idfitur_usertype_edit'],
            'title' => $input['nama_usertipe_edit'],
            'description' => $input['dekripsi_usertipe_edit'],
            'subfeature' => $subftr,

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
                alert()->success('Successfully Edit Usertype', 'Updated!')->autoclose(4500);
                return back();
            }
        } catch (ClientException $exception) {
            $code = $exception->getMessage();
            if ($code == 400) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4500);
            }
            if ($code == 404) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4500);
            }
        }
    }

    public function tabel_transaksi_all_super()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'transmanagement/listall';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }



    public function add_endpoint_module(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $url = env('SERVICE') . 'modulemanagement/addmoduleendpoint';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            "endpoint"      => $input['endpoint'],
            "method"        => $input['method'],
            "directory"     => $input['directory'],
            "controller"    => $input['controller'],
            "fungsi"        => $input['function'],
            "subfeature_id" => $input['subfiturid'],
            "auth"          => $input['auth'],
            "body"          => $input['bodyku'],
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
                alert()->success('Successfully Add New Module Endpoint', 'Added!')->autoclose(4000);
                return back();
            }
        } catch (ClientException $exception) {
            $code = $exception->getMessage();
            if ($code == 400) {
                alert()->error('Cannot add Dual Endpoint ', 'Failed!')->autoclose(4000);
                return back();
            }
            if ($code == 404) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4000);
                return back();
            }
        }
    }


    public function get_list_komunitas()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'transmanagement/listcommunity';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }


    public function get_list_transaction_tipe()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'transmanagement/listtransactiontype';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }




    public function get_list_subcriber_name(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'transmanagement/listsubscriber';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'community_id' => $input['community_id']

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
        } catch (ClientException $exception) {
            return $exception;
        }
    }

    public function tabel_transaksi_show(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
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
        } catch (ClientException $exception) {
            alert()->error('Low Connection try again later ', 'Failed!')->autoclose(3500);
            return back();
        }
    }

    public function detail_transaksi_superadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        // return $ses_login['access_token'];

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
        } catch (ClientException $exception) {
            return $exception;
        }
    }

    public function tabel_subs_komunitas_super()
    {
        $ses_login = session()->get('session_logged_superadmin');
        $client = new \GuzzleHttp\Client();

        try {
            $url = env('SERVICE') . 'subsmanagement/listcomm';
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => $ses_login['access_token']
                ]
            ]);

            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            return $json['data'];
        } catch (ClientException $exception) {
            $status_error = $exception->getCode();
            if ($status_error == 500) {
                return json_encode('Data Not Found');
            }
        }
    } //end-func

    public function tabel_subs_pending_super()
    {
        $ses_login = session()->get('session_logged_superadmin');

        // return $ses_login['access_token'];

        $url = env('SERVICE') . 'subsmanagement/listsubspendingbycomm';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }



    public function tabel_subscriber_comm_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'subsmanagement/listsubsbycomm';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            "community_id" => $input['community_id']
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

            if ($json['success'] == true) {
                return $json['data'];
            }
        } catch (ClientException $exception) {
            return 'error';
        }
    }

    public function tabel_user_management_super()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'usermanagement/listuser';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }

    public function detail_user_management_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'usermanagement/detailuser';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode(['user_id' => $input['user_id']]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        $response = $client->post($url, $datakirim);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        return $json['data'];
    }



    public function tabel_log_management_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'modulereport/listactivity';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'community_id' => $input['community_id'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'user_level' => $input['user_level'],
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

    public function list_komunitas_log()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'logmanagement/listcommunity';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }



    public function get_list_community_modulereport()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'modulereport/listcommunity';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }



    public function get_list_fitur_modulereport()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'modulereport/listfeature';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }

    public function get_subfitur_modulereport(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'modulereport/listsubfeature';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'feature_id' => $input['feature_id'],
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


    public function tabel_module_report_superadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();


        $url = env('SERVICE') . 'modulereport/listactivity';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            "community_id"  => $input['community_id'],
            "start_date" => $input['start_date'],
            "end_date" => $input['end_date'],
            "feature_id" => $input['feature_id'],
            "sub_feature_id" => $input['sub_feature_id'],
            "user_level" => $input['user_level'],
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



    public function tabel_pricing_management_superadmin()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'pricingmanagement/listpricing';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }


    public function detail_pricing_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'pricingmanagement/detailpricing';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode(['pricing_id' => $input['pricing_id']]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        $response = $client->post($url, $datakirim);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        return $json['data'];
    }


    public function get_list_fitur_pricing()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'pricingmanagement/feature';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }



    public function add_pricing_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $token = $ses_login['access_token'];

        // return $input;

        if (is_array($input['multi_fiturpricing'])) {
            $fiturlist = implode(", ", $input['multi_fiturpricing']);
        } else {
            $fiturlist = $input['multi_fiturpricing'];
        }

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "title"          => $input['add_nama_pricing'],
                "description"    => $input['add_deskripsi_pricing'],
                "grand_pricing"  => $input['add_sekali'],
                "price_annual"   => $input['add_tahunan'],
                "price_monthly"  => $input['add_bulanan'],
                "pricing_type"   => $input['add_tipepricing'],
                "feature_id"     => $fiturlist,
                "filename"    => $filnam,
                "file"        => $imgku
            ];


            $url = env('SERVICE') . 'pricingmanagement/addpricing';
            try {
                $resImg = $req->sendImgUploadPricing($imageRequest, $url, $token);
                // return $resImg;
                if ($resImg['success'] == true) {
                    alert()->success('Successfully add new pricing type', 'Added!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                return $exception;
                $status_error = $exception->getCode();
                if ($status_error == 400) {
                    alert()->error('So sorry cant add new pricing type!', 'Failed!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            }
        } //END-IF  UPLOAD-IMAGE
    }






    public function edit_pricing_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $token = $ses_login['access_token'];

        // return $input;

        if (is_array($input['edit_multi_fiturpricing'])) {
            $fiturlist = implode(", ", $input['edit_multi_fiturpricing']);
        } else {
            $fiturlist = $input['edit_multi_fiturpricing'];
        }

        if (isset($input['edit_status_pricing'])) {
            $statuspr = 1;
        } else {
            $statuspr = 0;
        }


        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $imageRequest = [
                "title"          => $input['edit_nama_pricing'],
                "description"    => $input['edit_deskripsi_pricing'],
                "grand_pricing"  => $input['edit_sekali'],
                "price_annual"   => $input['edit_tahunan'],
                "price_monthly"  => $input['edit_bulanan'],
                "pricing_type"   => $input['edit_tipepricing'],
                "feature_id"     => $fiturlist,
                "pricing_id"     => $input['id_pricing_edit'],
                "status"     => $statuspr,
                "filename"    => $filnam,
                "file"        => $imgku
            ];
        } else {
            $imageRequest = [
                "title"          => $input['edit_nama_pricing'],
                "description"    => $input['edit_deskripsi_pricing'],
                "grand_pricing"  => $input['edit_sekali'],
                "price_annual"   => $input['edit_tahunan'],
                "price_monthly"  => $input['edit_bulanan'],
                "pricing_type"   => $input['edit_tipepricing'],
                "feature_id"     => $fiturlist,
                "pricing_id"     => $input['id_pricing_edit'],
                "status"     => $statuspr,
                "filename"    => "",
                "file"        => ""
            ];
        }  //END-IF  UPLOAD-IMAGE

        $urledit = env('SERVICE') . 'pricingmanagement/editpricing';
        try {
            $resImg = $req->sendImgEditPricing($imageRequest, $urledit, $token);
            if ($resImg['success'] == true) {
                alert()->success('Successfully Edit pricing type', 'Updated!')->autoclose(4500)->persistent('Done');
                return back();
            }
        } catch (ClientException $exception) {
            return $exception;
            $status_error = $exception->getCode();
            if ($status_error == 400) {
                alert()->error('So sorry cant edit new pricing type!', 'Failed!')->autoclose(4500)->persistent('Done');
                return back();
            }
        }
    }

    public function get_list_transaction_type_super()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'reportmanagement/transactiontype';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }



    public function tabel_report_transaksi_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        // return $input;

        $url = env('SERVICE') . 'reportmanagement/admreporttrans';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "start_date"  => $input['start_date'],
            "end_date"  => $input['end_date'],
            "transaction_type_id"  => $input['transaction_type_id'],
            "transaction_status"  => $input['transaction_status'],
            "min_transaction"  => $input['min_transaction'],
            "max_transaction"  => $input['max_transaction'],
            "community_id"  => $input['community_id'],
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


    public function tabel_concile_report_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'reportmanagement/admreconcile';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "transaction_type_id"  => $input['transaction_type_id'],
            "community_id"  => $input['community_id'],
            "month" => $input['month'],
            "year" => $input['year'],
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


    public function tabel_payment_all_super()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'paymentmanagement/listall';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }



    public function tabel_payment_active_super()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'paymentmanagement/listallactive';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }





    public function add_payment_management_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $url = env('SERVICE') . 'paymentmanagement/add';
        $client = new \GuzzleHttp\Client();
        // return $input;
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "payment_title"      => $input['nama_pay'],
            "description"        => $input['deskripsi_pay'],
            "price_monthly"     => $input['harga_bulanan_pay'],
            "price_annual"    => $input['harga_tahunan_pay'],
            "minimum_monthly_subscription"        => $input['min_bulanan_pay'],
            "minimum_annual_subscription" => $input['min_tahunan_pay'],
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
                alert()->success('Successfully Add New Payment', 'Added!')->autoclose(4000);
                return back();
            }
        } catch (ClientException $exception) {
            $code = $exception->getMessage();
            if ($code == 404) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4000);
                return back();
            }
        }
    }



    public function detail_payment_all_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'paymentmanagement/detail';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            "payment_id" => $input['payment_id'],
            "level_status" => $input['level_status'],
            "status" => $input['status']
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
        } catch (ClientException $exception) {
            return $exception;
        }
    }


    public function get_setting_subpayment_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'paymentmanagement/listsetting';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            "payment_method_id" => $input['payment_method_id'],
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
        } catch (ClientException $exception) {
            $code = $exception->getMessage();
            if ($code == 404) {
                return '404';
            }
        }
    }



    public function edit_payment_management_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $url = env('SERVICE') . 'paymentmanagement/edit';
        $client = new \GuzzleHttp\Client();
        // return $input;
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "payment_id"         => $input['edit_idpay'],
            "payment_title"      => $input['edit_nama_pay'],
            "description"        => $input['edit_deskripsi_pay'],
            "price_monthly"      => $input['edit_harga_bulanan_pay'],
            "price_annual"       => $input['edit_harga_tahunan_pay'],
            "minimum_monthly_subscription" => $input['edit_min_bulanan_pay'],
            "minimum_annual_subscription"  => $input['edit_min_tahunan_pay'],
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
                alert()->success('Successfully Edit Payment', 'Edited!')->autoclose(4000);
                return back();
            }
        } catch (ClientException $exception) {
            $code = $exception->getMessage();
            if ($code == 404) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4000);
                return back();
            }
        }
    }


    public function get_list_bank_name_subpay(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'paymentmanagement/listbank';

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }



    public function add_subpayment_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $token = $ses_login['access_token'];
        // dd($input);

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $input = $request->all(); // getdata form by name

            $imageRequest = [
                "payment_title"     => $input['sub_namapay'],
                "description"       => $input['sub_deskripsi'],
                "bank_name"         => $input['sub_nama_bank'],
                "no_rekening"       => $input['sub_rekening'],
                "payment_owner_name"     => $input['sub_owner_bank'],
                "payment_time_limit" => $input['sub_timelimit'],
                "payment_type_id"    => $input['subid_payment'],
                "filename"    => $filnam,
                "file"        => $imgku
            ];


            $url = env('SERVICE') . 'paymentmanagement/addsubpayment';
            try {
                $resImg = $req->addSubPaymentSuper($imageRequest, $url, $token);
                // return $resImg;
                if ($resImg['success'] == true) {
                    alert()->success('Successfully add new sub-payment', 'Added!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                // return $exception;
                $status_error = $exception->getCode();
                if ($status_error == 400) {
                    alert()->error('So sorry cant add new sub-payment!', 'Failed!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            }
        } //END-IF  UPLOAD-IMAGE
    }



    public function edit_subpayment_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $token = $ses_login['access_token'];
        // dd($input);

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $input = $request->all(); // getdata form by name

            $imageRequest = [
                "payment_title"     => $input['edit_sub_namapay'],
                "description"       => $input['edit_sub_deskripsi'],
                "bank_name"         => $input['edit_sub_nama_bank'],
                "no_rekening"       => $input['edit_sub_rekening'],
                "payment_owner_name"     => $input['edit_sub_owner_bank'],
                "payment_time_limit" => $input['edit_sub_timelimit'],
                "payment_method_id"    => $input['payment_method_id'],
                "filename"    => $filnam,
                "file"        => $imgku
            ];


            $url = env('SERVICE') . 'paymentmanagement/editsubpayment';
            try {
                $resImg = $req->editSubPaymentSuper($imageRequest, $url, $token);
                // return $resImg;
                if ($resImg['success'] == true) {
                    alert()->success('Successfully Edit sub-payment', 'Sub-Payment Edited!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                // return $exception;
                $status_error = $exception->getCode();
                if ($status_error == 400) {
                    alert()->error('So sorry cant Edit sub-payment!', 'Failed!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            }
        } //END-IF  UPLOAD-IMAGE
    }



    public function tabel_generate_notification_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'notificationmanagement/listnotification';
        // $url = '21.0.0.108:2312/api/notificationmanagement/listnotification';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'community_id' => $input['community_id'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'filter_title'  => $input['filter_title'],
            'notification_sub_type' => $input['notification_sub_type'],
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


    public function get_list_user_notif_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'notificationmanagement/listusers';
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


    public function send_notification_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        // return $input;
        // $url = '21.0.0.108:2312/api/notificationmanagement/sendnotification';
        $url = env('SERVICE') . 'notificationmanagement/sendnotification';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        if (isset($input['user_notif'])) {
            $user = $input['user_notif'];
        } else {
            $user = "";
        }

        if (isset($input['url_notif'])) {
            $urlq = $input['url_notif'];
        } else {
            $urlq = "";
        }


        $bodyku = json_encode([
            "title" => $input['judul_notif'],
            "description" => $input['deksripsi_notif'],
            "user_type" => $input['usertipe_notif'],
            "user_id" => $user,
            "notification_type" => $input['tipenotif'],
            "notification_sub_type" => $input['subtipe_notif'],
            "community_id" => $input['komunitas_notif'],
            "url" => $urlq,
            "broadcast_status" => $input['idstatus_notif'],
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
                alert()->success('Successfully Send Notification', 'Already Sent!')->autoclose(4500);
                return back();
            }
        } catch (ClientException $exception) {
            $code = $exception->getMessage();
            if ($code == 400) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4500);
                return back();
            }
            if ($code == 404) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4500);
                return back();
            }
        }
    }



    public function detail_generate_notif_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'notificationmanagement/detailnotification';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            "notification_id" => $input['notification_id'],
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
        } catch (ClientException $exception) {
            return $exception;
        }
    }



    public function add_setting_sub_payment(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $datain = $request->except('_token', 'set_id_paymethod');
        $dtin = array_chunk($datain, 5);

        $data = [];
        foreach ($dtin as $i => $dt) {
            $dataArray = [
                "payment_method_id" => $input['set_id_paymethod'],
                "title" => $dt[0],
                "setting_type" => $dt[1],
                "description" => $dt[2],
                "value" => $dt[3],
                "html_tag" => $dt[4],
            ];
            array_push($data, $dataArray);
        }
        $fixdata = ["data_setting" => $data];
        $url = env('SERVICE') . 'paymentmanagement/setting';

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode(["data_setting" => $data]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            if ($json['success'] == true) {
                alert()->success('Successfully Add Data Setting Sub-Payment', 'Added!')->autoclose(4000);
                return back();
            }
        } catch (ClientException $exception) {
            $code = $exception->getMessage();
            if ($code == 404) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4000);
                return back();
            }
        }
    }



    public function tabel_generate_inbox_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        // return $input;

        $url = env('SERVICE') . 'inboxmanagement/listmessage';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            'community_id' => $input['community_id'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'filter_title'  => $input['filter_title'],
            'message_type' => $input['message_type'],
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


    public function send_inbox_message_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        // return $input;

        $url = env('SERVICE') . 'inboxmanagement/sendmessage';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        if (isset($input['list_user'])) {
            $user = $input['list_user'];
        } else {
            $user = "";
        }

        $bodyku = json_encode([
            "title" => $input['judul_inbox'],
            "description" => $input['deksripsi_inbox'],
            "user_type" => $input['usertipe_inbox'],
            "user_id" => $user,
            "message_type" =>  $input['tipe_inbox'],
            "community_id" => $input['komunitas_inbox'],
            "broadcast_status" => $input['bc_status'],
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
                alert()->success('Successfully Send Message', 'Already Sent!')->autoclose(4500);
                return back();
            }
        } catch (ClientException $exception) {
            $code = $exception->getMessage();
            if ($code == 400) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4500);
                return back();
            }
            if ($code == 404) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4500);
                return back();
            }
        }
    }


    public function get_list_user_inbox_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
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

    public function detail_generate_message_inbox_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
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
        } catch (ClientException $exception) {
            return $$exception->getCode();;
        }
    }



    public function delete_message_inbox_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'inboxmanagement/deletemessage';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "id" => $input['id'],
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
                return $json;
            }
        } catch (ClientException $exception) {
            return $exception->getCode();
        }
    }

    public function tabel_komunitas_report_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'reportmanagement/community';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "community_id"  => $input['community_id'],
            "month" => $input['month'],
            "year" => $input['year'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            $dt = $json['data'][0];
            return $dt['activity'][0];
        } catch (ClientException $exception) {
            $status_error = $exception->getCode();
            if ($status_error == 500) {
                return json_encode('Data Not Found');
            }
        }
    }

    public function get_list_fitur_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'reportmanagement/listfeature';

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }


    public function tabel_module_report_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'reportmanagement/module';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "feature_id"  => $input['feature_id'],
            "month" => $input['month'],
            "year" => $input['year'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            $dt = $json['data'][0];
            return $dt['activity'];
        } catch (ClientException $exception) {
            $status_error = $exception->getCode();
            if ($status_error == 500) {
                return json_encode('Data Not Found');
            }
        }
    }


    public function change_status_inbox_message_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
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
        } catch (ClientException $exception) {
            $code = $exception->getMessage();
            if ($code == 404) {
                alert()->error('Low Connection try again later ', 'Failed!')->autoclose(4000);
                return back();
            }
        }
    }



    public function edit_profile_superadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $token = $ses_login['access_token'];
        $ses_user = $ses_login['user'];
        $input = $request->all();
        // return $ses_user;
        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();


            $imageRequest = [
                "user_name" => $input['username_super'],
                "full_name" => $input['name_super'],
                "notelp" => $input['phone_super'],
                "email" => $input['email_super'],
                "alamat" => $input['alamat_super'],
                "filename" => $filnam,
                "file" => $imgku
            ];

            // dd( $imageRequest);

            $url = env('SERVICE') . 'profilemanagement/editprofile';
            try {
                $resImg = $req->editProfileAdmin($imageRequest, $url, $token);
                // return $resImg['data'];
                if ($resImg['success'] == true) {
                    session()->put('session_logged_superadmin.user', [
                        "user_name" => $resImg['data']['user_name'],
                        "full_name" => $resImg['data']['full_name'],
                        "picture" => $resImg['data']['image'],
                        "notelp" => $resImg['data']['notelp'],
                        "email" => $resImg['data']['email'],
                        "alamat" => $resImg['data']['alamat'],
                        //////////////////////
                        "user_id" => $ses_user['user_id'],
                        "level" => $ses_user['level'],
                    ]);

                    alert()->success($resImg['message'], 'Now Updated!')->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                $error = json_decode($exception->getResponse()->getBody()->getContents(), true);
                if ($error['success'] == false) {
                    alert()->error($error['message'], 'Failed!')->autoclose(4000);
                    return back();
                }
            }
        } else { //END-IF  UPLOAD-IMAGE
            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "user_name" => $input['username_super'],
                "full_name" => $input['name_super'],
                "notelp" => $input['phone_super'],
                "email" => $input['email_super'],
                "alamat" => $input['alamat_super'],
                "filename"    => "",
                "file"        => ""
            ];

            $url = env('SERVICE') . 'profilemanagement/editprofile';
            try {
                $resImg = $req->editProfileAdmin($imageRequest, $url, $token);
                // return $resImg;
                if ($resImg['success'] == true) {
                    session()->put('session_logged_superadmin.user', [
                        "user_name" => $resImg['data']['user_name'],
                        "full_name" => $resImg['data']['full_name'],
                        "notelp" => $resImg['data']['notelp'],
                        "email" => $resImg['data']['email'],
                        "alamat" => $resImg['data']['alamat'],
                        //////////////////////
                        "picture" => $ses_user['picture'],
                        "user_id" => $ses_user['user_id'],
                        "level" => $ses_user['level'],
                    ]);
                    alert()->success($resImg['message'], 'Now Updated!')->persistent('Done');
                    return back();
                } //end if sukses

            } catch (ClientException $exception) {
                $error = json_decode($exception->getResponse()->getBody()->getContents(), true);
                if ($error['success'] == false) {
                    alert()->error($error['message'], 'Failed!')->autoclose(4000);
                    return back();
                }
            }
        } // endelse
    } //endfunc


    public function change_password_superadmin(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'profilemanagement/changepassword';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'old_password' => $input['old_pass_super'],
            'new_password' => $input['new_pass_super']
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
        } catch (ClientException $exception) {
            $error = json_decode($exception->getResponse()->getBody()->getContents(), true);
            if ($error['success'] == false) {
                alert()->error($error['message'], 'Failed!')->autoclose(4000);
                return back();
            }
        }
    }


    public function get_user_tipe_manage()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'usermanagement/listusertype';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }


    public function add_user_management_super(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'usermanagement/createuser';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "full_name" => $input['name_user'],
            "user_name" => $input['username_user'],
            "notelp" => $input['phone_user'],
            "email" => $input['email_user'],
            "alamat" => $input['alamat_user'],
            "usertype_id" => $input['user_tipe'],
            "password" => $input['pass_user'],
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
                alert()->success('Successfully to add new user', 'Added')->persistent('Done');
                return back();
            }
        } catch (ClientException $exception) {
            $error = json_decode($exception->getResponse()->getBody()->getContents(), true);
            if ($error['success'] == false) {
                alert()->error($error['message'], 'Failed!')->autoclose(4000);
                return back();
            }
        }
    }



    public function edit_user_management_super(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'usermanagement/edituser';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            "user_id" => $input['idnya_user'],
            "notelp" => $input['edit_phone'],
            "email" => $input['edit_email'],
            "usertype_id" => $input['user_tipe_edit'],
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
                alert()->success('Successfully to edit data user', 'Updated')->persistent('Done');
                return back();
            }
        } catch (ClientException $exception) {
            $error = json_decode($exception->getResponse()->getBody()->getContents(), true);
            if ($error['success'] == false) {
                alert()->error($error['message'], 'Failed!')->autoclose(4000);
                return back();
            }
        }
    }
} //endclas
