@extends('layout.admin-dashboard')

@section('content')
<div class="row" style="margin-bottom: 2em;">
    <div class="col-md-3">
        <h3 class="page-title s22 cgrey" style="font-weight: bold;">Edit Community</h3>
    </div>
    <div class="col-md-9">
        <label class="cgrey">Edit Community Information<label>
    </div>
</div>




<div class="row" style="padding-left: 18%; padding-right: 18%;">
    <div class="col-12">
        <div class="card">
<div id="edit_profil_komunitas"></div>
            <form method="POST" id="form_edit_community" action="{{route('edit_profil_community')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4" style="padding-right: 8rem;">
                            <center>
                                <div class="img-upload-profil editprof">
                                    <div class="circle">
                                        <img class="profile-pic rounded-circle img-fluid logo_komunitas editcom"
                                            id="view_profil_kom" src="/img/focus.png" onerror = "this.onerror=null;this.src='/img/focus.png';">
                                    </div>
                                    <div class="p-imageditprof">
                                        <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                            style="width: 30px; height: 30px;">
                                            <i class="mdi mdi-camera upload-button" id="btn_up_profil-kom"></i>
                                        </button>
                                        <input class="file-upload file-upload-default" id="file-upload-profil-kom"
                                            type="file" id="fileup" name="fileup" accept="image/*" />
                                    </div>
                                </div>
                            </center>
                        </div>

                        <div class="col-md-8">
                            <h3 class="cgrey s18 tebal" style="margin-bottom: 1.5em;">About Community</h3>
                            <div class="form-group">
                                <label class="clight">Community Name</label>
                                <input type="text" class="form-control input-abu" id="edit_namacom" name="edit_namacom">
                            </div>

                            <div class="form-group">
                                <label class="clight">Description Community</label>
                                <textarea class="form-control input-abu" id="edit_deskripsicom" name="edit_deskripsicom"
                                    rows="4"></textarea>
                            </div>

                            <input type="hidden" class="form-control input-abu" id="edit_idcom" readonly="readonly">
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" onclick="location.href ='/admin/community_setting'"
                        class="btn btn-gradient-light btn-sm btn-fw melengkung8px">Cancel</button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm btn-fw">Save Editing</button>
                </div> <!-- end-footer     -->
            </form>
        </div>
    </div>
</div>


@endsection

