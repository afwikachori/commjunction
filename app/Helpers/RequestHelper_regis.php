<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client as Client;

// use GuzzleHttp\Client;

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

    public function __construct()
    {
        $this->publicKeyPath = storage_path('keys/public.pem');
        $this->privateKeyPath = storage_path('keys/private.pem');

        $this->client = new Client([
            'base_uri' => env('API_URL')
        ]);

        $this->asset = new Client([
            'base_uri' => env('CDN_URL')
        ]);
    }

    public function encryptedPost(Request $request, $input, $endpoint, $token)
    {

        // return $input;
        if ($token == null) {
            $headers = [
                'Content-Type' => 'application/json',
                'Encrypt_rsa' => 'true'
            ];
            $body = $this->encrypt($input);
        } else if ($token == "regis_admin") {
            $headers = [
                'Content-Type' => 'application/json',
                'Encrypt_rsa' => 'true'
            ];
            $body = $this->encrypt_regis($input);
        } else {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => $token,
                'Encrypt_rsa' => 'true'
            ];
            $body = $this->encrypt($input);
        }

        // return $body;

        $bodyku = json_encode([
            "data"     => $body,
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];

        if ($token == "regis_admin") {
            // return $datakirim;
            $leng =  count($body);
            if ($leng > 1) {
                $data = '';
                foreach ($body  as $i => $dt) {
                    $encrypted = $this->dekrip_proses(json_encode($body[$i]));
                    $data .= $encrypted;
                }
            } else {
                $data = $this->dekrip_proses(json_encode($body));
            }
            return $data;
        } else {
            $client = new \GuzzleHttp\Client();
            $request = $client->post($endpoint, $datakirim);
            $response = $request->getBody()->getContents();
            $dt_dekrip = json_decode($response, true);


            $leng =  count($dt_dekrip['data']);
            if ($leng > 1) {
                $data = '';
                foreach ($dt_dekrip['data'] as $i => $dt) {
                    $encrypted = $this->decrypt(json_encode($dt_dekrip['data'][$i]));
                    $data .= $encrypted;
                }
            } else {
                $data = $this->decrypt(json_encode($dt_dekrip['data']));
            }

            return $data;

            if ($data == '{}') {
                return  json_encode(["success" => "true"]);
            } else {
                return json_decode($data, true);
            }
        } //regisadmin
    }


    private function encrypt_regis($plain)
    {

        // _________________
        $data = '';
        $arr = [];
        foreach ($plain as $i => $item) {
            $encrypted = json_encode([$i => $item]);
            if ($i == 'community') {
                $res = '{' . substr($encrypted, 1);
            } else {
                $res = substr($encrypted, 1) . ',';
            }



            if ($i != 'payment') {
                if ($i == 'admin') {
                    $res = substr($res, 0, -2) . ',';
                } else if ($i == 'feature') {
                    $res = substr($res, 0, -2) . ',';
                } else {
                    $res = substr($res, 0, -1) . ',';
                }
            } else {
                $res = substr($res, 0, -1);
            }
            array_push($arr, $this->proses_enkrip($res));
            // $data .= $this->proses_enkrip($res);
        }
        return $arr;
        // ______________________
        // $community =  json_encode(["community" => $plain['community']]);
        // $community = substr($community, 2);
        // $community = substr($community, 0, -1) . ',';

        // $admin =  json_encode(["admin" => $plain['admin']]);
        // $admin = substr($admin,2);
        // $admin = substr($admin, 0, -1) . ',';

        // $feature =  json_encode(["feature" => $plain['feature']]);
        // $feature = substr($feature,2);
        // $feature = substr($feature, 0, -1) . ',';

        // $payment =  json_encode(["payment" => $plain['payment']]);
        // $payment = substr($payment, 2);
        // $payment = substr($payment, 0, -1);

        // $community2 = $this->proses_enkrip($community);
        // $admin2 = $this->proses_enkrip($admin);
        // $feature2 = $this->proses_enkrip($feature);
        // $payment2 = $this->proses_enkrip($payment);


        // $dta = [$community2, $admin2, $feature2, $payment2];
        // return $dta;
    }


    private function proses_enkrip($plain)
    {
        // return $plain;
        $openPubKey = fopen($this->publicKeyPath, "r");
        $readPubKey = fread($openPubKey, 8192);

        $pubKey = openssl_pkey_get_public($readPubKey);
        $pubKeyDetails = openssl_pkey_get_details($pubKey);

        $encChunkSize = ceil($pubKeyDetails['bits'] / 8) - 11;
        $output = '';

        $plain = json_encode($plain);

        while ($plain) {
            $chunk = substr($plain, 0, $encChunkSize);
            $plain = substr($plain, $encChunkSize);
            $encrypted = '';

            if (!openssl_public_encrypt($chunk, $encrypted, $pubKey, OPENSSL_PKCS1_OAEP_PADDING)) {
                die('Failed to encrypt data');
            }
            $output .= $encrypted;
        }

        openssl_free_key($pubKey);
        return base64_encode($output);
    }



    private function dekrip_proses($encrypted)
    {
        $privateKey = openssl_pkey_get_private(file_get_contents($this->privateKeyPath));
        // dd($encrypted);
        // $encrypted = json_encode($encrypted);
        // dd($encrypted);
        $encrypted = base64_decode($encrypted);
        // dd($encrypted);

        $a_key = openssl_pkey_get_details($privateKey);

        // Decrypt the data in the small chunks
        $chunkSize = ceil($a_key['bits'] / 8);
        $output = '';

        // $encrypted = json_encode($encrypted);
        while ($encrypted) {
            $chunk = substr($encrypted, 0, $chunkSize);
            $encrypted = substr($encrypted, $chunkSize);
            $decrypted = '';
            if (!openssl_private_decrypt($chunk, $decrypted, $privateKey, OPENSSL_PKCS1_OAEP_PADDING)) {
                die('Failed to decrypt data');
            }
            $output .= json_decode($decrypted, true);
        }
        openssl_free_key($privateKey);

        return $output;
    }


    private function encrypt($plain)
    {
        // return $plain;
        $openPubKey = fopen($this->publicKeyPath, "r");
        $readPubKey = fread($openPubKey, 8192);

        $pubKey = openssl_pkey_get_public($readPubKey);
        $pubKeyDetails = openssl_pkey_get_details($pubKey);

        // there are 11 bytes overhead for PKCS1 padding
        $encChunkSize = ceil($pubKeyDetails['bits'] / 8) - 11;

        // loop through the long plain text, and divide by chunks
        $output = '';

        $plain = json_encode($plain);

        while ($plain) {
            $chunk = substr($plain, 0, $encChunkSize);
            $plain = substr($plain, $encChunkSize);
            $encrypted = '';

            if (!openssl_public_encrypt($chunk, $encrypted, $pubKey, OPENSSL_PKCS1_OAEP_PADDING)) {
                die('Failed to encrypt data');
            }
            $output .= $encrypted;
        }

        openssl_free_key($pubKey);
        return base64_encode($output);
    }


    private function decrypt($encrypted)
    {
        $privateKey = openssl_pkey_get_private(file_get_contents($this->privateKeyPath));
        // dd($encrypted);
        // $encrypted = json_encode($encrypted);
        // dd($encrypted);
        $encrypted = base64_decode($encrypted);
        // dd($encrypted);

        $a_key = openssl_pkey_get_details($privateKey);

        // Decrypt the data in the small chunks
        $chunkSize = ceil($a_key['bits'] / 8);
        $output = '';

        // $encrypted = json_encode($encrypted);
        while ($encrypted) {
            $chunk = substr($encrypted, 0, $chunkSize);
            $encrypted = substr($encrypted, $chunkSize);
            $decrypted = '';
            if (!openssl_private_decrypt($chunk, $decrypted, $privateKey, OPENSSL_PKCS1_OAEP_PADDING)) {
                die('Failed to decrypt data');
            }
            $output .= $decrypted;
        }
        openssl_free_key($privateKey);

        return $output;
    }
}
