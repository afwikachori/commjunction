<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;
use Session;

class RequestController extends Controller{

	   public function sendImage($requestImage,$url)
    {	

    	
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $client = new \GuzzleHttp\Client();

        $request = $client->request('POST',$url,[
            'multipart' => [
                 [
                    'name'     => 'directory',
                    'contents' =>  $requestImage["directory"]
                ],
                [
                    'name'    => 'file',
                    'contents'  => $requestImage["image"],
                    'filename'=> $requestImage["filename"]
                ]
            ]
        ]);

        $data = json_decode($request->getBody()->getContents(),true);
        return $data;
    }



       public function sendImagePayConfirm($requestImage,$url){   

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

        $request = $client->request('POST',$url,[
            'multipart' => [
                [
                    'name'     => 'nama',
                    'contents' =>  $requestImage["nama"]
                ],
                 [
                    'name'     => 'invoice_number',
                    'contents' =>  $requestImage["invoice_number"]
                ],
                 [
                    'name'     => 'payment_method',
                    'contents' =>  $requestImage["payment_method"]
                ],
                 [
                    'name'     => 'payment_bank_name',
                    'contents' =>  $requestImage["payment_bank_name"]
                ],
                 [
                    'name'     => 'payment_owner_name',
                    'contents' =>  $requestImage["payment_owner_name"]
                ],
                [
                    'name'     => 'nominal',
                    'contents' =>  $requestImage["nominal"]
                ],
                [
                    'name'      => 'file',
                    'contents'  => $requestImage["file"],
                    'filename'  => $requestImage["filename"]
                ]
            ]
        ]);


        $data = json_decode($request->getBody()->getContents(),true);
        return $data;
    }

}
