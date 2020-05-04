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
                    'name'     => 'status',
                    'contents' =>  $requestImage["status"]
                ],
                [
                    'name'     => 'cancel_description',
                    'contents' =>  $requestImage["cancel_description"]
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
                    'name'     => 'headline_text',
                    'contents' =>  $requestImage["headline_text"]
                ],
                [
                    'name'     => 'description',
                    'contents' =>  $requestImage["description"]
                ],
                [
                    'name'     => 'font_headline',
                    'contents' =>  $requestImage["font_headline"]
                ],
                [
                    'name'     => 'font_link',
                    'contents' =>  $requestImage["font_link"]
                ],
                [
                    'name'     => 'base_color',
                    'contents' =>  $requestImage["base_color"]
                ],
                [
                    'name'     => 'accent_color',
                    'contents' =>  $requestImage["accent_color"]
                ],
                [
                    'name'      => 'file',
                    'contents'  => $requestImage["file"],
                    'filename'  => $requestImage["filename"]
                ],
                [
                    'name'      => 'icon',
                    'contents'  => $requestImage["icon"],
                    'filename'  => $requestImage["filename_logo"]
                ],
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


    public function editSubPaymentSuper($requestImage, $url, $token)
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
                    'name'     => 'payment_method_id',
                    'contents' =>  $requestImage["payment_method_id"]
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


    public function create_membership_admin($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();
        $request = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'membership_title',
                    'contents' =>  $requestImage["membership_title"]
                ],
                [
                    'name'     => 'subfeature_id',
                    'contents' =>  $requestImage["subfeature_id"]
                ],
                [
                    'name'     => 'pricing',
                    'contents' =>  $requestImage["pricing"]
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


    public function ConfirmPayMembership_subs($requestImage, $url, $token)
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
                    'name'      => 'file',
                    'contents'  => $requestImage["file"],
                    'filename'  => $requestImage["filename"]
                ]
            ],

        ]);

        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }




    public function editNews($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();
        $reqcollect = [

            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'title',
                    'contents' =>  $requestImage["title"]
                ],
                [
                    'name'     => 'content',
                    'contents' =>  $requestImage["content"]
                ],
                [
                    'name'      => 'image',
                    'contents'  => $requestImage["image"],
                    'filename'  => $requestImage["filename"]
                ],
                [
                    'name'     => 'news_id',
                    'contents' =>  $requestImage["id"]
                ],
                [
                    'name'     => 'scala',
                    'contents' =>  $requestImage["scala"]
                ],
                [
                    'name'     => 'url',
                    'contents' =>  $requestImage["url"]
                ]
            ]
        ];

        $request = $client->request('POST', $url, $reqcollect);
        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }

    public function AddNews($requestImage, $url, $token)
    {

        $client = new \GuzzleHttp\Client();

        $reqcollect = [

            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'title',
                    'contents' =>  $requestImage["title"]
                ],
                [
                    'name'     => 'content',
                    'contents' =>  $requestImage["content"]
                ],
                [
                    'name'      => 'image',
                    'contents'  => $requestImage["image"],
                    'filename'  => $requestImage["filename"]
                ],
                [
                    'name'     => 'scala',
                    'contents' =>  $requestImage["scala"]
                ],
                [
                    'name'     => 'url',
                    'contents' =>  $requestImage["url"]
                ]
            ]
        ];


        $request = $client->request('POST', $url, $reqcollect);
        $dataku = json_decode($request->getBody()->getContents(), true);
        return $dataku;
    }

    public function change_status_reactive($requestImage, $url, $token)
    {
        // dd($requestImage);
        $client = new \GuzzleHttp\Client();
        $request = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'comment',
                    'contents' =>  $requestImage["comment"]
                ],
                [
                    'name'     => 'active',
                    'contents' =>  $requestImage["active"]
                ],
                [
                    'name'     => 'community_id',
                    'contents' =>  $requestImage["community_id"]
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


    public function change_reactive_subscriber($requestImage, $url, $token)
    {
        // dd($requestImage);
        $client = new \GuzzleHttp\Client();
        $request = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $token
            ],
            'multipart' => [
                [
                    'name'     => 'comment',
                    'contents' =>  $requestImage["comment"]
                ],
                [
                    'name'     => 'active',
                    'contents' =>  $requestImage["active"]
                ],
                [
                    'name'     => 'community_id',
                    'contents' =>  $requestImage["community_id"]
                ],
                [
                    'name'     => 'subscriber_id',
                    'contents' =>  $requestImage["subscriber_id"]
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
