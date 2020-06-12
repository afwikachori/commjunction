@extends('layout.admin-dashboard')
@section('title', 'News Management')
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
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_all">
                            <a href="#tab_default_1" data-toggle="tab">
                                <span lang="en">Event</span>
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_pending">
                            <a href="#tab_default_2" data-toggle="tab">
                                <span lang="en">Ticket</span>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <div class="row mgb-1">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6 kananin">
                                    <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                        data-target="#modal_create_event" lang="en">Create Event</button>
                                </div>
                            </div>


                            <table id="tabel_event_management"
                                class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b lang="en">ID Event</b></th>
                                        <th><b lang="en">Title</b></th>
                                        <th><b lang="en">Image</b></th>
                                        <th><b lang="en">Date</b></th>
                                        <th><b lang="en">Time</b></th>
                                        <th><b lang="en">Status</b></th>
                                        <th><b lang="en">Ticket Type</b></th>
                                        <th><b lang="en">Action</b></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <div class="row mgb-1">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="clight" lang="en">Select Event</small>
                                        <select class="form-control input-abu list-event" name="tiket_event_filter" id="tiket_event_filter" required></select>
                                    </div>
                                </div>
                                <div class="col-md kananin">
                                    <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                        data-target="#modal_create_ticket" lang="en">Create Ticket</button>
                                </div>
                            </div>

                            <table id="tabel_ticket_event" class="table table-hover table-striped dt-responsive nowrap hidendulu" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b lang="en">ID Ticket</b></th>
                                        <th><b lang="en">Title</b></th>
                                        <th><b lang="en">Description</b></th>
                                        <th><b lang="en">Type Ticket</b></th>
                                        <th><b lang="en">Price</b></th>
                                        <th><b lang="en">Total</b></th>
                                        <th><b lang="en">Date</b></th>
                                        <th><b lang="en">Remaining</b></th>
                                        <th><b lang="en">Action</b></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
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
                                <small class="clight" lang="en">Lokasi</small>
                                <p>Malang</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Venue</small>
                                <p>halo1p</p>
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
                                <small class="clight" lang="en">Lokasi</small>
                                <p>Malang</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Venue</small>
                                <p>halo1p</p>
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






<!-- MODAL CREATE TICKET -->
<div class="modal fade" id="modal_create_ticket" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%; max-width: 850px;">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_create_ticket" action="{{route('post.admin.create-ticket')}}">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Add Ticket</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;overflow-y: scroll; height:470px;">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <small class="clight" lang="en">Title Ticket</small>
                                <input type="text" id="tiket_judul" name="tiket_judul" class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight" lang="en">Select Event</small>
                                <select class="form-control input-abu list-event" name="tiket_event0" id="tiket_event0"
                                    required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <small class="clight" lang="en">Description Ticket</small>
                                <input type="text" id="tiket_dekripsi" name="tiket_dekripsi"
                                    class="form-control input-abu" required>
                            </div>
                            <div class="form-group">
                                <small class="clight" lang="en">Start Date</small>
                                <input type="date" id="tiket_mulaidate" name="tiket_mulaidate"
                                    class="form-control input-abu" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <small class="clight" lang="en">Type Ticket</small>
                                <select class="form-control input-abu" name="tiket_type" id="tiket_type" required>
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="0" lang="en">Free</option>
                                    <option value="1" lang="en">Paid</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <small class="clight" lang="en">End Date</small>
                                <input type="date" id="tiket_akhirdate" name="tiket_akhirdate"
                                    class="form-control input-abu" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <small class="clight" lang="en">Price</small>
                                <input type="text" id="tiket_harga" name="tiket_harga" class="form-control input-abu"
                                    required>
                            </div>
                            <div class="form-group">
                                <small class="clight" lang="en">Total Stock</small>
                                <input type="text" id="tiket_total" name="tiket_total" class="form-control input-abu"
                                    required>
                            </div>
                        </div>
                    </div>



                    <div id="isi_newrow_ticket"></div>
                    <center>
                        <button type="button" class="btn btn-icon-text" id="addnewrow_ticket">
                            <i class="mdi mdi-plus-circle" style="color: #50C9C3;"></i>
                            <small lang="en">Add New Row</small> </button>
                    </center>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Add Ticket</span> </button>
                </div>
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>

@endsection
