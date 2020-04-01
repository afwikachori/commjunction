@extends('layout.admin-dashboard')
@section('title', 'Community Setting')
@section('content')
<div class="row">
    <div class="col-md-3">
        <h3 class="page-title s22 cgrey" style="font-weight: bold;">Community Setting</h3>
    </div>
    <div class="col-md-9">
        <label class="cgrey">Publish Community to Live<label>
    </div>
</div>
<br>
<div class="row" style="margin-top: 1em;">
    <div class="col-12">
        <div class="card">
            <div class="card-header putih">
                <div class="row">
                    <div class="col-md-8" style="margin-top: 0.5em;">
                       <h4 class="cgrey tebal"> Registrasion Data</h4>
                    </div>
                    <div class="col-md-4" style="text-align: right;">
                        <button class="btn btn-birumuda btn-sm" id="btn-add-question"> Add Question</button>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <!-- tabel all susbcriber -->
                <table id="tabel_list_regisdata" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th><b>ID Question</b></th>
                            <th><b>Question Title</b></th>
                            <th><b>Type</b></th>
                            <th><b>Date Created</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                </table>
                <!-- end tabel all  -->

            </div>
        </div>
    </div>
</div>



<!-- //MODAL ADD QUESTION -->
<div class="modal fade" id="modal_add_question" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title putih">Add New Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 280px; height: auto;">
                <form method="POST" id="form_add_dataregis" action="{{route('add_regisdata_comm')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Default input</label>
                                <input type="text" class="form-control input-abu" name="question_regis">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Input Type</label>
                                <select class="form-control input-abu" id="tipedata_regis" name="tipedata_regis">
                                    <option value="1">Input Text Box</option>
                                    <option value="2">Date Picker</option>
                                    <option value="3">Checkbox</option>
                                    <option value="4">Radiobutton</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="input_pilihan" style="display: none;">
                        <div class="row form-group">
                            <div class="col-md-3" style="margin-top: 1em;">
                                <label class="cgrey">Choose Input</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control input-abu" name="pilihan_input1">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-3" style="margin-top: 1em;">
                                <label class="cgrey">Choose Input</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control input-abu" name="pilihan_input2">
                            </div>
                        </div>
                        <div id="isi_newrow"></div>
                        <center>
                            <button type="button" class="btn btn-icon-text" id="addnewrow">
                                <i class="mdi mdi-plus-circle" style="color: #50C9C3;"></i>
                                <small>Add New Row</small> </button>
                        </center>
                    </div>
            </div>
            <div class="modal-footer putih" style="margin-bottom: 1em;">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"
                    style="border-radius: 6px;">Cancel</button>
                <button type="submit" class="btn btn-teal btn-sm">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- //MODAL EDIT QUESTION REGIS -->
