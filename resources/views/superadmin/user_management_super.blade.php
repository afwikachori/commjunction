@extends('layout.superadmin')

@section('title', 'Users Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>User Management</h3>

    <nav aria-label="breadcrumb">
        <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-target="#modal_add_user">Add
            User</button>
    </nav>
</div>


<div class="row">
    <div id="page_user_management_super"></div>
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih">
                List User
            </div>

            <div class="card-body">
                <!-- tabel all susbcriber -->
                <table id="tabel_user_manage" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th><b>ID User</b></th>
                            <th><b>Name</b></th>
                            <th><b>Username</b></th>
                            <th><b>User Type</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                </table>
                <!-- end tabel all  -->
            </div> <!-- //body -->
        </div>
    </div>
</div> <!-- endrow -->






<!-- MODAL ADD USER-->
<div class="modal fade" id="modal_add_user" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_edit_usermanage" action="{{route('add_user_management_super')}}">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Add User</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight">Fullname</small>
                                <input type="text" id="name_user" name="name_user" class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight">Phone Number</small>
                                <input type="text" id="phone_user" name="phone_user" class="form-control input-abu">
                            </div>

                        </div>

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight">Email</small>
                                <input type="email" id="email_user" name="email_user" class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight">User Type</small>
                                <select class="form-control input-abu" id="user_tipe" name="user_tipe">
                                </select>
                            </div>

                        </div>
                    </div>

                    <small class="cgrey tebal">Account Information</small>
                    <div class="row" style="margin-top: 0.5em;">
                        <div class="form-group col-md-6">
                            <small class="clight">Username</small>
                            <input type="text" id="username_user" name="username_user" class="form-control input-abu">
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5em;">
                        <div class="form-group col-md-12">
                            <small class="clight">Address</small>
                            <textarea class="form-control input-abu" id="alamat_user" name="alamat_user"
                                rows="2"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight">Password</small>
                                <input type="Password" id="pass_user" name="pass_user" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <small class="clight">Confirm Password</small>
                                <div class="input-group">
                                    <input class="form-control input-abu" id="confirmpass_user" type="password"
                                        name="confirmpass_user" required="" autocomplete="passadmin"
                                        aria-describedby="btn_newshowpass">
                                    <div class="input-group-append">
                                        <a class="btn btn-outline-light" type="button" id="btn_newshowpass"
                                            onclick="showPassUsermanage()"
                                            style="background-color: #efefef; border-radius: 0px 10px 10px 0px; padding: 14px 10px 0 10px;">
                                            <span class="mdi mdi-eye" aria-hidden="true" style="color: grey;"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end-row -->

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_add_usermanage" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Add User </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>





<!-- MODAL DETAIL USER MANAGEMENT-->
<div class="modal fade" id="modal_detail_user" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                <h4 class="modal-title cgrey">Detail User</h4>
            </div> <!-- end-header -->

            <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                <div class="bunder-ring">
                    <img class="profile-pic rounded-circle img-fluid" id="foto_user" src=""
                        onError="this.onerror=null;this.src='/img/noimg.jpg';">
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight">Fullname</small>
                            <p class="cgrey1 tebal" id="detail_nama"></p>
                        </div>
                        <div class="form-group">
                            <small class="clight">Phone Number</small>
                            <p class="cgrey1 tebal" id="detail_hp"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight">Email</small>
                            <p class="cgrey1 tebal" id="detail_email"></p>
                        </div>
                        <div class="form-group">
                            <small class="clight">User Type</small>
                            <p class="cgrey1 tebal" id="detail_usertipe"></p>
                        </div>
                    </div>
                </div>

                <small class="cgrey tebal">Account Information</small>
                <div class="row" style="margin-top: 0.5em;">
                    <div class="form-group col-md-6" style="padding-bottom: -0.5em;">
                        <small class="clight">Username</small>
                        <p class="cgrey1 tebal" id="detail_username"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12" style="margin-top: -1em;">
                        <small class="clight">Address</small>
                        <p class="cgrey1 tebal" id="detail_alamat"></p>
                    </div>
                </div>
            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
                    <i class="mdi mdi-close"></i> Cancel
                </button>
                &nbsp;
                <button type="button" id="" class="btn btn-teal btn-sm" data-toggle="modal"
                    data-target="#modal_edit_user" data-dismiss="modal">
                    <i class="mdi mdi-check btn-icon-prepend">
                    </i> Edit User </button>
            </div> <!-- end-footer     -->
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>





<!-- MODAL EDIT USER MANAGEMENT-->
<div class="modal fade" id="modal_edit_user" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_add_user_manage" action="{{route('edit_user_management_super')}}">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Edit User</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight">Fullname</small>
                                <input type="text" id="edit_nama" readonly
                                    class="form-control-plaintext melengkung10px">
                            </div>
                            <div class="form-group">
                                <small class="clight">Phone Number</small>
                                <input type="text" id="edit_phone" name="edit_phone" class="form-control input-abu">
                            </div>

                        </div>

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight">Email</small>
                                <input type="email" id="edit_email" name="edit_email" class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight">User Type</small>
                                <select class="form-control input-abu" name="user_tipe_edit" id="user_tipe_edit">
                                </select>
                            </div>
                        </div>

                        <input type="hidden" id="idnya_user" name="idnya_user" class="form-control input-abu">
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Edit </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



@endsection
