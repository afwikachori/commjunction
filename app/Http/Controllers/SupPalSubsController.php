<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\support\RequestHelper;

use Session;
use Alert;


class SupPalSubsController extends Controller
{
    use RequestHelper;
    // -------------------------------- ARTIKEL -----------------------------------------
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
            } else {
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
        // return $input;

        $data = $this->insertFile($input, $url, 'POST');

        if ($data['status'] == "success") {
            alert()->success($data['message'], 'Success')->persistent('Done');
            return back();
        } else {
            alert()->error($data['message'], 'Failed')->autoclose(5000);;
            return back();
        }
    }




    // -------------------------------- TICKET ------------------------------------------
    public function listTicket()
    {
        $ses_subs = session()->get('session_subscriber_logged');
        $user = $ses_subs['user'];

        $input = '';
        $email = $user['email'];
        $departemen = '12';

        $url = env('API_SUPPORTPAL', null) . '/api/ticket/ticket?user_email=' . $email . '&departement=' . $departemen;
        $data = $this->insertGet($input, $url, false, 'GET');
        return $data['data'];
    }

    public function detailTicket($id)
    {
        $input = '';

        $url = env('API_SUPPORTPAL', null) . '/api/ticket/ticket/' . $id;
        $dataTicket = $this->insertGet($input, $url, false, 'GET');
        $data = $this->getMessage($id);
        return view('subscriber/supportpal/ticket_detail', compact('data'))->with(['dataDetail' => $dataTicket['data']]);
    }

    public function createTicketView()
    {
        return view('subscriber/supportpal/ticket_create');
    }

    public function createTicketReq(Request $request)
    {
        $input = $request->all();
        $today = date('d/m/Y');
        // return $today;
        $createddate = strtotime($today);

        $input = [
            'user'                      => $input['userId'],
            'department'                => "12",
            'status'                    => "1",
            'subject'                   => $input['inputSubject'],
            'text'                      => $input['inputText'],
            'user_email'                => $input['emailUser'],
            'created_at'                => $createddate,
            'attachment[n][contents]'   => $input['inputAttach'],
            'brand'                     => '1',
            'priority'                  => $input['priorityId'],
            'attachment[n][filename]'   => $input['inputFile']
        ];
        // return $input;

        $url = env('API_SUPPORTPAL', null) . '/api/ticket/ticket';
        $data = $this->insertFile($input, $url, 'POST');

        if ($data['status'] == "success") {
            alert()->success($data['message'], 'Success')->persistent('Done');
            return redirect('/subscriber/supportpal/ticket');
        } else {
            alert()->error($data['message'], 'Failed')->autoclose(5000);
            return back();
        }
    }

    public function updateTicket($id, $value)
    {
        $input = [
            'status'   => $value
        ];

        $url = env('API_SUPPORTPAL', null) . '/api/ticket/ticket/' . $id;
        $data = $this->insertGet($input, $url, true, 'PUT');

        if ($data['status'] == "success") {
            alert()->success($data['message'], 'Success')->persistent('Done');
            return redirect(route('get.ticket.detail', $id));
        } else {
            alert()->error($data['message'], 'Failed')->autoclose(5000);
            return redirect(route('get.ticket.detail', $id));
        }
    }

    // message ticket
    public function getMessage($id)
    {
        $input = [
            'ticket_id' => $id
        ];
        $url = env('API_SUPPORTPAL', null) . '/api/ticket/message';
        $data = $this->insertGet($input, $url, false, 'GET');
        return $data;
    }




    // ------------------------------- MESSAGGE -----------------------------------------
    public function createMessage(Request $request)
    {
        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->getClientOriginalName();
            $image = base64_encode(file_get_contents($request->file('file')));
        } else {
            $fileName = '';
            $image = '';
        }
        $input = [
            'ticket_id' => $request->ticket_id,
            'user_id' => $request->user_id,
            'text' => $request->comment,
            'send_user_email' => '0',
            'attachment[n][filename]' => $fileName,
            'attachment[n][contents]' => $image,
        ];

        // return $input;
        $url = env('API_SUPPORTPAL', null) . '/api/ticket/message';
        $data = $this->insertFile($input, $url, 'POST');
        if ($data['status'] == "success") {
            alert()->success($data['message'], 'Success')->persistent('Done');
            return back();
        } else {
            alert()->error($data['message'], 'Failed')->autoclose(5000);
            return back();
        }
        return redirect()->back();
    }
}
