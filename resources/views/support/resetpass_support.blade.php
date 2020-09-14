@extends('layout.support-master')
@section('title', 'Reset Password')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Reset Password</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey">Force Reset Password for User<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
        </nav>
    </div>
</div>

<br>
<br>
<div class="row">
    <div id="page_support_resetpassword"></div>
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih">
                <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                    data-target="#modal_generate_user">
                    Generate Log</button>
            </div>

            <div class="card-body">

                <table id="tabel_user_resetpass" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th><b> ID User </b></th>
                            <th><b> Photo </b></th>
                            <th><b> Full Name </b></th>
                            <th><b> Email </b></th>
                            <th><b> Username </b></th>
                            <th><b> Action </b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->


<!-- MODAL GENERATE USER RESET PASSWORD -->
<div class="modal fade" id="modal_generate_user" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="mod-header pad-5persen">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Generate User</small>
                <br>
                <h4 class=" cblue">Force Reset Password</h4>
            </div>

            <form>
                <div class="modal-body body250">


                    <div class="row" style="margin-top: 0.5em;">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Community Status</small>
                                <select class="form-control input-abu" name="status_komunitas" id="status_komunitas"
                                    required>
                                    <option selected disabled> Choose </option>
                                    <option value="all" selected> All </option>
                                    <option value="0"> Newly </option>
                                    <option value="1"> First Login </option>
                                    <option value="2"> Active </option>
                                    <option value="3"> Published </option>
                                    <option value="4"> Deactive </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group" id="hide_status_kom" style="display: nones;">
                                <small class="clight s13">Community List</small>
                                <select class="form-control input-abu" name="list_komunitas_resetpas" id="list_komunitas_resetpas"
                                    required>
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>



                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">User Type</small>
                                <select class="form-control input-abu" name="user_type" id="user_type" required>
                                    <option selected disabled> Choose </option>
                                    <option value="2"> Admin Community </option>
                                    <option value="3"> Subscriber </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md">
                        </div> <!-- end-col-md -->
                    </div>
                </div> <!-- end-body -->
                <div class="modal-footer" style="border: none; padding-top: 2em">
                    <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_user_resetpas" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Generate </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL DETAIL USER -->
<div class="modal fade" id="modal_detail_user_reset" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="mod-header pad-5persen">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Detail User</small>
                <br>
                <h4 class=" cblue">Force Reset Password</h4>
                <nav aria-label="breadcrumb">

                </nav>
            </div>
            <br>
            <form method="POST" id="form_reset_pass" action="{{route('reset_pass_share_otp')}}">
                {{ csrf_field() }}
                <input type="hidden" id="id_komunitas" name="id_komunitas">
                <input type="hidden" id="user_tipe" name="user_tipe">
                <input type="hidden" id="user_id" name="user_id">


                <div class="modal-body body250" style="padding-left: 1.5em;">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="/img/kosong.png" onclick="clickImage(this)" id="imgsprev"
                                class="img zoom rounded-circle"
                                style="margin-left: auto; margin-right: auto; width: 100%;"
                                onerror="this.onerror=null;this.src='/img/kosong.png';">
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <small class="clight s13">ID User</small>
                                <p class="cgrey s13" id="detail_iduser"></p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="clight s13">Full Name</small>
                                        <p class="cgrey s13" id="detail_fullname"></p>
                                    </div>
                                    <div class="form-group">
                                        <small class="clight s13">Email</small>
                                        <p class="cgrey s13" id="detail_email"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="clight s13">Username</small>
                                        <p class="cgrey s13" id="detail_username"></p>
                                    </div>
                                    <div class="form-group">
                                        <small class="clight s13">Resend OTP</small>
                                        <button type="button" id="btn_send_otp_resetpas" class="btn btn-tosca btn-sm">
                                            <i class="mdi mdi-lock btn-icon-prepend">
                                            </i> Send OTP </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4" style="padding-right: 0em;">
                                <h6 class="cgrey2">OTP Number</h6>
                                <small class="clight">Input OTP Number from User's Email</small>
                            </div>
                            <div class="col-md-4" style="padding-right: 0em;">
                                <input type="text" id="text_OTP" name="text_OTP" class="form-control input-abu"
                                    style="font-size: 20px; color: #50b7b9;">
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div> <!-- end-body -->
                <div class="modal-footer" style="border: none; padding-top: 2em">
                    <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Reset </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



@endsection
