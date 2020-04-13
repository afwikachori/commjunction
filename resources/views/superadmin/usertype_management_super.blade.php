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
                        <input type="text" id="nama_usertipe" name="nama_usertipe" class="form-control input-abu" value="{{ old('nama_usertipe') }}">
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
                            <div class="spinner-border" role="status" style="margin-top: 3em; color: rgb(202, 202, 202); width: 4rem; height: 4rem;">
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
                            <div class="spinner-border" role="status" style="margin-top: 3em; color: rgb(202, 202, 202); width: 4rem; height: 4rem;">
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
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {
        tabel_usertype_management();
        get_listfitur_usertype_ceklist();
        cek_error_addusertype();
    });

    function cek_error_addusertype() {
        var err_add = $("#error_priv").val();
        if(err_add != "" && err_add != undefined){
            swal("Cant Null !","Please Fill All Fields","error").then((value) => {
               $("#modal_add_usertype").modal('show');
            });
        }

          var err_edit = $("#error_priv2").val();
        if (err_edit != "" && err_edit != undefined) {
            swal("Cant Null !", "Please Fill All Fields", "error").then((value) => {
                $("#modal_edit_usertype").modal('show');
            });
        }
    }


    function get_listfitur_usertype_ceklist() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function beforeSend(jxqhr) {
                $(".loading_tree").show();
                $(".btnsubmit").attr("disabled", "disabled");
            },
            complete: function complete() {
                $(".btnsubmit").removeAttr("disabled", "disabled");
            }
        });
        $.ajax({
            url: '/admin/get_listfitur_usertype_ceklist',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                $(".btnsubmit").removeAttr("disabled", "disabled");
                   $(".loading_tree").hide();

                var parent_ui = '';
                $.each(result, function (i, item) {
                    var child_ui = '';
                    var parent = item.title;
                    var jum = 0;
                    var idfitur = '';

                    $.each(item.sub_features, function (i, item) {
                        // console.log(item);
                        idfitur = item.feature_id;
                        child_ui += '<li class="">' +
                            '<input type="checkbox" name="subfitur[]"' +
                            'id="subfitur_'+item.subfeature_id+'"'+
                            'value="' + item.subfeature_id + '">' +
                            '<label>' + item.sub_feature_title + '</label>' +
                            '</li>';
                        jum++;
                    });

                    if (jum == 0) {
                        parent_ui += '<ul class="tree">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="fitur_id[]" value="0"  onclick="cek_nofitur(' + item.feature_id + ')" id="id_' + item.feature_id + '">' +
                            '<label>' + parent + ' &nbsp;' +
                            '</label>' +
                            '</li>' +
                            '</ul>';
                    } else {
                        parent_ui += '<ul class="tree">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="fitur_id[]"  value="'+ idfitur +'">' +
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
            // ___________________________________________________________________________________
                var parent_ui2 = '';
                $.each(result, function (i, item) {
                    var child_ui2 = '';
                    var parent2 = item.title;
                    var jum2 = 0;
                    var idfitur_edit = '';

                    $.each(item.sub_features, function (i, item) {
                        idfitur_edit = item.feature_id;
                        child_ui2 += '<li class="">' +
                            '<input type="checkbox" name="edit_subfitur[]"' +
                            'id="edit_subfitur_' + item.subfeature_id + '"' +
                            'value="' + item.subfeature_id + '"> ' +
                            '<label>' + item.sub_feature_title + '</label>' +
                            '</li>';
                        jum2++;
                    });

                    if (jum2 == 0) {
                          var idno = 111+item.feature_id ;
                        parent_ui2 += '<ul class="tree">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="edit_fitur_id[]" value="0" onclick="cek_nofitur(' + idno + ')" id="id_' + idno+ '">' +
                            '<label>' + parent2 + ' &nbsp;' +
                            '</label>' +
                            '</li>' +
                            '</ul>';
                    } else {
                        parent_ui2 += '<ul class="tree">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="edit_fitur_id[]" value="' + idfitur_edit + '" id="edit_fitur_id' + idfitur_edit + '">' +
                            '<label>' + parent2 + ' &nbsp;' +
                            '<small class="total"> &nbsp; (' + jum2 + ') </small>' +
                            '<i class="mdi mdi-chevron-down clight"></i>' +
                            '</label>' +
                            '<ul>' + child_ui2 + '</ul>' +
                            '</li>' +
                            '</ul>';
                    }
                });
                $(".isi_cek_priviledge_edit").html(parent_ui2);

            },
            error: function (result) {
                  $(".loading_tree").hide();
                $(".btnsubmit").attr("disabled", "disabled");
                ui.popup.show('warning', 'Cant get any response', 'Timeout');
            }
        });
    }



    function cek_nofitur(idf) {
        var checkid = $('#id_' + idf);
        checkid.prop("checked", false);
        checkid.attr("disabled", "disabled");
        ui.popup.show('error', 'Cant Choose this feature', 'No Access');
    }

    function tabel_usertype_management() {
        var tabel = $('#tabel_usertype_manage').DataTable({
            responsive: true,
             language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/superadmin/tabel_usertype_superadmin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
             error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_usertype_manage tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
            },
            columns: [
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        return "<div class='text-wrap width-50'>" + data + "</div>";
                    },
                },
                { mData: 'title' },
                {
                    mData: 'description',
                    render: function (data, type, row, meta) {
                        return "<div class='text-wrap width-400'>" + data + "</div>";
                    },
                },
                {
                    mData: null,
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnedit">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],
            columnDefs:
                [
                    {
                        "data": null,
                        "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"><i class="mdi mdi-eye"></i></button>',
                        "targets": -1
                    }
                ],
        });
        //DETAIL USERTYPE FROM DATATABLE
        $('#tabel_usertype_manage tbody').on('click', 'button', function () {
          var data = tabel.row($(this).parents('tr')).data();
            // console.log(data);
            $("#modal_edit_usertype").modal("show");
            $("#idfitur_usertype").val(data.id);
            $("#nama_usertipe_edit").val(data.title);
            $("#dekripsi_usertipe_edit").text(data.description);

            var subfitur = data.subfeature;
            var arr = [];
            $.each(subfitur, function (i, item) {
                $('#edit_fitur_id' + item.feature_id).prop('checked', true);
                $('#edit_subfitur_' + item.subfeature_id).prop('checked', true);
            });


        });

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
