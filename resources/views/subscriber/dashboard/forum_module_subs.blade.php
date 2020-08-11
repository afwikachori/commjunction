@extends('layout.subscriber')
@section('title', 'Forum Module')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Forum Module</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your forum and group or members activity<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">

        </nav>
    </div>
</div>
<br>

<div class="row">
    <div id="page_forum_module_subs"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="row mgb-1">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6 kananin">
                        <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                            data-target="#modal_create_group" lang="en">Add Member</button>
                    </div>
                </div>
<br>

                <table id="tabel_forum_group_subs" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th><b lang="en">ID</b></th>
                            <th><b lang="en">Title</b></th>
                            <th><b lang="en">Icon</b></th>
                            <th><b lang="en">Banner</b></th>
                            <th><b lang="en">Type</b></th>
                            <th><b lang="en">Status</b></th>
                            <th><b lang="en">Date Created</b></th>
                             <th><b lang="en">Link</b></th>
                            <th><b lang="en">Action</b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- MODAL CREATE GROUP -->
<div class="modal fade" id="modal_create_group" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_create_group_subs" action="{{route('post.subs.forum-addgroup')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Add Group - Forum</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Title Group</small>
                                <input type="text" id="group_judul" name="group_judul" class="form-control input-abu"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Description Group</small>
                                <textarea type="text" id="group_deskripsi" name="group_deskripsi" rows="3"
                                    class="form-control input-abu" required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Group Type</small>
                                <input type="text" id="group_type" name="group_type" class="form-control input-abu"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Private Group</small>
                                <select class="form-control input-abu" name="group_private" id="group_private" required>
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="0" lang="en">Public</option>
                                    <option value="1" lang="en">Private</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Group Icon</small>
                                <input type="file" id="img_group_icon" name="img_group_icon"
                                    class="form-control input-abu" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Banner Group</small>
                                <input type="file" id="img_group_banner" name="img_group_banner"
                                    class="form-control input-abu" required>
                            </div>
                        </div>
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Create</span> </button>
                </div>
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL DETAIL GROUP -->
<div class="modal fade" id="modal_detail_group" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                <div class="card bg-dark text-white profil-grup">
                    <img src="/img/artikel.jpg" class="card-img profil-grup" id="banner-group">
                    <div class="card-img-overlay">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="/img/noimg.jpg" class="rounded-circle img-fluid img-profil-grup"
                                    id="icon-group">
                                <a class="btn-sm btn-tosca btn-addadmingrup" data-toggle="collapse" href="#collapseExample" role="button"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    <small>Add Admin</small>
                                </a>
                            </div>
                            <div class="col-md-9">
                                <h5 class="ctosca" id="info_title">Profile Group</h5>
                                <p class="cwhite s13 des-group" id="info_deskripsi"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end-header -->

            <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Title Group</small>
                            <h6 class="cgrey" id="info_judul"></h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Date Created Group</small>
                            <h6 class="cgrey" id="info_tanggal"></h6>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Group Type</small>
                            <h6 class="cgrey" id="info_tipe"></h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Private Group</small>
                            <h6 class="cgrey" id="info_privat"></h6>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Invitation Limitation</small>
                            <h6 class="cgrey" id="info_invit"></h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Discussion Limitation</small>
                            <h6 class="cgrey" id="info_diskus"></h6>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Member Limitation</small>
                            <h6 class="cgrey" id="info_member"></h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Total Member</small>
                            <h6 class="cgrey" id="info_totalmember"></h6>
                        </div>
                    </div>
                </div>

                <div class="collapse" id="collapseExample">
                    <div class="card card-body set-admin">
                        <form method="POST" id="form_set_admin_grup" action="{{route('post.subs.forum-setadmin')}}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" id="group_id" name="group_id">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <small class="clight" lang="en">Choose Admininstratot</small>
                                        <select class="form-control input-abu" name="list_admin" id="list_admin"
                                            required>
                                            <option selected disabled lang="en">Loading ...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 pas-tengah">
                                    <button type="submit" class="btn btn-teal btn-sm">
                                        <span lang="en s13">Add as Admin</span> </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>


            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
                    <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                </button>

                <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-dismiss="modal"
                    data-target="#modal_edit_group" lang="en">Edit Group</button>
            </div>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL EDIT GROUP -->
<div class="modal fade" id="modal_edit_group" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_edit_forum_group" action="{{route('post.subs.forum-editgroup')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Edit Group - Forum</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Title Group</small>
                                <input type="text" id="edit_judul" name="edit_judul" class="form-control input-abu"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Description Group</small>
                                <textarea type="text" id="edit_deskripsi" name="edit_deskripsi" rows="3"
                                    class="form-control input-abu" required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Group Type</small>
                                <input type="text" id="edit_type" name="edit_type" class="form-control input-abu"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Private Group</small>
                                <select class="form-control input-abu" name="edit_private" id="edit_private" required>
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="0" lang="en">Public</option>
                                    <option value="1" lang="en">Private</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Group Icon</small>
                                <input type="file" id="img_edit_icon" name="img_edit_icon" accept="image/*"
                                    class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Banner Group</small>
                                <input type="file" id="img_edit_banner" name="img_edit_banner" accept="image/*"
                                    class="form-control input-abu">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="id_group_edit" name="id_group_edit" readonly>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Edit</span> </button>
                </div>
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>

<!-- MODAL SETTING GROUP -->
<div class="modal fade" id="modal_setting_group" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="border: none;">
                <h3 class="modal-title" lang="en">Setting Group</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form_setting_group_admin" action="{{route('post.subs.forum-settinggroup')}}">
                {{ csrf_field() }}
                <div class="modal-body set-group">
                    <h5 class="ctosca" id="judul_group"></h5>
                    <small class="cgrey mgb-1" id="deskripsi_group"></small>

                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Invitation Limitation</small>
                                <div class="custom-control custom-switch" id="div_invit_limit">
                                    <input type="checkbox" class="custom-control-input" id="invit_limit"
                                        name="invit_limit">
                                    <label class="custom-control-label" for="invit_limit">
                                        <span id="txt_invit_limit">Off</span></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <small class="clight" lang="en">Discussion Limitation</small>
                                <div class="custom-control custom-switch" id="div_diskusi_limit">
                                    <input type="checkbox" class="custom-control-input" id="diskusi_limit"
                                        name="diskusi_limit">
                                    <label class="custom-control-label" for="diskusi_limit">
                                        <span id="txt_diskusi_limit">Off</span></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <small class="clight" lang="en">Member Limitation</small>
                                <div class="custom-control custom-switch" id="div_member_limit">
                                    <input type="checkbox" class="custom-control-input" id="member_limit"
                                        name="member_limit">
                                    <label class="custom-control-label" for="member_limit">
                                        <span id="txt_member_limit">Off</span></label>
                                </div>
                            </div>

                            <div class="form-group on-member" style="display: none;">
                                <small class="clight" lang="en">Total Member Limitation</small>
                                <input type="text" id="total_member" name="total_member" class="form-control input-abu">
                            </div>

                        </div>
                    </div>
                    <input type="hidden" id="id_grup" name="id_grup">
                </div>
                <div class="modal-footer"
                    style="border: none; margin-bottom: 0.5em;
                            display: flex;align-items: center; justify-content: center; padding-left: 5%; padding-right: 5%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i><span lang="en">Setting</span></button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection
