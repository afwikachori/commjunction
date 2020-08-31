@extends('layout.support-master')
@section('title', 'Knowledge')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Knowledge</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey">Manage your information for Knowledges<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-target="#modal_add_knowledge">
                Create Knowledge </button>
        </nav>
    </div>
</div>

<br>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-body">
                <table id="tabel_knowledge_support" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th><b> Title Knowledge</b></th>
                            <th><b> Feature Type </b></th>
                            <th><b> Condition </b></th>
                            <th><b> Analysis </b></th>
                            <th><b> Date </b></th>
                            <th><b> Feature </b></th>
                            <th><b> Error </b></th>
                            <th><b> Action </b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->


<!-- MODAL ADD KNOWLEDGE -->
<div class="modal fade" id="modal_add_knowledge" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff; margin-top: -1em;">
            <div class="mod-header">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Create New</small>
                <br>
                <h4 class=" cblue">Knowledge</h4>
            </div>

            <form method="POST" id="form_add_create_knowledge" action="{{route('add_knowledge_support')}}">
                {{ csrf_field() }}
                <div class="modal-body body250">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Feature Type</small>
                                <select class="form-control input-abu" name="feature_type" id="feature_type" required>
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Feature </option>
                                    <option value="2"> Support / Non Feature </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Error Level</small>
                                <select class="form-control input-abu" name="error_level" id="error_level" required>
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Low </option>
                                    <option value="2"> Medium </option>
                                    <option value="3"> High </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Title</small>
                                <input type="text" id="judul" name="judul" class="form-control input-abu" required>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Date</small>
                                <input type="date" id="tanggal" name="tanggal" class="form-control input-abu" required>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row" id="hide_fitur" style="display: none;">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Feature</small>
                                <select class="form-control input-abu" name="list_feature" id="list_feature">
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_subfitur">
                                <small class="clight s13">Sub-Feature</small>
                                <select class="form-control input-abu" name="list_subfeature" id="list_subfeature">
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md-12" id="hide_fiturdeskripsi" style="display: none;">
                            <div class="form-group">
                                <small class="clight s13">Feature Description</small>
                                <input type="text" id="deskripsi_fitur" name="deskripsi_fitur"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Condition</small>
                                <input type="text" id="kondisi" name="kondisi" class="form-control input-abu" required>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Analysis</small>
                                <input type="text" id="analisis" name="analisis" class="form-control input-abu"
                                    required>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Solution</small>
                                <input type="text" id="solusi" name="solusi" class="form-control input-abu" required>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; padding-top: 1.5em">
                    <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Create </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL DETAIL KNOWLEDGE-->
<div class="modal fade" id="modal_detail_knowledge" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%; max-width: 700px;">
        <div class="modal-content" style="background-color: #ffffff;">
            <div style="padding: 6%; padding-bottom: 2% !important; padding-top: 2% !important;">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Detail</small>
                <br>
                <h4 class=" cblue">Knowledge</h4>
            </div>

            <div class="modal-body detaillog" style="height: auto; padding-left: 6% !important;
            padding-right: 6% !important; padding-top:2%;">
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Feature Type</small>
                            <p class="cgrey2 s14" id="detail_fiturtipe"> - </p>
                        </div>
                    </div> <!-- end-col-md -->

                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Error Level</small>
                            <p class="cgrey2 s14" id="detail_errorlevel"> - </p>
                        </div>
                    </div> <!-- end-col-md -->
                </div>

                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Title</small>
                            <p class="cgrey2 s14" id="detail_title"> - </p>
                        </div>
                    </div> <!-- end-col-md -->
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Date</small>
                            <p class="cgrey2 s14" id="detail_date"> - </p>
                        </div>

                    </div> <!-- end-col-md -->
                </div>

                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Feature</small>
                            <p class="cgrey2 s14" id="detail_fitur"> - </p>
                        </div>
                    </div> <!-- end-col-md -->

                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Sub-Feature</small>
                            <p class="cgrey2 s14" id="detail_subfitur"> - </p>
                        </div>
                    </div> <!-- end-col-md -->
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <small class="clight s13">Feature Description</small>
                            <p class="cgrey2 s14" id="detail_fiturdeskripsi"> - </p>
                        </div>
                    </div> <!-- end-col-md -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <small class="clight s13">Condition</small>
                            <p class="cgrey2 s14" id="detail_kondisi"> - </p>
                        </div>
                    </div> <!-- end-col-md -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <small class="clight s13">Analysis</small>
                            <p class="cgrey2 s14" id="detail_analisis"> - </p>
                        </div>
                    </div> <!-- end-col-md -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <small class="clight s13">Solution</small>
                            <p class="cgrey2 s14" id="detail_solusi"> - </p>
                        </div>
                    </div> <!-- end-col-md -->
                </div>
            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none; margin-bottom: 0.5em;
                   padding-left: 6%; padding-right: 6%;">
                <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                <button type="button" class="btn btn-teal btn-sm" data-toggle="modal"
                    data-target="#modal_edit_knowledge" data-dismiss="modal">
                    <i class="mdi mdi-pencil btn-icon-prepend">
                    </i> Edit </button>
                &nbsp;
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                    <i class="mdi mdi-close"></i> Cancel
                </button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL EDIT KNOWLEDGE -->
