@extends('layout.superadmin')

@section('title', 'User Type Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>User Type Management</h3>

    <nav aria-label="breadcrumb">
        <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-target="#modal_add_usertype">Add
            User Type</button>
    </nav>
</div>


<div class="row">
    <div id="page_usertype_management"></div>
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">

            <div class="card-body">
                <table id="tabel_usertype_manage" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th><b>ID Usertype</b></th>
                            <th><b>Title</b></th>
                            <th><b>Description</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->


<!-- MODAL ADD NEW USERTYPE-->
<div class="modal fade" id="modal_add_usertype" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <form method="POST" id="form_add_usertype" action="{{route('add_new_usertype_management')}}">
        {{ csrf_field() }}
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%; border:none;">
                    <h4 class="modal-title cdarkgrey">Add User Type</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding-left: 10%;padding-right: 10%; min-height: 300px;">
                    <div class="form-group">
                        <small class="cgrey">User Type Name</small>
                        <input type="text" id="nama_usertipe" name="nama_usertipe" class="form-control input-abu"
                            value="{{ old('nama_usertipe') }}">
                    </div>
                    <div class="form-group">
                        <small class="cgrey">Description</small>
                        <textarea class="form-control input-abu" id="dekripsi_usertipe" name="dekripsi_usertipe"
                            rows="2">{{ old('dekripsi_usertipe') }}</textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <small class="cgrey">Priviledge</small>
                        <div class="text-center loading_tree" style="display: none;">
                            <div class="spinner-border" role="status"
                                style="margin-top: 3em; color: rgb(202, 202, 202); width: 4rem; height: 4rem;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        @if($errors->has('subfitur'))
                        <input type="hidden" id="error_priv" value="error">
                        <small class="error_subfitur" style="color: red;">{{ $errors->first('subfitur')}}</small>
                        @endif
                        <div class="isi_cek_priviledge">

                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; padding-left: 5%;padding-right: 5%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Add </button>
                </div>
            </div>
        </div>
    </form>
</div>



<!-- MODAL EDIT USERTYPE-->
<div class="modal fade" id="modal_edit_usertype" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <form method="POST" id="form_edit_usertype" action="{{route('edit_usertype_management')}}">
        {{ csrf_field() }}
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%; border:none;">
                    <h4 class="modal-title cdarkgrey">Edit User Type</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding-left: 10%;padding-right: 10%; min-height: 300px;">
                    <div class="form-group">
                        <small class="cgrey">User Type Name</small>
                        <input type="text" id="nama_usertipe_edit" name="nama_usertipe_edit"
                            class="form-control input-abu" value="{{ old('nama_usertipe_edit') }}">
                    </div>
                    <div class="form-group">
                        <small class="cgrey">Description</small>
                        <textarea class="form-control input-abu" id="dekripsi_usertipe_edit"
                            name="dekripsi_usertipe_edit" rows="2">{{ old('dekripsi_usertipe_edit') }}</textarea>
                    </div>
                    <input type="hidden" name="idfitur_usertype_edit" id="idfitur_usertype">

                    <div class="form-group" style="margin-top: 0.5em;">
                        <small class="cgrey">Priviledge</small>
                        <div class="text-center loading_tree" style="display: none;">
                            <div class="spinner-border" role="status"
                                style="margin-top: 3em; color: rgb(202, 202, 202); width: 4rem; height: 4rem;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        @if($errors->has('edit_subfitur'))
                        <input type="hidden" id="error_priv2" value="error">
                        <small class="error_subfitur" style="color: red;">{{ $errors->first('edit_subfitur')}}</small>
                        @endif
                        <div class="isi_cek_priviledge_edit">

                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; padding-left: 5%;padding-right: 5%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Edit </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
