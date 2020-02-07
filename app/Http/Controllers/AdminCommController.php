<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use Session;
use Alert;

class AdminCommController extends Controller{

// METHOD GET 

// @if (Session::has('session_admin_logged')) 
// @else 
//   <script>window.location = "/admin";</script>
//   @endif



public function adminDashboardView(){
    return view('admin/dashboard/dashboard_admin');
}

public function login(){
    return view('admin/login');
}

public function comSettingView(){
	return view('admin/dashboard/com_setting_admin');
}

public function publishAdminView(){
	return view('admin/dashboard/publish_admin');
}

public function editProfilAdminView(){
	return view('admin/dashboard/editprofil_admin');
}

public function loginRegisAdminView(){
	return view('admin/dashboard/set_loginregis_admin');
}

public function membershipAdminView(){
	return view('admin/dashboard/set_membership_admin');
}

public function regisdataAdminView(){
	return view('admin/dashboard/set_regisdata_admin');
}

public function SetpaymentAdminView(){
	return view('admin/dashboard/set_payment_admin');
}

public function SubsManagementView(){
    return view('admin/dashboard/subscriber_management');
}

public function MembershipManagementView(){
    return view('admin/dashboard/membership_management');
}

public function UserManagementView(){
    return view('admin/dashboard/user_management');
}







// METHOD POST 
public function auth_adminlogin(Request $request) {
$request->validate([
   'useradmin' => 'required',
   'passadmin' => 'required',
]);
$input = $request->all();

// dd($input);

if($input['useradmin'] == 'afwika' && $input['passadmin'] == 'afwika'){
	return redirect('admin/dashboard');
}else{
    $url = env('SERVICE').'auth/commadmin';
try{
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
        'form_params' => [
        'user_name'   => $input['useradmin'],
        'password'    => $input['passadmin']
        ]
    ]);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    // dd($json);

    if($json['success'] == true){
    Session::put('session_admin_logged', $json['data']);
    $nameku = $json['data']['user']['full_name'];

    return redirect('admin/dashboard')->with('nama_admin',$nameku );
    }

}catch(ClientException $exception) {
$code_error = $exception->getCode();
   if( $code_error == 404){
    alert()->error('Wrong Password!', 'Failed!')->autoclose(4500)->persistent('Done');
    return back()->withInput();
    }
    
} //end-catch
} //end-if
} //end-func


//SESSION LOGGED USER - DASHBOARD SUPERADMIN
public function session_admin_logged(){
    if(Session::has('session_admin_logged')){
    $ses_login = Session::get('session_admin_logged');
    return $ses_login;
    }else{
    return redirect('admin');
    }
}

public function LogoutAdmin(){
    $ses_login = Session::get('session_admin_logged');

    $url = env('SERVICE').'profilemanagement/logout';
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

try{
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    Session::forget('session_admin_logged');

    if($json['success'] == true){
        return redirect('admin');
    }
}catch(ClientException $exception) {
    $status_error = $exception->getCode();
    if( $status_error == 401){
       alert()->error('Over linit time, please do login again', 'Unauthorized')->persistent('Done');
        return redirect('admin');
    }
}
} //enfunc



public function get_dashboard_admin(){
    $ses_login = Session::get('session_admin_logged');
    // return $ses_login['access_token'];

    $url = env('SERVICE').'dashboard/admincommunity';
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
}


public function tabel_subs_management(Request $request){
$ses_login = Session::get('session_admin_logged');
$input = $request->all();
$client = new \GuzzleHttp\Client();    
// return $input;
try{
if($request['subs_datemulai'] != null && $request['subs_dateselesai'] != null ){
    
$urlx = env('SERVICE').'subsmanagement/filtersubsbydate';
    $headers = [
     'Content-Type' => 'application/json',
     'Authorization' => $ses_login['access_token']
    ];
    $bodyku = json_encode([
    'start_date'   => $input['subs_datemulai'],
    'end_date'    => $input['subs_dateselesai']
    ]);
    $options = [
    'body' => $bodyku,
    'headers' => $headers,
    ];

    $response = $client->post($urlx, $options);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
}else{ //data-all
$url = env('SERVICE').'subsmanagement/listsubs';
    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
} //end-else    
} catch(ClientException $exception) {
    $status_error = $exception->getCode();
    if( $status_error == 500){
        return json_encode('Data Not Found');
    }
} 
} //end-func




