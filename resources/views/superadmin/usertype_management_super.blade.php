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
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">

            <div class="card-body">
                <table id="tabel_usertype_manage" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>ID Usertype</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
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
                        <input type="text" id="nama_usertipe" name="nama_usertipe" class="form-control input-abu">
                    </div>
                    <div class="form-group">
                        <small class="cgrey">Description</small>
                        <textarea class="form-control input-abu" id="dekripsi_usertipe" name="dekripsi_usertipe"
                            rows="2"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <small class="cgrey">Priviledge</small>
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
                            class="form-control input-abu">
                    </div>
                    <div class="form-group">
                        <small class="cgrey">Description</small>
                        <textarea class="form-control input-abu" id="dekripsi_usertipe_edit"
                            name="dekripsi_usertipe_edit" rows="2"></textarea>
                    </div>
                    <input type="hidden" name="idfitur_usertype_edit" id="idfitur_usertype">

                    <div class="form-group" style="margin-top: 0.5em;">
                        <small class="cgrey">Priviledge</small>
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
                        </i> Edit </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {
        session_logged_superadmin();
        // tabel_tes();
        tabel_usertype_management();

        get_listfitur_usertype_ceklist();
    });

    // function tabel_tes() {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: '/superadmin/tabel_usertype_superadmin',
    //         type: 'POST',
    //         datatype: 'JSON',
    //         success: function (result) {
    //             console.log(result);
    //         },
    //         error: function (result) {
    //             console.log("Cant Show");
    //         }
    //     });
    // }

    function get_listfitur_usertype_ceklist() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/get_listfitur_usertype_ceklist',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result);
                var parent_ui = '';
                $.each(result, function (i, item) {
                    var child_ui = '';
                    var parent = item.title;
                    var jum = 0;
                    var idfitur = '';

                    $.each(item.module_endpoints, function (i, item) {
                        // console.log(item.feature_id, parent, item.subfeature_id, item.sub_feature_title);
                        idfitur = item.feature_id;
                        child_ui += '<li class="">' +
                            '<input type="checkbox" name="subfitur[]"' +
                            'value="' + item.subfeature_id + '">' +
                            '<label>' + item.sub_feature_title + '</label>' +
                            '</li>';
                        jum++;
                    });

                    if (jum == 0) {
                        parent_ui += '<ul class="tree">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="fitur_id[]" value=" ' + idfitur + '">' +
                            '<label>' + parent + ' &nbsp;' +
                            '</label>' +
                            '</li>' +
                            '</ul>';
                    } else {
                        parent_ui += '<ul class="tree">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="fitur_id[]" value=" ' + item.feature_id + '">' +
                            '<label>' + parent + ' &nbsp;' +
                            '<small class="total"> &nbsp; (' + jum + ') </small>' +
                            '<i class="mdi mdi-chevron-down clight"></i>' +
                            '</label>' +
                            '<ul>' + child_ui + '</ul>' +
                            '</li>' +
                            '</ul>';
                    }


                });
                $(".isi_cek_priviledge").html(parent_ui);

            },
            error: function (result) {
                console.log("Cant Show");
            }
        });
    }


    function tabel_usertype_management() {
        var tabel = $('#tabel_usertype_manage').DataTable({
            responsive: true,
            ajax: {
                url: '/superadmin/tabel_usertype_superadmin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
            },
            columns: [
                { mData: 'id' },
                { mData: 'title' },
                { mData: 'description' },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        var dt = [row.id, row.title, row.description];

                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_usertype_manage(\'' + dt + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });

    }

    function detail_usertype_manage(idusertype) {
        var result;
        usertipe = idusertype.split(",");

        $("#modal_edit_usertype").modal("show");
        $("#idfitur_usertype").val(usertipe[0]);
        $("#nama_usertipe_edit").val(usertipe[1]);
        $("#dekripsi_usertipe_edit").text(usertipe[2]);

        // $.ajaxSetup({
        //     headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //       url: '/admin/detail_user_management',
        //       type: 'POST',
        //       datatype: 'JSON',
        //       data: {
        //       "user_id": iduser
        //       },
        //       success: function (result) {

        //       },
        //       error: function (result) {
        //         console.log("Cant Show Detail User");
        //     }
        // });
    }

    $(document).on('click', '.tree label', function (e) {
        $(this).next('ul').fadeToggle();
        e.stopPropagation();
    });

    $(document).on('change', '.tree input[type=checkbox]', function (e) {
        $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
        $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
        e.stopPropagation();
    });

    $(document).on('click', 'button', function (e) {
        switch ($(this).text()) {
            case 'Collepsed':
                $('.tree ul').fadeOut();
                break;
            case 'Expanded':
                $('.tree ul').fadeIn();
                break;
            case 'Checked All':
                $(".tree input[type='checkbox']").prop('checked', true);
                break;
            case 'Unchek All':
                $(".tree input[type='checkbox']").prop('checked', false);
                break;
            default:
        }
    });


</script>

@endsection