<div class="modal fade" id="modal_edit_knowledge" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff; margin-top: -1em;">
            <div class="mod-header">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Edit New</small>
                <br>
                <h4 class=" cblue">Knowledge</h4>
            </div>

            <form method="POST" id="form_edit_knowledge" action="{{route('edit_knowledge_support')}}">
                {{ csrf_field() }}
                <div class="modal-body body250">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Feature Type</small>
                                <select class="form-control input-abu" name="edit_feature_type" id="edit_feature_type"
                                    required>
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Feature </option>
                                    <option value="2"> Support / Non Feature </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Error Level</small>
                                <select class="form-control input-abu" name="edit_error_level" id="edit_error_level"
                                    required>
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Low </option>
                                    <option value="2"> Medium </option>
                                    <option value="3"> High </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Title</small>
                                <input type="text" id="edit_judul" name="edit_judul" class="form-control input-abu"
                                    required>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Date</small>
                                <input type="date" id="edit_tanggal" name="edit_tanggal" class="form-control input-abu"
                                 required>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row" id="hide_fitur2" style="display: none;">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Feature</small>
                                <select class="form-control input-abu" name="edit_list_feature" id="edit_list_feature">
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_subfitur2">
                                <small class="clight s13">Sub-Feature</small>
                                <select class="form-control input-abu" name="edit_list_subfeature"
                                    id="edit_list_subfeature">
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md-12" id="hide_fiturdeskripsi2" style="display: none;">
                            <div class="form-group">
                                <small class="clight s13">Feature Description</small>
                                <input type="text" id="edit_deskripsi_fitur" name="edit_deskripsi_fitur"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Condition</small>
                                <input type="text" id="edit_kondisi" name="edit_kondisi" class="form-control input-abu"
                                    required>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Analysis</small>
                                <input type="text" id="edit_analisis" name="edit_analisis"
                                    class="form-control input-abu" required>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Solution</small>
                                <input type="text" id="edit_solusi" name="edit_solusi" class="form-control input-abu"
                                    required>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>
                    <input type="hidden" id="edit_knowledge_id" name="edit_knowledge_id">
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; padding-top: 1.5em">
                    <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Update </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL DELETE-->
<div class="modal fade" id="modal_detele_knowledge" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff; min-height: 250px;">
            <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                <center>
                    <img src="/img/logout.png" id="img_signout_superadmin">
                    <h4 class="cgrey">Delete Comfirmation</h4>
                    <small class="clight">Are you sure, you want to delete ?</small>
                </center>
            </div>
            <div class="modal-footer changepass" style="border: none; text-align: center;">
                <center>

                    <form method="POST" id="form_delete_knowledge" action="{{route('delete_knowledge_support')}}">
                        {{ csrf_field() }}
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> No
                        </button>
                        &nbsp;
                        <input type="hidden" id="id_knowledge" name="id_knowledge">
                        <button type="submit" class="btn btn-tosca btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Yes </button>
                    </form>
                </center>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL LOGOUT -->

