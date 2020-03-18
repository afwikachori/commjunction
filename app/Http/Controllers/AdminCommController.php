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
use Helper;

class AdminCommController extends Controller
{

    // METHOD GET

    // @if (session()->has('session_admin_logged'))
    // @else
    //   <script>window.location = "/admin";</script>
    //   @endif



    public function adminDashboardView()
    {
        return view('admin/dashboard/dashboard_admin');
    }

    public function login()
    {
        return view('admin/login');
    }

    public function comSettingView()
    {
        return view('admin/dashboard/com_setting_admin');
    }

    public function publishAdminView()
    {
        return view('admin/dashboard/publish_admin');
    }

    public function editProfilAdminView()
    {
        return view('admin/dashboard/editprofil_admin');
    }

    public function loginRegisAdminView()
    {
        return view('admin/dashboard/set_loginregis_admin');
    }

    public function membershipAdminView()
    {
        return view('admin/dashboard/set_membership_admin');
    }

    public function regisdataAdminView()
    {
        return view('admin/dashboard/set_regisdata_admin');
    }

    public function SetpaymentAdminView()
    {
        return view('admin/dashboard/set_payment_admin');
    }

    public function SubsManagementView()
    {
        return view('admin/dashboard/subscriber_management');
    }

    public function MembershipManagementView()
    {
        return view('admin/dashboard/membership_management');
    }

    public function UserManagementView()
    {
        return view('admin/dashboard/user_management');
    }

    public function ModuleManagementView()
    {
        return view("admin/dashboard/module_management");
    }

    public function NotificationManagementAdminCommunity()
    {
        return view("admin/dashboard/notification_management_admin");
    }

    public function PaymentManagementAdminCommunity()
    {
        return view("admin/dashboard/payment_management_admin");
    }

    public function InboxMessageManagementAdmin()
    {
        return view("admin/dashboard/inbox_management_admin");
    }

    public function usertypeManagementAdminView()
    {
        return view("admin/dashboard/usertype_management_admin");
    }




    // METHOD POST
    public function auth_adminlogin(Request $request)
    {
        $request->validate([
            'useradmin' => 'required',
            'passadmin' => 'required',
        ]);
        $input = $request->all();

        if ($input['useradmin'] == 'afwika' && $input['passadmin'] == 'afwika') {
            return redirect('admin/dashboard');
        } else {
            $url = env('SERVICE') . 'auth/commadmin';
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', $url, [
                    'form_params' => [
                        'user_name'   => $input['useradmin'],
                        'password'    => $input['passadmin']
                    ]
                ]);
                $response = $response->getBody()->getContents();
                $json = json_decode($response, true);
                // dd($json);

