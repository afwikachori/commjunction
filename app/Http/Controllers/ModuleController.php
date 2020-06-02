<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\BadResponseException;

use App\Http\Controllers\SendRequestController;

use Session;
use Alert;
use Helper;

class ModuleController extends Controller
{

    use SendRequestController;

    public function NewsManagementView()
    {
        return view('admin/dashboard/news_management');
    }

    public function NewsList()
    {
        return view('subscriber/dashboard/news_management');
    }



    public function get_all_news(Request $request)
    {

        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/listall';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function getHeadlineNews(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/headlinenews';

        $input = $request->all();
        $csrf = $input['_token'];

        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function tabel_news_management(Request $request)
    {

        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/listall';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function table_news_list(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/news/listall';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function LastNews(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/lastnews';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'limit'   => 5
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function TopVisitNews(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/visitnews';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'limit'   => 5
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function TopLovedNews(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/toplovenews';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'limit'   => 5
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function getDetailNews($news_id)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/detail';
        $body = [
            'news_id'   => intval($news_id)
        ];

        $crsf = null;

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $crsf);

        if ($json['success'] == true) {
            $in =  $json['data'];
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
            return view('admin/dashboard/detail_news')->with($dtaku);
        } else {
            return $json;
        }
    }




    public function DetailNews($news_id)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/news/detail';

        $body = [
            'news_id'   => intval($news_id)
        ];

        $crsf = null;

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $crsf);
        if ($json['success'] == true) {
            $in =  $json['data'];

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
            return view('subscriber/dashboard/news_detail')->with($dtaku);
        } else {
            alert()->error($json['message'], 'Failed')->persistent('Done');
            return back();
        }
    }



    public function getDataEdit(request $news_id)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/detail';

        $body = [
            'news_id'   => $news_id['news_id']
        ];
        $crsf = null;
        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $crsf);

        if ($json['success'] == true) {
            $in =  $json['data'];
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
        } else {
            return $json;
        }
    }

    public function PublishNews(request $request)
    {

        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/publish';

        $input = $request->all();
        $csrf = $input['_token'];

        // return $input;

        $body = [
            'news_id'   => $input['news_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);

        if ($json['success'] == true) {
            $in = $json['data'];

            $response = [
                "status"       => $in['status']
            ];

            return $response;
        } else {
            return $json;
        }
    }

    public function PublishHeadline(request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/setheadline';

        $input = $request->all();
        // return $input;
        $csrf = $input['_token'];
        $body = [
            'news_id'   => $input['news_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);

        if ($json['success'] == true) {
            $in = $json['data'];

            $response = [
                "status" => $in['headline']
            ];

            return $response;
        } else {
            return $json;
        }
    }


    public function ScrapeNews(request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/scrapnews';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'url'   => $input['url']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        // return $json;
        if ($json['success'] == true) {
            alert()->success('Scrape News Success')->persistent('Done');
            return back();
        } else {
            alert()->error('Scrape News Unsuccessful, please Check your News URL')->persistent('Done');
            return back();
        }
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


    public function tabel_friend_management(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/viewfriendlist';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function tabel_friend_pending_list(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/pendingfriendconfirmation';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function friendProfile($friend_id)
    {
        // return $friend_id;
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/viewfriendprofile';


        $csrf = null;

        $body = [
            'user_id'   => $friend_id
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        // return $json;
        if ($json['success'] == true) {
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

            return view('subscriber/dashboard/friend_profile')->with($dtaku);
        } else {
            return $json;
        }
    }



    public function SendMessage(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/sendmessage';
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

        $body = [
            "title"        => $input['subject'],
            "description" => $input['message'],
            "user_id"        => $input['friend_id']
        ];

        $csrf = $input["_token"];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {

            alert()->success('Send Message Success')->persistent('Done');
            return back();
        } else {
            alert()->error($json['message'], 'Failed!')->autoclose(4500);
            return back();
        }
    }




    public function confirm_new_friend(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/approve';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'user_id'   => $input['id_new_friend'],
            'status'   => $input['status_acc'],
        ];

        // return $body;

        if($input['status_acc'] == "2"){
            $text = 'Approved';
        }else{
            $text = 'Rejected';
        }

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        // return $json;
        if ($json['success'] == true) {
            alert()->success('Successfully give confirmation',$text)->persistent('Done');
            return back();
        } else {
            alert()->error($json['message'], 'Failed')->persistent('Done');
            return back();
        }
    }




    public function setting_module_friend(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/setting';

        $input = $request->all();
        $csrf = $input['_token'];

        $datain = $request->except('_token');
        $dtin = array_chunk($datain, 2);

        $data = [];
        foreach ($dtin as $i => $dt) {
            $dataArray = [
                "setting_id" => $dt[1],
                "value" => $dt[0],
            ];
            array_push($data, $dataArray);
        }

        $body = [
            "data_Setting" => $data
        ];

        // return $body;

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        // return $json;
        if ($json['success'] == true) {
            alert()->success('Successfully Setting Up Friends Module', 'Success')->persistent('Done');
            return back();
        } else {
            alert()->error($json['message'], 'Failed')->persistent('Done');
            return back();
        }
    }


    public function get_list_setting_module_friends(Request $request){
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/listsetting';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function find_search_filter_friends(Request $request){
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/searchfriend';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'name'   => $input['name']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


} //end-class
