@extends('layout.superadmin')

@section('title', 'Inbox Management')

@section('content')
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Inbox Management</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey">Manage your message information<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
            <button type="button" class="btn btn-tosca btn-sm" style="min-width: 170px;" data-toggle="modal"
                data-target="#modal_send_inbox_super">
                Broadcast Message</button>
        </nav>
    </div>
</div>

<br>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih">
                Message List
            </div>

            <div class="card-body">
                <button type="button" class="btn btn-tosca btn-sm" style="margin-top: -1em; margin-bottom: 2em;"
                    data-toggle="modal" data-target="#modal_generate_inbox_tabel">
                    Generate Message</button>

                <table id="tabel_inbox_message_super" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%; display: none;">
                    <thead>
                        <tr>
                            <th><b> ID </b></th>
                            <th><b> Title </b></th>
                            <th><b> Type Notif</b></th>
                            <th><b> User Type </b></th>
                            <th><b> Community Type </b></th>
                            <th><b> Status</b></th>
                            <th><b> Created By </b></th>
                            <th><b> Date </b></th>
                            <th><b> Action </b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->

<!-- MODAL GENERATED Message-->
<div class="modal fade" id="modal_generate_inbox_tabel" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form>
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Generate Inbox</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Start Date</small>
                                <input type="date" id="tanggal_mulai2" name="tanggal_mulai2"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">End Date</small>
                                <input type="date" id="tanggal_selesai2" name="tanggal_selesai2"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Community</small>
                                <select class="form-control input-abu" name="list_komunitas_inbox"
                                    id="list_komunitas_inbox">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Message Type</small>
                                <select class="form-control input-abu" name="tipe_pesan" id="tipe_pesan">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> System </option>
                                    <option value="2"> Module</option>
                                    <option value="3"> Broadcast </option>
                                    <option value="4"> Single send</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Filter Title</small>
                                <input type="text" id="filter_judul" name="filter_judul" class="form-control input-abu">
                            </div>
                        </div>
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_inbox_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Generate </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL ADD SEND MESSAGE INBOX-->
<div class="modal fade" id="modal_send_inbox_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_send_inbox_super" action="{{route('send_inbox_message_super')}}">
                {{ csrf_field() }}<div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Send Message</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Message Title</small>
                                <input type="text" id="judul_inbox" name="judul_inbox" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">User Type</small>
                                <select class="form-control input-abu" name="usertipe_inbox" id="usertipe_inbox">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Admin Commjuction </option>
                                    <option value="2"> Admin Community </option>
                                    <option value="3"> Subscriber </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Message Description</small>
                                <textarea type="text" id="deksripsi_inbox" name="deksripsi_inbox"
                                    class="form-control input-abu" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <small class="clight s13">Message Type</small>
                            <select class="form-control input-abu" name="tipe_inbox" id="tipe_inbox">
                                <option selected disabled> Choose </option>
                                <option value="1"> System </option>
                                <option value="2"> Module </option>
                                <option value="3"> Single </option>
                                <option value="4"> Broadcast </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Community</small>
                                <select class="form-control input-abu" name="komunitas_inbox" id="komunitas_inbox">

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Broadcast Status</small>
                                <select class="form-control input-abu" name="bc_status" id="bc_status">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Single</option>
                                    <option value="2"> Broadcast</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="hide_user_notif" style="display: none;">
                                <small class="clight s13">List User</small>
                                <select class="form-control input-abu" name="list_user" id="list_user">
                                </select>
                            </div>
                        </div>
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_send_notif_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Send </button>
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
        // tabel_tes();
        get_list_komunitas();
    });

    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/tabel_generate_inbox_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas_inbox").val(),
                "start_date": $("#tanggal_mulai2").val(),
                "end_date": $("#tanggal_selesai2").val(),
                "filter_title": $("#filter_judul").val(),
                "message_type": $("#tipe_pesan").val(),
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }


    $("#btn_generate_inbox_super").click(function () {
        tabel_tes();
    });


    $('#bc_status').change(function () {
        var dipilih = this.value;
    if(dipilih == 1){
        $("#hide_user_notif").fadeIn("fast");
    }else{
          $("#hide_user_notif").fadeOut("fast");
    }

    });


    //dropdown subs_name list
    $('#komunitas_inbox').change(function () {
        var itempilih = this.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_list_user_inbox_super",
            type: "POST",
            dataType: "json",
            data: {
                "user_type": $("#usertipe_inbox").val(),
                "community_id": itempilih,
            },
            success: function (result) {
                console.log(result);

                $('#list_user').empty();
                $('#list_user').append("<option disabled value='0'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_user').append("<option value=\"".concat(result[i].user_id, "\">").concat(result[i].full_name, "</option>"));
                }
                //Short Function Ascending//
                $("#list_user").html($('#list_user option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#list_user").get(0).selectedIndex = 0; const
                    OldSubf = "{{old('list_user')}}";
                if (OldSubf !== '') {
                    $('#list_user').val(OldSubf);
                }
            },
            error: function (result) {
                $('#hide_user_notif').fadeOut("fast");
                $('#list_user').empty();
                $('#list_user').append("<option disabled value='0'>No Related User</option>");
            }
        });
    });
    //end list subscriber



    //dropdown komunitas list
    function get_list_komunitas() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/list_komunitas_log",
            type: "POST",
            dataType: "json",
            success: function (result) {
                $('#list_komunitas_inbox').empty();
                $('#list_komunitas_inbox').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_komunitas_inbox').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#list_komunitas_inbox").html($('#list_komunitas_inbox option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#list_komunitas_inbox").get(0).selectedIndex = 0;
                // _________________________________________________________________________

                $('#komunitas_inbox').empty();
                $('#komunitas_inbox').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komunitas_inbox').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#komunitas_inbox").html($('#komunitas_inbox option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#komunitas_inbox").get(0).selectedIndex = 0;
                Olddt = "{{old('usekomunitas_notifr_notif')}}";
                if (Olddt !== '') {
                    $('#komunitas_inbox').val(Olddt);
                }

            }
        });
    } //endfunction


</script>

@endsection