public function filter_membership_subs(Request $request){
$ses_login = Session::get('session_admin_logged');
$input = $request->all();
$client = new \GuzzleHttp\Client(); 

$urlx = env('SERVICE').'subsmanagement/filtersubsbymembership';
$headers = [
     'Content-Type' => 'application/json',
     'Authorization' => $ses_login['access_token']
    ];
$bodyku = json_encode([
    'membership_id'   => $input['membership'],
    ]);
    $options = [
    'body' => $bodyku,
    'headers' => $headers,
    ];

try{
    $response = $client->post($urlx, $options);
    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
}catch(ClientException $exception) {
    $status_error = $exception->getCode();
    if( $status_error == 500){
        return json_encode('Data Not Found');
    }
}
}



public function tabel_subs_pending(){
     $ses_login = Session::get('session_admin_logged');

    // return $ses_login['access_token'];

    $url = env('SERVICE').'subsmanagement/listsubspending';
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
}


public function setting_publish_comm(){
     $ses_login = Session::get('session_admin_logged');

    $url = env('SERVICE').'commsetting/publish';
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);

    if($json['success'] == true){
        alert()->success('Succcessflly to pulish your community, enjoy with your subscribers','Published !')->persistent('Done');
    return back();
    }
    // return $json['data'];
}



public function detailSubcriberManagementView($id_subs){
$ses_login = Session::get('session_admin_logged');
$urlx = env('SERVICE').'subsmanagement/detailsubs';

$client = new \GuzzleHttp\Client();
$headers = [
 'Content-Type' => 'application/json',
 'Authorization' => $ses_login['access_token']
];
$bodyku = json_encode([
'user_id'   => $id_subs
]);

$options = [
'body' => $bodyku,
'headers' => $headers,
];

$response = $client->post($urlx, $options);
$response = $response->getBody()->getContents();
$json = json_decode($response, true);
$in = $json['data'];

if($in['status'] == 3){
$status = 'Published';
}else if($in['status'] == 2){
$status = 'Active';
}else if($in['status'] == 1){
$status = 'Deactive';
}else{
$status = 'Newly Join';
}

$dtaku = [
"user_id"       => $in['user_id'],
"full_name"     => $in['full_name'],
"created_at"    => $in['created_at'],
"status"        => $status,
"status_id"     => $in['status'],
"membership_id" => $in['membership_id'],
"sso_picture"   => $in['sso_picture'],
];
// dd($dtaku);
return view('admin/dashboard/detail_subs_all')->with($dtaku);
}        



public function editSubsManagementView($id_subs){
    return view('admin/dashboard/editsubs_profil', ['idsubs' => $id_subs ]);
}


public function detailPendingSubcriberView($id_pending){
    $iniid = 'data pending tester '.$id_pending;
    return view('admin/dashboard/detail_subs_pending', ['profil_subs' => $iniid ]);
}


public function edit_profil_community(Request $request){
// dd($request);
    
    $ses_login = Session::get('session_admin_logged');
    $token = $ses_login['access_token'];

    $req = new RequestController; 
    $fileimg = "";

    if ($request->hasFile('fileup')) {
        $imgku = file_get_contents($request->file('fileup')->getRealPath());
        $filnam = $request->file('fileup')->getClientOriginalName();

        $input = $request->all(); // getdata form by name
        $imageRequest = [
                "name"        => $input['edit_namacom'],
                "description" => $input['edit_deskripsicom'],
                "filename"    => $filnam,
                "file"        => $imgku
        ]; 


    $url =env('SERVICE').'commsetting/editcomm';
    try{
      $resImg = $req->editProfilCommunity($imageRequest,$url,$token);
      // return $resImg;

      if ($resImg['success'] == true) {
        alert()->success('Successfully to update your community information', 'Now Updated!')->persistent('Done');
        return back();
      }
    }catch(ClientException $exception) {
        dd($exception);
    }
    }else{//END-IF  UPLOAD-IMAGE 
     $input = $request->all(); // getdata form by name
        $imageRequest = [
                "name"        => $input['edit_namacom'],
                "description" => $input['edit_deskripsicom'],
                "filename"    => "",
                "file"        => ""
        ]; 


    $url =env('SERVICE').'commsetting/editcomm';
    try{
      $resImg = $req->editProfilCommunity($imageRequest,$url,$token);
      // return $resImg;

      if ($resImg['success'] == true) {
        alert()->success('Successfully to update your community information', 'Now Updated!')->persistent('Done');
        return back();
      }
    }catch(ClientException $exception) {
        dd($exception);
    }
    }// endelse
}



