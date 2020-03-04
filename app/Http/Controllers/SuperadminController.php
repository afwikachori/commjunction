<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
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
            $status_error = $exception->getCode();
            if ($status_error == 404) {
                alert()->error('Password didnt match with your username', 'Invalid')->persistent('Done');
                return back()->withInput();
            }
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
        return ($jsonku);
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
                $status_error = $exception->getCode();
                if ($status_error == 400) {
                    alert()->error('Wrong Password!', 'Failed!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            }

            return $resImg;
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
            "payment_title" => $input['payment_title'],
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
            "payment_id" => $input['payment_id'],
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


} //endclas
