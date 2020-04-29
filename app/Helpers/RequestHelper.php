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
        // dd($input);
        if ($token == null) {
            $headers = [
                'Content-Type' => 'application/json',
                'Encrypt_rsa' => 'true'
            ];
        } else {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => $token,
                'Encrypt_rsa' => 'true'
            ];
        }

        $body = $this->encrypt($input);
        $bodyku = json_encode([
            "data"     => $body,
        ]);

        $datakirim = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        // dd($datakirim);

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

        if ($data == '{}') {
            return  json_encode(["success" => "true"]);
        } else {
            return json_decode($data, true);
        }
    }


    private function encrypt($plain)
    {
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
