@extends('layout.subscriber')
@section('title', 'News List')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>News List</h3>

    <nav aria-label="breadcrumb">
        <div class="dropdown">
            <!-- <button class="btn btn-secondary btn-tosca btn-sm" type="button" id="find_friend" data-toggle="modal" data-target="#find_friend_modal">
                    Filter News
                  </button> -->
        </div>

    </nav>
</div>


<div class="row">
    <div class="col-md-12">
        <div id="headline" class="suggestionlist">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div style="min-height: 450px;">

            <div class="card-body">
                <div id="nodata_news" style="display: none; min-height: 300px; margin-left: auto; margin-right: auto;">
                    <br><br><br><br><br>
                    <center>
                        <h1 class="clight" lang="en">No Data Available</h1>
                    </center>
                </div>
                <div id="news_container">


                </div>
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

        table_news_list();
        // tabel_tes();
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

    function table_news_list() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/table_news_list',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                if (result.success === false) {
                    $("#nodata_news").show();
                    $("#news_container").hide();
                } else {
                    var newslist = '';
                    var jumlah = 0;
                    var nofoto = '/img/artikel.jpg';

                    $.each(result, function (i, item) {
                        jumlah++;
                        $news_id = parseInt(item.id);
                        // $date=item.author_name;

                        var headpic = server_cdn + cekimage_cdn(item.image);
                        newslist += '<div class="news-card" id="' + item.id + '">' +
                            '<div class="row"><div class="col-md-6 news_pic_container">' +
                            '<img src="' + headpic + '" class="img-fluid picimg_news"' +
                            'onerror = "this.onerror=null;this.src=\'' + nofoto + '\';"></div>' +
                            '<div class="col-md-6 news_content_container"><h4 class="news-title">' + item.title + '</h4>' +
                            '<h6 class="author_name cgrey2 s13">Date : ' + item.createdAt + '</h6>' +
                            '<h6 class="author_name cgrey2 s13">Author : ' + item.author_name + '</h6>' +
                            '<br><a href="/subscriber/detail_news/' + item.id + '" class="btn btn-tosca btn-sm konco">' +
                            'See Detail' +
                            '</a></div>' +
                            '</div>' +
                            '</div>';
                    });
                    $("#nodata_news").hide();
                    $("#news_container").html(newslist);
                }
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }

    // function suggestion_list(){
    //             $.ajaxSetup({
    //             headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    //         $.ajax({
    //               url: '/subscriber/get_friends_sugestion',
    //               type: 'POST',
    //               datatype: 'JSON',
    //               success: function (result) {
    //                 var suggestionlist = '';
    //                 var jumlah = 0;
    //                 var nofoto = '/img/kosong.png';

    //                 $.each(result, function (i, item) {
    //                   jumlah++;
    //                   $news_id = parseInt(item.id);
    //                     var $headpic = server_cdn + item.image;
    //                     suggestionlist += '<div class="card konco" id="' + item.user_id + '">' +
    //                         '<div class="card-body color">' +
    //                         '<div class="close_konco">' +
    //                         '<button type="button" class="close cgrey2" aria-label="Close"' +
    //                         'onclick="hide_friendsugest(\'' + item.user_id + "<>" + jumlah + '\')">' +
    //                         '<span aria-hidden="true">&times;</span>' +
    //                         '</button>' +
    //                         '</div>' +
    //                         '<form>' +
    //                         '<center>' +
    //                         '<img src="' + server_cdn + item.picture + '" class="rounded-circle img-fluid mb-2 konco"' +
    //                         'onerror = "this.onerror=null;this.src=\'' + nofoto + '\';">' +
    //                         '<h6 class="cgrey2 s13">' + item.full_name + '</h6>' +
    //                         '<input type="hidden" value="" name="frend_suges">' +
    //                         '<button type="button" class="btn btn-tosca btn-sm konco">' +
    //                         '<i class="mdi mdi-account-plus"></i> &nbsp; Add' +
    //                         '</button>' +
    //                         '<center>' +
    //                         '</form>' +
    //                         '</div>' +
    //                         '</div>' +
    //                         '</div>';
    //                 });

    //                 $("#suggestion_list").html(suggestionlist);
    //               },
    //               error: function (result) {
    //                 console.log("Cant Show");
    //             }
    //         });
    // }




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
