<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\support\RequestHelper;

use Session;
use Alert;

class ArticleController extends Controller
{
    use RequestHelper;

    public function listArticle()
    {
        $input = "";

        $url = env('API_SUPPORTPAL', null) . 'api/selfservice/article';
        $data = $this->insertGet($input, $url, false, 'GET');
        return $data['data'];
    }


    public function detailArticle(Request $request)
    {
        $req = $request->all();
        $input = '';
        $url = env('API_SUPPORTPAL', null) . 'api/selfservice/article/' . $req['id_article'];

        $data = $this->insertGet($input, $url, false, 'GET');
        return $data['data'];
    }


    public function searchArticle(Request $request)
    {
        $req = $request->all();
        $input = '';

        $url = env('API_SUPPORTPAL', null) . 'api/selfservice/article/search?term=' . $req['keyword'];
        $data = $this->insertGet($input, $url, true, 'GET');

        if ($data['status'] != "success") {
            return $data;
        } else {
            if (count($data['data']) != 0) {
                return $data['data'];
            }else{
                return 'No Data';
            }
        }
    }


    public function setRating(Request $request)
    {
        $input = $request->all();
        $url = env('API_SUPPORTPAL', null) . 'api/selfservice/article/' . $input['id_artikel'] . '/rating';

        $ip = file_get_contents('https://api.ipify.org');
        // $ip = '4.5.6.7';
        $input = [
            'score' => $input['score'],
            'user_id' => $input['user_id'],
            'user_ip' => $ip,
        ];

        $data = $this->insertFile($input, $url, 'POST');

        if($data['status'] == "success"){
             alert()->success($data['message'], 'Success')->persistent('Done');
               return back();
        }else{
            alert()->error($data['message'], 'Failed')->autoclose(5000);;
            return back();
        }
    }
}