<div class="modal fade" id="modal_edit_question" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title putih">Edit Data Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 280px; height: auto;">
                <form method="POST" id="form_edit_dataregis" action="{{route('edit_setting_regisdata_comm')}}">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control input-abu" name="id_question" id="id_question">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Default input</label>
                                <input type="text" class="form-control input-abu" name="edit_question"
                                    id="edit_question">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Input Type</label>
                                <select class="form-control input-abu" id="edit_tipedata" name="edit_tipedata">
                                    <option value="1">Input Text Box</option>
                                    <option value="2">Date Picker</option>
                                    <option value="3">Checkbox</option>
                                    <option value="4">Radiobutton</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="edit_input_pilihan" style="display: none;">
                        <div id="isi_newrow_edit"></div>
                        <center>
                            <button type="button" class="btn btn-icon-text" id="addnewrow_edit">
                                <i class="mdi mdi-plus-circle" style="color: #50C9C3;"></i>
                                <small>Add New Row</small> </button>
                        </center>
                    </div>
            </div>
            <div class="modal-footer putih" style="margin-bottom: 1em;">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"
                    style="border-radius: 6px;">Cancel</button>
                <button type="submit" class="btn btn-teal btn-sm">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {
        get_result_setup_comsetting();
        tabel_list_regisdata();
        addRowRegisData();
    });

    $("#tipedata_regis").change(function () {
        var val = this.value;
        console.log(val);
        if (val == 1 || val == 2) {
            $("#input_pilihan").fadeOut("slow").hide();
        } else {
            $("#input_pilihan").fadeIn("slow").show();
        }
    });

    $("#edit_tipedata").change(function () {
        var val = this.value;
        console.log(val);
        if (val == 1 || val == 2) {
            $("#edit_input_pilihan").fadeOut("slow").hide();
        } else {
            $("#edit_input_pilihan").fadeIn("slow").show();
        }
    });

    function tagsInput() {
        var input2 = document.querySelector('textarea[name=tags2]'),
            tagify2 = new Tagify(input2, {
                enforeWhitelist: true,
                whitelist: ["Single", "Married", "WNI", "WNA", "Male", "Female"]
            });

        // toggle Tagify on/off
        document.querySelector('input[type=checkbox]').addEventListener('change', function () {
            document.body.classList[this.checked ? 'add' : 'remove']('disabled');
        })
    }


    function tabel_cek() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/tabel_list_regisdata',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                // console.log(result[0].param_form_array[0]);

                $.each(result, function (i, item) {
                    var judul = item.param_form_array[0];
                    var tipedata = item.param_form_array[1];

                });
            },
            error: function (result) {
                console.log("Cant Show");
            }
        });
    }

    function tabel_list_regisdata() {
        var tabel = $('#tabel_list_regisdata').DataTable({
            responsive: true,
             language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/admin/tabel_list_regisdata',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
            },
            columns: [
                { mData: 'id' },
                {
                    mData: 'param_form_array',
                    render: function (data, type, row, meta) {
                        var judul = data[0];
                        return judul;
                    }
                },
                {
                    mData: 'param_form_array',
                    render: function (data, type, row, meta) {
                        var tipedata = data[1];
                        var tp = '';
                        if (tipedata == 1) {
                            tp = 'Input Text';
                        } else if (tipedata == 2) {
                            tp = 'Date Picker';
                        } else if (tipedata == 3) {
                            tp = 'Checkbox';
                        } else {
                            tp = 'Radiobutton';
                        }
                        return tp;
                    }
                },
                {
                    mData: 'created_at',
                    render: function (data, type, row, meta) {
                        var tgl = dateFormat(data);
                        return tgl;
                    }
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

        //DETAIL QUESTIONs FROM DATATABLE
        $('#tabel_list_regisdata tbody').on('click', 'button', function () {
            var pilih = tabel.row($(this).parents('tr')).data();
            $("#id_question").val(pilih.id);
            var isi = pilih.param_form_array;
            $("#edit_question").val(isi[0]);
            $("#edit_tipedata").val(isi[1]).attr("selected", "selected");
            if (isi[1] == 1 || isi[1] == 2) {
                $("#edit_input_pilihan").fadeOut("slow").hide();
            } else {
                $("#edit_input_pilihan").fadeIn("slow").show();
            }
            var len = isi.length;
            var cek = isi.slice(2, len);
            var len_2 = cek.length;
            addRowRegisData_edit(len_2);
            var new_row2 = '';
            $.each(cek, function (i, item) {
                new_row2 += '<div class="row form-group newly2" id="row' + i + '">' +
                    '<div class="col-md-3" style="margin-top: 1em;">' +
                    '<label class="cgrey">Choose Input</label>' +
                    '</div>' +
                    '<div class="col-md-7">' +
                    '<input type="text" class="form-control input-abu" value="' + item + '" name="value' + i + '">' +
                    '</div>' +
                    '<div class="col-md">' +
                    '<button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon delete-row2" style="width: 25px; height: 25px; margin-top: 0.7em;">' +
                    '<i class="mdi mdi-delete"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>';
            });

            $('#isi_newrow_edit').html(new_row2 + '<div id="isi_newrow_edit_new"></div>');
            $("#modal_edit_question").modal('show');

        });

    }






    $("#btn-add-question").click(function () {
        $("#modal_add_question").modal('show');
    });


    function detail_regisdata(id_regisdata) {
        alert('id list regis data : ' + id_regisdata);
    }

    function addRowRegisData() {
        // Add row
        var row = 1;
        var id = 3;

        $(document).on("click", "#addnewrow", function () {
            var new_row = '<div class="row form-group newly" id="row' + row + '">' +
                '<div class="col-md-3" style="margin-top: 1em;">' +
                '<label class="cgrey">Choose Input</label>' +
                '</div>' +
                '<div class="col-md-7">' +
                '<input type="text" class="form-control input-abu" name="pilihan_input' + id + '">' +
                '</div>' +
                '<div class="col-md">' +
                '<button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon delete-row" style="width: 25px; height: 25px; margin-top: 0.7em;">' +
                '<i class="mdi mdi-delete"></i>' +
                '</button>' +
                '</div>' +
                '</div>';

            $('#isi_newrow').append(new_row);
            row++;
            id++;
            return false;
        });

        // Remove criterion
        $(document).on("click", ".delete-row", function () {
            //  alert("deleting row#"+row);
            if (row > 1) {
                $(this).closest('div .newly').remove();
                row--;
            }
            return false;
        });

    }

    function addRowRegisData_edit(last_id) {
        console.log(last_id);
        // var row = 1;
        // var id = 3;

        $(document).on("click", "#addnewrow_edit", function () {
            var new_row = '<div class="row form-group newly2" id="row' + last_id + '">' +
                '<div class="col-md-3" style="margin-top: 1em;">' +
                '<label class="cgrey">Choose Input</label>' +
                '</div>' +
                '<div class="col-md-7">' +
                '<input type="text" class="form-control input-abu" name="value' + last_id + '">' +
                '</div>' +
                '<div class="col-md">' +
                '<button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon delete-row2" style="width: 25px; height: 25px; margin-top: 0.7em;">' +
                '<i class="mdi mdi-delete"></i>' +
                '</button>' +
                '</div>' +
                '</div>';
            last_id++;
            $('#isi_newrow_edit_new').append(new_row);

            return false;
        });

        // Remove criterion
        $(document).on("click", ".delete-row2", function () {
            //  alert("deleting row#"+row);
            // if (row > 1) {
            $(this).closest('div .newly2').remove();
            //     row--;
            // }
            return false;
        });

    }


</script>

@endsection