@endsection
@section('script')
<script type="text/javascript">

    $(document).ready(function () {

        tabel_knowledge_support();
        get_list_feature_support();
    });

    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/support/tabel_knowledge_support',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas").val(),
                "activity_type": $("#activity_type").val(),
                "subscriber_id": $("#list_subscriber").val(),
            },
            success: function (result) {
                console.log('tabel log ');
                console.log(result);
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show tabel log");
            }
        });
    }

    function tabel_knowledge_support() {
        $('#tabel_knowledge_support').dataTable().fnClearTable();
        $('#tabel_knowledge_support').dataTable().fnDestroy();

        $("#modal_generate_spesific_com").modal('hide');
        $("#tabel_knowledge_support").show();

        var tabel = $('#tabel_knowledge_support').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print', {
                    text: 'JSON',
                    action: function (e, dt, button, config) {
                        var data = dt.buttons.exportData();

                        $.fn.dataTable.fileSave(
                            new Blob([JSON.stringify(data)]),
                            'Export.json'
                        );
                    }
                }
            ],
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/support/tabel_knowledge_support',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_knowledge_support tbody').empty().append(nofound);
                },
            },
            columns: [
                {
                    mData: 'title',
                    render: function (data, type, row, meta) {
                        if (data == null) {
                            return '<span class="s13"> - </span>';
                        } else {
                            return '<span class="s13 text-wrap width-400">' + data + '</span>';
                        }
                    }
                },
                {
                    mData: 'feature_type_title',
                    render: function (data, type, row, meta) {
                        return '<span class="s13 text-wrap width-100">' + data + '</span>';
                    }
                },
                {
                    mData: 'kondisi',
                    render: function (data, type, row, meta) {
                        return '<span class="s13 text-wrap width-400">' + data + '</span>';
                    }
                },
                {
                    mData: 'analisis',
                    render: function (data, type, row, meta) {
                        return '<span class="s13 text-wrap width-400">' + data + '</span>';
                    }
                },
                {
                    mData: 'date',
                    render: function (data, type, row, meta) {
                        return '<span class="s13 text-wrap width-200">' + dateFormat(data) + '</span>';
                    }
                },
                {
                    mData: 'feature',
                    render: function (data, type, row, meta) {
                        if (data == null) {
                            return '<span class="s13"> - </span>';
                        } else {
                            return '<span class="s13 text-wrap width-300">' + data.title + '</span>';
                        }
                    }
                },
                {
                    mData: 'error_level_status',
                    render: function (data, type, row, meta) {
                        return '<span class="s13 text-wrap width-100">' + data + '</span>';
                    }
                },
                {
                    mData: null,
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnedit btn_detail_knowledge">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button> &nbsp;<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnedi btn_delete_knowledge">' +
                            '<i class="mdi mdi-delete"></i>' +
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

        //DETAIL
        $('#tabel_knowledge_support tbody').on('click', 'button.btn_detail_knowledge', function () {

            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);

            $("#detail_fiturtipe").html(data.feature_type_title);
            $("#detail_errorlevel").html(data.error_level_status);
            $("#detail_title").html(data.title);
            $("#detail_date").html(dateTime(data.date));
            if (data.feature != null && data.feature != undefined) {
                $("#detail_fitur").html(data.feature.title);
            }
            if (data.sub_feature != null && data.sub_feature != undefined) {
                $("#detail_subfitur").html(data.sub_feature.title);
            }
            $("#detail_fiturdeskripsi").html(data.feature_description);
            $("#detail_kondisi").html(data.kondisi);
            $("#detail_analisis").html(data.analisis);
            $("#detail_solusi").html(data.solusi);
            $("#modal_detail_knowledge").modal('show');
            // _____________________________________________
            $("#edit_knowledge_id").val(data.id);
            if (data.feature != null && data.feature != undefined) {
                $("#edit_list_feature").val(data.feature.id);
                get_edit_list_subfeature_support(data.feature.id);

            }
            $("#edit_feature_type").val(data.feature_type);
            $("#edit_error_level").val(data.error_level);
            $("#edit_judul").val(data.title);
            $("#edit_tanggal").val(formatDate(data.date));

            if (data.feature_description != null && data.feature_description != undefined) {
                $("#edit_deskripsi_fitur").val(data.feature_description);
            }
            $("#edit_kondisi").val(data.kondisi);
            $("#edit_analisis").val(data.analisis);
            $("#edit_solusi").val(data.solusi);

            if (data.feature_type == 1) {
                $("#hide_fitur2").show();
                $("#hide_fiturdeskripsi2").hide();
            } else {
                $("#hide_fitur").hide();
                $("#hide_fiturdeskripsi2").show();
            }

            if (data.sub_feature != null && data.sub_feature != undefined) {
                $("#edit_list_subfeature").val(data.sub_feature.id).attr("selected","selected");
                // $('select[name="edit_list_subfeature"]').val(69);
                $("#hide_subfitur2").show();
            }

        });

        $('#tabel_knowledge_support tbody').on('click', 'button.btn_delete_knowledge', function () {
            var data = tabel.row($(this).parents('tr')).data();
            $("#id_knowledge").val(data.id);
            $("#modal_detele_knowledge").modal();
        });

    }



    function get_list_feature_support() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/support/get_list_feature_support",
            type: "POST",
            dataType: "json",
            success: function (result) {
                // console.log(result);
                $('#list_feature').empty();
                $('#list_feature').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_feature').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }

                $("#list_feature").html($('#list_feature option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#list_feature").get(0).selectedIndex = 0;
                // _________________________________________________

                $('#edit_list_feature').empty();
                $('#edit_list_feature').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#edit_list_feature').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }

                $("#edit_list_feature").html($('#edit_list_feature option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#edit_list_feature").get(0).selectedIndex = 0;
            }
        });
    } //endfunction


    $('#edit_list_feature').change(function () {
        var item = $(this);
        var id_fitur = item.val();

        get_edit_list_subfeature_support(id_fitur);
    });


    function get_edit_list_subfeature_support(feature_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/support/get_list_subfeature_support",
            type: "POST",
            dataType: "json",
            data: {
                "feature_id": feature_id
            },
            success: function (result) {
                // console.log(result);

                $("#hide_subfitur2").show();
                $('#edit_list_subfeature').empty();
                if (result.success == false || result.code == "CMQ01") {
                    $('#edit_list_subfeature').append("<option disabled selected> No Data </option>");
                } else {
                    $('#edit_list_subfeature').append("<option disabled> Choose</option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#edit_list_subfeature').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#edit_list_subfeature").html($('#edit_list_subfeature option').sort(function (x, y) {
                        return $(x).text() < $(y).text() ? -1 : 1;
                    }));

                    $("#edit_list_subfeature").get(0).selectedIndex = 0;
                }
            }
        });
    } //endfunction



    $('#list_feature').change(function () {
        var item = $(this);
        var id_fitur = item.val();

        get_list_subfeature_support(id_fitur);
    });



    function get_list_subfeature_support(feature_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/support/get_list_subfeature_support",
            type: "POST",
            dataType: "json",
            data: {
                "feature_id": feature_id
            },
            success: function (result) {
                // console.log(result);

                $("#hide_subfitur").show();
                $('#list_subfeature').empty();
                if (result.success == false || result.code == "CMQ01") {
                    $('#list_subfeature').append("<option disabled selected> No Data </option>");
                } else {
                    $('#list_subfeature').append("<option disabled> Choose</option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#list_subfeature').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#list_subfeature").html($('#list_subfeature option').sort(function (x, y) {
                        return $(x).text() < $(y).text() ? -1 : 1;
                    }));

                    $("#list_subfeature").get(0).selectedIndex = 0;
                }
            }
        });
    } //endfunction


    $('#feature_type').change(function () {
        var item = $(this);
        var idtipe = item.val();

        if (idtipe == 1) {
            $("#hide_fitur").show();
            $("#hide_fiturdeskripsi").hide();
        } else {
            $("#hide_fitur").hide();
            $("#hide_fiturdeskripsi").show();
        }
    });

    $('#edit_feature_type').change(function () {
        var item = $(this);
        var idtipe = item.val();

        if (idtipe == 1) {
            $("#hide_fitur2").show();
            $("#hide_fiturdeskripsi2").hide();
        } else {
            $("#hide_fitur").hide();
            $("#hide_fiturdeskripsi2").show();
        }
    });

</script>

@endsection
