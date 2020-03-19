@extends('layout.admin-dashboard')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span> Community Settings</h3>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Community Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registrasion Data</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header putih">
                <div class="row">
                    <div class="col-md-8 cgrey" style="margin-top: 0.5em;">
                        Registrasion Data
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
                            <th>ID Question</th>
                            <th>Question Title</th>
                            <th>Type</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
                <!-- end tabel all  -->

            </div>
        </div>
    </div>
</div>



<!-- //MODAL ADD QUESTION REGIS -->
<div class="modal fade" id="modal_add_question" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title putih">Add New Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_add_dataregis" action="{{route('setting_regisdata_comm')}}">
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
            <div class="modal-footer putih">
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
            <div class="modal-body">
                <form method="POST" id="form_edit_dataregis" action="{{route('setting_regisdata_comm')}}">
                    {{ csrf_field() }}
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

                    <!-- <div class="row form-group">
                        <div class="col-md-3" style="margin-top: 1em;">
                            <label class="cgrey">Choose Input</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control input-abu" name="value0" id="value0">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3" style="margin-top: 1em;">
                            <label class="cgrey">Choose Input</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control input-abu" name="value1" id="value1">
                        </div>
                    </div> -->

                    <div id="isi_newrow_edit"></div>

                    <center>
                        <button type="button" class="btn btn-icon-text" id="addnewrow_edit">
                            <i class="mdi mdi-plus-circle" style="color: #50C9C3;"></i>
                            <small>Add New Row</small> </button>
                    </center>
            </div>
            <div class="modal-footer putih">
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
        tabel_list_regisdata();
        addRowRegisData();
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

        //DETAIL USERTYPE FROM DATATABLE
        $('#tabel_list_regisdata tbody').on('click', 'button', function () {
            var pilih = tabel.row($(this).parents('tr')).data();
            console.log(pilih);
            var isi = pilih.param_form_array;
            $("#edit_question").val(isi[0]);
            $("#edit_tipedata").val(isi[1]).attr("selected", "selected");

            var len = isi.length;
             var cek = isi.slice(2, len);
             var len_2 = cek.length;
             addRowRegisData_edit(len_2);
             var new_row2 ='';
             $.each(cek, function (i, item) {
                 console.log(item);
                //  $("#value"+i).val(item);
            new_row2 +='<div class="row form-group newly2" id="row' + i + '">' +
                     '<div class="col-md-3" style="margin-top: 1em;">' +
                     '<label class="cgrey">Choose Input</label>' +
                     '</div>' +
                     '<div class="col-md-7">' +
                     '<input type="text" class="form-control input-abu" value="'+item+'" name="value' + i + '">' +
                     '</div>' +
                     '<div class="col-md">' +
                     '<button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon delete-row2" style="width: 25px; height: 25px; margin-top: 0.7em;">' +
                     '<i class="mdi mdi-delete"></i>' +
                     '</button>' +
                     '</div>' +
                     '</div>';
             });

            $('#isi_newrow_edit').html(new_row2+'<div id="isi_newrow_edit_new"></div>');
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
