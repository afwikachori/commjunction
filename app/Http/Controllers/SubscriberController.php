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
use League\ColorExtractor\Palette;

use Session;
use Alert;
// use RequestHelper;
class SubscriberController extends Controller
{
    use RequestHelper;
    use SendRequestController;

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

    public function NotificationManagementViewSubs()
    {
        return view('subscriber/dashboard/notification_management_subs');
    }

    public function ModuleSettingSubsView()
    {
        return view('subscriber/dashboard/module_setting_subs');
    }

    public function TesEnkripView()
    {
        return view('subscriber/tes_enkrip');
    }


    public function LoginSubscriber(Request $request)
    {
        $validator = $request->validate([
            'input_login' => 'required',
            'pass_subs' => 'required',
            'id_community' => 'required',
        ]);

        $input = $request->all();
        $url = env('SERVICE') . 'auth/commsubs';
        $client = new \GuzzleHttp\Client();
        try {
            // $response = $client->request('POST', $url, [
            //     'form_params' => [
            //         'input'       => $input['input_login'],
            //         'password'    => $input['pass_subs'],
            //         'community_id' => $input['id_community']
            //     ]
            // ]);

            // $response = $response->getBody()->getContents();
            // $json = json_decode($response, true);
            // $jsonlogin = $json['data'];

            $req_input =  [
                'input'       => $input['input_login'],
                'password'    => $input['pass_subs'],
                'community_id' => $input['id_community']
            ];
            $jsonlogin = $this->encryptedPost($request, $req_input, $url, null);
            // return $jsonlogin;
            session()->put('session_subscriber_logged', $jsonlogin);
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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
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

        $datain =  $request->except('_token', 'fullname_subs', 'notlp_subs', 'email_subs', 'username_subs', 'password_subs', 'passconfirm_subs', 'name_community', 'sso_type', 'sso_token', 'community_id');

        // return $datain;
        $dtin = array_chunk($datain, 2);
        $data = [];
        foreach ($dtin as $i => $dt) {
            $dataArray = [
                "param_id" => $dt[0],
                "value" => $dt[1],
            ];
            array_push($data, $dataArray);
        }
        // return $data;

        $url_comname = $input['name_community'];
        $url = env('SERVICE') . 'registration/subscriber';
        try {

            $req_input =  [
                'full_name'     => $input['fullname_subs'],
                'notelp'        => $input['notlp_subs'],
                'email'         => $input['email_subs'],
                'user_name'     => $input['username_subs'],
                'password'      => $input['password_subs'],
                'community_id'  => $input['community_id'],
                "sso_type"      => $input['sso_type'],
                "sso_token"     => $input['sso_token'],
                "custom_input"  => $data
            ];

            $respon_enkrp = $this->encryptedPost($request, $req_input, $url, "array");
            // return $respon_enkrp;
            $respon = json_decode($respon_enkrp, true);

            if ($respon['success'] == true) {
                alert()->success('Your Subscriber registrasion is successfull', 'Yay !');
                $url_sukses = '/subscriber/url/' . $url_comname;
                return back()->with('register_sukses', $url_sukses);
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

            $idkom_auth = $json['data']['id'];

            if (session()->has('session_subscriber_logged')) {
                $ses_loggeduser = session()->get('session_subscriber_logged');
                $idkom_login = $ses_loggeduser['user']['community_id'];
                $username = $ses_loggeduser['user']['user_name'];
                // user_name
                if ($idkom_auth != $idkom_login) {
                    alert()->error('Please logout Subscriber account : ' . $username, 'Failed Switch Community')->persistent('Done');
                    return view('404');
                }
            }
            $portal = $json['data']['cust_portal_login']['image'];
            $bgportal = env('CDN') . '/' . $portal;
            $arr_auth = [];

            $im = @imagecreatefromjpeg($bgportal);
            /* See if it failed */
            if (!$im) {
                $bgportal = asset('img/bg_subs.jpg');
            } else {
                $bgportal = env('CDN') . '/' . $portal;
            }
            // require $bgportal;

            $image = imagecreatefromjpeg($bgportal);
            $thumb = imagecreatetruecolor(1, 1);
            imagecopyresampled($thumb, $image, 0, 0, 0, 0, 1, 1, imagesx($image), imagesy($image));

            $mainColor = strtoupper(dechex(imagecolorat($thumb, 0, 0)));
            $maincolor = '#' . $mainColor;

            $new =  array_merge(["maincolor" => $maincolor], $json['data']);
            array_push($arr_auth, $new);


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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return view('404');
        }
    } //end-func


    public function GetdataSubdomainSubscriber($domain)
    {

        $subdomain = $domain . '.smartcomm.id';
        $url = env('SERVICE') . 'auth/configcommsubdomain';
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'subdomain' => $subdomain
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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return view('404');
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


    public function LogoutSubscriber()
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'profilemanagement/logout';
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
                session()->forget('session_subscriber_logged');
                return 'sukses';
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
            $error['success'] = false;
            return $error;
        }
    } //enfunc

    public function logout_subs_href()
    {
        $ses_login = session()->get('session_subscriber_logged');
        $crsf = "";
        $url = env('SERVICE') . 'profilemanagement/logout';

        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $crsf);

        if ($json['success'] == true) {
            session()->forget('session_subscriber_logged');
            $auth_subs = session()->get('auth_subs');
            $url_subs = '/subscriber/url/' . $auth_subs[0]['name'];
            return redirect($url_subs);
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
        }
    }