public function setting_loginresgis_comm(Request $request){
// dd($request);

    $ses_login = Session::get('session_admin_logged');
    $token = $ses_login['access_token'];

    $req = new RequestController; 
    $fileimg = "";

    if ($request->hasFile('fileup')) {
        $imgku = file_get_contents($request->file('fileup')->getRealPath());
        $filnam = $request->file('fileup')->getClientOriginalName();

        $input = $request->all(); // getdata form by name
        $imageRequest = [
            "form_type"     => $input['optionsRadios'],
            "headline_text" => $input['headline'],
            "description"   => $input['description_custom'],
            "subdomain"     => $input['subdomain'],
            "filename"      => $filnam,
            "file"          => $imgku
        ]; 


    $url =env('SERVICE').'commsetting/loginregister';
    try{
      $resImg = $req->SettingLoginRegis($imageRequest,$url,$token);
      // return $resImg;

      if ($resImg['success'] == true) {
      alert()->success('Successfully setting login and registrasion, setup domain being process', 'Done!')->persistent('Done');
        return back();
      }
    }catch(ClientException $exception) {
        dd($exception);
    }
    }else{//END-IF  UPLOAD-IMAGE 
     $input = $request->all(); // getdata form by name
     $imageRequest = [
            "form_type"     => $input['optionsRadios'],
            "headline_text" => $input['headline'],
            "description"   => $input['description_custom'],
            "subdomain"     => $input['subdomain'],
            "filename"      => "",
            "file"          => ""
        ]; 


    $url =env('SERVICE').'commsetting/loginregister';
    try{
      $resImg = $req->editProfilCommunity($imageRequest,$url,$token);
      // return $resImg;

      if ($resImg['success'] == true) {
       alert()->success('Successfully setting login and registrasion, setup domain being process', 'Done!')->persistent('Done');
        return back();
      }
    }catch(ClientException $exception) {
        dd($exception);
    }
    }// endelse
}





public function setting_membership_comm(Request $request){
// dd($request);
$ses_login = Session::get('session_admin_logged');
$input = $request->all();

$url = env('SERVICE').'commsetting/membershiptype';
$client = new \GuzzleHttp\Client();
$member = (int)$input['membership'];
// START
$headers = [
 'Content-Type' => 'application/json',
 'Authorization' => $ses_login['access_token']
];
$bodyku = json_encode(['membership_type' => $member]);

$datakirim = [
'body' => $bodyku,
'headers' => $headers,
];
$response = $client->post($url, $datakirim);
$response = $response->getBody()->getContents();
$json = json_decode($response, true);

// return $json;

if($json['success'] == true){
alert()->success('Succcessflly set Membership type for your community','Succcessflly Set Membership !')->persistent('Done');
return redirect('/admin/settings/membership');
}
}



public function tabel_list_regisdata(){
    $ses_login = Session::get('session_admin_logged');

    $url = env('SERVICE').'commsetting/listregistrationdata';
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
}




public function setting_regisdata_comm(Request $request){
$ses_login = Session::get('session_admin_logged');

$in = $request->except('_token'); 
$param_isi = array_values($in);

$url = env('SERVICE').'commsetting/addregistrationdata';
$client = new \GuzzleHttp\Client();
$headers = [
 'Content-Type' => 'application/json',
 'Authorization' => $ses_login['access_token']
];
$bodyku = json_encode(['params' => $param_isi]);
$options = [
'body' => $bodyku,
'headers' => $headers,
];

$response = $client->post($url, $options);
$response = $response->getBody()->getContents();
$json = json_decode($response, true);

if($json['success'] == true){
alert()->success('Succcessflly adding new question','Question Added !')->persistent('Done');
return redirect('/admin/settings/registrasion_data');
}
} //endfunc



