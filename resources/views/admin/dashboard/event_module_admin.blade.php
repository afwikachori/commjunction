@extends('layout.admin-dashboard')
@section('title', 'Event Management')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Event Management</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your event and commounity activity<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">

        </nav>
    </div>
</div>
<br>

<div class="row">
    <div id="page_event_module_admin"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="row mgb-1">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6 kananin">
                        <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                            data-target="#modal_create_event" lang="en">Create Event</button>
                    </div>
                </div>


                <table id="tabel_event_management" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th><b lang="en">ID Event</b></th>
                            <th><b lang="en">Title</b></th>
                            <th><b lang="en">Image</b></th>
                            <th><b lang="en">Date</b></th>
                            <th><b lang="en">Time</b></th>
                            <th><b lang="en">Status</b></th>
                            <th><b lang="en">Ticket Type</b></th>
                            <th><b lang="en">Link</b></th>
                            <th><b lang="en">Action</b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- MODAL CREATE EVENT -->
<div class="modal fade" id="modal_create_event" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_create_event" action="{{route('post.admin.create-event')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Add Event</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Title Event</small>
                                <input type="text" id="event_judul" name="event_judul" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Image Event</small>
                                <input type="file" id="event_img" name="event_img" class="form-control input-abu"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Description Event</small>
                                <textarea type="text" id="event_deskripsi" name="event_deskripsi" rows="3"
                                    class="form-control input-abu"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">link Event</small>
                                <input type="text" id="event_link" name="event_link" class="form-control input-abu">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Date Event</small>
                                <input type="date" id="event_tgl" name="event_tgl" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Time Event</small>
                                <input type="time" id="event_time" name="event_time" class="form-control input-abu">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Status Event</small>
                                <select class="form-control input-abu" name="event_status" id="event_status">
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="0" lang="en">Non-Active</option>
                                    <option value="1" lang="en">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Type Event</small>
                                <select class="form-control input-abu" name="event_type" id="event_type">
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="0" lang="en">Internal</option>
                                    <option value="1" lang="en">External</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Venue</small>
                                <p>halo1p</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group offlined">
                                <small class="clight" lang="en">Lokasi</small>
                                <p>Malang</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Event Type</small>
                                <div class="custom-control custom-switch" id="div_tipe_event">
                                    <input type="checkbox" class="custom-control-input" id="switch_jenis_event"
                                        name="switch_jenis_event">
                                    <label class="custom-control-label" for="switch_jenis_event">
                                        <span id="jenis_event">Offline</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group onlined">
                                <small class="clight" lang="en">Lokasi Tiket Online</small>
                                <input type="text" id="lokasi_online" name="lokasi_online"
                                    class="form-control input-abu">
                            </div>
                        </div>
                    </div>

                    <div class="row onlined">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Link Event Online</small>
                                <input type="text" id="link_online" name="link_online" class="form-control input-abu">
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
                        </i> <span lang="en">Add Event</span> </button>
                </div>
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>

<!-- MODAL EDIT EVENT -->
<div class="modal fade" id="modal_edit_event" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_edit_event" action="{{route('post.admin.edit-event')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Edit Event</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <input type="hidden" id="id_event_admin" name="id_event">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Title Event</small>
                                <input type="text" id="edit_judul" name="edit_judul" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Image Event</small>
                                <input type="file" id="edit_img" name="edit_img" class="form-control input-abu">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Description Event</small>
                                <textarea type="text" id="edit_deskripsi" name="edit_deskripsi" rows="3"
                                    class="form-control input-abu"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">link Event</small>
                                <input type="text" id="edit_link" name="edit_link" class="form-control input-abu">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Date Event</small>
                                <input type="date" id="edit_tgl" name="edit_tgl" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Time Event</small>
                                <input type="time" id="edit_time" name="edit_time" class="form-control input-abu">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Status Event</small>
                                <select class="form-control input-abu" name="edit_status" id="edit_status">
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="0" lang="en">Non-Active</option>
                                    <option value="1" lang="en">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Type Event</small>
                                <select class="form-control input-abu" name="edit_type" id="edit_type">
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="0" lang="en">Internal</option>
                                    <option value="1" lang="en">External</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Venue</small>
                                <p>halo1p</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group offlined2">
                                <small class="clight" lang="en">Lokasi</small>
                                <p>Malang</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Event Type</small>
                                <div class="custom-control custom-switch" id="div_tipe_event">
                                    <input type="checkbox" class="custom-control-input" id="edit_switch_jenis_event"
                                        name="edit_switch_jenis_event">
                                    <label class="custom-control-label" for="edit_switch_jenis_event">
                                        <span id="edit_jenis_event">Offline</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group onlined2">
                                <small class="clight" lang="en">Lokasi Tiket Online</small>
                                <input type="text" id="edit_lokasi_online" name="edit_lokasi_online"
                                    class="form-control input-abu">
                            </div>
                        </div>
                    </div>

                    <div class="row onlined2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Link Event Online</small>
                                <input type="text" id="edit_link_online" name="edit_link_online"
                                    class="form-control input-abu">
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
                        </i> <span lang="en">Edit Event</span> </button>
                </div>
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>






<!-- MODAL SET REMINDER EVENT -->
<div class="modal fade" id="modal_reminder_event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="border: none;">
                <h3 class="modal-title" lang="en">Setting Reminder Event</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form_set_reminder_event" action="{{route('post.admin.set-reminder')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="min-height: 130px;">
                    <span class="cteal mgb-1" id="judul_event_reminder"></span>
                    &nbsp; at &nbsp;
                    <span class="cteal mgb-1 s14" id="date_event"></span>
                    <br><br>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">First Reminder</small>
                                <input type="date" id="reminder_1" name="reminder_1" class="form-control input-abu">
                            </div>

                            <div class="form-group">
                                <small class="clight" lang="en">Second Reminder</small>
                                <input type="date" id="reminder_2" name="reminder_2" class="form-control input-abu">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="idevent" name="idevent">
                </div>
                <div class="modal-footer"
                    style="border: none; margin-bottom: 0.5em;
                            display: flex;align-items: center; justify-content: center; padding-left: 5%; padding-right: 5%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i><span lang="en">Setting</span></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL DELETE TICKET-->
<div class="modal fade" id="modal_delete_ticket" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff; width: 80%;
        min-height: 350px;">

            <form method="POST" id="form_del_tiket" action="{{route('post.admin.delete-ticket')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <center>
                        <img src="/visual/warning.png" id="img_signout_admin">
                        <h3 class="cgrey" lang="en">Confirmation</h3>
                        <small class="clight" lang="en">Are you sure, you want to delete ?</small>
                        <input type="hidden" id="id_tickets" name="id_tickets">
                        <input type="hidden" id="id_eventtiket" name="id_eventtiket">
                    </center>
                </div> <!-- end-body -->

                <div class="modal-footer changepass" style="border: none;">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> <span lang="en">No, Im Doubt</span>
                        </button>
                        &nbsp;
                        <button type="submit" class="btn btn-tosca btn-sm" style="border-radius: 10px;">
                            <i class="mdi mdi-check"></i> <span lang="en">Yes, Sure</span>
                        </button>
                    </center>
                </div> <!-- end-footer     -->
            </form>


        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


@endsection