    public function edit_profile_subs(Request $request)
    {
        // dd($request);
        $input = $request->all(); // getdata form by name
        $ses_login = session()->get('session_subscriber_logged');
        $token = $ses_login['access_token'];
        $ses_user = $ses_login['user'];

        $req = new RequestController;
        $fileimg = "";


        if ($request->has('alamat_subs')) {
            $alamat = $input['alamat_subs'];
        } else {
            $alamat = "null";
        }

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();


            $imageRequest = [
                "user_name" => $input['username_subs'],
                "full_name" => $input['name_subs'],
                "notelp" => $input['phone_subs'],
                "email" => $input['email_subs'],
                "alamat" => $alamat,
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
                        "picture" => $resImg['data']['image'],
                        "notelp" => $resImg['data']['notelp'],
                        "email" => $resImg['data']['email'],
                        "alamat" => $resImg['data']['alamat'],
                        //////////////////////
                        "community_id" => $ses_user['community_id'],
                        "community_name" => $ses_user['community_name'],
                        "community_description" => $ses_user['community_description'],
                        "community_logo" => $ses_user['community_logo'],
                        "user_id" => $ses_user['user_id'],
                        "supportpal_id" =>  $ses_user['supportpal_id'],
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
                $error['success'] = false;
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
                "alamat" => $alamat,
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
                        "picture" => $ses_user['picture'],
                        "notelp" => $resImg['data']['notelp'],
                        "email" => $resImg['data']['email'],
                        "alamat" => $resImg['data']['alamat'],
                        //////////////////////
                        "community_id" => $ses_user['community_id'],
                        "community_name" => $ses_user['community_name'],
                        "community_description" => $ses_user['community_description'],
                        "community_logo" => $ses_user['community_logo'],
                        "user_id" => $ses_user['user_id'],
                        "supportpal_id" =>  $ses_user['supportpal_id'],
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
                $error['success'] = false;
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

        // $client = new \GuzzleHttp\Client();
        // $headers = [
        //     'Content-Type' => 'application/json',
        //     'Authorization' => $ses_login['access_token']
        // ];
        // $bodyku = json_encode([
        //     'old_password' => $input['old_pass_subs'],
        //     'new_password' => $input['new_pass_subs']
        // ]);

        // $datakirim = [
        //     'body' => $bodyku,
        //     'headers' => $headers,
        // ];

        try {
            // $response = $client->post($url, $datakirim);
            // $response = $response->getBody()->getContents();
            // $json = json_decode($response, true);

            $req_input =  [
                'old_password' => $input['old_pass_subs'],
                'new_password' => $input['new_pass_subs']
            ];
            $jsonlogin = $this->encryptedPost($request, $req_input, $url,  $ses_login['access_token']);
            $respon = json_decode($jsonlogin, true);
            // return $respon['success'];
            if ($respon['success'] == true) {
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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function get_dashboard_news(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/news/lastnews';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'limit' => $input['limit'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function get_list_subcriber_name(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
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


    public function get_list_transaction_tipe(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
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


    public function tabel_transaksi_show(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'transmanagement/listall';

        $input = $request->all();
        $csrf = $input['_token'];

        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            return $error;
        }

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



    public function detail_transaksi_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'transmanagement/detail';

        $input = $request->all();

        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            return $error;
        }
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


    public function get_inbox_navbar_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'inboxmanagement/listmessage';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'status' => "1",
            "notification_status" => "Receive",
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
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
            // return $json['data'];

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
            $error['success'] = false;
            return $error;
        }
    }



    public function change_status_inbox_message_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();

        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed')->persistent('Done');
            return back();
        }
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
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function get_pricing_membership()
    {
        $ses_login = session()->get('session_subscriber_logged');

        $url = env('SERVICE') . 'dashboard/membership';
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
            $error['success'] = false;
            return $error;
        }
    }

    public function show_my_membership(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'dashboard/membership';
        $input = $request->all();
        $csrf = $input['_token'];

        $token = $ses_login['access_token'];
        $dataku = [
            "membership_id" => $input['membership_id'],
        ];

        // return $input;

        try {
            $postdata = $this->post_get_request($dataku, $url, false, $token, $csrf);
            return $postdata['data'];
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

    public function get_payment_initial()
    {
        $ses_login = session()->get('session_subscriber_logged');

        $url = env('SERVICE') . 'dashboard/paymentmethod';
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
            $error['success'] = false;
            return $error;
        }
    }



    public function set_initial_membership_pay(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();
        $url = env('SERVICE') . 'dashboard/payment';
        $client = new \GuzzleHttp\Client();
        // return $input;
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];

        $bodyku = json_encode([
            "membership_id"     => $input['id_membertype'],
            "payment_id" => $input['id_pay_initial'],
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
                alert()->success('Waiting your membership confirmation from Administrator', 'Successfully')->autoclose(4000);
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


    public function get_list_notif_navbar(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'notificationmanagement/listnotification';
        $input = $request->all();

        $body = [
            "read_status"   => (int) $input['read_status'],
            "limit"         => (int) $input['limit'],
        ];
        $csrf = '';

        try {
            $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
            if ($json['success'] == true) {
                return $json['data'];
            } else {
                return $json;
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
            $error['success'] = false;
            return $error;
        }
    }

    public function get_list_notif_management(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'notificationmanagement/listnotification';
        $input = $request->all();


        if ($input['limit'] == 000) {
            $body = [
                "read_status"   => (int) $input['read_status'],
                "limit"         => (int) 27,
            ];
        } else {
            $body = [
                "read_status"       => (int) $input['read_status'],
                "limit"             => (int) $input['limit'],
            ];
        }


        try {
            $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], null);
            if ($json['success'] == true) {
                return $json['data'];
            } else {
                return $json;
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
            $error['success'] = false;
            return $error;
        }
    }



    public function confirm_pay_membership_subs(Request $request)
    {
        $input = $request->all(); // getdata form by name
        // dd($request);
        $validator = $request->validate([
            'invoice_number' => 'required',
            'fileup'     => 'required',
        ]);
        $user_logged = session()->get('session_subscriber_logged');
        $token = $user_logged['access_token'];

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $imageRequest = [
                "invoice_number"     => $input['invoice_number'],
                "filename"    => $filnam,
                "file"        => $imgku
            ];
            // dd($imageRequest);
            $url = env('SERVICE') . 'membershipmanagement/subsupload';
            try {
                $resImg = $req->ConfirmPayMembership_subs($imageRequest, $url, $token);

                if ($resImg['success'] == true) {
                    alert()->success('Successfully upload payment confirmation', 'Sent!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                $errorq = json_decode($exception->getResponse()->getBody()->getContents(), true);

                if ($errorq['success'] == false) {
                    alert()->error($errorq['message'], 'Failed!')->autoclose(4500)->persistent('Done');
                    return back();
                }
            } catch (ConnectException $errornya) {
                $error['status'] = 500;
                $error['message'] = "Internal Server Error";
                $error['success'] = false;

                alert()->error($error['message'], 'Failed!')->autoclose(4500)->persistent('Done');
                return back();
            } catch (ServerException $exception) {
                $error = json_decode($exception->getResponse()->getBody()->getContents(), true);
                return $error;
                alert()->error($error['message'], 'Failed!')->autoclose(4500)->persistent('Done');
                return back();
            }
        } else {
            alert()->error('File is Required', 'Failed!')->autoclose(4500)->persistent('Done');
            return back();
        }
    } //end-function




    public function get_invoice_num_membership(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'transmanagement/findinvoice';
        $input = $request->all();
        // return $input;
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'invoice_number'  => $input['invoice_number'],
            'transaction_type_id'    => $input['transaction_type_id'],
            'community_id'      => $input['community_id'],
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


    public function get_list_setting_notif_subs()
    {
        $ses_login = session()->get('session_subscriber_logged');

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


    public function tabel_generate_notification_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();

        $url = env('SERVICE') . 'notificationmanagement/listnotification';
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


    public function setting_notification_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
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


    public function detail_notif_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
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


    public function get_list_setting_module_subs()
    {
        $ses_login = session()->get('session_subscriber_logged');

        $url = env('SERVICE') . 'dashboard/listsetting';
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


    public function get_friends_total(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/totalfriend';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_friends_sugestion(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/friendsugest';


        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_last_news(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/news/lastnews';


        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'limit' => $input['limit'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_love_news(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/news/toplovenews';


        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'limit' => $input['limit'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function get_topvisit_news(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/news/visitnews';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'limit' => $input['limit'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function get_top_player(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/player/topvisit';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'limit' => $input['limit'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_top_visit_club(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/club/topvisit';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'limit' => $input['limit'],
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }





    public function add_friend_suggest_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/addfriend';

        $input = $request->all();
        $body = [
            "user_id"     => $input['user_id_subs'],
        ];
        $csrf = $input['_token'];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function tes_enkrip(Request $request)
    {
        // dd(env('CDN'));
        $input = $request->all();

        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed')->persistent('Done');
            return back();
        }


        $csrf = $input['_token'];
        $url = env('SERVICE') . 'auth/commsubs';

        $data =  [
            'input'       => $input['input_login'],
            'password'    => $input['pass_subs'],
            'community_id' => $input['id_community']
        ];

        return $this->post_get_request($data, $url, false, null, $csrf);


        // $res_enkkrip = $this->encryptedPost($request, $req_input, $url, null);
        // return $res_enkkrip;
    }

    public function edit_profile_custom_regis(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'profilemanagement/editprofilecustom';

        $input = $request->all();


        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed')->persistent('Done');
            return back();
        }
        // return $input;
        $csrf = $input['_token'];
        $datain =  $request->except('_token');

        $dtin = array_chunk($datain, 2);
        $data = [];
        foreach ($dtin as $i => $dt) {
            $dataArray = [
                "param_id" => $dt[0],
                "value" => $dt[1],
            ];
            array_push($data, $dataArray);
        }
        // return $data;
        $body = [
            "custom_input"  => $data
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            // return $json['data'];
            session()->put('session_subscriber_logged.custom_input', $json['data']);
            alert()->success('Successfully update your profile', 'Now Updated!')->persistent('Done');
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(3500);
            return back();
        }
    }


    function cek_array_multi($myarray)
    {
        if (count($myarray) == count($myarray, COUNT_RECURSIVE)) {
            echo 'MyArray is not multidimensional';
        } else {
            echo 'MyArray is multidimensional';
        }
    }
} //end-class
