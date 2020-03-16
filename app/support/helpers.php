<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Session;

// $data : json data request
// $url : api backend
// $get : true : get without data , false : using data
// $roleuser : isi session by jenis user

function insert_get($data, $url, $get, $roleuser)
{
    $client = new Client([
        'headers' => [
            'Content-Type' => 'application/json',
            'authorization' => Session::get($roleuser)
        ]
    ]);

    try {
        if ($get == true) {
            $response = $client->request('POST', $url);
        } else {
            $response = $client->post(
                $url,
                ['body' => json_encode($data)]
            );
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
        $error['succes'] = false;

        return $error;
    }
}

?>
