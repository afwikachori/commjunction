@extends('layout.subscriber')
@section('title', 'Event Module')

@section('content')
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Module Event</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your event activity<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">

        </nav>
    </div>
</div>

<br>

<div id="page_event_module_subs"></div>

<div class="row">
    <div id="nodata_card_event" class="col-md-12" style="margin-right: auto; margin-left: auto; height: 300px;">
        <center>
            <br><br><br><br><br>
            <h1 class="clight" lang="en">No Data Available</h1>
        </center>
    </div>
    <div id="isi_card_event" class="card-deck" style="width: 100%;">

    </div>
</div>


<!-- MODAL LIST TICKET-->
<div class="modal fade" id="modal_ticket_event_subs" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%; max-width: 1000px;">
        <div class="modal-content" style="background-color: #ffffff;">

            <div class="modal-header">
                <h4 class="cgrey">List Ticket Event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form>
            <div class="modal-body">
                <input type="hidden" id="id_event_tiket" name="id_event_tiket" readonly>
<br>
                <table id="tabel_ticket_event" class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th><b lang="en">ID Ticket</b></th>
                            <th><b lang="en">Title</b></th>
                            <th><b lang="en">Description</b></th>
                            <th><b lang="en">Type Ticket</b></th>
                            <th><b lang="en">Price</b></th>
                            <th><b lang="en">Date</b></th>
                            <th><b lang="en">Action</b></th>
                        </tr>
                    </thead>
                </table>
            </div> <!-- end-body -->
            </form>
        </div>
    </div>
</div>



<!-- MODAL PAYMENT MODULE -->
<div id="modal_pay_initial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_pay_initial"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 65%; margin: auto;">
            <form method="POST" id="form_initial_tiket" action="{{route('post.subs.buy-ticket')}}">
                {{ csrf_field() }}

                <div class="modal-body" style="min-height: 355px; height: auto; padding-left: 5%; padding-right: 5%;">
                    <h3 class="cgrey" style="margin-bottom: 1.5em; margin-top:1em;" lang="en">Choose Payment Method</h3>
                    <div class="row" style="margin-bottom: 0.5em;">
                        <div class="col-md-12">
                            <h5 class="h5 clight" lang="en">Ticket Price</h5>
                            <small class="cgrey2">Rp &nbsp;</small>
                            <span class="h6 cblue" id="harga_tiket"></span>&nbsp;
                            <small class="cgrey2"> ,-</small>
                        </div>
                    </div>

                    <input type="hidden" id="id_event_buy" name="id_event_buy" readonly>
                    <input type="hidden" id="id_tiket_buy" name="id_tiket_buy" readonly>

                    <br>
                    <div class="row">
                        <div class="col-md-7">
                            <h6 class="h6 clight" lang="en">Choose Payment Method</h6>
                            <div class="row" style="padding-left: 5%; margin-top: -0.3em;">
                                <div class="isi_method_pay">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="isi_show_bank" class="collapse-accordion" role="tablist"
                                aria-multiselectable="true">

                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id_pay_initial" id="id_pay_initial" readonly>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" lang="en">Close</button>
                    <button type="submit" class="btn btn-teal btn-sm" id="btn_submit_paymethod"
                        lang="en">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
