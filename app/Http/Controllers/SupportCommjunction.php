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
            "community_id" => (int)$input['community_id'],
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



} //END-CLASS
