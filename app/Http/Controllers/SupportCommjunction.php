<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\BadResponseException;
use Session;
use Alert;
use Helper;

class SupportCommjunction extends Controller
{
    public function __construct()
    {
        $this->middleware(['XFrameOptions']);
    }

    public function OpeningSupportView()
    {
        return view('support/index_support');
    }

    public function InquirySpecificView()
    {
        return view('support/inquiry_specific');
    }


    public function InquiryLogActivityView()
    {
        return view('support/inquiry_log_activity');
    }


    public function ReactivateDeactivateView()
    {
        return view('support/reactivate_deactivate');
    }

    public function knowledgeSupportView()
    {
        return view('support/knowledge_support');
    }

    public function SubdomainSupportView()
    {
        return view('support/subdomain_support');
    }

    public function ResetPassSupportView()
    {
        return view('support/resetpass_support');
    }


    public function ResetFailedAttemptSupportView()
    {
        return view('support/resetfailed_attempt');
    }

    public function ResendMailSupportView()
    {
        return view('support/resend_mail_support');
    }








    public function get_list_komunitas_support(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();


        $url = env('SERVICE') . 'operationalsupportsystem/listcommunity';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "community_status" => $input['community_status'],
        ]);

        if ($input['community_status'] == "all") {
            $datakirim = [
                'headers' => $headers,
            ];
        } else {
            $datakirim = [
                'body' => $bodyku,
                'headers' => $headers,
            ];
        }

        // dd($datakirim);

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
            $error['succes'] = false;
            return $error;
        }
    }



    public function get_list_subfeature_support(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();


        $url = env('SERVICE') . 'operationalsupportsystem/listsubfeature';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "feature_id" => $input['feature_id'],
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
            $error['succes'] = false;
            return $error;
        }
    }


    public function get_list_feature_support()
    {
        $user_logged = session()->get('session_logged_superadmin');

        $url = env('SERVICE') . 'operationalsupportsystem/listfeature';
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => $user_logged['access_token']
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



    public function get_list_endpoint_support(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/listendpoint';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
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


    public function get_list_subscriber_support(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/listsubscriber';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "community_id" => (int) $input['community_id'],
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
            $error['succes'] = false;
            return $error;
        }
    }

    public function get_list_admin_support(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/listadmincommunity';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "community_id" => (int) $input['community_id'],
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
            $error['succes'] = false;
            return $error;
        }
    }


    public function tabel_inquiry_log_activity(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();
        // return $input;

        $url = env('SERVICE') . 'operationalsupportsystem/inquiryactivitylog';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "community_id" => $input['community_id'],
            "start_date" => $input['start_date'],
            "end_date" => $input['end_date'],
            "endpoint" => $input['endpoint'],
            "activity_type" => $input['activity_type'],
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

    public function tabel_inquiry_spesific_com(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();
        // return $input;

        $url = env('SERVICE') . 'operationalsupportsystem/inquiryspecific';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "community_id" => $input['community_id'],
            "activity_type" => $input['activity_type'],
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
            return $json['data'][0]['last_activity'];
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



    public function change_status_reactive(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $token = $ses_login['access_token'];
        $url = env('SERVICE') . 'operationalsupportsystem/reactivateordeactivatecommunity';

        if ($request->has('status_active') && $input['status_active'] == "on") {
            $reactive = "true";
        } else {
            $reactive = "false";
        }

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "comment"       => $input['acc_komen'],
                "active"        => $reactive,
                "community_id"  => $input['id_komunitas'],
                "filename"      => $filnam,
                "file"          => $imgku
            ];


            try {
                $resImg = $req->change_status_reactive($imageRequest, $url, $token);

                if ($resImg['success'] == true) {
                    alert()->success('Successfully update status', 'Updated!')->persistent('Done');
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
                $error['succes'] = false;
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } else {
            alert()->error("File Confirmation is Required", 'Failed!')->autoclose(4500);
            return back()->withInput();
        } // endelse
    }


    public function change_reactive_subscriber(Request $request)
    {
        $ses_login = session()->get('session_logged_superadmin');
        $input = $request->all();
        $token = $ses_login['access_token'];
        $url = env('SERVICE') . 'operationalsupportsystem/reactivateordeactivatesubscriber';

        if ($request->has('status_active_subs') && $input['status_active_subs'] == "on") {
            $reactive = "true";
        } else {
            $reactive = "false";
        }

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "comment"       => $input['acc_komen_subs'],
                "active"        => $reactive,
                "community_id"  => $input['id_komunitas_subs'],
                "subscriber_id"  => $input['id_subs'],
                "filename"      => $filnam,
                "file"          => $imgku
            ];


            try {
                $resImg = $req->change_reactive_subscriber($imageRequest, $url, $token);

                if ($resImg['success'] == true) {
                    alert()->success('Successfully update status subscriber', 'Updated!')->autoclose(4500);
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
                $error['succes'] = false;
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } else {
            alert()->error("File Confirmation is Required", 'Failed!')->autoclose(4500);
            return back()->withInput();
        } // endelse
    }



    public function tabel_knowledge_support(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/listknowledge';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $datakirim = [
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
            $error['succes'] = false;
            return $error;
        }
    }



    public function add_knowledge_support(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/createknowledge';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];

        if ($request->has('list_feature')) {
            $fitur =  $input['list_feature'];
        } else {
            $fitur = "";
        }
        if ($request->has('list_subfeature')) {
            $subfitur =  $input['list_subfeature'];
        } else {
            $subfitur = "";
        }

        $bodyku = json_encode([
            "date" => $input['tanggal'],
            "feature_id" => $fitur,
            "subfeature_id" => $subfitur,
            "feature_type" => $input['feature_type'],
            "feature_description" => $input['deskripsi_fitur'],
            "kondisi" => $input['kondisi'],
            "analisis" => $input['analisis'],
            "solusi" => $input['solusi'],
            "title" => $input['judul'],
            "error_level" => $input['error_level'],
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
                alert()->success('Successfully create new knowledge', 'Added!')->autoclose(4500);
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
            $error['succes'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function edit_knowledge_support(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();
// return $input;
        $url = env('SERVICE') . 'operationalsupportsystem/editknowledge';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];

        if ($request->has('list_feature')) {
            $fitur =  $input['edit_list_feature'];
        } else {
            $fitur = "";
        }
        if ($request->has('list_subfeature')) {
            $subfitur =  $input['edit_list_subfeature'];
        } else {
            $subfitur = "";
        }

        $bodyku = json_encode([
            "knowledge_id" => $input['edit_knowledge_id'],
            "date" => $input['edit_tanggal'],
            "feature_id" => $fitur,
            "subfeature_id" => $subfitur,
            "feature_type" => $input['edit_feature_type'],
            "feature_description" => $input['edit_deskripsi_fitur'],
            "kondisi" => $input['edit_kondisi'],
            "analisis" => $input['edit_analisis'],
            "solusi" => $input['edit_solusi'],
            "title" => $input['edit_judul'],
            "error_level" => $input['edit_error_level'],
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
                alert()->success('Successfully edit knowledge', 'Edited!')->autoclose(4500);
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
            $error['succes'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function delete_knowledge_support(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();
        // return $input;
        $url = env('SERVICE') . 'operationalsupportsystem/deleteknowledge';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];


        $bodyku = json_encode([
            "knowledge_id" => $input['id_knowledge'],
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
                alert()->success('Successfully delete knowledge', 'Deleted!')->autoclose(4500);
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
            $error['succes'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function change_status_subdomain(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();
        // return $input;

        if($input['status_domain'] == "true"){
            $statusdomain = true;
        }else{
            $statusdomain = false;
        }

        $url = env('SERVICE') . 'operationalsupportsystem/updatestatussubdomain';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];


        $bodyku = json_encode([
            "community_id" => (int)$input['id_community'],
            "status" => $statusdomain,
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
            // return $json;
            if ($json['success'] == true) {
                alert()->success('Successfully change status domain', 'Status Updated!')->autoclose(4500);
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
            $error['succes'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    public function reset_pass_share_otp(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();
        // return $input;
        $url = env('SERVICE') . 'operationalsupportsystem/resetpassword';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];


        $bodyku = json_encode([
            "community_id" => $input['id_komunitas'],
            "user_type" => $input['user_tipe'],
            "user_id" => $input['user_id'],
            "data_otp" => $input['text_OTP'],
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
                alert()->success('Successfully Force Reset Password', 'Reset!')->autoclose(4500);
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
            $error['succes'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }



    public function get_random_otp(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();
// return $input;
        $url = env('SERVICE') . 'operationalsupportsystem/sendotp';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "community_id" => (int) $input['community_id'],
            "user_type" => (int) $input['user_type'],
            "user_id" => $input['user_id'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $datakirim);
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


    public function reset_attempt_otp(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/resetotp';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "community_id" => (int) $input['community_id'],
            "email" =>  $input['email'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $datakirim);
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


    public function reset_attempt_login(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/resetlogin';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "community_id" => (int) $input['community_id'],
            "user_type" =>  (int) $input['user_type'],
            "user_id" =>  $input['user_id'],
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

    public function resend_mail_otp_admin(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/resendotp';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "email" =>  $input['email'],
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


    public function resend_invoice_payment_admin(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/resendinvoiceactivationpayment';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "email" =>  $input['email'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $datakirim);
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

    public function resend_invoice_regis_community(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/resendinvoiceregistration';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "email" =>  $input['email'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $datakirim);
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


    public function resend_invoice_module_admin(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/resendinvoiceactivationmodule';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "email" =>  $input['email'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $datakirim);
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


    public function resend_invoice_membership_subs(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/resendinvoicemembership';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "email" =>  $input['email'],
            "community_id" =>  $input['community_id'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $datakirim);
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



    public function resend_membership_approv_subs(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/resendmembershipapproval';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "email" =>  $input['email'],
            "community_id" =>  $input['community_id'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $datakirim);
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



    public function resend_mail_subs_approv(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/resendsubscriberapproval';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "email" =>  $input['email'],
            "community_id" =>  $input['community_id'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $datakirim);
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



    public function resend_mail_subs_nonaktif(Request $request)
    {
        $user_logged = session()->get('session_logged_superadmin');
        $input = $request->all();

        $url = env('SERVICE') . 'operationalsupportsystem/resendsubscribernonaktif';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $user_logged['access_token']
        ];
        $bodyku = json_encode([
            "email" =>  $input['email'],
            "community_id" =>  $input['community_id'],
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        try {
            $response = $client->post($url, $datakirim);
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


} //END-CLASS
