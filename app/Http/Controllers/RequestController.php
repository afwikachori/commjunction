<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;
use Session;

class RequestController extends Controller
{

    public function NotFoundView()
    {
        return view('404');
    }

    public function sendImage($requestImage, $url)
    {


        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $client = new \GuzzleHttp\Client();

        $request = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => 'directory',
                    'contents' =>  $requestImage["directory"]
                ],
                [
                    'name'    => 'file',
                    'contents'  => $requestImage["image"],
                    'filename' => $requestImage["filename"]
                ]
            ]
        ]);

        $data = json_decode($request->getBody()->getContents(), true);
        return $data;
    }



    public function sendImagePayConfirm($requestImage, $url)
    {

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

        $request = $client->request('POST', $url, [
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


        $data = json_decode($request->getBody()->getContents(), true);
        return $data;
    }




    public function sendImgVerify($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

        $request = $client->request('POST', $url, [
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

        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }


    public function editProfilCommunity($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

        $request = $client->request('POST', $url, [
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

        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }



    public function editProfileAdmin($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

        $request = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'user_name',
                    'contents' =>  $requestImage["user_name"]
                ],
                [
                    'name'     => 'full_name',
                    'contents' =>  $requestImage["full_name"]
                ],
                [
                    'name'     => 'notelp',
                    'contents' =>  $requestImage["notelp"]
                ],
                [
                    'name'     => 'email',
                    'contents' =>  $requestImage["email"]
                ],
                [
                    'name'     => 'alamat',
                    'contents' =>  $requestImage["alamat"]
                ],
                [
                    'name'      => 'file',
                    'contents'  => $requestImage["file"],
                    'filename'  => $requestImage["filename"]
                ]
            ],

        ]);

        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }


    public function SettingLoginRegis($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

        $request = $client->request('POST', $url, [
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

        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }


    public function accReqMembership($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

        $request = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'invoice_number',
                    'contents' =>  $requestImage["invoice_number"]
                ],
                [
                    'name'     => 'payment_status',
                    'contents' =>  $requestImage["payment_status"]
                ],
                [
                    'name'     => 'subscriber_id',
                    'contents' =>  $requestImage["subscriber_id"]
                ],
                [
                    'name'     => 'cancel_description',
                    'contents' =>  $requestImage["cancel_description"]
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

        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }

    public function upload_image_module($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

        $request = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'title',
                    'contents' =>  $requestImage["title"]
                ],
                [
                    'name'     => 'description',
                    'contents' =>  $requestImage["description"]
                ],
                [
                    'name'     => 'feature_type_id',
                    'contents' =>  $requestImage["feature_type_id"]
                ],
                [
                    'name'      => 'file',
                    'contents'  => $requestImage["file"],
                    'filename'  => $requestImage["filename"]
                ]
            ],

        ]);

        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }




    public function sendImgUploadPricing($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

        $request = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'title',
                    'contents' =>  $requestImage["title"]
                ],
                [
                    'name'     => 'description',
                    'contents' =>  $requestImage["description"]
                ],
                [
                    'name'     => 'grand_pricing',
                    'contents' =>  $requestImage["grand_pricing"]
                ],
                [
                    'name'     => 'price_annual',
                    'contents' =>  $requestImage["price_annual"]
                ],
                [
                    'name'     => 'price_monthly',
                    'contents' =>  $requestImage["price_monthly"]
                ],
                [
                    'name'     => 'pricing_type',
                    'contents' =>  $requestImage["pricing_type"]
                ],
                [
                    'name'     => 'feature_id',
                    'contents' =>  $requestImage["feature_id"]
                ],
                [
                    'name'      => 'file',
                    'contents'  => $requestImage["file"],
                    'filename'  => $requestImage["filename"]
                ]
            ],

        ]);

        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }

    public function sendImgEditPricing($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

        $request = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'title',
                    'contents' =>  $requestImage["title"]
                ],
                [
                    'name'     => 'description',
                    'contents' =>  $requestImage["description"]
                ],
                [
                    'name'     => 'grand_pricing',
                    'contents' =>  $requestImage["grand_pricing"]
                ],
                [
                    'name'     => 'price_annual',
                    'contents' =>  $requestImage["price_annual"]
                ],
                [
                    'name'     => 'price_monthly',
                    'contents' =>  $requestImage["price_monthly"]
                ],
                [
                    'name'     => 'pricing_type',
                    'contents' =>  $requestImage["pricing_type"]
                ],
                [
                    'name'     => 'feature_id',
                    'contents' =>  $requestImage["feature_id"]
                ],
                [
                    'name'     => 'pricing_id',
                    'contents' =>  $requestImage["pricing_id"]
                ],
                [
                    'name'     => 'status',
                    'contents' =>  $requestImage["status"]
                ],
                [
                    'name'      => 'file',
                    'contents'  => $requestImage["file"],
                    'filename'  => $requestImage["filename"]
                ]
            ],

        ]);

        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }



    public function addSubPaymentSuper($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();
        // dd($requestImage);

        $request = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'payment_title',
                    'contents' =>  $requestImage["payment_title"]
                ],
                [
                    'name'     => 'description',
                    'contents' =>  $requestImage["description"]
                ],
                [
                    'name'     => 'bank_name',
                    'contents' =>  $requestImage["bank_name"]
                ],
                [
                    'name'     => 'no_rekening',
                    'contents' =>  $requestImage["no_rekening"]
                ],
                [
                    'name'     => 'payment_owner_name',
                    'contents' =>  $requestImage["payment_owner_name"]
                ],
                [
                    'name'     => 'payment_time_limit',
                    'contents' =>  $requestImage["payment_time_limit"]
                ],
                [
                    'name'     => 'payment_type_id',
                    'contents' =>  $requestImage["payment_type_id"]
                ],
                [
                    'name'      => 'file',
                    'contents'  => $requestImage["file"],
                    'filename'  => $requestImage["filename"]
                ]
            ],

        ]);

        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }

} //END_CLASS
