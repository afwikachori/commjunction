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

    public function __construct()
    {
        $this->middleware(['XFrameOptions']);
    }

    public function NewsManagementView()
    {
        return view('admin/dashboard/news_management');
    }

    public function NewsList()
    {
        return view('subscriber/dashboard/news_management');
    }

    public function EventModuleView()
    {
        return view('admin/dashboard/event_module_admin');
    }

    public function createNewVenueAdmin()
    {
        return view('admin/dashboard/venue_module_admin');
    }

    public function marketplaceItemCreateView_admin()
    {
        return view('admin/dashboard/marketplace_module_admin');
    }

    public function marketplaceItemCreateView_subs()
    {
        return view('subscriber/dashboard/marketplace_module_subs');
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
            return 'nodata';
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

        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            return $error;
        }

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

        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            return $error;
        }
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

        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed')->persistent('Done');
            return back();
        }

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

        $input = $request->all(); // getdata form by name


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

        if ($request->has('add_title')) {
              $judul = preg_replace("#</?[^>]*>#i", "", $input['add_title']);
        }

        $imageRequest = [
            "title"        => $judul,
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


    public function get_top_friends(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/topfriend';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], null);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function get_friend_profile(Request $request)
    {
        // return $friend_id;
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/viewfriendprofile';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'user_id'   => $input['user_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        // return $json;
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


        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed')->persistent('Done');
            return back();
        }

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

        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed')->persistent('Done');
            return back();
        }
        $csrf = $input['_token'];

        $body = [
            'user_id'   => $input['id_new_friend'],
            'status'   => $input['status_acc'],
        ];

        // return $body;

        if ($input['status_acc'] == "2") {
            $text = 'Approved';
        } else {
            $text = 'Rejected';
        }

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        // return $json;
        if ($json['success'] == true) {
            alert()->success('Successfully give confirmation', $text)->persistent('Done');
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
        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed')->persistent('Done');
            return back();
        }

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


    public function get_list_setting_module_friends(Request $request)
    {
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


    public function find_search_filter_friends(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/friend/searchfriend';

        $input = $request->all();

        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            return $error;
        }
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


    public function send_love_news_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/news/like';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'news_id'   => (int) $input['news_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }

    public function send_love_news_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/news/like';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'news_id'   => (int) $input['news_id']
        ];
        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            alert()->success('News has been liked', 'Success')->autoclose(4000);
            return back();
        } else {
            alert()->error($json['message'], 'Failed')->autoclose(4000);
            return back();
        }
    }


    //--------------------------- EVENT MODULE ------------------------
    public function tabel_event_list_admin(Request $request)
    {

        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'event/list';

        $input = $request->all();
        $csrf = $input['_token'];
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return 'nodata';
        }
    }



    public function create_new_event_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'event/create';
        $input = $request->all();
        // return $input;
        $req = new RequestController;
        $fileimg = "";

        if ($request->hasFile('event_img')) {
            $imgku = file_get_contents($request->file('event_img')->getRealPath());
            $filnam = $request->file('event_img')->getClientOriginalName();


            $imageRequest = [
                "title"         => $input['event_judul'],
                "description"   => $input['event_deskripsi'],
                "event_date"    => $input["event_tgl"],
                "event_time"    => $input['event_time'],
                "status"        => $input['event_status'],
                "ticket_type"   => $input["event_type"],
                "link"          => $input['event_link'],
                "latitude"      => "-7.982398",
                "longitude"     => "112.632224",
                "venue_id"      => "1",
                "image"          => $imgku,
            ];

            $resImg = $req->send_image_formdata($imageRequest, $url, $filnam, $ses_login['access_token']);
            alert()->success('Success create event!', 'Success')->autoclose(4000);
            return back();
        } else {
            alert()->error('image required !', 'Failed')->autoclose(4000);
            return back();
        }
    }

    public function edit_new_event_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'event/update';
        $input = $request->all();
        // return $input;
        $req = new RequestController;
        if ($request->hasFile('edit_img')) {
            $imgku = file_get_contents($request->file('edit_img')->getRealPath());
            $filnam = $request->file('edit_img')->getClientOriginalName();
            $imageRequest = [
                "event_id"         => $input['id_event'],
                "title"         => $input['edit_judul'],
                "description"   => $input['edit_deskripsi'],
                "edit_date"    => $input["edit_tgl"],
                "edit_time"    => $input['edit_time'],
                "status"        => $input['edit_status'],
                "ticket_type"   => $input["edit_type"],
                "link"          => $input['edit_link'],
                "latitude"      => "-7.982398",
                "longitude"     => "112.632224",
                "venue_id"      => "1",
                "image"          => $imgku,
            ];
        } else {
            $filnam = '';
            $imageRequest = [
                "event_id"         => $input['id_event'],
                "title"         => $input['edit_judul'],
                "description"   => $input['edit_deskripsi'],
                "edit_date"    => $input["edit_tgl"],
                "edit_time"    => $input['edit_time'],
                "status"        => $input['edit_status'],
                "ticket_type"   => $input["edit_type"],
                "link"          => $input['edit_link'],
                "latitude"      => "-7.982398",
                "longitude"     => "112.632224",
                "venue_id"      => "1",
                "image"          => "",
            ];
        }

        $resImg = $req->send_image_formdata($imageRequest, $url, $filnam, $ses_login['access_token']);

        if ($resImg['success'] == true) {
            alert()->success('Success Edit event!', 'Success')->autoclose(4000);
            return back();
        } else {
            alert()->error($resImg['message'], 'Failed')->autoclose(4000);
            return back();
        }
    }


    public function share_event_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'event/share';

        $input = $request->all();
        $csrf = $input['_token'];

        $body = [
            'event_id'   => $input['event_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        return $json;
    }

    public function create_new_ticket_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'event/createticket';
        $input = $request->all();

        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            alert()->error($error['message'], 'Failed')->persistent('Done');
            return back();
        }

        $datain = $request->except('_token');
        $dtin = array_chunk($datain, 8);

        $data = [];
        foreach ($dtin as $i => $dt) {
            $dataArray = [
                "title" => $dt[0],
                "event_id" => $dt[1],
                "description" => $dt[2],
                "start_date" => $dt[3],
                "ticket_type" => $dt[4],
                "end_date" => $dt[5],
                "price" => $dt[6],
                "total" => $dt[7],



            ];
            array_push($data, $dataArray);
        }

        $csrf = "";
        $body = [
            'data_ticket'   => $data
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            alert()->success('Success Create New Ticket!', 'Success')->autoclose(4000);
            return back();
        } else {
            alert()->error($json['message'], 'Failed')->autoclose(4000);
            return back();
        }
    }


    public function participantEventModuleView()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'event/listparticipant';

        // $input = $request->all();
        $csrf = "";

        $body = [
            'event_id'   => 2
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function tabel_ticket_list_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'event/listticket';

        $input = $request->all();
        $csrf = "";

        $body = [
            'event_id'   => $input['id_event']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return 'nodata';
        }
    }

    public function delete_ticket_event_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'event/deleteticket';

        $input = $request->all();
        $csrf = "";

        $body = [
            'event_id'   => (int) $input['event_id']
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }



    public function buyTicketEvent(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'event/buyticket';

        $input = $request->all();
        $csrf = "";

        $body = [
            'ticket_id'   => '2',
            'event_id'   => '2',
            'payment_method_id'   => '5',
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }


    // -------------------------------  MODULE VENUE  -----------------------------------

    public function VenueListAdmin()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/venue';

        $input = '';
        $csrf = '';
        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return 'nodata';
        }
    }


    public function detailVenueAdmin($id_venue)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/venue/detail';

        $csrf = "";

        $body = [
            'venue_id'   => $id_venue
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function LastVenueListAdmin()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/venue/last';

        $csrf = "";
        $body = [
            'limit'   => (int) "5"
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json['data'];
        } else {
            return $json;
        }
    }


    public function publishVenueAdmin($id_venue)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/venue/publish';

        $csrf = "";
        $body = [
            'venue_id'   => $id_venue
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }




    public function PostcreateNewVenueAdmin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();
        if ($input['action'] == "ADD") {
            $url = env('SERVICE') . 'module/venue/create';
        } else {
            $url = env('SERVICE') . 'module/venue/edit';
        }

        $fasilitas = explode(",", $input['venue_fasilitas']);

        $req = new RequestController;
        if ($request->hasFile('photo_venue') || $request->hasFile('venue_thumbnail')) {

            $img_thum = file_get_contents($request->file('venue_thumbnail')->getRealPath());
            $nam_thum = $request->file('venue_thumbnail')->getClientOriginalName();


            $photo = [];

            foreach ($request->file('photo_venue') as $image) {
                $fileName = $image->getClientOriginalName();
                $image_path = $image->path();

                $files = [
                    'name'     => 'photos',
                    'contents' => fopen($image_path, 'r'),
                    'filename' => $fileName
                ];
                array_push($photo, $files);
            }

            if ($input['action'] == "ADD") {
                $imageRequest = [
                    "name"         => $input['venue_judul'],
                    "location"         => $input['venue_lokasi'],
                    "capacity"   => $input['venue_kapasitas'],
                    "open_time"    => $input["open_time"],
                    "close_time"    => $input['close_time'],
                    "facilities"        => $fasilitas,
                    "thumbnail"      => [$img_thum => $nam_thum],
                    "photo"          => $photo,
                ];
            } else {
                $imageRequest = [
                    "name"       => $input['venue_judul'],
                    "location"   => $input['venue_lokasi'],
                    "capacity"   => $input['venue_kapasitas'],
                    "open_time"  => $input["open_time"],
                    "close_time" => $input['close_time'],
                    "facilities" => $fasilitas,
                    "thumbnail"  => [$img_thum => $nam_thum],
                    "photo"      => $photo,
                    "venue_id"   => $input['id_venue'],
                ];
            }
        }

        $resImg = $req->create_venue_multipart($imageRequest, $url, $ses_login['access_token']);
        dd($resImg);
        // if ($resImg['success'] == true) {
        //     alert()->success('Success Edit event!', 'Success')->autoclose(4000);
        //     return back();
        // } else {
        //     alert()->error($resImg['message'], 'Failed')->autoclose(4000);
        //     return back();
        // }
    }




    // --------------------------------- ADMIN - MODULE MARKET PLACE ----------------------------------

    public function marketplaceStatusCreate_admin()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/status';

        $csrf = "";
        $body = [
            "name"  => "Status Baru",
            "note"  => "Status baru masih transisi"
        ];

        $cekhtml = $this->cek_tag_html($body, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            return $error;
        }

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }


    public function marketplacecategoryCreate_admin()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/category/create';

        $csrf = "";
        $body = [
            "name"  => 'Categori KEdua webfront',
        ];

        $cekhtml = $this->cek_tag_html($body, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            return $error;
        }

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], $csrf);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }


    public function marketplaceCategoryList_admin()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/category';


        $json = $this->formdata_nobody($url, $ses_login['access_token']);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }


    public function marketplaceItemList_admin()
    {
        $ses_login = session()->get('session_admin_logged');
        $q = 'sabun';
        $price = 'DESC';
        $date = 'DESC';
        $category_id = '1';

        // $url = env('SERVICE') . 'module/marketplaceproliga/item?q=' . $q . '&price=' . $price . '&date=' . $date . '&category_id=' . $category_id;
        $url = env('SERVICE') . 'module/marketplaceproliga/item?price=' . $price . '&date=' . $date;


        $json = $this->post_get_request(null, $url, true, $ses_login['access_token'], null);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }

    public function marketplaceItemListUser_admin()
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/item/user';

        $body = [
            "category_id"   => "",
            "date"          => "",
            "price"         => "",
            "q"             => ""
        ];

        $cekhtml = $this->cek_tag_html($body, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            return $error;
        }

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], null);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }


    public function marketplaceItemPublish_admin($id_item)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/item/publish';

        $body = [
            "item_id"  => (int) $id_item,
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], null);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }


    public function marketplaceItemDelete_admin($id_item)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/item/delete';

        $body = [
            "item_id"  => (int) $id_item,
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], null);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }

    public function marketplaceItemDetail_admin($id_item)
    {
        $ses_login = session()->get('session_admin_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/itemdetail';

        $body = [
            "item_id"  => (int) $id_item,
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], null);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }

    public function marketplaceItemCreate_admin(Request $request)
    {
        $ses_login = session()->get('session_admin_logged');
        $input = $request->all();
        // return $input;
        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            alert()->error($error['message'], 'Forbidden !')->autoclose(4500);
            return back();
        }

        if ($input['action'] == "ADD") {
            $url = env('SERVICE') . 'module/marketplaceproliga/item/create';
        } else {
            $url = env('SERVICE') . 'module/marketplaceproliga/item/edit';
        }

        $tags = explode(",", $input['item_tag']);


        $req = new RequestController;
        if ($request->hasFile('photo_item')) {
            $photo = [];
            foreach ($request->file('photo_item') as $image) {
                $fileName = $image->getClientOriginalName();
                $image_path = $image->path();

                $files = [
                    'name'     => 'photo',
                    'contents' => fopen($image_path, 'r'),
                    'filename' => $fileName
                ];
                array_push($photo, $files);
            }

            if ($input['action'] == "ADD") {
                $imageRequest = [
                    "name"          => $input['item_name'],
                    "category_id"   => $input['id_category'],
                    "description"   => $input['item_deskripsi'],
                    "store"         => $input["store"],
                    "price"         => $input['item_price'],
                    "tag"           => $tags,
                    "photo"         => $photo,
                ];
            } else {
                $imageRequest = [
                    "name"         => $input['item_name'],
                    "category_id"   => $input['id_category'],
                    "description"   => $input['item_deskripsi'],
                    "store"         => $input["store"],
                    "price"         => $input['item_price'],
                    "tag"           => $tags,
                    "photo"         => $photo,
                    "item_id"       => $input['item_id'],
                    "stock"         => (int) 100,
                    "weight"        => (int) '2',
                    "condition"     => 'New',
                    "insurance"     => 'Tidak Ada',
                    "min_order"     => '1',
                ];
            }
        } else {
            alert()->error('Photo is reuired, multiple is allowed', 'Required')->autoclose(4000);
            return back();
        }

        $resImg = $req->create_item_marketplace_multiple($imageRequest, $url, $ses_login['access_token']);
        dd($resImg);
    }

    // --------------- xx -------------- ADMIN -  MODULE MARKET PLACE -------------- xx ----------------




    // --------------------------------- SUBSCRIBER  - MODULE MARKET PLACE ----------------------------------

    public function marketplaceCategoryList_subs()
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/category';


        $json = $this->formdata_nobody($url, $ses_login['access_token']);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }

    public function marketplaceItemListUser_subs()
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/item/user';

        $body = [
            "category_id"   => "",
            "date"          => "",
            "price"         => "",
            "q"             => ""
        ];

        $cekhtml = $this->cek_tag_html($body, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            return $error;
        }

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], null);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }


    public function marketplaceItemPublish_subs($id_item)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/item/publish';

        $body = [
            "item_id"  => (int) $id_item,
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], null);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }


    public function marketplaceItemDelete_subs($id_item)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/item/delete';

        $body = [
            "item_id"  => (int) $id_item,
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], null);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }

    public function marketplaceItemDetail_subs($id_item)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $url = env('SERVICE') . 'module/marketplaceproliga/itemdetail';

        $body = [
            "item_id"  => (int) $id_item,
        ];

        $json = $this->post_get_request($body, $url, false, $ses_login['access_token'], null);
        if ($json['success'] == true) {
            return $json;
        } else {
            return $json;
        }
    }

    public function marketplaceItemCreate_subs(Request $request)
    {
        $ses_login = session()->get('session_subscriber_logged');
        $input = $request->all();
        // return $input;
        $cekhtml = $this->cek_tag_html($input, false);
        if ($cekhtml >= 1) {
            $error['status'] = 500;
            $error['message'] = "Contains tag html in input are not allowed";
            $error['success'] = false;
            alert()->error($error['message'], 'Forbidden !')->autoclose(4500);
            return back();
        }

        if ($input['action'] == "ADD") {
            $url = env('SERVICE') . 'module/marketplaceproliga/item/create';
        } else {
            $url = env('SERVICE') . 'module/marketplaceproliga/item/edit';
        }

        $tags = explode(",", $input['item_tag']);


        $req = new RequestController;
        if ($request->hasFile('photo_item')) {
            $photo = [];
            foreach ($request->file('photo_item') as $image) {
                $fileName = $image->getClientOriginalName();
                $image_path = $image->path();

                $files = [
                    'name'     => 'photo',
                    'contents' => fopen($image_path, 'r'),
                    'filename' => $fileName
                ];
                array_push($photo, $files);
            }

            if ($input['action'] == "ADD") {
                $imageRequest = [
                    "name"          => $input['item_name'],
                    "category_id"   => $input['id_category'],
                    "description"   => $input['item_deskripsi'],
                    "store"         => $input["store"],
                    "price"         => $input['item_price'],
                    "tag"           => $tags,
                    "photo"         => $photo,
                ];
            } else {
                $imageRequest = [
                    "name"         => $input['item_name'],
                    "category_id"   => $input['id_category'],
                    "description"   => $input['item_deskripsi'],
                    "store"         => $input["store"],
                    "price"         => $input['item_price'],
                    "tag"           => $tags,
                    "photo"         => $photo,
                    "item_id"       => $input['item_id'],
                    "stock"         => (int) 100,
                    "weight"        => (int) '2',
                    "condition"     => 'New',
                    "insurance"     => 'Tidak Ada',
                    "min_order"     => '1',
                ];
            }
        } else {
            alert()->error('Photo is reuired, multiple is allowed', 'Required')->autoclose(4000);
            return back();
        }

        $resImg = $req->create_item_marketplace_multiple($imageRequest, $url, $ses_login['access_token']);
        dd($resImg);
    }

    // --------------- xx -------------- SUBSCRIBER -  MODULE MARKET PLACE -------------- xx ----------------




} //end-class