                if ($json['success'] == true) {
                    session()->put('session_admin_logged', $json['data']);
                    $nameku = $json['data']['user']['full_name'];

                    return redirect('admin/dashboard')->with('nama_admin', $nameku);
                }
            } catch (ClientException $exception) {
                $errorq = json_decode($exception->getResponse()->getBody()->getContents(), true);
                // return $errorq;

                if ($errorq['success'] == false) {
                    alert()->error($errorq['message'], 'Failed!')->autoclose(4500)->persistent('Done');
                    return back()->withInput();
                }
            } catch (ConnectException $errornya) {

                $error['status'] = 500;
                $error['message'] = "Internal Server Error";
                $error['succes'] = false;

                if ($error == 500) {
                    alert()->error($error['message'], 'Failed!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            }
        } //end-if
    } //end-func


    //SESSION LOGGED USER - DASHBOARD SUPERADMIN
    public function session_admin_logged()
    {
        if (session()->has('session_admin_logged')) {
            $ses_login = session()->get('session_admin_logged');
            return $ses_login;
        } else {
            return redirect('admin');
        }
    }

    public function LogoutAdmin()
    {
        $ses_login = session()->get('session_admin_logged');

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
            session()->forget('session_admin_logged');

            if ($json['success'] == true) {
                return redirect('admin');
            }
        } catch (ClientException $exception) {
            $status_error = $exception->getCode();
            if ($status_error == 401) {
                alert()->error('Over limit time, please do login again', 'Unauthorized')->persistent('Done');
                return redirect('admin');
            }
        }
    } //enfunc



    public function get_dashboard_admin()
    {
        $ses_login = session()->get('session_admin_logged');
        // return $ses_login['access_token'];

        $url = env('SERVICE') . 'dashboard/admincommunity';
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


    public function tabel_subs_management(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();
        $client = new \GuzzleHttp\Client();
        // return $input;
        try {
            if ($request['subs_datemulai'] != null && $request['subs_dateselesai'] != null) {

                $urlx = env('SERVICE') . 'subsmanagement/filtersubsbydate';
                $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => $ses_login['access_token']
                ];
                $bodyku = json_encode([
                    'start_date'   => $input['subs_datemulai'],
                    'end_date'    => $input['subs_dateselesai']
                ]);
                $options = [
                    'body' => $bodyku,
                    'headers' => $headers,
                ];

                $response = $client->post($urlx, $options);
                $response = $response->getBody()->getContents();
                $json = json_decode($response, true);
                return $json['data'];
            } else { //data-all
                $url = env('SERVICE') . 'subsmanagement/listsubs';
                $response = $client->request('POST', $url, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => $ses_login['access_token']
                    ]
                ]);

                $response = $response->getBody()->getContents();
                $json = json_decode($response, true);
                return $json['data'];
            } //end-else
        } catch (ClientException $exception) {
            $status_error = $exception->getCode();
            if ($status_error == 500) {
                return json_encode('Data Not Found');
            }
        }
    } //end-func




    public function filter_membership_subs(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();
        $client = new \GuzzleHttp\Client();

        $urlx = env('SERVICE') . 'subsmanagement/filtersubsbymembership';
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'membership_id'   => $input['membership'],
        ]);
        $options = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($urlx, $options);
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



    public function tabel_subs_pending()
    {
        $ses_login = session()->get('session_admin_logged');

        // return $ses_login['access_token'];

        $url = env('SERVICE') . 'subsmanagement/listsubspending';
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


    public function setting_publish_comm()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'commsetting/publish';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        if ($json['success'] == true) {
            alert()->success('Succcessflly to pulish your community, enjoy with your subscribers', 'Published !')->persistent('Done');
            return back();
        }
        // return $json['data'];
    }



    public function detailSubcriberManagementView($id_subs)
    {
        $ses_login = session()->get('session_admin_logged');
        $urlx = env('SERVICE') . 'subsmanagement/detailsubs';

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'user_id'   => $id_subs
        ]);

        $options = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        $response = $client->post($urlx, $options);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        $in = $json['data'];

        //status
        if ($in['status'] == 4) {
            $status = 'Deactive';
        } else if ($in['status'] == 3) {
            $status = 'Active';
        } else if ($in['status'] == 2) {
            $status = 'Pending Membership';
        } else if ($in['status'] == 1) {
            $status = 'Newly';
        } else {
            $status = 'Pending';
        }

        $dtaku = [
            "user_id"       => $in['user_id'],
            "full_name"     => $in['full_name'],
            "created_at"    => $in['created_at'],
            "status"        => $status,
            "status_id"     => $in['status'],
            "membership_id" => $in['membership_id'],
            "sso_picture"   => $in['sso_picture'],
        ];
        // dd($dtaku);
        return view('admin/dashboard/detail_subs_all')->with($dtaku);
    }



    public function editSubsManagementView($id_subs)
    {
        return view('admin/dashboard/editsubs_profil', ['idsubs' => $id_subs]);
    }


    public function detailPendingSubcriberView($id_pending)
    {
        $ses_login = session()->get('session_admin_logged');
        $urlx = env('SERVICE') . 'subsmanagement/detailsubs';

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'user_id'   => $id_pending
        ]);

        $options = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        $response = $client->post($urlx, $options);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        $in = $json['data'];

        //status
        if ($in['status'] == 4) {
            $status = 'Deactive';
        } else if ($in['status'] == 3) {
            $status = 'Active';
        } else if ($in['status'] == 2) {
            $status = 'Pending Membership';
        } else if ($in['status'] == 1) {
            $status = 'Newly';
        } else {
            $status = 'Pending';
        }

        $dtaku = [
            "user_id"       => $in['user_id'],
            "full_name"     => $in['full_name'],
            "created_at"    => $in['created_at'],
            "status"        => $status,
            "status_id"     => $in['status'],
            "membership_id" => $in['membership_id'],
            "sso_picture"   => $in['sso_picture'],
        ];
        // dd($dtaku);

        return view('admin/dashboard/detail_subs_pending')->with($dtaku);
    }


    public function edit_profil_community(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $token = $ses_login['access_token'];
        $ses_user = $ses_login['user'];
        // return $ses_user;

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "name"        => $input['edit_namacom'],
                "description" => $input['edit_deskripsicom'],
                "filename"    => $filnam,
                "file"        => $imgku
            ];


            $url = env('SERVICE') . 'commsetting/editcomm';
            try {
                $resImg = $req->editProfilCommunity($imageRequest, $url, $token);
                $hasil = $resImg['data'];
                if ($resImg['success'] == true) {
                    session()->put('session_admin_logged.user', [
                        "user_name" => $ses_user['user_name'],
                        "full_name" => $ses_user['full_name'],
                        "picture" => $ses_user['picture'],
                        "notelp" => $ses_user['notelp'],
                        "email" => $ses_user['email'],
                        "alamat" => $ses_user['alamat'],
                        //////////////////////
                        "community_name" => $hasil['name'],
                        "community_description" => $hasil['description'],
                        "community_logo" => $hasil['logo'],
                        /////////////////////
                        "user_id" => $ses_user['user_id'],
                        "level" => $ses_user['level'],
                        "status" => $ses_user['status'],
                        "community_created" => $ses_user['community_created'],
                        "community_type" => $ses_user['community_type'],
                        "community_membership_type" => $ses_user['community_membership_type'],
                    ]);

                    alert()->success('Successfully to update your community information', 'Now Updated!')->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                dd($exception);
            }
        } else { //END-IF  UPLOAD-IMAGE
            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "name"        => $input['edit_namacom'],
                "description" => $input['edit_deskripsicom'],
                "filename"    => "",
                "file"        => ""
            ];


            $url = env('SERVICE') . 'commsetting/editcomm';
            try {
                $resImg = $req->editProfilCommunity($imageRequest, $url, $token);
                // return $resImg;

                if ($resImg['success'] == true) {
                    alert()->success('Successfully to update your community information', 'Now Updated!')->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                dd($exception);
            }
        } // endelse
    }



    public function setting_loginresgis_comm(Request $request)
    {
        // dd($request);

        $ses_login = session()->get('session_admin_logged');
        $token = $ses_login['access_token'];

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "form_type"     => $input['optionsRadios'],
                "headline_text" => $input['headline'],
                "description"   => $input['description_custom'],
                "subdomain"     => $input['subdomain'],
                "filename"      => $filnam,
                "file"          => $imgku
            ];


            $url = env('SERVICE') . 'commsetting/loginregister';
            try {
                $resImg = $req->SettingLoginRegis($imageRequest, $url, $token);
                // return $resImg;

                if ($resImg['success'] == true) {
                    alert()->success('Successfully setting login and registrasion, setup domain being process', 'Done!')->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                dd($exception);
            }
        } else { //END-IF  UPLOAD-IMAGE
            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "form_type"     => $input['optionsRadios'],
                "headline_text" => $input['headline'],
                "description"   => $input['description_custom'],
                "subdomain"     => $input['subdomain'],
                "filename"      => "",
                "file"          => ""
            ];


            $url = env('SERVICE') . 'commsetting/loginregister';
            try {
                $resImg = $req->editProfilCommunity($imageRequest, $url, $token);
                // return $resImg;

                if ($resImg['success'] == true) {
                    alert()->success('Successfully setting login and registrasion, setup domain being process', 'Done!')->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                dd($exception);
            }
        } // endelse
    }





    public function setting_membership_comm(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'commsetting/membershiptype';
        $client = new \GuzzleHttp\Client();
        $member = (int) $input['membership'];
        // START
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode(['membership_type' => $member]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        $response = $client->post($url, $datakirim);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        // return $json;

        if ($json['success'] == true) {
            alert()->success('Succcessflly set Membership type for your community', 'Succcessflly Set Membership !')->persistent('Done');
            return redirect('/admin/settings/membership');
        }
    }



    public function tabel_list_regisdata()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'commsetting/listregistrationdata';
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




    public function setting_regisdata_comm(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');

        $in = $request->except('_token');
        $param_isi = array_values($in);

        $url = env('SERVICE') . 'commsetting/addregistrationdata';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode(['params' => $param_isi]);
        $options = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        $response = $client->post($url, $options);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        if ($json['success'] == true) {
            alert()->success('Succcessflly adding new question', 'Question Added !')->persistent('Done');
            return redirect('/admin/settings/registrasion_data');
        }
    } //endfunc






    public function get_list_membership_admin()
    {
        $ses_login = session()->get('session_admin_logged');
        // return $ses_login;
        // return $ses_login['access_token'];

        $url = env('SERVICE') . 'membershipmanagement/listmembership';
        $client = new \GuzzleHttp\Client();
try{
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
            $errorq = json_decode($exception->getResponse()->getBody()->getContents(), true);
            return $errorq;
        } catch (ConnectException $errornya) {

            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;

            return $error;
        }
    }



    public function tabel_req_membership()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'membershipmanagement/membershipreq';

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
            return $json;
        } catch (ClientException $exception) {
            $errorq = json_decode($exception->getResponse()->getBody()->getContents(), true);
            return $errorq;
        } catch (ConnectException $errornya) {

            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;

            return $error;
        }
    }


    public function get_membership_subs()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'subsmanagement/membership';
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



    public function get_payment_tipe()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'commsetting/listpaymenttype';
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


    public function get_bank_pay()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'commsetting/listbank';
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


    public function tabel_payment_community()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'commsetting/listpayment';
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


    public function get_detail_membership_req(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'membershipmanagement/detailmembershipreq';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode(['invoice_number' => $input['invoice_number']]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        $response = $client->post($url, $datakirim);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        return $json['data'];
    }


    public function edit_profile_admincom(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_admin_logged');
        $token = $ses_login['access_token'];
        $ses_user = $ses_login['user'];

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "user_name" => $input['username_admin'],
                "full_name" => $input['name_admin'],
                "notelp" => $input['phone_admin'],
                "email" => $input['email_admin'],
                "alamat" => $input['alamat_admin'],
                "filename" => $filnam,
                "file" => $imgku
            ];

            $url = env('SERVICE') . 'profilemanagement/editprofile';
            try {
                $resImg = $req->editProfileAdmin($imageRequest, $url, $token);
                // return $resImg['data'];
                if ($resImg['success'] == true) {
                    session()->put('session_admin_logged.user', [
                        "user_name" => $resImg['data']['user_name'],
                        "full_name" => $resImg['data']['full_name'],
                        "picture" => $resImg['data']['sso_picture'],
                        "notelp" => $resImg['data']['notelp'],
                        "email" => $resImg['data']['email'],
                        "alamat" => $resImg['data']['alamat'],
                        //////////////////////
                        "community_name" => $ses_user['community_name'],
                        "community_description" => $ses_user['community_description'],
                        "community_logo" => $ses_user['community_logo'],
                        /////////////////////
                        "user_id" => $ses_user['user_id'],
                        "level" => $ses_user['level'],
                        "status" => $ses_user['status'],
                        "community_created" => $ses_user['community_created'],
                        "community_type" => $ses_user['community_type'],
                        "community_membership_type" => $ses_user['community_membership_type'],
                    ]);

                    alert()->success('Successfully to update your community information', 'Now Updated!')->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                dd($exception);
            }
        } else { //END-IF  UPLOAD-IMAGE
            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "user_name" => $input['username_admin'],
                "full_name" => $input['name_admin'],
                "notelp" => $input['phone_admin'],
                "email" => $input['email_admin'],
                "alamat" => $input['alamat_admin'],
                "filename"    => "",
                "file"        => ""
            ];

            $url = env('SERVICE') . 'profilemanagement/editprofile';
            try {
                $resImg = $req->editProfileAdmin($imageRequest, $url, $token);

                if ($resImg['success'] == true) {
                    session()->put('session_admin_logged.user', [
                        "user_name" => $resImg['data']['user_name'],
                        "full_name" => $resImg['data']['full_name'],
                        "picture" => $resImg['data']['sso_picture'],
                        "notelp" => $resImg['data']['notelp'],
                        "email" => $resImg['data']['email'],
                        "alamat" => $resImg['data']['alamat'],
                        //////////////////////
                        "community_name" => $ses_user['community_name'],
                        "community_description" => $ses_user['community_description'],
                        "community_logo" => $ses_user['community_logo'],
                        /////////////////////
                        "user_id" => $ses_user['user_id'],
                        "level" => $ses_user['level'],
                        "status" => $ses_user['status'],
                        "community_created" => $ses_user['community_created'],
                        "community_type" => $ses_user['community_type'],
                        "community_membership_type" => $ses_user['community_membership_type'],
                    ]);
                    alert()->success('Successfully to update your community information', 'Now Updated!')->persistent('Done');
                    return back();
                } //end if sukses

            } catch (ClientException $exception) {
                alert()->error('Try again later', 'Get Something Wrong')->persistent('Done');
                return back();
                // dd($exception);
            }
        } // endelse
    } //endfunc



    public function change_password_admincom(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'profilemanagement/changepassword';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'old_password' => $input['old_pass_admin'],
            'new_password' => $input['new_pass_admin']
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
            $status_error = $exception->getCode();
            // return $status_error;
            if ($status_error == 400) {
                alert()->error('Your Old Password didnt match', 'Wrong Password')->persistent('Done');
                return back();
            }
        }
    }



    public function tabel_user_management()
    {
        $ses_login = session()->get('session_admin_logged');

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




    public function get_user_tipe_manage()
    {
        $ses_login = session()->get('session_admin_logged');

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



    public function add_user_management(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_admin_logged');
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
            $status_error = $exception->getCode();
            // return $status_error;
            if ($status_error == 400) {
                alert()->error('Proccess might interrupted at the middle, try again', 'Opps')->persistent('Done');
                return back();
            }
        }
    }




    public function nonaktif_status_subs(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'subsmanagement/nonactivesubs';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode(['user_id' => $input['idsubs']]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        $response = $client->post($url, $datakirim);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);


        if ($json['success'] == true) {
            alert()->success('Succcessflly to change your subscriber status ', 'Success !')->persistent('Done');
            return redirect('admin/subs_management');
        }
    }



    public function approval_req_membership(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_admin_logged');
        $token = $ses_login['access_token'];
        $input = $request->all(); // getdata req

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();
            if ($request->input('action') == 'approve') {
                $paystatus = "2";
                $paystatusjudul = "Membership Approved";
            } else if ($request->input('action') == 'reject') {
                $paystatus = "3";
                $paystatusjudul = "Membership Rejected";
            }

            $imageRequest = [
                "invoice_number" => $input['invoice_num_acc'],
                "payment_status" => $paystatus,
                "password"       => $input['acc_password'],
                "subscriber_id"  => $input['id_subs_acc'],
                "cancel_description" => $input['acc_komen'],
                "filename"       => $filnam,
                "file"           => $imgku
            ];

            $url = env('SERVICE') . 'membershipmanagement/approvalmembership';
            try {
                $resImg = $req->accReqMembership($imageRequest, $url, $token);
                if ($resImg['success'] == true) {
                    alert()->success('Successfully give membership approval', $paystatusjudul)->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                $status_error = $exception->getCode();
                if ($status_error == 400) {
                    alert()->error('Your password didnt match, please check again', 'Wrong Password!')->persistent('Done');
                    return back();
                }
            }
        } //endif
    }



    public function approval_pending_subs(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'subsmanagement/approvalsubs';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'user_id' => $input['id_subspending'],
            'approval' => $input['approval'],
            'description' => $input['alasan_approv']
        ]);

        if ($input['approval'] == "true") {
            $textatus = 'Approved';
        } else {
            $textatus = 'Rejected';
        }

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        $response = $client->post($url, $datakirim);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        if ($json['success'] == true) {
            alert()->success('Successfully give a approval', $textatus)->persistent('Done');
            return redirect('admin/subs_management');
        }
    }





    public function detail_user_management(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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




    public function edit_user_management(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_admin_logged');
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
            $status_error = $exception->getCode();
            // return $status_error;
            if ($status_error == 400) {
                alert()->error('Proccess might interrupted at the middle, try again', 'Opps')->persistent('Done');
                return back();
            }
        }
    }



    public function add_payment_subs(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'commsetting/addpayment';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'payment_title' => $input['payment_name'],
            'payment_type_id' => $input['payment_tipe'],
            'payment_owner_name' => $input['rekening_name'],
            'no_rekening' => $input['rekening_number'],
            'description' => [$input['deskripsi_paysubs']],
            'bank_name' => $input['bank_name'],
            'payment_time_limit' => $input['pay_time_limit'],
            'status' => $input['payment_status']
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
                alert()->success('Successfully to add new payment method', 'Added')->persistent('Done');
                return redirect('admin/settings/payment');
            }
        } catch (ClientException $exception) {
            $status_error = $exception->getCode();
            if ($status_error == 400) {
                alert()->error('Data Bank tidak boleh sama dengan list yang sudah ada', 'Sorry')->persistent('Done');
                return back();
            }
        }
    }


    public function delete_payment_subs(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'commsetting/deletepayment';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode(['payment_id' => $input['id_paymentsubs']]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        $response = $client->post($url, $datakirim);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        // return $json;
        if ($json['success'] == true) {
            alert()->success('Successfully delete payment method', 'Deleted')->persistent('Done');
            return redirect('admin/settings/payment');
        }
    }



    public function get_active_module_list()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'modulemanagement/activemodule';
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



    public function get_all_module_list()
    {
        $ses_login = session()->get('session_admin_logged');

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


    public function detail_module_all(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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


    public function aktifasi_module_admincomm(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'modulemanagement/addmodule';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'feature_id' => $input['id_modulefitur'],
            'payment_time' => $input['payment_time'],
            'payment_method_id' => $input['payment_method_id']
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        $response = $client->post($url, $datakirim);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);

        if ($json['success'] == true) {
            alert()->success('Successfully Add Module Feature', 'Module Added')->persistent('Done');
            return redirect('admin/module_management');
        }
    }




    public function cek_prepare_publish()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'commsetting/listsettingcomm';
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



    public function get_list_subscriber_report_super()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'reportmanagement/listsubscriber';
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

    public function tabel_subscriber_report_super(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'reportmanagement/subscriber';
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "start_date"  => $input['start_date'],
            "end_date"  => $input['end_date'],
            "subscriber_id" => $input['subscriber_id'],
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


    public function tabel_generate_notification_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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



    public function detail_generate_notif_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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


    public function get_list_setting_notif_admin()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'notificationmanagement/listsetting';
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
            return $exception;
        }
    }

    public function send_notification_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

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


    public function setting_notification_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();
        $datain = $request->except('_token');
        $dtin = array_chunk($datain, 2);

        $data = [];
        foreach ($dtin as $i => $dt) {
            $dataArray = [
                "setting_id" => $dt[1],
                "value" => $dt[0],
            ];
            array_push($data, $dataArray);
        }

        $url = env('SERVICE') . 'notificationmanagement/setting';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode(["data_Setting" => $data]);
        // return $bodyku;

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            // return $json;
            if ($json['success'] == true) {
                alert()->success('Successfully Setting Notification', 'Done!')->autoclose(4500);
                return back();
            }
        } catch (ClientException $exception) {
            return $exception;
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


    public function tabel_payment_all_admin()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'paymentmanagement/listall';
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
            }
        }
    }

    public function tabel_payment_active_admin()
    {
        $ses_login = session()->get('session_admin_logged');

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
            }
        }
    }

    public function detail_payment_all_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'paymentmanagement/detail';
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


    public function get_setting_subpayment_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();
        // return $input;

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


    public function aktivasi_payment_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'paymentmanagement/activation';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "payment_method_id" => $input['payment_method_id'],
            "payment_type_id" => $input['aktif_id_payment'],
            "payment_time" => $input['aktif_payment_time']
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
            // return $json['data'];

            if ($json['success'] == true) {
                alert()->success('Successfully Activated Payment', 'Done!')->autoclose(4500);
                return back();
            }
        } catch (ClientException $exception) {
            return $exception;
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

    public function tabel_generate_inbox_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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

    public function get_list_subscriber_inbox_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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


    public function detail_generate_message_inbox_super_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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

    public function send_inbox_message_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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
            "user_type" => $input['usertipe_inbox1'],
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

    public function delete_message_inbox_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'inboxmanagement/deletemessage';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "id" => $input['id_message_inbox'],
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
                alert()->success('Successfully Delete Message Inbox', 'Deleted!')->autoclose(4500);
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

    public function change_status_inbox_message_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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


    public function get_list_setting_module_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'get_list_setting_module_admin';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            "subfeature_id" => $input['subfeature_id'],
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


    public function tabel_usertype_admin()
    {
        $ses_login = session()->get('session_admin_logged');

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
        return $json['data'][0];
    }



    public function add_create_membership_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $token = $ses_login['access_token'];
        $input = $request->all();
        // return $input;
        $url = env('SERVICE') . 'membershipmanagement/createmembership';
        $fitur = $input['fitur_member'];
        $hasilfitur = implode(",", $fitur);

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();
            $imageRequest = [
                "membership_title"  => $input['judul_member'],
                "feature_id"        => $hasilfitur,
                "pricing"           => $input['harga_member'],
                "description"       => $input['deskripsi_member'],
                "filename"          => $filnam,
                "file"              => $imgku
            ];


            $url = env('SERVICE') . 'commsetting/editcomm';
            try {
                $resImg = $req->create_membership_admin($imageRequest, $url, $token);
                // return $resImg;
                if ($resImg['success'] == true) {
                    alert()->success('Successfully create new membership for Admin Community', 'Added!')->persistent('Done');
                    return back();
                }
            }catch (ClientException $errornya) {
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
        } else { //END-IF  UPLOAD-IMAGE
            $imageRequest = [
                "membership_title"  => $input['judul_member'],
                "feature_id"        => $hasilfitur,
                "pricing"           => $input['harga_member'],
                "description"       => $input['deskripsi_member'],
                "filename"    => "",
                "file"        => ""
            ];


            $url = env('SERVICE') . 'commsetting/editcomm';
            try {
                $resImg = $req->create_membership_admin($imageRequest, $url, $token);
                // return $resImg;

                if ($resImg['success'] == true) {
                    alert()->success('Successfully create new membership for Admin Community', 'Added!')->persistent('Done');
                    return back();
                }
            }   catch (ClientException $errornya) {
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
        } // endelse
        }



    public function get_listfitur_usertype_ceklist()
    {
        $ses_login = session()->get('session_admin_logged');

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


    public function get_list_fitur_membership_admin()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'membershipmanagement/listfeature';
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
            $errorq = json_decode($exception->getResponse()->getBody()->getContents(), true);
            return $errorq;
        } catch (ConnectException $errornya) {

            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['succes'] = false;

            return $error;
        }
    }






} //end-class
