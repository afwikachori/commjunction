<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\support\RequestHelper;
use Carbon;
use Alert;

class MessageController extends Controller
{
    use RequestHelper;

    public function uiCreateMessage()
    {
        return view('message.create');
    }

    public function createMessage(Request $request)
    {
        if($request->hasFile('file')){
            $fileName = $request->file('file')->getClientOriginalName();
            $image = base64_encode(file_get_contents($request->file('file')));
        }else{
            $fileName='';
            $image='';
        }
        $input = [
            'ticket_id'=>$request->ticket_id,
            'user_id'=> $request->user_id,
            'text'=>$request->comment,
            'send_user_email'=>'0',
            'attachment[n][filename]'=>$fileName,
            'attachment[n][contents]'=>$image,
        ];

        $url = env('API_SUPPORTPAL', null) . '/api/ticket/message';
        $data= $this->insertFile($input, $url,'POST');
        if($data['status'] == "success"){
            alert()->success($data['message'], 'Success')->persistent('Done');
            return back();
        }else{
            alert()->error($data['message'], 'Failed')->autoclose(5000);
            return back();
        }
        return redirect()->back();
    }
}
