@extends('layout.admin-dashboard')
@section('title', 'News Management')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">News Management</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your news information<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
          <nav aria-label="breadcrumb">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle btn-tosca btn-sm" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" lang="en">Add News</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_add_news" lang="en">Manual Add News</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_scrape_news" lang="en">Scrape News</a>
            </div>
        </div>
    </nav>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih" lang="en">List News</div>

            <div class="card-body">
                <!-- tabel all susbcriber -->
                <table id="tabel_news_manage" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th><b></b></th>
                            <th><b lang="en">Title</b></th>
                            <th><b lang="en">Author</b></th>
                            <th><b lang="en">Date</b></th>
                            <th><b lang="en">Publish Status</b></th>
                            <th><b lang="en">Headline Status</b></th>
                            <th><b lang="en">Action</b></th>
                        </tr>
                    </thead>
                </table>
                <!-- end tabel all  -->
            </div> <!-- //body -->
        </div>
    </div>
</div> <!-- endrow -->






<!-- MODAL ADD NEWS-->
<div class="modal fade" id="modal_add_news" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_add_news" action="{{route('add_news_management')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Add News</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <div class="news-img-upload">
                                    <div class="news-img-cont">
                                        <img class="img-fluid news_pic" id="news_picture2" src="/img/noimg.jpg"
                                            onerror="this.onerror=null;this.src='/visual/car1.png';">
                                    </div>
                                    <div class="p-image editnews">
                                        <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                            style="width: 30px; height: 30px;">
                                            <i class="mdi mdi-camera upload-button" id="btn_up_logo_komunitas2"></i>
                                        </button>
                                        <input class="file-upload file-upload-default" id="file-upload-komunitas2"
                                            type="file" name="fileup2" accept="image/*" />
                                    </div>
                                </div>
                                <small class="clight" lang="en">News Title</small>
                                <input type="text" id="add_title" name="add_title"
                                    class="form-control input-abu melengkung10px" required>
                            </div>
                            <div class="form-group">
                                <small class="clight" lang="en">News Content</small>
                                <textarea class="form-control input-abu" label="Konten" req="" id="news_add_content"
                                    name="news_add_content"></textarea>
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
                        </i> <span lang="en">Add News</span> </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL SCRAPE NEWS-->
<div class="modal fade" id="modal_scrape_news" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_scrape_news" action=" {{route('scrape_news')}}" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Scrape News</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">

                                <small class="clight" lang="en">News URL</small>
                                <input type="text" id="url_add" name="url" class="form-control input-abu melengkung10px"
                                    required>
                            </div>

                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> <span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Get News</span> </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>









<!-- MODAL EDIT NEWS -->
<div class="modal fade" id="modal_edit_news" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <form method="POST" id="form_edit_news_management" action="{{route('edit_news_management')}}"
            enctype="multipart/form-data">{{ csrf_field() }}
            <div class="modal-content" style="background-color: #ffffff;">
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Edit News</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> <!-- end-header -->

                <div class="modal-body"
                    style="padding-left: 5%;padding-right: 5%; min-height: 300px; overflow-y: scroll;overflow-x: hidden;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <div class="news-img-upload">
                                    <div class="news-img-cont">
                                        <img class="img-fluid news_pic" id="news_picture" src="/img/focus.png"
                                            onerror="this.onerror=null;this.src='/visual/car1.png';">
                                    </div>
                                    <div class="p-image editnews">
                                        <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                            style="width: 30px; height: 30px;">
                                            <i class="mdi mdi-camera upload-button" id="btn_up_logo_komunitas"></i>
                                        </button>
                                        <input class="file-upload file-upload-default" id="file-upload-komunitas"
                                            type="file" id="fileup" name="fileup" accept="image/*" />
                                    </div>
                                </div>
                                <small class="clight" lang="en">News Title</small>
                                <input type="text" id="edit_title" name="edit_title"
                                    class="form-control input-abu melengkung10px">
                            </div>
                            <div class="form-group">
                                <small class="clight" lang="en">News Content</small>
                                <textarea class="form-control input-abu" label="Konten" req="" id="news_edit_content"
                                    name="news_edit_content"></textarea>
                            </div>

                            <div class="form-group publish-stat">
                                <small class="clight" lang="en">Publish Status</small>
                                <input id="toggle-status" type="checkbox" data-toggle="toggle" data-on="Published"
                                    data-off="Disabled" data-onstyle="success" data-offstyle="danger" data-width="100"
                                    data-size="sm" onclick="toggleStatus()">
                            </div>

                            <div class="form-group headline-stat">
                                <small class="clight" lang="en">Headline Status</small>
                                <input id="toggle-headline" type="checkbox" data-toggle="toggle" data-on="Headline"
                                    data-off="Normal" data-onstyle="warning" data-offstyle="light" data-width="100"
                                    data-size="sm" onclick="toggleHeadline()">
                            </div>

                        </div>
                        <input type="hidden" id="id_news" name="id_news" class="form-control input-abu">
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> <span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Save</span> </button>
                </div> <!-- end-footer     -->
            </div> <!-- END-MDL CONTENT -->
        </form>
    </div>
</div>



@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {
         $('#toggle-headline').attr("disabled");
         $('#toggle-status').attr("disabled");
        //get_all_news();
        tabel_news_management();
        tabel_tes();
    });

    $("#file-upload-komunitas").on('change', function () {
        readURLini(this);
    });

    $("#btn_up_logo_komunitas").on('click', function () {
        $("#file-upload-komunitas").click();
    });

    var readURLini = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#news_picture').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file-upload-komunitas2").on('change', function () {
        readURLini2(this);
    });

    $("#btn_up_logo_komunitas2").on('click', function () {
        $("#file-upload-komunitas2").click();
    });

    var readURLini2 = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#news_picture2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }



    $("#btn_add_news").on('click', function () {
        var editor = new nicEditor({ iconsPath: '/img//nicEditorIcons.gif' }).panelInstance('news_add_content');
        $('.nicEdit-panelContain').parent().width('100%');
        $('.nicEdit-main').parent().width('98%');
        $('.nicEdit-main').width('98%');
        $('.nicEdit-main').height('200px');

    });


    $('#toggle-status').change(function () {
        $id = $('#toggle-status').attr('value');
        change_status($id);
    });

    $('#toggle-headline').change(function () {
        $id = $('#toggle-headline').attr('value');
        change_headline($id);
    });

    function change_status(id) {
        $id = id;
        //alert('Toggle: '+ $id + $('#toggle-status').prop('checked'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/publish_news',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "news_id": id
            },
            success: function (result) {
                $msg = result.status;
                // alert($msg);
                if ($msg == 1) {
                    swal("News Successfully Published");
                } else {
                    swal("News Successfully Disabled");
                }
            },
            error: function (result) {
                $msg = result.message;
                //alert($msg);

            }
        });
    }

    function change_headline(id) {
        $id = id;
        //alert('Toggle: '+ $id + $('#toggle-status').prop('checked'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/publish_headline',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "news_id": id
            },
            success: function (result) {
                $msg = result.status;
                //alert($msg);
                if ($msg == true) {
                    swal("News Set as Headline");
                } else {
                    swal("News Headline Disabled");
                }
            },
            error: function (result) {
                $msg = result.message;
                //alert($msg);

            }
        });
    }


    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/tabel_news_management',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log("Cant Show");
            }
        });
    }

    function tabel_news_management() {
        var tabel = $('#tabel_news_manage').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/admin/tabel_news_management',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="7" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_news_manage tbody').empty().append(nofound);
                },
            },
            columns: [
                {
                    mData: 'image',
                    render: function (data, type, row, meta) {
                        // console.log(data);
                        var noimg = '/img/kosong.png';
                        return '<img src=' + server_cdn + cekimage_cdn(data) + ' class="news-list-box zoom"  onclick="clickImage(this)" onerror = "this.onerror=null;this.src=\'' + noimg + '\';">';
                    }
                },
                {
                    mData: 'title',
                    render: function (data, type, row, meta) {
                        return '<p class="s13 text-wrap width-200">' + data + '</p>';
                    }
                },
                { mData: 'author_name' },
                {
                    mData: 'createdAt',
                    render: function (data, type, row, meta) {
                        return dateFormat(data);
                    }
                },
                {
                    mData: 'publish',
                    render: function (data, type, row, meta) {
                        if (data == 0) {
                            return '<div class="label-off">Unpublish</div>';
                        } else {
                            return '<div class="label-on">Published</div>';
                        }
                    }
                },
                {
                    mData: 'headline',
                    render: function (data, type, row, meta) {
                        if (data == false) {
                            return '<div class="headline-off">Normal</div>';
                        } else {
                            return '<div class="headline-on">Headline</div>';
                        }
                    }
                },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        return '<a href="/admin/get_detail_news/' + data + '" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref">' +
                            '<i class="mdi mdi-eye matadetail"></i></a>' +
                            '<a href="#" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref" onclick=edit_news_management(' + data + ')>' +
                            '<i class="mdi mdi-pencil matadetail"></i></i></a>';
                    }
                }
            ],

        });
    }



    function showPassword() {
        var a = document.getElementById("confirmpass_user");
        if (a.type == "password") {
            a.type = "text";
        } else {
            a.type = "password";
        }
    }

    function edit_news_management(news_id) {
           $('#toggle-headline').removeAttr("disabled");
         $('#toggle-status').removeAttr("disabled");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_data_edit',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "news_id": news_id
            },
            success: function (res) {
                $publish_stat = res.publish;
                $headline_stat = res.headline;


                if ($publish_stat == 1) {
                    $('#toggle-status').bootstrapToggle('on');
                } else {
                    $('#toggle-status').bootstrapToggle('off');
                }

                if ($headline_stat == true) {
                    $('#toggle-headline').bootstrapToggle('on')
                } else {

                    $('#toggle-headline').bootstrapToggle('off')
                }

                //console.log(res);
                // console.log(res.title);
                // console.log(res.content);
                //var res = result[0];
                $("#modal_edit_news").modal("show");
                var editor = new nicEditor({ iconsPath: '/img//nicEditorIcons.gif' }).panelInstance('news_edit_content');
                $('.nicEdit-panelContain').parent().width('100%');
                $('.nicEdit-main').parent().width('98%');
                $('.nicEdit-main').width('98%');
                $('.nicEdit-main').height('200px');

                var content = nicEditors.findEditor('news_edit_content');
                content.setContent(res.content);
                $('textarea[name=news_edit_content]').val(res.content);

                //$("#news_picture").attr("src", server_cdn+res.image);
                $("#news_picture").attr("src", server_cdn + res.image);
                $("#edit_title").val(res.title);
                $("#id_news").val(res.id);
                $("#toggle-status").val(res.id);
                $("#toggle-headline").val(res.id);





            },
            error: function (result) {
                console.log("Cant Show Detail User");
            }
        });
    }