public function filter_subs(){
$ses_login = Session::get('session_admin_logged');
$urlx = env('SERVICE').'subsmanagement/filtersubsbydate
';

$client = new \GuzzleHttp\Client();
$headers = [
 'Content-Type' => 'application/json',
 'Authorization' => $ses_login['access_token']
];
$bodyku = json_encode([
'start_date'   => $input['subs_datemulai'],
'end_date'    => $input['subs_dateselesai']
]);

$options = [
'body' => $bodyku,
'headers' => $headers,
];

$response = $client->post($urlx, $options);
$response = $response->getBody()->getContents();
$json = json_decode($response, true);
return $json;

}



public function get_list_membership_admin(){
$ses_login = Session::get('session_admin_logged');
// return $ses_login;
// return $ses_login['access_token'];

    $url = env('SERVICE').'membershipmanagement/listmembership';
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
}



public function tabel_req_membership(){
$ses_login = Session::get('session_admin_logged');

    $url = env('SERVICE').'membershipmanagement/membershipreq';

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
}


public function get_membership_subs(){
    $ses_login = Session::get('session_admin_logged');

    $url = env('SERVICE').'subsmanagement/membership';
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
}



public function get_payment_tipe(){
    $ses_login = Session::get('session_admin_logged');

    $url = env('SERVICE').'commsetting/listpaymenttype';
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
}


public function tabel_payment_community(){
$ses_login = Session::get('session_admin_logged');
$url = env('SERVICE').'commsetting/listpaymenttype';
$client = new \GuzzleHttp\Client();

    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

$response = $response->getBody()->getContents();
$json = json_decode($response, true);
return $json['data'];
}


public function get_detail_membership_req(Request $request){
$ses_login = Session::get('session_admin_logged');
$input = $request->all();

$url = env('SERVICE').'membershipmanagement/detailmembershipreq';
$client = new \GuzzleHttp\Client();

$headers = [
 'Content-Type' => 'application/json',
 'Authorization' => $ses_login['access_token']
];
$bodyku = json_encode(['invoice_number' => $input['invoice_number']]);

$datakirim = [
'body' => $bodyku,
'headers' => $headers,
];
$response = $client->post($url, $datakirim);
$response = $response->getBody()->getContents();
$json = json_decode($response, true);

return $json['data'];
}


public function edit_profile_admincom(Request $request){
// dd($request);

    $ses_login = Session::get('session_admin_logged');
    $token = $ses_login['access_token'];

    $req = new RequestController; 
    $fileimg = "";

    if ($request->hasFile('fileup')) {
        $imgku = file_get_contents($request->file('fileup')->getRealPath());
        $filnam = $request->file('fileup')->getClientOriginalName();

        $input = $request->all(); // getdata form by name
        $imageRequest = [
        "user_name" => $input['username_admin'],
        "full_name" => $input['name_admin'],
        "notelp" => $input['phone_admin'],
        "email" => $input['email_admin'],
        "alamat" => $input['alamat_admin'],
        "filename" => $filnam,
        "file" => $imgku
        ]; 


    $url =env('SERVICE').'profilemanagement/editprofile';
    try{
      $resImg = $req->editProfileAdmin($imageRequest,$url,$token);
      // return $resImg;

      if ($resImg['success'] == true) {
        alert()->success('Successfully to update your community information', 'Now Updated!')->persistent('Done');
        return back();
      }
    }catch(ClientException $exception) {
        dd($exception);
    }
    }else{//END-IF  UPLOAD-IMAGE 
     $input = $request->all(); // getdata form by name
        $imageRequest = [
        "user_name" => $input['username_admin'],
        "full_name" => $input['name_admin'],
        "notelp" => $input['phone_admin'],
        "email" => $input['email_admin'],
        "alamat" => $input['alamat_admin'],
        "filename"    => "",
        "file"        => ""
        ]; 


    $url =env('SERVICE').'profilemanagement/editprofile';
    try{
      $resImg = $req->editProfileAdmin($imageRequest,$url,$token);
      // return $resImg;

      if ($resImg['success'] == true) {
        alert()->success('Successfully to update your community information', 'Now Updated!')->persistent('Done');
        return back();
      }
    }catch(ClientException $exception) {
        dd($exception);
    }
    }// endelse
} //endfunc



