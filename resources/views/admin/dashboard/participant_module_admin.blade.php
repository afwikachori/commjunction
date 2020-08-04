@extends('layout.admin-dashboard')

@section('content')
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Participant List</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your participant information<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">

        </nav>
    </div>
</div>

<br>

<div id="page_participant_event"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 485px;">
            <div class="card-header putih">

                <div class="row mgb-1">
                    <div class="col-md-6">
                        <small class="cgrey2">ID Event </small>
                        <input type="text" id="event_id_par" value="{{ $id_event }}" readonly>
                    </div>
                    <div class="col-md-6 kananin">

                    </div>
                </div>

            </div>

            <div class="card-body">
                <table id="tabel_participant_event" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th><b lang="en">ID</b></th>
                            <th><b lang="en">ID Subscriber</b></th>
                            <th><b lang="en">Profile</b></th>
                            <th><b lang="en">Fullname</b></th>
                            <th><b lang="en">Title Ticket</b></th>
                            <th><b lang="en">Ticket Price</b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