//dropdown
// function get_news_manage() {
// $.ajaxSetup({
//     headers: {
//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
// $.ajax({
//     url: "/admin/get_news_manage",
//     type: "POST",
//     dataType: "json",
//     success: function (result) {

//       $('#user_tipe').empty();
//       $('#user_tipe').append("<option disabled> Choose </option>");

//       for (var i = result.length - 1; i >= 0; i--) {
//         $('#user_tipe').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
//       }
//       //Short Function Ascending//
//       $("#user_tipe").html($('#user_tipe option').sort(function (x, y) {
//         return $(y).val() < $(x).val() ? -1 : 1;
//       }));

//       $("#user_tipe").get(0).selectedIndex = 0;

//        const OldValue = '{{old('user_tipe')}}';

//     if(OldValue !== '') {
//       $('#user_tipe').val(OldValue);
//     }
// // ______________________________________________

//       $('#user_tipe_edit').empty();
//       $('#user_tipe_edit').append("<option disabled> Choose </option>");

//       for (var i = result.length - 1; i >= 0; i--) {
//         $('#user_tipe_edit').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
//       }
//       //Short Function Ascending//
//       $("#user_tipe_edit").html($('#user_tipe_edit option').sort(function (x, y) {
//         return $(y).val() < $(x).val() ? -1 : 1;
//       }));

//       $("#user_tipe_edit").get(0).selectedIndex = 0;

//        const OldValue2 = '{{old('user_tipe_edit')}}';

//     if(OldValue2 !== '') {
//       $('#user_tipe_edit').val(OldValue2);
//     }
// }
// });
// } //endfunction

</script>

@endsection
