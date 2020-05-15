<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\BadResponseException;
use Session;
use Alert;
use Helper;

class ModuleController extends Controller
{

    //MODULE CLASS - NEWS

    public function NewsManagementView()
    {
        return view('admin/dashboard/news_management');
    }

    public function NewsList()
    {
        return view('subscriber/dashboard/news_management');
    }



    public function get_all_news()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/listall';

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }

    public function getHeadlineNews()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/headlinenews';
        //dd($ses_login['access_token']);
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $ses_login['access_token']
            ]
        ]);

        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        return $json['data'];
    }

    public function tabel_news_management()
    {

        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/listall';
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => $ses_login['access_token']
                ]
            ]);

            $response = $response->getBody()->getContents();
            //dd($response);
            $json = json_decode($response, true);
            return $json['data'];
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['success'] = false;
            return $error;
        }
    }

    public function table_news_list()
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/news/listall';
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => $ses_login['access_token']
                ]
            ]);

            $response = $response->getBody()->getContents();
            //dd($response);
            $json = json_decode($response, true);
            return $json['data'];
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['success'] = false;
            return $error;
        }
    }

    public function LastNews()
    {

        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/lastnews';
        $client = new \GuzzleHttp\Client();

        $limit = 5;
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'limit'   => $limit
        ]);
        //dd($bodyku);


        $options = [
            'headers' => $headers,
            'body' => $bodyku

        ];
        try {
            $response = $client->post($url, $options);
            $response = $response->getBody()->getContents();
            //dd($response);
            $json = json_decode($response, true);
            return $json['data'];
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['success'] = false;
            return $error;
        }
    }

    public function TopVisitNews()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/visitnews';
        $client = new \GuzzleHttp\Client();

        $limit = 5;
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'limit'   => $limit
        ]);
        //dd($bodyku);


        $options = [
            'headers' => $headers,
            'body' => $bodyku

        ];
        try {
            $response = $client->post($url, $options);
            $response = $response->getBody()->getContents();

            $json = json_decode($response, true);
            return $json['data'];
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['success'] = false;
            return $error;
        }
    }

    public function TopLovedNews()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/toplovenews';
        $client = new \GuzzleHttp\Client();

        $limit = 5;
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'limit'   => $limit
        ]);
        //dd($bodyku);


        $options = [
            'headers' => $headers,
            'body' => $bodyku

        ];
        try {
            $response = $client->post($url, $options);
            $response = $response->getBody()->getContents();
            //dd($response);
            $json = json_decode($response, true);
            return $json['data'];
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['success'] = false;
            return $error;
        }
    }

    public function getDetailNews($news_id)
    {
        $ses_login = session()->get('session_admin_logged');
        $urlx = env('SERVICE') . 'module/news/detail';

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'news_id'   => intval($news_id)
        ]);
        //dd($bodyku);

        $options = [
            'headers' => $headers,
            'body' => $bodyku

        ];
        //dd($options);
        $response = $client->post($urlx, $options);
        //dd($response);
        $response = $response->getBody()->getContents();
        //dd($response);
        $json = json_decode($response, true);
        $in = $json['data'];

        $dtaku = [
            "id"       => $in['id'],
            "title"     => $in['title'],
            "author_name"    => $in['author_name'],
            "author_photo"  => $in['author_photo'],
            "visit"     => $in['visit'],
            "like"     => $in['like'],
            "image"     => $in['image'],
            "share"     => $in['share'],
            "url"     => $in['url'],
            "publish"     => $in['publish'],
            "publish_title"     => $in['publish_title'],
            "headline"     => $in['headline'],
            "headline_title"     => $in['headline_title'],
            "content"     => $in['content'],
            "author_photo"     => $in['content'],
            "createdAt"     => $in['createdAt']
        ];
        // dd($dtaku);
        return view('admin/dashboard/detail_news')->with($dtaku);
    }

    public function DetailNews($news_id)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $urlx = env('SERVICE') . 'module/news/detail';

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'news_id'   => intval($news_id)
        ]);
        //dd($bodyku);

        $options = [
            'headers' => $headers,
            'body' => $bodyku

        ];
        //dd($options);
        $response = $client->post($urlx, $options);
        //dd($response);
        $response = $response->getBody()->getContents();
        //dd($response);
        $json = json_decode($response, true);
        $in = $json['data'];

        $dtaku = [
            "id"       => $in['id'],
            "title"     => $in['title'],
            "author_name"    => $in['author_name'],
            "author_photo"  => $in['author_photo'],
            "visit"     => $in['visit'],
            "like"     => $in['like'],
            "image"     => $in['image'],
            "share"     => $in['share'],
            "url"     => $in['url'],
            "publish"     => $in['publish'],
            "publish_title"     => $in['publish_title'],
            "headline"     => $in['headline'],
            "headline_title"     => $in['headline_title'],
            "content"     => $in['content'],
            "author_photo"     => $in['content'],
            "createdAt"     => $in['createdAt']
        ];
        //dd($dtaku);
        return view('subscriber/dashboard/news_detail')->with($dtaku);
    }

    public function getDataEdit(request $news_id)
    {

        $ses_login = session()->get('session_admin_logged');
        $urlx = env('SERVICE') . 'module/news/detail';

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'news_id'   => $news_id['news_id']
        ]);
        //dd($bodyku);

        $options = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        //dd($options);
        $response = $client->post($urlx, $options);
        //dd($response);
        $response = $response->getBody()->getContents();
        $json = json_decode($response, true);
        $in = $json['data'];

        $dtaku = [
            "id"       => $in['id'],
            "title"     => $in['title'],
            "author_name"    => $in['author_name'],
            "author_photo"  => $in['author_photo'],
            "visit"     => $in['visit'],
            "like"     => $in['like'],
            "image"     => $in['image'],
            "share"     => $in['share'],
            "url"     => $in['url'],
            "publish"     => $in['publish'],
            "publish_title"     => $in['publish_title'],
            "headline"     => $in['headline'],
            "headline_title"     => $in['headline_title'],
            "content"     => $in['content'],
            "author_photo"     => $in['content'],
            "createdAt"     => $in['createdAt']
        ];
        return $dtaku;
    }

    public function PublishNews(request $request)
    {

        $ses_login = session()->get('session_admin_logged');
        $urlx = env('SERVICE') . 'module/news/publish';

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'news_id'   => $request['news_id']
        ]);
        //dd($bodyku);

        $options = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        //dd($options);
        $response = $client->post($urlx, $options);
        //dd($response);

        $response = json_decode($response->getBody()->getContents(), true);
        $in = $response['data'];

        $response = [
            "status"       => $in['status']
        ];
        //dd($response);

        return $response;
    }

    public function PublishHeadline(request $request)
    {

        $ses_login = session()->get('session_admin_logged');
        $urlx = env('SERVICE') . 'module/news/setheadline';

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'news_id'   => $request['news_id']
        ]);
        //dd($bodyku);

        $options = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        //dd($options);
        $response = $client->post($urlx, $options);
        //dd($response);

        $response = json_decode($response->getBody()->getContents(), true);
        $in = $response['data'];

        $response = [
            "status"       => $in['headline']
        ];
        //dd($response);

        return $response;
    }


    public function ScrapeNews(request $request)
    {

        $ses_login = session()->get('session_admin_logged');
        $urlx = env('SERVICE') . 'module/news/scrapnews';

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'url'   => $request['url']
        ]);
        //dd($bodyku);

        $options = [
            'body' => $bodyku,
            'headers' => $headers,
        ];
        //dd($options);

        //dd($response);


        //$in = $response['data'];
        try {
            $response = $client->post($urlx, $options);
            $response = json_decode($response->getBody()->getContents(), true);
            if ($response['success'] == true) {
                alert()->success('Scrape News Success')->persistent('Done');
                return back();
            }
        } catch (ClientException $exception) {
            alert()->error('Scrape News Unsuccessful, please Check your News URL')->persistent('Done');
            return back();
            //dd($exception);
        }

        // $response = [
        //     "status"       => $in['status']
        // ];
        //dd($response);

        // return $response;

    }


    public function edit_news_management(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $token = $ses_login['access_token'];
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => $ses_login['access_token']
        ];
        // return $ses_user;

        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('fileup')) {
            $imgku = file_get_contents($request->file('fileup')->getRealPath());
            $filnam = $request->file('fileup')->getClientOriginalName();

            $input = $request->all(); // getdata form by name

            //VALIDATION EMPTY TITLE
            if ($input['edit_title'] == "") {
                alert()->error('Please Insert Title')->persistent('Done');
                return back();
            }
            //VALIDATION EMPTY CONTENT
            if ($input['news_edit_content'] == "" or $input['news_edit_content'] == "<br>") {
                alert()->error('Please Insert News Content')->persistent('Done');
                return back();
            }

            $imageRequest = [
                "title"        => $input['edit_title'],
                "content" => $input['news_edit_content'],
                "image"        => $imgku,
                "filename"      => $filnam,
                "id"        => $input['id_news'],
                "scala"        => "Nasional",
                "url"        => "www.google.com"
            ];

            //dd($imageRequest);

            $url = env('SERVICE') . 'module/news/edit';
            try {
                $resImg = $req->editNews($imageRequest, $url, $token);
                $hasil = $resImg['data'];
                if ($resImg['success'] == true) {
                    alert()->success('Change News Success')->persistent('Done');
                    return back();
                }
            } catch (ClientException $exception) {
                dd($exception);
            }
        } else { //END-IF  UPLOAD-IMAGE
            $input = $request->all(); // getdata form by name
            $imageRequest = [
                "title"        => $input['edit_title'],
                "scala"        => "Nasional",
                "image"    => "",
                "content" => $input['news_edit_content'],
                "url"           => "www.google.com",
                "id"        => $input['id_news'],
                "filename"      => ""
            ];
            //dd($imageRequest);

            $url = env('SERVICE') . 'module/news/edit';
            try {
                //dd($url);
                // $options = [
                //     'headers' => $headers,
                //     'body' => $imageRequest
                // ];
                //dd($options);
                //dd($imageRequest);
                // $resp = $client->POST($urlx, $options);
                //dd($resp);
                $resp = $req->editNews($imageRequest, $url, $token);
                // return $resImg;
                if ($resp['success'] == true) {
                    alert()->success('Change News Success')->persistent('Done');
                    return back();
                }
            } catch (ClientException $errornya) {
                $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                alert()->error($error['message'], 'Failed!')->autoclose(3500);
                return back();
            } catch (ServerException $errornya) {
                $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            } catch (ConnectException $errornya) {
                $error['status'] = 500;
                $error['message'] = "Internal Server Error";
                $error['success'] = false;
                alert()->error($error['message'], 'Failed!')->autoclose(4500);
                return back();
            }
        } // endelse
    }

    public function add_news_management(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $token = $ses_login['access_token'];
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => $ses_login['access_token']
        ];
        // return $ses_user;

        $req = new RequestController;
        $fileimg = "";
        // dd($request['fileup2']);

        //VALIDATION EMPTY IMAGE
        if (($request->file('fileup2')) == null) {
            alert()->error('Please Insert News Headline Image')->persistent('Done');
            return back();
        };

        $imgku = file_get_contents($request->file('fileup2')->getRealPath());
        $filnam = $request->file('fileup2')->getClientOriginalName();

        $input = $request->all(); // getdata form by name

        //VALIDATION EMPTY TITLE
        if ($input['add_title'] == "") {
            alert()->error('Please Insert Title')->persistent('Done');
            return back();
        }
        //VALIDATION EMPTY CONTENT
        if ($input['news_add_content'] == "" or $input['news_add_content'] == "<br>") {
            alert()->error('Please Insert News Content')->persistent('Done');
            return back();
        }

        $imageRequest = [
            "title"        => $input['add_title'],
            "content" => $input['news_add_content'],
            "image"        => $imgku,
            "filename"      => $filnam,
            "scala"        => "Nasional",
            "url"        => "www.google.com"
        ];


        $url = env('SERVICE') . 'module/news/create';
        try {
            $resImg = $req->AddNews($imageRequest, $url, $token);
            $hasil = $resImg['data'];
            if ($resImg['success'] == true) {
                alert()->success('Add News Success')->persistent('Done');
                return back();
            }
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Server bermasalah";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }


    //MODULE CLASS - FRIEND

    public function FriendList()
    {
        return view('subscriber/dashboard/friend_management');
    }


    public function tabel_friend_management()
    {

        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/viewfriendlist';
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => $ses_login['access_token']
                ]
            ]);

            $response = $response->getBody()->getContents();
            //dd($response);
            $json = json_decode($response, true);
            return $json['data'];
        } catch (ClientException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ServerException $errornya) {
            $error = json_decode($errornya->getResponse()->getBody()->getContents(), true);
            return $error;
        } catch (ConnectException $errornya) {
            $error['status'] = 500;
            $error['message'] = "Internal Server Error";
            $error['success'] = false;
            return $error;
        }
    }

    public function friendProfile($friend_id)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $urlx = env('SERVICE') . 'module/friend/viewfriendprofile';

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        $bodyku = json_encode([
            'user_id'   => $friend_id
        ]);
        //dd($bodyku);

        $options = [
            'headers' => $headers,
            'body' => $bodyku

        ];
        //dd($options);
        $response = $client->post($urlx, $options);
        //dd($response);
        $response = $response->getBody()->getContents();
        //dd($response);
        $json = json_decode($response, true);
        $in = $json['data'];

        $dtaku = [
            "user_id"       => $in['user_id'],
            "full_name"     => $in['full_name'],
            "user_name"    => $in['user_name'],
            "email"  => $in['email'],
            "notelp"     => $in['notelp'],
            "alamat"     => $in['alamat'],
            "picture"     => $in['picture']
        ];
        //dd($dtaku);
        return view('subscriber/dashboard/friend_profile')->with($dtaku);
    }

    public function SendMessage(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $token = $ses_login['access_token'];
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $ses_login['access_token']
        ];
        // return $ses_user;

        $req = new RequestController;
        $fileimg = "";
        //dd($request['fileup2']);

        //VALIDATION EMPTY IMAGE
        $input = $request->all(); // getdata form by name

        //VALIDATION EMPTY TITLE
        if ($input['subject'] == "") {
            alert()->error('Please Insert Message Subject')->persistent('Done');
            return back();
        }
        //VALIDATION EMPTY CONTENT
        if ($input['message'] == "" or $input['message'] == "<br>") {
            alert()->error('Please Insert Message Content')->persistent('Done');
            return back();
        }

        $sendMessageReq = json_encode([
            "title"        => $input['subject'],
            "description" => $input['message'],
            "user_id"        => $input['friend_id']
        ]);

        $options = [
            'headers' => $headers,
            'body' => $sendMessageReq

        ];

        //dd($options);

        $url = env('SERVICE') . 'module/friend/sendmessage';
        try {
            // $res = $req->sendMessage($sendMessageReq, $url, $token);
            $res = $client->post($url, $options);
            $response = json_decode($res->getBody()->getContents(), true);
            // dd($response);

            if ($response['success'] == true) {
                alert()->success('Send Message Success')->persistent('Done');
                return back();
            }
        } catch (ClientException $exception) {
            dd($exception);
        }
    }
} //end-class
