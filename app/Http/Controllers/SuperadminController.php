<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\BadResponseException;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use App\Helpers\RequestHelper;
use App\Http\Controllers\SendRequestController;

use Session;
use Alert;
use Helper;

class SuperadminController extends Controller
{
    use RequestHelper;
    use SendRequestController;


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

        try {
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
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            if ($error["status"] == 401 || $error["message"] == "Unauthorized") {
                alert()->error("Another user has logged", 'Unauthorized')->autoclose(4500);
                return redirect('superadmin');
            } else {
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Server bermasalah";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    //LOGIN SUPERADMIN
    public function loginSuperadmin(Request $request)
    {
        $validator = $request->validate([
            'username_superadmin'   => 'required',
            'pass_superadmin' => 'required',
        ]);

        $input = $request->all();
        $url = env('SERVICE') . 'auth/superadmin';
        try {

            $req_input =  [
                'user_name'   => $input['username_superadmin'],
                'password'    => $input['pass_superadmin']
            ];
            $jsonlogin = $this->encryptedPost($request, $req_input, $url, null);
            // return $jsonlogin;
            session()->put('session_logged_superadmin', $jsonlogin);
            $user_logged = session()->get('session_logged_superadmin');

            $user = $user_logged['user']['full_name'];
            return redirect('superadmin/dashboard')->with('fullname', $user);
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            if ($error["status"] == 401 || $error["message"] == "Unauthorized") {
                alert()->error("Another user has logged", 'Unauthorized')->autoclose(4500);
                return redirect('superadmin');
            } else {
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Server bermasalah";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function InputloginSuperadmin(Request $request)
    {
        $validator = $request->validate([
            'username_superadmin'   => 'required',
            'pass_superadmin' => 'required',
        ]);

        $input = $request->all();
        $url = env('SERVICE') . 'auth/superadmin';


        try {
            $req_input =  [
                'user_name'   => $input['username_superadmin'],
                'password'    => $input['pass_superadmin']
            ];
            $jsonlogin = $this->encryptedPost($request, $req_input, $url, null);

            session()->put('session_logged_superadmin', $jsonlogin);
            $user_logged = session()->get('session_logged_superadmin');

            $user = $user_logged['user']['full_name'];
            return redirect('support/inquiry_log');
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            if ($error["status"] == 401 || $error["message"] == "Unauthorized") {
                alert()->error("Another user has logged", 'Unauthorized')->autoclose(4500);
                return redirect('support');
            } else {
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Server bermasalah";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
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

    //SESSION LOGGED USER - DASHBOARD SUPERADMIN
    public function get_session_logged_superadmin()
    {
        if (session()->has('session_logged_superadmin')) {
            $ses_loggeduser = session()->get('session_logged_superadmin');
            return $ses_loggeduser;
        } else {
            return "session is null";
        }
    }


    // DROPDOWN PRIVILEDGE
    public function get_priviledge()
    {
        $url = env('SERVICE') . 'registration/priviledge';
        $client = new \GuzzleHttp\Client();

        try {
            $request = $client->post($url);
            $response = $request->getBody();
            $jsonku = json_decode($response, true);
            return $jsonku['data'];
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['success'] = false;
            return $error;
        }
    }


    //DATATABLE LIST REQ VERIFY ADMINN-COMM
    public function list_req_admincomm_func(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'paymentverification/datapaymentconfirmation';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function verify_admincom(Request $request)
    {
        $input = $request->all();
        $validator = $request->validate([
            'invoice_num' => 'required',
            'pass_super' => 'required',
            'fileup'     => 'required',
        ]);
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
                "_token" => $input['_token'],
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
                $error['success'] = false;

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



    public function LogoutSuperadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'profilemanagement/logout';

        $input = $request->all();
        // return $input;
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);

        if ($json['success'] == true) {
            session()->forget('session_logged_superadmin');
            return redirect('superadmin');
        } else if ($json["status"] == 401 || $json["message"] == "Unauthorized") {
            alert()->error("Another user has logged", 'Unauthorized')->autoclose(4500);
            return redirect('superadmin');
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }

    public function get_dashboard_superadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'dashboard/commjunction';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);

        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function get_all_module_list_superadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'modulemanagement/allmodule';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function detail_module_all_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'modulemanagement/detailmodule';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'feature_id' => $input['feature_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
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
                "_token"            => $input['_token'],
                "filename"          => $filnam,
                "file"              => $imgku
            ];
        } else {
            $imageRequest = [
                "title"             => $input['judul_modul'],
                "description"       => $input['dekripsi_modul'],
                "feature_type_id"   => $input['fitur_tipe'],
                "_token"            => $input['_token'],
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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function tabel_usertype_superadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'usertype/listusertype';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function get_listfitur_usertype_ceklist(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'usertype/listfeature';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function add_new_usertype_management(Request $request)
    {
        $request->validate([
            'nama_usertipe' => 'required',
            'dekripsi_usertipe' => 'required',
            'subfitur' => 'required',
        ]);
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

        $csrf = $input['_token'];
        $body = [
            'title' => $input['nama_usertipe'],
            'description' => $input['dekripsi_usertipe'],
            'subfeature' => $subftr,
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);

        if ($json['success'] == true) {
            alert()->success('Successfully Add User Type', 'Added!')->autoclose(4500);
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }

    public function edit_usertype_management(Request $request)
    {
        $request->validate([
            'nama_usertipe_edit' => 'required',
            'dekripsi_usertipe_edit' => 'required',
            'edit_subfitur' => 'required',
        ]);
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $subftr = [];
        foreach ($input['edit_subfitur'] as $i => $dt) {
            $dataArray = [
                'subfeature_id'       => $dt
            ];
            array_push($subftr, $dataArray);
        }

        $url = env('SERVICE') . 'usertype/edit';

        $csrf = $input['_token'];
        $body = [
            'usertype_id' => $input['idfitur_usertype_edit'],
            'title' => $input['nama_usertipe_edit'],
            'description' => $input['dekripsi_usertipe_edit'],
            'subfeature' => $subftr,
        ];
        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);

        if ($json['success'] == true) {
            alert()->success('Successfully Edit Usertype', 'Updated!')->autoclose(4500);
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }

    public function tabel_transaksi_all_super()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'transmanagement/listall';
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
            $error['success'] = false;
            return $error;
        }
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


    public function get_list_komunitas(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'transmanagement/listcommunity';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_list_transaction_tipe(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'transmanagement/listtransactiontype';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }




    public function get_list_subcriber_name(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'transmanagement/listsubscriber';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'community_id' => $input['community_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function tabel_transaksi_show(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'transmanagement/listall';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "start_date" => $input['tanggal_mulai'],
            "end_date" => $input['tanggal_selesai'],
            "community_id" => $input['komunitas'],
            "transaction_type_id" => $input['tipe_trans'],
            "subscriber_id" => $input['subs_name'],
            "transaction_status" => $input['status_trans']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function detail_transaksi_superadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'transmanagement/detail';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "invoice_number" => $input['invoice_number'],
            "community_id" => $input['community_id'],
            "payment_level" => $input['payment_level']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function tabel_subs_komunitas_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'subsmanagement/listcomm';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    } //end-func

    public function tabel_subs_pending_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'subsmanagement/listsubspendingbycomm';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "community_id" => $input['community_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function tabel_subscriber_comm_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'subsmanagement/listsubsbycomm';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "community_id" => $input['community_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function tabel_user_management_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'usermanagement/listuser';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function detail_user_management_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'usermanagement/detailuser';


        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'user_id' => $input['user_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function tabel_log_management_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'modulereport/listactivity';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'community_id' => $input['community_id'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'user_level' => $input['user_level'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function get_list_komunitas_log_manage(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'logmanagement/listcommunity';
        $input = $request->all();

        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        //    return $json;
        if ($json['status'] == 200) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function get_list_community_modulereport(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'modulereport/listcommunity';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['status'] == 200) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function get_list_fitur_modulereport(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'modulereport/listfeature';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['status'] == 200) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function get_subfitur_modulereport(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'modulereport/listsubfeature';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'feature_id' => $input['feature_id'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function tabel_module_report_superadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'modulereport/listactivity';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "community_id"  => $input['community_id'],
            "start_date" => $input['start_date'],
            "end_date" => $input['end_date'],
            "feature_id" => $input['feature_id'],
            "sub_feature_id" => $input['sub_feature_id'],
            "user_level" => $input['user_level'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function tabel_pricing_management_superadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'pricingmanagement/listpricing';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function detail_pricing_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'pricingmanagement/detailpricing';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'pricing_id' => $input['pricing_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_list_fitur_pricing(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'pricingmanagement/feature';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
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
                $error['success'] = false;
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } //END-IF  UPLOAD-IMAGE
    }






    public function edit_pricing_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $token = $ses_login['access_token'];

        if ($request->has('edit_multi_fiturpricing')) {

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
        } else {
            alert()->error("Feature Can Not Null", 'Failed!')->autoclose(4500);
            return back();
        }

        $urledit = env('SERVICE') . 'pricingmanagement/editpricing';
        try {
            $resImg = $req->sendImgEditPricing($imageRequest, $urledit, $token);
            if ($resImg['success'] == true) {
                alert()->success('Successfully Edit pricing type', 'Updated!')->autoclose(4500)->persistent('Done');
                return back();
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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }

    public function get_list_transaction_type_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'reportmanagement/transactiontype';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function tabel_report_transaksi_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'reportmanagement/admreporttrans';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "start_date"  => $input['start_date'],
            "end_date"  => $input['end_date'],
            "transaction_type_id"  => $input['transaction_type_id'],
            "transaction_status"  => $input['transaction_status'],
            "min_transaction"  => $input['min_transaction'],
            "max_transaction"  => $input['max_transaction'],
            "community_id"  => $input['community_id'],
        ];
        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);

        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function tabel_concile_report_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'reportmanagement/admreconcile';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "transaction_type_id"  => $input['transaction_type_id'],
            "community_id"  => $input['community_id'],
            "month" => $input['month'],
            "year" => $input['year'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);

        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function tabel_payment_all_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'paymentmanagement/listall';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function tabel_payment_active_super()
    {
        $ses_login = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'paymentmanagement/listallactive';
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
        } catch (ClientException $exception) {
            $status_error = $exception->getCode();
            if ($status_error == 500) {
                return json_encode('Data Not Found');
            } else {
                $error = json_decode($exception->getResponse()->getBody()->getContents(), true);
                return $error;
            }
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['success'] = false;
            return $error;
        }
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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }



    public function detail_payment_all_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'paymentmanagement/detail';


        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "payment_id" => $input['payment_id'],
            "level_status" => $input['level_status'],
            "status" => $input['status']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_setting_subpayment_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'paymentmanagement/listsetting';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "payment_method_id" => $input['payment_method_id'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['status'] == 200) {
            return $json['data'];
        } else {
            return $json;
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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function get_list_bank_name_subpay(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'paymentmanagement/listbank';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
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
                "_token"            => $input['_token'],
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
                $error['success'] = false;
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
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
                "_token"    => $input['_token'],
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
                $error['success'] = false;
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } //END-IF  UPLOAD-IMAGE
    }



    public function tabel_generate_notification_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'notificationmanagement/listnotification';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'community_id' => $input['community_id'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'filter_title'  => $input['filter_title'],
            'notification_sub_type' => $input['notification_sub_type'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_list_user_notif_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'notificationmanagement/listusers';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "user_type" => $input['user_type'],
            "community_id" => $input['community_id'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function send_notification_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $url = env('SERVICE') . 'notificationmanagement/sendnotification';

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

        $csrf = $input['_token'];

        $body = [
            "title" => $input['judul_notif'],
            "description" => $input['deksripsi_notif'],
            "user_type" => $input['usertipe_notif'],
            "user_id" => $user,
            "notification_type" => $input['tipenotif'],
            "notification_sub_type" => $input['subtipe_notif'],
            "community_id" => $input['komunitas_notif'],
            "url" => $urlq,
            "broadcast_status" => $input['idstatus_notif'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            alert()->success('Successfully Send Notification', 'Already Sent!')->autoclose(4500);
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }



    public function detail_generate_notif_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'notificationmanagement/detailnotification';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "notification_id" => $input['notification_id'],
            "level_status" => $input['level_status'],
            "community_id" => $input['community_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
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
        $url = env('SERVICE') . 'paymentmanagement/setting';

        $csrf = $input['_token'];

        $body = [
            "data_setting" => $data
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);


        if ($json['success'] == true) {
            alert()->success('Successfully Add Data Setting Sub-Payment', 'Added!')->autoclose(4000);
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }



    public function tabel_generate_inbox_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'inboxmanagement/listmessage';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'community_id' => $input['community_id'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'filter_title'  => $input['filter_title'],
            'message_type' => $input['message_type'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function send_inbox_message_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'inboxmanagement/sendmessage';

        $input = $request->all();
        $csrf = $input['_token'];

        if (isset($input['list_user'])) {
            $user = $input['list_user'];
        } else {
            $user = "";
        }

        $body = [
            "title" => $input['judul_inbox'],
            "description" => $input['deksripsi_inbox'],
            "user_type" => $input['usertipe_inbox'],
            "user_id" => $user,
            "message_type" =>  $input['tipe_inbox'],
            "community_id" => $input['komunitas_inbox'],
            "broadcast_status" => $input['bc_status'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            alert()->success('Successfully Send Message', 'Already Sent!')->autoclose(4500);
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function get_list_user_inbox_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'inboxmanagement/listusers';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "user_type" => $input['user_type'],
            "community_id" => $input['community_id'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function detail_generate_message_inbox_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'inboxmanagement/detailmessage';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "message_id" => $input['message_id'],
            "level_status" => $input['level_status'],
            "community_id" => $input['community_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function delete_message_inbox_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'inboxmanagement/deletemessage';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "id" => $input['id'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function tabel_komunitas_report_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'reportmanagement/community';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "community_id"  => $input['community_id'],
            "month" => $input['month'],
            "year" => $input['year'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            $dt = $json['data'][0];
            return $dt['activity'][0];
        } else {
            return $json;
        }
    }

    public function get_list_fitur_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'reportmanagement/listfeature';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function tabel_module_report_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'reportmanagement/module';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "feature_id"  => $input['feature_id'],
            "month" => $input['month'],
            "year" => $input['year'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            $dt = $json['data'][0];
            return $dt['activity'];
        } else {
            return $json;
        }
    }


    public function change_status_inbox_message_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'inboxmanagement/changestatus';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "id"     => $input['id_inbox'],
            "status" => $input['list_status'],
            "status_type"     => $input['status_tipe'],
            "level_status" => $input['level_status'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }

        if ($json['success'] == true) {
            alert()->success('Successfully Change Status Message Inbox', 'Has Been Change!')->autoclose(4000);
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }



    public function edit_profile_superadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $token = $ses_login['access_token'];
        $ses_user = $ses_login['user'];
        $input = $request->all();
        $url = env('SERVICE') . 'profilemanagement/editprofile';


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
                "_token" => $input['_token'],
                "filename" => $filnam,
                "file" => $imgku
            ];

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
            } catch (ServerException $errornya) {
                $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            } catch (ConnectException $errornya) {
                $error['status'] = 500;
                $error['message'] = "Server bermasalah";
                $error['success'] = false;
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } else { //END-IF  UPLOAD-IMAGE
            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "user_name" => $input['username_super'],
                "full_name" => $input['name_super'],
                "notelp" => $input['phone_super'],
                "email" => $input['email_super'],
                "alamat" => $input['alamat_super'],
                "_token" => $input['_token'],
                "filename"    => "",
                "file"        => ""
            ];

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
            } catch (ServerException $errornya) {
                $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            } catch (ConnectException $errornya) {
                $error['status'] = 500;
                $error['message'] = "Server bermasalah";
                $error['success'] = false;
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } // endelse
    } //endfunc


    public function change_password_superadmin(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'profilemanagement/changepassword';
        $csrf = $input['_token'];
        try {
            $req_input =  [
                'old_password' => $input['old_pass_super'],
                'new_password' => $input['new_pass_super']
            ];
            $jsonlogin = $this->encryptedPost($request, $req_input, $url,  $ses_login['access_token']);
            $respon = json_decode($jsonlogin, true);
            if ($respon['success'] == true) {
                alert()->success('Successfully to change password', 'Password Updated')->persistent('Done');
                return back();
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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function get_user_tipe_manage(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'usermanagement/listusertype';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function add_user_management_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $url = env('SERVICE') . 'usermanagement/createuser';

        try {
            $req_input =  [
                "full_name" => $input['name_user'],
                "user_name" => $input['username_user'],
                "notelp" => $input['phone_user'],
                "email" => $input['email_user'],
                "alamat" => $input['alamat_user'],
                "usertype_id" => $input['user_tipe'],
                "password" => $input['pass_user'],
            ];
            $jsonlogin = $this->encryptedPost($request, $req_input, $url, $ses_login['access_token']);
            $respon = json_decode($jsonlogin, true);

            if ($respon['success'] == true) {
                alert()->success('Successfully to add new user', 'Added')->persistent('Done');
                return back();
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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }



    public function edit_user_management_super(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $url = env('SERVICE') . 'usermanagement/edituser';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "user_id" => $input['idnya_user'],
            "notelp" => $input['edit_phone'],
            "email" => $input['edit_email'],
            "usertype_id" => $input['user_tipe_edit'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);

        if ($json['success'] == true) {
            alert()->success('Successfully to edit data user', 'Updated')->persistent('Done');
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }
} //endclas
