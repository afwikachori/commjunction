<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\support\RequestHelper;

use Alert;

class TicketController extends Controller
{
    use RequestHelper;

    public function listTicket()
    {
        $input = '';
        $email = 'machfudh27@gmail.com';
        $departemen = '12';

        $url = env('API_SUPPORTPAL', null) . '/api/ticket/ticket?user_email='.$email.'&departement='.$departemen;
        $data= $this->insertGet($input, $url, false,'GET');
        return $data['data'];
    }

    public function detailTicket($id)
    {
        $input = '';

        $url = env('API_SUPPORTPAL', null) . '/api/ticket/ticket/'.$id;
        $dataTicket= $this->insertGet($input, $url, false,'GET');
        $data = $this->getMessage($id);
        return view('subscriber/supportpal/ticket_detail',compact('data'))->with(['dataDetail'=>$dataTicket['data']]);
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
        $data= $this->insertFile($input, $url, 'POST');

        if($data['status'] == "success"){
            alert()->success($data['message'], 'Success')->persistent('Done');
            return redirect('/subscriber/supportpal/ticket');
        }else{
            alert()->error($data['message'], 'Failed')->autoclose(5000);
            return back();
        }
    }

    public function updateTicket($id, $value)
    {
        $input = [
            'status'   => $value
        ];

        $url = env('API_SUPPORTPAL', null) . '/api/ticket/ticket/'.$id;
        $data= $this->insertGet($input, $url, true,'PUT');

        if($data['status'] == "success"){
            alert()->success($data['message'], 'Success')->persistent('Done');
            return redirect(route('get.ticket.detail',$id));
        }else{
            alert()->error($data['message'], 'Failed')->autoclose(5000);
            return redirect(route('get.ticket.detail',$id));
        }

    }

    // message ticket
    public function getMessage($id)
    {
        $input = [
            'ticket_id'=>$id
        ];
        $url = env('API_SUPPORTPAL', null) . '/api/ticket/message';
        $data= $this->insertGet($input, $url, false,'GET');
        return $data;
    }
}
