<?php

/*===================== Helpers =================================
| File untuk fungsi2 get dan post menggunakan guzzle
|----------------------------------------------------------------
| FE Vascom Malang
| Juni 2020
| HCIS Ceklok
|

*/

namespace App\support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;

use GuzzleHttp\Cookie\SessionCookieJar;

use Carbon\Carbon;

trait RequestHelper
{
    private $client;
    private $clientId;
    private $clientSecret;
    private $headers;

    private $publicKeyPath;
    private $privateKeyPath;

    private $token;


    // ---------------------------------------------------------------------------------------
    // FUNGSI HIT API
    // ---------------------------------------------------------------------------------------

    // --------------------------------- Fungsi Insert Gambar ------------------------------------
    public function insertFile($data, $url,$method='POST')
    {
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'auth' => [
                'X=CMuMH2%KhGpQdnnkmCTxo55t%q8a7q',
                ''
            ]
        ]);
        
        try {
            $response = $client->request(
                $method,
                $url,
                 ['form_params' => $data]
            );

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
            $error['error'] = true;

            return $error;
        }
    }
    // ----------------X---------------- Fungsi Insert Gambar -----------------X------------------

    // --------------------------------- fungsi Inset Get ----------------------------------------
    public function insertGet($data, $url, $body = false, $method = 'POST')
    {
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'auth' => [
                'X=CMuMH2%KhGpQdnnkmCTxo55t%q8a7q',
                ''
            ]
        ]);

        try {
            if ($body == true) {
                $response = $client->request($method, $url);
                if($method=='PUT'){
                    $response = $client->request($method, $url,['form_params' => $data]);
                }
            } else {
                $response = $client->request($method, $url,['body' => json_encode($data)]);
                // if($method=='PUT'){
                //     $response = $client->request($method, $url,['form_params' => $data]);
                // }
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
            $error['error'] = true;

            return $error;
        }
    }

    // ---------------x----------------- fungsi Inset Get --------------------x------------------
}
