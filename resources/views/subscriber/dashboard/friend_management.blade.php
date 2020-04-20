@extends('layout.subscriber')
@section('title', 'Friend List')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>Friend List</h3>

    <nav aria-label="breadcrumb">
        <div class="dropdown">
            <button class="btn btn-secondary btn-tosca btn-sm" type="button" id="find_friend" data-toggle="modal"
                data-target="#find_friend_modal">
                Find Friends
            </button>
        </div>

    </nav>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="divkonco">
            <div id="suggestion_list" class="suggestionlist">

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih">
                Added Friends
            </div>

            <div class="card-body">
                <!-- tabel all susbcriber -->
                <table id="tabel_friend_manage" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th><b>Name</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                </table>
                <!-- end tabel all  -->
            </div> <!-- //body -->
        </div>
    </div>
</div> <!-- endrow -->






<!-- MODAL SEND MESSAGE-->
<div class="modal fade" id="modal_send_message" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_send_message" action="{{route('friend_send_message')}}">
                {{ csrf_field() }}


                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Send Message</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight">Subject</small>
                                <input type="text" id="subject" name="subject"
                                    class="form-control input-abu melengkung10px" required>
                            </div>
                            <div class="form-group">
                                <small class="clight">Message</small>
                                <textarea class="form-control input-abu" label="Konten" req="" id="news_add_content"
                                    name="message"></textarea>
                            </div>
                            <input type="hidden" id="friend_id" name="friend_id" class="form-control input-abu">
                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Send Message</button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL FIND FRIEND -->
<div class="modal fade" id="find_friend_modal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_send_message" action="{{route('friend_send_message')}}">
                {{ csrf_field() }}


                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Find Friend</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight">Subject</small>
                                <input type="text" id="subject" name="subject"
                                    class="form-control input-abu melengkung10px" required>
                            </div>
                            <div class="form-group">
                                <small class="clight">Message</small>
                                <textarea class="form-control input-abu" label="Konten" req="" id="news_add_content"
                                    name="message"></textarea>
                            </div>
                            <input type="hidden" id="friend_id" name="friend_id" class="form-control input-abu">
                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Send Message</button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {
        //get_all_news();
        suggestion_list();
        tabel_friend_list();
        tabel_tes();
    });



    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/tabel_friend_management',
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

    function tabel_friend_list() {
        var tabel = $('#tabel_friend_manage').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/subscriber/tabel_friend_management',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h4 class="cgrey">Data Not Found</h4</td></tr>';
                    $('#tabel_friend_manage tbody').empty().append(nofound);
                },
            },
            columns: [
                {
                    mData: 'image',
                    render: function (data, type, row, meta) {
                        // console.log(data);
                        return '<img src=' + server_cdn + cekimage_cdn(data) + ' class="news-list-box">';
                    }
                },
                { mData: 'full_name' },
                {
                    mData: 'friend_id',
                    render: function (data, type, row, meta) {
                        return '<a href="/subscriber/view_profile/' + data + '" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref">' +
                            '<i class="mdi mdi-eye matadetail"></i></a>' +
                            '<a href="#" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref" onclick=send_message("' + data + '")>' +
                            '<i class="mdi mdi-email matadetail"></i></i></a>' +
                            '<a href="#" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref" onclick=send_whatsapp("' + data + '")>' +
                            '<i class="mdi mdi-whatsapp matadetail"></i></i></a>';
                    }
                }
            ],

        });
    }

    function suggestion_list() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_friends_sugestion',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                var suggestionlist = '';
                var jumlah = 0;
                var nofoto = '/img/kosong.png';

                $.each(result, function (i, item) {
                    jumlah++;
                    $news_id = parseInt(item.id);
                    var $headpic = server_cdn + cekimage_cdn(item.image);
                    suggestionlist += '<div class="card konco" id="' + item.user_id + '">' +
                            '<div class="card-body color">' +
                            '<div class="close_konco">' +
                            '<button type="button" class="close cgrey2" aria-label="Close"' +
                            'onclick="hide_friendsugest(\'' + item.user_id + "<>" + jumlah + '\')">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>' +
                            '<form method="POST" id="form_add_friend" action="{{route('add_friend_suggest_subs')}}">' +
                            '{{ csrf_field() }}' +
                            '<center>' +
                            '<img src="' + server_cdn + cekimage_cdn(item.picture) + '" class="rounded-circle img-fluid mb-2 konco"' +
                            'onerror = "this.onerror=null;this.src=\'' + nofoto + '\';">' +
                            '<h6 class="cgrey2 s13">' + item.full_name + '</h6>' +
                            '<input type="hidden" value="' + item.user_id + '" name="user_id_subs">' +
                            '<button type="submit" class="btn btn-tosca btn-sm konco">' +
                            '<i class="mdi mdi-account-plus"></i> &nbsp; Add' +
                            '</button>' +
                            '<center>' +
                            '</form>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                });

                $("#suggestion_list").html(suggestionlist);
            },
            error: function (result) {
                console.log("Cant Show");
            }
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
    // function send_message(friend_id){
    // $.ajaxSetup({
    //     headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    // $.ajax({
    //       url: '/subscriber/send_friend_message',
    //       type: 'POST',
    //       datatype: 'JSON',
    //       data: {
    //       "friend_id": friend_id
    //       },
    //       success: function (res) {

    //       $("#modal_send_message").modal("show");
    //       // var editor = new nicEditor({iconsPath : '/img//nicEditorIcons.gif'}).panelInstance('news_edit_content');
    //       //  $('.nicEdit-panelContain').parent().width('100%');
    //       // $('.nicEdit-main').parent().width('98%');
    //       // $('.nicEdit-main').width('98%');
    //       // $('.nicEdit-main').height('200px');

    //       // var content  = nicEditors.findEditor('news_edit_content');
    //       //       content.setContent(res.content);
    //       //       $('textarea[name=news_edit_content]').val(res.content);

    //      //$("#news_picture").attr("src", server_cdn+res.image);
    //      // $("#news_picture").attr("src", server_cdn+res.image);
    //      //   $("#edit_title").val(res.title);
    //      //   $("#id_news").val(res.id);
    //      //   $("#toggle-status").val(res.id);
    //      //   $("#toggle-headline").val(res.id);
    //       },
    //       error: function (result) {
    //         console.log("Cant Send Message to Friend");
    //     }
    // });
    // }



    function send_message(friend_id) {
        $friend_id = friend_id;
        $("#modal_send_message").modal("show");
        $("#friend_id").val($friend_id);
        // var editor = new nicEditor({iconsPath : '/img//nicEditorIcons.gif'}).panelInstance('news_edit_content');
        //  $('.nicEdit-panelContain').parent().width('100%');
        // $('.nicEdit-main').parent().width('98%');
        // $('.nicEdit-main').width('98%');
        // $('.nicEdit-main').height('200px');

        // var content  = nicEditors.findEditor('news_edit_content');
        //       content.setContent(res.content);
        //       $('textarea[name=news_edit_content]').val(res.content);

        //$("#news_picture").attr("src", server_cdn+res.image);
        // $("#news_picture").attr("src", server_cdn+res.image);
        //   $("#edit_title").val(res.title);
        //   $("#id_news").val(res.id);
        //   $("#toggle-status").val(res.id);
        //   $("#toggle-headline").val(res.id);
    };

    function send_whatsapp(friend_id) {
        $friend_id = friend_id;
        $phonum = +628123229810;
        $pretext = "Halo, Salam kenal";
        window.open('https://api.whatsapp.com/send?phone=' + $phonum + '&text=' + $pretext + '');

    }


</script>

@endsection
