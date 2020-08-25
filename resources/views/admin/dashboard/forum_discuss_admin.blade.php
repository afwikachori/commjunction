@extends('layout.admin-dashboard')
@section('title', 'Forum Discussion')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Discussion Group</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your forum and group or Discussion activity<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <small class="cgrey2">ID Group </small>
        <input type="text" id="id_group" value="{{ $id_group }}" readonly>
    </div>
</div>
<br>

<div class="row">
    <div id="page_discussion_group_admin"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="row mgb-1">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6 kananin">
                        <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                            data-target="#modal_diskusi_group_forum" lang="en">Create Discussion</button>
                    </div>
                </div>

                <table id="tabel_diskusi_group" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th><b lang="en">ID</b></th>
                            <th><b lang="en">Title</b></th>
                            <th><b lang="en">Banner</b></th>
                            <th><b lang="en">Tags</b></th>
                            <th><b lang="en">Status</b></th>
                            <th><b lang="en">Date Created</b></th>
                            <th><b lang="en">View</b></th>
                            <th><b lang="en">Likes</b></th>
                            <th><b lang="en">Action</b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>




<!-- MODAL CREATE DISKUSI GROUP -->
<div class="modal fade" id="modal_diskusi_group_forum" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_diskusi_group_forum" action="{{route('post.admin.forum-adddiskusi')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id_group_add" value="{{ $id_group }}" readonly>

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Add Discussion Group</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Title Discussion</small>
                                <input type="text" id="discuss_judul" name="discuss_judul"
                                    class="form-control input-abu" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Description Discussion</small>
                                <textarea type="text" id="discuss_deskripsi" name="discuss_deskripsi" rows="3"
                                    class="form-control input-abu" required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Tag Discussion</small>
                                <!-- <input type="text" id="discuss_tags" name="discuss_tags" class="form-control input-abu"
                                    required> -->

                                <ul class="tags">
                                    <li class="addedTag">Discussion<span onclick="$(this).parent().remove();"
                                            class="tagRemove">x</span><input type="hidden" name="tags[]"
                                            value="Discussion"></li>
                                    <li class="tagAdd taglist">
                                        <input type="text" id="search-field">
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Banner Group</small>
                                <input type="file" id="img_discuss_banner" name="img_discuss_banner"
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


<!-- MODAL DETAIL DISCUSSION GROUP -->
<div class="modal fade" id="modal_info_discussion" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                <div class="card bg-dark text-white profil-grup">
                    <img src="/img/artikel.jpg" class="card-img profil-grup" id="banner-discuss">
                    <div class="card-img-overlay">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="/img/noimg.jpg" class="rounded-circle img-fluid zoom img-profil-grup"
                                    id="icon-discuss" onclick="clickImage(this)">

                                <div class="info-aksi">
                                    <label class="badge badge-gradient-success">
                                        <i class="mdi mdi-eye icon-sm"></i>
                                        <span id="info-viewers">0</span>
                                    </label>
                                    <label class="badge badge-gradient-danger">
                                        <i class="mdi mdi-heart icon-sm"></i>
                                        <span id="info-likers">0</span>
                                    </label>

                                </div>
                            </div>
                            <div class="col-md-9">
                                <h5 class="ctosca" id="info_title">Discussion Group</h5>
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
                            <small class="clight" lang="en">Title Discussion</small>
                            <h6 class="cgrey" id="info_judul"></h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Date Created Discussion</small>
                            <h6 class="cgrey" id="info_tanggal"></h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Tags Discussion</small>
                            <div class="cgrey" id="info_tags"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Status Discussion</small>
                            <h6 class="cgrey" id="info_status"></h6>
                        </div>
                    </div>
                </div>
            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
                    <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                </button>

                <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-dismiss="modal"
                    data-target="#modal_edit_diskusi_group_forum" lang="en">Edit Discussion</button>
            </div>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



<!-- MODAL DELETE MEMBER-->
<div class="modal fade" id="modal_delete_discussion" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff; width: 80%;
        min-height: 350px;">

            <form method="POST" id="form_delete_discussion" action="{{route('post.admin.forum-deletediskusi')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <center>
                        <img src="/visual/warning.png" id="img_signout_admin">
                        <h3 class="cgrey" lang="en">Confirmation</h3>
                        <small class="clight" lang="en">Are you sure, you want to delete
                            <span id="nama_del_member" class="tebal">this member</span>
                            from this group ?</small>


                        <input type="hidden" id="discussion_id" name="discussion_id" readonly>
                        <input type="hidden" name="group_id" value="{{ $id_group }}" readonly>
                    </center>
                </div> <!-- end-body -->

                <div class="modal-footer changepass" style="border: none;">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> <span lang="en">No, Im Doubt</span>
                        </button>
                        &nbsp;
                        <button type="submit" class="btn btn-tosca btn-sm" style="border-radius: 10px;">
                            <i class="mdi mdi-check"></i> <span lang="en">Yes, Sure</span>
                        </button>
                    </center>
                </div> <!-- end-footer     -->
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT  DISKUSI GROUP -->
<div class="modal fade" id="modal_edit_diskusi_group_forum" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_edit_diskusi_group_forum" action="{{route('post.admin.forum-adddiskusi')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="edit_id_group" value="{{ $id_group }}" readonly>
                <input type="hidden" id="edit_id_diskusi" name="edit_id_diskusi" readonly>

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Edit Discussion Group</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Title Discussion</small>
                                <input type="text" id="edit_judul" name="edit_judul" class="form-control input-abu"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Description Discussion</small>
                                <textarea type="text" id="edit_deskripsi" name="edit_deskripsi" rows="3"
                                    class="form-control input-abu" required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Tag Discussion</small>
                                <ul class="tags">
                                    <div id="old_tags"></div>
                                    <li class="addedTag">Discussion<span onclick="$(this).parent().remove();"
                                            class="tagRemove">x</span><input type="hidden" name="edit-tags[]"
                                            value="Discussion"></li>
                                    <li class="tagAdd taglist">
                                        <input type="text" id="search-field">
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Banner Group</small>
                                <img src="/img/noimg.jpg" class="zoom img-profil-grup" id="show_editbanner"
                                    onclick="clickImage(this)">
                                <button type="button" id="btn_close_banner"
                                    class="btn btn-gradient-light btn-rounded btn-icon detilhref">
                                    <i class="mdi mdi-window-close"></i>
                                </button>
                                <input type="file" id="edit_img_discuss_banner" name="edit_img_discuss_banner"
                                    class="form-control input-abu hidendulu">
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
                        </i> <span lang="en">Edit</span> </button>
                </div>
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



@endsection