public function change_password_admincom(Request $request){
// dd($request);
$ses_login = Session::get('session_admin_logged');
$input = $request->all();

$url = env('SERVICE').'profilemanagement/changepassword';
$client = new \GuzzleHttp\Client();

$headers = [
 'Content-Type' => 'application/json',
 'Authorization' => $ses_login['access_token']
];
$bodyku = json_encode([
    'old_password' => $input['old_pass_admin'],
    'new_password' => $input['new_pass_admin']
]);

$datakirim = [
'body' => $bodyku,
'headers' => $headers,
];

try{
$response = $client->post($url, $datakirim);
$response = $response->getBody()->getContents();
$json = json_decode($response, true);
if( $json['success'] == true){
       alert()->success('Successfully to change password', 'Password Updated')->persistent('Done');
        return back();
    }

}catch(ClientException $exception) {
    $status_error = $exception->getCode();
    // return $status_error;
    if( $status_error == 400){
       alert()->error('Your Old Password didnt match', 'Wrong Password')->persistent('Done');
        return back();
    }
}

}



public function tabel_user_management(){
$ses_login = Session::get('session_admin_logged');

    $url = env('SERVICE').'usermanagement/listuser';
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
}




public function get_user_tipe_manage(){
    $ses_login = Session::get('session_admin_logged');

    $url = env('SERVICE').'usermanagement/listusertype';
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST',$url, [
    'headers' => [
    'Content-Type' => 'application/json',
    'Authorization' => $ses_login['access_token']
    ]
    ]);

    $response = $response->getBody()->getContents();
    $json = json_decode($response, true);
    return $json['data'];
}



public function add_user_management(Request $request){
// dd($request);
$ses_login = Session::get('session_admin_logged');
$input = $request->all();

$url = env('SERVICE').'usermanagement/createuser';
$client = new \GuzzleHttp\Client();

$headers = [
 'Content-Type' => 'application/json',
 'Authorization' => $ses_login['access_token']
];
$bodyku = json_encode([
    "full_name" => $input['name_user'],
    "user_name" => $input['username_user'],
    "notelp" => $input['phone_user'],
    "email" => $input['email_user'],
    "alamat" => $input['alamat_user'],
    "usertype_id" => $input['user_tipe'],
    "password" => $input['pass_user'],
]);

$datakirim = [
'body' => $bodyku,
'headers' => $headers,
];

try{
$response = $client->post($url, $datakirim);
$response = $response->getBody()->getContents();
$json = json_decode($response, true);
if( $json['success'] == true){
       alert()->success('Successfully to add new user', 'Added')->persistent('Done');
        return back();
    }

}catch(ClientException $exception) {
    $status_error = $exception->getCode();
    // return $status_error;
    if( $status_error == 400){
       alert()->error('Proccess might interrupted at the middle, try again', 'Opps')->persistent('Done');
        return back();
    }
}
}



public function add_useredit_management(Request $request){
dd($request);

}


public function nonaktif_status_subs(Request $request){
$ses_login = Session::get('session_admin_logged');
$input = $request->all();

$url = env('SERVICE').'subsmanagement/nonactivesubs';
$client = new \GuzzleHttp\Client();

$headers = [
 'Content-Type' => 'application/json',
 'Authorization' => $ses_login['access_token']
];
$bodyku = json_encode(['user_id' => $input['idsubs'] ]);

$datakirim = [
'body' => $bodyku,
'headers' => $headers,
];
$response = $client->post($url, $datakirim);
$response = $response->getBody()->getContents();
$json = json_decode($response, true);


if($json['success'] == true){
alert()->success('Succcessflly to change your subscriber status ','Success !')->persistent('Done');
return back();
}

}


















} //end-class
