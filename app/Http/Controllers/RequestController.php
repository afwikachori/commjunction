<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;
use Session;

class RequestController extends Controller{

public function NotFoundView(){
    return view('404');
}

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




    public function sendImgVerify($requestImage,$url,$token){  

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

            $request = $client->request('POST',$url,[
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'invoice',
                    'contents' =>  $requestImage["invoice"]
                ],
                [
                    'name'     => 'password',
                    'contents' =>  $requestImage["password"]
                ],
                [
                    'name'      => 'file',
                    'contents'  => $requestImage["file"],
                    'filename'  => $requestImage["filename"]
                ]
            ],
            
        ]);

        $dataku = json_decode($request->getBody()->getContents(),true);
        return $dataku;
    }


       public function editProfilCommunity($requestImage,$url,$token){  

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

            $request = $client->request('POST',$url,[
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'name',
                    'contents' =>  $requestImage["name"]
                ],
                [
                    'name'     => 'description',
                    'contents' =>  $requestImage["description"]
                ],
                [
                    'name'      => 'file',
                    'contents'  => $requestImage["file"],
                    'filename'  => $requestImage["filename"]
                ]
            ],
            
        ]);

        $dataku = json_decode($request->getBody()->getContents(),true);
        return $dataku;
    }


    public function SettingLoginRegis($requestImage,$url,$token){  

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

            $request = $client->request('POST',$url,[
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'form_type',
                    'contents' =>  $requestImage["form_type"]
                ],
                [
                    'name'     => 'headline_text',
                    'contents' =>  $requestImage["headline_text"]
                ],
                [
                    'name'     => 'description',
                    'contents' =>  $requestImage["description"]
                ],
                [
                    'name'     => 'subdomain',
                    'contents' =>  $requestImage["subdomain"]
                ],
                [
                    'name'      => 'file',
                    'contents'  => $requestImage["file"],
                    'filename'  => $requestImage["filename"]
                ]
            ],
            
        ]);

        $dataku = json_decode($request->getBody()->getContents(),true);
        return $dataku;
    }



}
