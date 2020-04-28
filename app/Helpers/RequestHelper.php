<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use GuzzleHttp\Client;

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
        $this->publicKeyPath = storage_path('keys/public.key');
        $this->privateKeyPath = storage_path('keys/private.key');

        $this->client = new Client([
            'base_uri' => env('API_URL')
        ]);

        $this->asset = new Client([
            'base_uri' => env('CDN_URL')
        ]);
    }

    public function encryptedPost(Request $request, $input, $endpoint)
    {
        $body = $this->encrypt($enc);
        $headers = [
            'Authorization' => 'Bearer '.$this->getToken(true),
            'Content-Type' => 'application/json'
        ];

        $request = $this->$client->post($endpoint, [
            'json' => [
                'data' => $body
            ]
        ]);
        $encrypted = json_decode($request->getBody()->getContents(), true)['data'];

        $response = $this->decrypt($encrypted);

        return response()->json($result);
    }

    private function encrypt($plain){
        $openPubKey = fopen($this->publicKeyPath, "r");
        $readPubKey = fread($openPubKey, 8192);

        $pubKey = openssl_pkey_get_public($readPubKey);
        $pubKeyDetails = openssl_pkey_get_details($publicKey);

        // there are 11 bytes overhead for PKCS1 padding
        $encChunkSize = ceil($pubKeyDetails['bits'] / 8) - 11;

        // loop through the long plain text, and divide by chunks
        $output = '';

        while ($plain) {
            $chunk = substr($plain, 0, $encChunkSize);
            $plain = substr($plain, $encChunkSize);
            $encrypted = '';

            if (!openssl_public_encrypt($chunk, $encrypted, $public_key, OPENSSL_PKCS1_OAEP_PADDING))
                die('Failed to encrypt data');

            $output .= $encrypted;
        }

        openssl_free_key($public_key);
        return base64_encode($output);
    }

    private function decrypt($encrypted){
        $privateKey = openssl_pkey_get_private(file_get_contents($this->privateKeyPath)

        $encrypted = base64_decode($encrypted);
        $a_key = openssl_pkey_get_details($privateKey);

        // Decrypt the data in the small chunks
        $chunkSize = ceil($a_key['bits'] / 8);
        $output = '';

        while ($encrypted)
        {
            $chunk = substr($encrypted, 0, $chunkSize);
            $encrypted = substr($encrypted, $chunkSize);
            $decrypted = '';
            if (!openssl_private_decrypt($chunk, $decrypted, $privateKey, OPENSSL_PKCS1_OAEP_PADDING))
            {
                die('Failed to decrypt data');
            }
            $output .= $decrypted;
        }
        openssl_free_key($privateKey);

        return $output;
    }
}
