@extends('layout.admin-dashboard')
@section('title', 'News Management')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Venue Module Management</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your veneue and community activity<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                data-target="#modal_create_venue_admin" lang="en">Create Venue</button>
        </nav>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h1 class="clight">Module Venue</h1>


            </div>
        </div>
    </div>
</div>


<!-- MODAL CREATE EVENT -->
<div class="modal fade" id="modal_create_venue_admin" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_create_event" action="{{route('post.admin.create-venue')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Add Venue</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <small class="clight" lang="en">Action</small>
                                <input type="text" id="action" name="action"
                                    placeholder="ADD/EDIT" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <small class="clight" lang="en">ID Venue</small>
                                <input type="text" id="id_venue" name="id_venue" class="form-control input-abu">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Title Venue</small>
                                <input type="text" id="venue_judul" name="venue_judul" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Lokasi Venue</small>
                                <input type="text" id="venue_lokasi" name="venue_lokasi" value="-7.3688655, 112.7264173"
                                    placeholder="-7.3688655, 112.7264173" class="form-control input-abu">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Capacity Venue</small>
                                <input type="text" id="venue_kapasitas" name="venue_kapasitas" value="100"
                                    placeholder="100" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Thumbnail Venue</small>
                                <input type="file" id="venue_thumbnail" name="venue_thumbnail" accept="image/*"
                                    class="form-control input-abu">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Open Time</small>
                                <input type="time" id="open_time" name="open_time" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Close Time</small>
                                <input type="time" id="close_time" name="close_time" class="form-control input-abu">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Venue Facilities</small>
                                <input type="text" id="venue_fasilitas" name="venue_fasilitas"
                                value="Pool,Hall,Parking Area,Dining,Masjid,Toilet"
                                placeholder="Pool, Hall, Parking Area, Dining, Masjid, Toilet"
                                 class="form-control input-abu">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Photo Venue</small>
                                <input type="file" id="photo_venue" name="photo_venue[]" accept="image/*" multiple
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
                        </i> <span lang="en">Add Venue</span> </button>
                </div>
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



@endsection
