<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;

trait SendRequestController
{

    function post_get_request($data, $url, $get, $token, $csrf)
    {

        $client = new \GuzzleHttp\Client();

        $headers = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $token
            ]
        ];

        $datakirim = [
            'body' => json_encode($data),
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $token
            ]
        ];


        // ------ $get -------
        // true = header + url
        // false = header + body + url
        // "getdata" = body + url
        // null = url

        try {
            if ($get == true) {
                $response = $client->post($url, $headers);
            } else if ($get == false) {
                $response = $client->post($url, $datakirim);
            } else if ($get == "getdata") {
                $response = $client->post($url, ['form_params'  => $data]);
            } else {
                $response = $client->post($url);
            }


            $ini = $response->getBody()->getContents();
            $json = json_decode($ini, true);

            return $json;
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Server bermasalah";
            $error['success'] = false;
            $error['error'] = true;
            return $error;
        }
    }


    public function formdata_nobody($url, $token)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $token
            ],
        ]);
        try {
            $json = json_decode($request->getBody()->getContents(), true);
            return $json;
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Server bermasalah";
            $error['success'] = false;
            $error['error'] = true;
            return $error;
        }
    }


    function is_html($string)
    {
        if(is_array($string) != 1){
            return preg_match("/<[^<]+>/", $string, $m) != 0;
        }
    }

    function cek_tag_html($input, $sendmethod)
    {
        $jum = 0;
        if ($input != null && $input != "") {

            foreach ($input as $key => $value) {
                $ini = $this->is_html($value);
                if ($ini == TRUE) {
                    $jum++;
                }
            }
            return $jum;
        }
    }
} //end-traits
