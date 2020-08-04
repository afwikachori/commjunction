@extends('layout.admin-dashboard')

@section('content')
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Ticket Module</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your ticket information<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">

        </nav>
    </div>
</div>

<br>

<div id="page_ticket_module_admin"></div>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 485px;">
            <div class="card-header putih">

                <div class="row mgb-1">
                    <div class="col-md-6">
                        <small class="cgrey2">ID Event </small>
                        <input type="text" id="event_id_tiket" value="{{ $id_event }}" readonly>
                    </div>
                    <div class="col-md-6 kananin">
                        <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                            data-target="#modal_create_ticket" lang="en">Create Ticket</button>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <table id="tabel_ticket_event" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
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
                                <small class="clight" lang="en">This Event</small>
                                    <input type="text" id="tiket_event0" name="tiket_event0" value="{{ $id_event }}"
                                     class="form-control input-abu" readonly>
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
                        <input type="text" id="id_tickets" name="id_tickets">
                        <input type="text" id="id_eventtiket" name="id_eventtiket">
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
