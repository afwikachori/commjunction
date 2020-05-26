<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\BadResponseException;
use App\Helpers\RequestHelper;

use App\Http\Controllers\SendRequestController;

use Session;
use Alert;
use Helper;

class AdminCommController extends Controller
{
    use RequestHelper;
    use SendRequestController;

    public function adminDashboardView()
    {
        return view('admin/dashboard/dashboard_admin');
    }

    public function login()
    {
        return view('admin/login');
    }

    public function CommunitySettingsView()
    {
        return view('admin/dashboard/community_setting');
    }

    public function publishAdminView()
    {
        return view('admin/dashboard/publish_admin');
    }

    public function editProfilAdminView()
    {
        return view('admin/dashboard/editprofil_admin');
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

    public function TransactionManagementViewAdmin()
    {
        return view("admin/dashboard/transaction_management_admin");
    }

    public function ModuleReportManagementView()
    {
        return view("admin/dashboard/module_report_management_admin");
    }

    public function ReportManagementViewAdmin()
    {
        return view("admin/dashboard/report_management_admin");
    }


    // METHOD POST
    public function auth_adminlogin(Request $request)
    {
        $request->validate([
            'useradmin' => 'required',
            'passadmin' => 'required',
        ]);
        $input = $request->all();

        $url = env('SERVICE') . 'auth/commadmin';
        try {
            $req_input =  [
                'user_name'   => $input['useradmin'],
                'password'    => $input['passadmin']
            ];

            $json = $this->encryptedPost($request, $req_input, $url, null);
            // return $json;

            session()->put('session_admin_logged', $json);
            $nameku = $json['user']['full_name'];

            return redirect('admin/dashboard')->with('nama_admin', $nameku);
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back()->withInput();
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back()->withInput();
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Server bermasalah";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back()->withInput();
        }
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

    public function LogoutAdmin(Request $request)
    {
        $input = $request->all();
        $crsf = $input['_token'];

        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'profilemanagement/logout';


        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $crsf);

        if ($json['success'] == true) {
            session()->forget('session_admin_logged');
            return 'sukses';
        } else {
            return $json;
        }
    }



    public function get_dashboard_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'dashboard/admincommunity';

        $input = $request->all();
        $csrf = $input['_token'];

        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function tabel_subs_management(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        if ($request['subs_datemulai'] != null && $request['subs_dateselesai'] != null) {
            $urlx = env('SERVICE') . 'subsmanagement/filtersubsbydate';

            $body = json_encode([
                'start_date'   => $input['subs_datemulai'],
                'end_date'    => $input['subs_dateselesai']
            ]);
            $csrf = $input['_token'];

            $json = $this->post_get_request($body, $urlx, false, $ses_login['access_token'], $csrf);
            if ($json['success'] == true) {
                return $json['data'];
            } else {
                return $json;
            }
        } else { //data-all
            $url2 = env('SERVICE') . 'subsmanagement/listsubs';
            $csrf = $input['_token'];
            $json = $this->post_get_request(null, $url2, true, $ses_login['access_token'], $csrf);
            if ($json['success'] == true) {
                return $json['data'];
            } else {
                return $json;
            }
        } //end-else
    }




    public function filter_membership_subs(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'subsmanagement/filtersubsbymembership';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = json_encode([
            'membership_id'   => $input['membership'],
        ]);

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function tabel_subs_pending(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'subsmanagement/listsubspending';
        $input = $request->all();
        $csrf = $input['_token'];

        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);

        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function setting_publish_comm()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'commsetting/publish';
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

            if ($json['success'] == true) {
                $stpublish = array("status_publish" => 3);
                $status_publish =  array_merge($ses_login, $stpublish);
                session()->put('session_admin_logged', $status_publish);

                alert()->success('Succcessflly to pulish your community, enjoy with your subscribers', 'Published !')->persistent('Done');
                return redirect('/admin/community_setting');
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

        try {
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

        try {
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


    public function edit_profil_community(Request $request)
    {
        // dd($request);
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
                "_token"      => $input["_token"],
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
        } else { //END-IF  UPLOAD-IMAGE
            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "name"        => $input['edit_namacom'],
                "description" => $input['edit_deskripsicom'],
                "_token"      => $input["_token"],
                "filename"    => "",
                "file"        => ""
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
        } // endelse
    }



    public function setting_loginresgis_comm(Request $request)
    {
        // dd($request);
        $input = $request->all();
        $ses_login = session()->get('session_admin_logged');
        $token = $ses_login['access_token'];
        // return $input;

        $req = new RequestController;
        $fileimg = "";
        if ($request->hasFile('fileup') && $request->hasFile('fileup_logo')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $img_icon = file_get_contents($request->file('fileup_logo')->getRealPath());
            $filnam_logo = $request->file('fileup_logo')->getClientOriginalName();

            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "headline_text" => $input['headline'],
                "description"   => $input['description_custom'],
                "font_headline" => $input['font_headline'],
                "font_link" => $input['font_link'],
                "base_color" => $input['color_base'],
                "accent_color" => $input['color_accent'],
                "icon"      => $img_icon,
                "file"          => $imgku,
                "filename"  => $filnam,
                "filename_logo"  => $filnam_logo,
            ];
            // dd($imageRequest);
            $url = env('SERVICE') . 'commsetting/setcustominterface';
            try {
                $resImg = $req->SettingLoginRegis($imageRequest, $url, $token);

                if ($resImg['success'] == true) {
                    // alert()->success('Successfully setting login and registrasion, setup domain being process', 'Done!')->persistent('Done');
                    // return back();
                    if ($input['form_tipe'] != null && $input['subdomain'] != null) {
                        $url_domain = env('SERVICE') . 'commsetting/setformtypeandsubdomain';
                        $client = new \GuzzleHttp\Client();
                        $headers = [
                            'Content-Type' => 'application/json',
                            'Authorization' => $ses_login['access_token']
                        ];
                        $bodyku = json_encode([
                            "form_type"     => $input['form_tipe'],
                            "subdomain"     => $input['subdomain'] . '.smartcomm.id',
                        ]);

                        $dtsend = [
                            'body' => $bodyku,
                            'headers' => $headers,
                        ];

                        try {
                            $response = $client->post($url_domain, $dtsend);
                            $response = $response->getBody()->getContents();
                            $json = json_decode($response, true);
                            if ($resImg['success'] == true) {
                                alert()->success('Successfully setting login and registrasion, setup domain being process', 'Done!')->persistent('Done');
                                return back();
                            }
                        } catch (ClientException $errornya) {
                            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                            alert()->error($error['message'], 'Failed!')->autoclose(4500);
                            return back()->withInput();
                        } catch (ServerException $errornya) {
                            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                            alert()->error($error['message'], 'Failed!')->autoclose(4500);
                            return back()->withInput();
                        } catch (ConnectException $errornya) {
                            $error['status'] = 500;
                            $error['message'] = "Server bermasalah";
                            $error['success'] = false;
                            alert()->error($error['message'], 'Failed!')->autoclose(4500);
                            return back()->withInput();
                        }
                    } else {
                        alert()->error('Set Login type and Subdomain', 'Failed!')->persistent('Done');
                        return back();
                    }
                }
            } catch (ClientException $errornya) {
                $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                alert()->error($error['message'], 'Failed!')->persistent('Done');
                return back();
            } catch (ServerException $errornya) {
                $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                alert()->error($error['message'], 'Failed!')->persistent('Done');
                return back();
            } catch (ConnectException $errornya) {
                $error['status'] = 500;
                $error['message'] = "Server bermasalah";
                $error['success'] = false;
                alert()->error($error['message'], 'Failed!')->persistent('Done');
                return back();
            }
        } else { //END-IF  UPLOAD-IMAGE
            alert()->error('File Logo & Image portal is Required', 'Failed!')->persistent('Done');
            return back();
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

        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            if ($json['success'] == true) {
                alert()->success('Succcessflly set Membership type for your community', 'Succcessflly Set Membership !')->persistent('Done');
                return redirect('/admin/community_setting');
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



    public function tabel_list_regisdata(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'commsetting/listregistrationdata';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }




    public function add_regisdata_comm(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();
        $in = $request->except('_token', 'deskripsi_regis');

        if ($input['tipedata_regis'] == "2" || $input['tipedata_regis'] == "3" || $input['tipedata_regis'] == "4" || $input['tipedata_regis'] == "5") {
            $param_isi = [$input['question_regis'], $input['tipedata_regis']];
        } else {
            $param_isi = array_values($in);
        }

        $url = env('SERVICE') . 'commsetting/addregistrationdata';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'params' => $param_isi,
            'title' => $input['question_regis'],
            'description' => $input['deskripsi_regis']
        ]);

        // return $bodyku;

        $options = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $options);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            if ($json['success'] == true) {
                alert()->success('Succcessflly adding new question', 'Question Added !')->persistent('Done');
                return redirect('/admin/community_setting');
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
    } //endfunc


    public function get_status_com_publish(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'commsetting/commstatus';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function get_list_membership_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'membershipmanagement/listmembership';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_list_custum_inputipe(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'commsetting/listcustominput';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }




    public function tabel_req_membership(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'membershipmanagement/membershipreq';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_membership_subs(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'subsmanagement/membership';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function get_payment_tipe(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'commsetting/listpaymenttype';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_bank_pay(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'commsetting/listpaymentcommjunction';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'payment_type_id' => $input['payment_type_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function tabel_payment_community(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'commsetting/listpayment';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_detail_membership_req(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'membershipmanagement/detailmembershipreq';

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


    public function edit_profile_admincom(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $token = $ses_login['access_token'];
        $ses_user = $ses_login['user'];
        $input = $request->all(); // getdata form by name
        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('alamat_admin')) {
            $alamat = $input['alamat_admin'];
        } else {
            $alamat = "null";
        }

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();


            $imageRequest = [
                "user_name" => $input['username_admin'],
                "full_name" => $input['name_admin'],
                "notelp" => $input['phone_admin'],
                "email" => $input['email_admin'],
                "alamat" => $alamat,
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
        } else { //END-IF  UPLOAD-IMAGE
            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "user_name" => $input['username_admin'],
                "full_name" => $input['name_admin'],
                "notelp" => $input['phone_admin'],
                "email" => $input['email_admin'],
                "alamat" => $alamat,
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
        } // endelse
    } //endfunc



    public function change_password_admincom(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'profilemanagement/changepassword';


        try {
            // $response = $client->post($url, $datakirim);
            // $response = $response->getBody()->getContents();
            // $json = json_decode($response, true);
            $req_input =  [
                'old_password' => $input['old_pass_admin'],
                'new_password' => $input['new_pass_admin']
            ];
            $jsonlogin = $this->encryptedPost($request, $req_input, $url, $ses_login['access_token']);
            $respon = json_decode($jsonlogin, true);
            // return $respon;
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



    public function tabel_user_management(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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




    public function get_user_tipe_manage(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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



    public function add_user_management(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'usermanagement/createuser';


        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "full_name" => $input['name_user'],
            "user_name" => $input['username_user'],
            "notelp" => $input['phone_user'],
            "email" => $input['email_user'],
            "alamat" => $input['alamat_user'],
            "usertype_id" => $input['user_tipe'],
            "password" => $input['pass_user'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            alert()->success('Successfully to add new user', 'Added')->persistent('Done');
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }




    public function nonaktif_status_subs(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'subsmanagement/nonactivesubs';
        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'user_id' => $input['idsubs']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            alert()->success('Succcessflly to change your subscriber status ', 'Success !')->persistent('Done');
            return redirect('admin/subs_management');
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }



    public function approval_req_membership(Request $request)
    {
        // dd($request);
        $ses_login = session()->get('session_admin_logged');
        $token = $ses_login['access_token'];
        $input = $request->all(); // getdata req
        // return $input;
        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {

            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $paystatusjudul = "";
            $paystatus = "";

            if ($input['action'] == 'approve') {
                $paystatus = "2";
                $paystatusjudul = "Membership Approved";
            } else if ($input['action'] == 'reject') {
                $paystatus = "3";
                $paystatusjudul = "Membership Rejected";
            }


            if ($input['invoice_num_acc'] == "Free") {
                $invnum = 0;
            } else {
                $invnum = $input['invoice_num_acc'];
            }

            $imageRequest = [
                "invoice_number" => $invnum,
                "payment_status" => $paystatus,
                "password"       => $input['acc_password'],
                "subscriber_id"  => $input['id_subs_acc'],
                "cancel_description" => $input['acc_komen'],
                "_token"         => $input['_token'],
                "filename"       => $filnam,
                "file"           => $imgku
            ];

            // dd($imageRequest);

            $url = env('SERVICE') . 'membershipmanagement/approvalmembership';
            try {
                $resImg = $req->accReqMembership($imageRequest, $url, $token);
                if ($resImg['success'] == true) {
                    alert()->success('Successfully give membership approval', $paystatusjudul)->persistent('Done');
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
        } else {
            alert()->error('File verification is required', 'Failed!')->autoclose(4500);
            return back();
        }
    }



    public function approval_pending_subs(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'subsmanagement/approvalsubs';

        $input = $request->all();
        $csrf = $input['_token'];

        if ($input['approval'] == "true") {
            $appv = true;
            $textatus = 'Approved';
        } else {
            $appv = false;
            $textatus = 'Rejected';
        }

        if ($appv == false && $input['alasan_approv'] == null) {
            alert()->error('Field reason for rejection is required', 'Can Not Null')->autoclose(4500);
            return back();
        } else {
            $body = [
                'user_id' => $input['id_subspending'],
                'approval' => $appv,
                'description' => $input['alasan_approv']
            ];


            $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
            if ($json['success'] == true) {
                alert()->success('Successfully give a approval', $textatus)->persistent('Done');
                return redirect('admin/subs_management');
            } else {
                alert()->error($json['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        }
    }





    public function detail_user_management(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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




    public function edit_user_management(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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
            'payment_type_id' => $input['payment_tipe'],
            'payment_owner_name' => $input['rekening_name'],
            'no_rekening' => $input['rekening_number'],
            'payment_method_id' => $input['bank_name'],
            'payment_time_limit' => $input['pay_time_limit'],
            'status' => $input['payment_status']
        ]);
        // return $bodyku;

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        // return $datakirim;
        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);

            if ($json['success'] == true) {
                alert()->success('Successfully to add new payment method', 'Added')->persistent('Done');
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
        try {
            $response = $client->post($url, $datakirim);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            // return $json;
            if ($json['success'] == true) {
                alert()->success('Successfully delete payment method', 'Deleted')->persistent('Done');
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



    public function get_active_module_list(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'modulemanagement/activemodule';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function get_all_module_list(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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


    public function detail_module_all(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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


    public function aktifasi_module_admincomm(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'modulemanagement/addmodule';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'feature_id' => $input['id_modulefitur'],
            'payment_time' => $input['payment_time_module'],
            'payment_method_id' => $input['id_pay_method_module']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            alert()->success('Successfully Add Module Feature', 'Activated')->persistent('Done');
            return redirect('admin/module_management');
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }




    public function cek_prepare_publish(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'commsetting/listsettingcomm';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function get_list_subscriber_report_super()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'reportmanagement/listsubscriber';
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
            $error = json_decode($exception->getResponse()->getBody()->getContents(), true);
            $status_error = $exception->getCode();
            if ($status_error == 500) {
                return json_encode('Data Not Found');
            } else {
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


    public function tabel_generate_notification_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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



    public function detail_generate_notif_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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


    public function get_list_setting_notif_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'notificationmanagement/listsetting';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function send_notification_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $validator = $request->validate([
            'judul_notif' => 'required',
            'usertipe_notif' => 'required',
            'deksripsi_notif' => 'required',
            'subtipe_notif' => 'required',
            'tipenotif' => 'required',
        ]);


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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
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
        $bodyku = json_encode(["data_setting" => $data]);
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


    public function tabel_payment_all_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'paymentmanagement/listall';
        $client = new \GuzzleHttp\Client();

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function tabel_payment_active_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'paymentmanagement/listallactive';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function detail_payment_all_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'paymentmanagement/detail';

        $input = $request->all();
        $csrf = $input['_token'];

        if ($input['status'] == "true") {
            $tat = true;
        } else {
            $tat = false;
        }

        $body = [
            "payment_id" => (int) $input['payment_id'],
            "level_status" => (int) $input['level_status'],
            "status" => $tat
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_setting_subpayment_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'paymentmanagement/listsetting';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "payment_method_id" => $input['payment_method_id'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
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
            "payment_method_id" => $input['id_pay_method_module'],
            "payment_type_id" => $input['aktif_id_payment'],
            "payment_time" => $input['payment_time_module']
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

    public function tabel_generate_inbox_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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

    public function get_list_subscriber_inbox_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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


    public function detail_generate_message_inbox_super_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
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
                alert()->success('Successfully Change Status Message Inbox', 'Changed!')->autoclose(4000);
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


    public function get_list_setting_module_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'modulemanagement/listsetting';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "feature_id" => $input['feature_id'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function tabel_usertype_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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



    public function add_create_membership_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $token = $ses_login['access_token'];
        $input = $request->all();

        $url = env('SERVICE') . 'membershipmanagement/createmembership';

        if ($request->has('fitur_member')) {
            $fitur = $input['fitur_member'];
        } else {
            alert()->error('Features is required', 'Can Not Null!')->autoclose(4500);
            return back();
        }
        $hasilfitur = implode(",", $fitur);

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();
            $imageRequest = [
                "membership_title"  => $input['judul_member'],
                "subfeature_id"        => $hasilfitur,
                "pricing"           => $input['harga_member'],
                "description"       => $input['deskripsi_member'],
                "_token"            => $input['_token'],
                "filename"          => $filnam,
                "file"              => $imgku
            ];
        } else {
            $imageRequest = [
                "membership_title"  => $input['judul_member'],
                "subfeature_id"        => $hasilfitur,
                "pricing"           => $input['harga_member'],
                "description"       => $input['deskripsi_member'],
                "_token"            => $input['_token'],
                "filename"          => "",
                "file"              => "",
            ];
        }
        // dd($imageRequest);

        try {
            $resImg = $req->create_membership_admin($imageRequest, $url, $token);
            if ($resImg['success'] == true) {
                alert()->success('Successfully create new membership for Admin Community', 'Added!')->persistent('Done');
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



    public function get_listfitur_usertype_ceklist(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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


    public function get_list_fitur_membership_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'membershipmanagement/listfeature';
        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function add_new_usertype_management_admin(Request $request)
    {
        $request->validate([
            'nama_usertipe' => 'required',
            'dekripsi_usertipe' => 'required',
            'subfitur' => 'required',
        ]);

        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'usertype/create';

        $input = $request->all();
        $csrf = $input['_token'];

        $subftr = [];
        foreach ($input['subfitur'] as $i => $dt) {
            $dataArray = [
                'subfeature_id'       => $dt
            ];
            array_push($subftr, $dataArray);
        }
        $body = [
            'title' => $input['nama_usertipe'],
            'description' => $input['dekripsi_usertipe'],
            'subfeature' => $subftr,
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            alert()->success($json['message'], 'Successfully!')->autoclose(4500);
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }

    public function get_list_komunitas()
    {
        $ses_login = session()->get('session_admin_logged');

        $url = env('SERVICE') . 'transmanagement/listcommunity';
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


    public function get_list_transaction_tipe(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();
        $user = $ses_login['user'];
        $comid = $user['community_id'];
        $url = env('SERVICE') . 'transmanagement/listsubscriber';

        $csrf = $input['_token'];
        $body = [
            'community_id' => $comid

        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function edit_setting_regisdata_comm(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();
        $in = $request->except('_token', 'id_question', 'deskripsi_regis');

        // return $input;

        if ($request->exists('edit_tipedata')) {
            if ($input['edit_tipedata'] == "2" || $input['edit_tipedata'] == "3" || $input['edit_tipedata'] == "4" || $input['edit_tipedata'] == "5") {
                $param_isi = [$input['edit_question'], $input['edit_tipedata']];
            } else {
                $param_isi = array_values($in);
            }
        } else {
            alert()->error('Input Type is Required', 'Can Not Null!')->autoclose(4000);
            return back();
        }

        // return $param_isi;

        $url = env('SERVICE') . 'commsetting/editregistrationdata';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'params' => $param_isi,
            "id"     =>  $input['id_question'],
            'title' => $input['edit_question'],
            'description' => $input['edit_deskripsi_regis']
        ]);
        // return $bodyku;
        $options = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        try {
            $response = $client->post($url, $options);
            $response = $response->getBody()->getContents();
            $json = json_decode($response, true);
            if ($json['success'] == true) {
                alert()->success($json['message'], 'Question Updated!')->autoclose(4500);
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
    } //endfunc


    public function tabel_transaksi_show(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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
        $ses_login = session()->get('session_admin_logged');
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

    public function get_list_user_notif_super(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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


    public function edit_payment_subs(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'commsetting/editpayment';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'payment_owner_name' => $input['edit_rekening_name'],
            'no_rekening' => $input['edit_rekening_number'],
            'payment_id' => $input['id_subs_payment']
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
                alert()->success('Successfully Edit Payment', 'Updated')->persistent('Done');
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


    public function tabel_report_transaksi_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'reportmanagement/commreporttrans';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "start_date"  => $input['start_date'],
            "end_date"  => $input['end_date'],
            "transaction_type_id"  => $input['transaction_type_id'],
            "transaction_status"  => $input['transaction_status'],
            "min_transaction"  => $input['min_transaction'],
            "max_transaction"  => $input['max_transaction'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function tabel_concile_report_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'reportmanagement/commreconcile';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "transaction_type_id"  => $input['transaction_type_id'],
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


    public function get_list_transaction_type_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
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

    public function get_list_subscriber_report(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'reportmanagement/listsubscriber';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function tabel_report_subscriber_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'reportmanagement/subscriber';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            "start_date"  => $input['start_date'],
            "end_date"  => $input['end_date'],
            "subscriber_id"  => $input['subscriber_id'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function get_result_setup_comsetting(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'commsetting/listsettingcomm';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function send_setting_module_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'modulemanagement/settingmodule';

        $datain = $request->except('_token');
        $dtin = array_chunk($datain, 2);
        $data = [];
        foreach ($dtin as $i => $dt) {
            $dataArray = [
                "setting_id" => $dt[0],
                "value" => $dt[1],
            ];
            array_push($data, $dataArray);
        }
        $input = $request->all();
        $csrf = $input['_token'];
        $body = [
            "data_setting" => $data
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            alert()->success('Successfully Setting up Module', 'Succesfully')->persistent('Done');
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function edit_usertype_management_admin(Request $request)
    {
        $request->validate([
            'nama_usertipe_edit' => 'required',
            'dekripsi_usertipe_edit' => 'required',
            'edit_subfitur' => 'required',
        ]);
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'usertype/edit';
        $subftr = [];

        $input = $request->all();
        $csrf = $input['_token'];

        foreach ($input['edit_subfitur'] as $i => $dt) {
            $dataArray = [
                'subfeature_id'       => $dt
            ];
            array_push($subftr, $dataArray);
        }

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


    public function detail_tabel_subpayment(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'paymentmanagement/detailsubpayment';

        $input = $request->all();
        $csrf = $input['_token'];

        if ($input['status'] == "true") {
            $stat = true;
        } else {
            $stat = false;
        }

        $body = [
            "subpayment_id" => (int) $input['subpayment_id'],
            "level_status" => (int) $input['level_status'],
            "status" => $stat
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_payment_module(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'modulemanagement/paymenttype';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }




    public function setting_subpayment_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $datain = $request->except('_token');
        // return $datain;
        $dtin = array_chunk($datain, 2);

        $data = [];
        foreach ($dtin as $i => $dt) {
            $dataArray = [
                "setting_id" => $dt[0],
                "value" => $dt[1],
            ];
            array_push($data, $dataArray);
        }

        $url = env('SERVICE') . 'paymentmanagement/setting';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode(["data_setting" => $data]);
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
                alert()->success('Successfully Setting up Payment', 'Succesfully')->autoclose(4500);
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


    public function get_list_notif_navbar(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'notificationmanagement/listnotification';

        $input = $request->all();
        $csrf = $input['_token'];
        $body = [
            'community_id'  => $input['community_id'],
            'start_date'    => $input['start_date'],
            'end_date'      => $input['end_date'],
            "read_status"   => $input['read_status'],
            "notification_status" => $input['notification_status'],
            "limit"         => $input['limit'],
            "notification_type" => "1"
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }
} //end-class
