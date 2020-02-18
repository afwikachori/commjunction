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

    public function UserTypeView(){
        return view('superadmin/usertype_management_super');
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
        session()->forget('session_logged_superadmin');
        return redirect('superadmin');
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
        // return $input;
        $req = new RequestController;
        $fileimg = "";
        $imgku = file_get_contents($request->file('fileup')->getRealPath());
        $filnam = $request->file('fileup')->getClientOriginalName();
        $url = env('SERVICE') . 'modulemanagement/addfeature';

        if ($request->hasFile('fileup')) {
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
            return $resImg['data']['feature_id'];
            // if ($resImg['success'] == true) {
            //     alert()->success('Successfully setting login and registrasion, setup domain being process', 'Done!')->persistent('Done');
            //     return back();
            // }
        } catch (ClientException $exception) {
            dd($exception);
        }
    }
} //endclas
