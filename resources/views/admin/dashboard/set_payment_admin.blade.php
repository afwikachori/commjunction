<div class="row">
    <div class="col-md-8" style="margin-top: 0.5em;">
        <small class="clight1 s14" lang="en">Set your Subscriber Payment Options</small>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <button type="button" id="btn_add_payment" class="btn btn-tosca btn-sm" style="margin-top: 0.5em;"
            data-toggle="modal" data-target="#modal_add_payment" data-dismiss="modal" lang="en">Add
            Payment</button>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <!-- tabel all susbcriber -->
        <table id="tabel_paysubs" class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th><b class="cgrey2" lang="en">ID Pay</b></th>
                    <th><b class="cgrey2" lang="en">Payment Title</b></th>
                    <th><b class="cgrey2" lang="en">Account Name</b></th>
                    <th><b class="cgrey2" lang="en">Bank Name</b></th>
                    <th><b class="cgrey2" lang="en">Status</b></th>
                    <th><b class="cgrey2" lang="en">Action</b></th>
                </tr>
            </thead>
        </table>
        <!-- end tabel all  -->
    </div>
</div>
</div>


<!-- MODAL ADD PAYMENT-->
<div class="modal fade" id="modal_add_payment" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <div class="modal-header" style="border: none;">
                <center>
                    <h4 class="modal-title cgrey" lang="en">Add Payment Type</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="form_add_payment_subs" action="{{route('add_payment_subs')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label lang="en">Payment Name</label>
                                <input type="text" id="payment_name" name="payment_name" class="form-control input-abu">
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label lang="en">Payment Type</label>
                                <select class="form-control input-abu" id="payment_tipe" name="payment_tipe">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label lang="en">Payment Status</label>
                                <select class="form-control input-abu" id="payment_status" name="payment_status"
                                    value="{{old('payment_status')}}">
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="1" lang="en">Active</option>
                                    <option value="0" lang="en">Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label lang="en">Account Holder Name</label>
                                <input type="text" id="rekening_name" name="rekening_name"
                                    class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label lang="en">Rekening Number</label>
                                <input type="text" id="rekening_number" name="rekening_number"
                                    class="form-control input-abu">
                            </div>
                        </div>

                        <!-- <div class="col-md-12 form-group">
                            <small lang="en">Description</small>
                            <textarea class="form-control input-abu" id="deskripsi_paysubs" name="deskripsi_paysubs"
                                rows="2"></textarea>
                        </div> -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label lang="en">Bank Name</label>
                                <select class="form-control input-abu" id="bank_name" name="bank_name">
                                    <option disabled selected lang="en">Choose Payment Type First</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label lang="en">Payment Time Limit</label>
                                <select class="form-control input-abu" id="pay_time_limit" name="pay_time_limit"
                                    value="{{old('pay_time_limit')}}">
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="1" lang="en">1 Day</option>
                                    <option value="2" lang="en">2 Days</option>
                                    <option value="3" lang="en">3 Days</option>
                                    <option value="4" lang="en">4 Days</option>
                                    <option value="5" lang="en">5 Days</option>
                                    <option value="6" lang="en">6 Days</option>
                                    <option value="7" lang="en">7 Days</option>
                                </select>
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
                    <button type="submit" id="btn_add_paysubs" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Add</span> </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>

<!-- MODAL DETAIL PAYMENT SUBS  -->
<div class="modal fade" id="modal_detail_paymentsubs" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal" style="background-color: #ffffff;">

            <div class="modal-header" style="border-bottom: none;">
                <h4 class="modal-title cgrey" lang="en">Detail Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="height: auto; min-height: 300px; padding-left: 5%; padding-right: 5%;">
                <div class="row">
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Payment Name</small>
                            <p class="cgrey2" id="detail_nama_pay"></p>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Payment Type</small>
                            <p class="cgrey2" id="detail_tipe_pay"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Payment Status</small>
                            <p class="cgrey2" id="detail_status"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Account Holder Name</small>
                            <p class="cgrey2" id="detail_owner"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Rekening Number</small>
                            <p class="cgrey2" id="detail_no_rekening"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <small class="clight" lang="en">Description</small>
                        <p class="cgrey2" id="detail_deskripsi"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Bank Name</small>
                            <p class="cgrey2" id="detail_bank"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight" lang="en">Payment Time Limit</small>
                            <p class="cgrey2" id="detail_timelimit"></p>
                        </div>
                    </div>
                </div>
            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none; margin-top: -1em; margin-bottom: 0.5em;">
                <form method="POST" id="form_delete_paysubs" action="{{route('delete_payment_subs')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_paymentsubs" id="id_paymentsubs">
                    <button type="submit" class="btn bg-merah melengkung10px btn-sm"
                        style="text-align: right; width: 100px;">
                        <i class="mdi mdi-delete btn-icon-prepend">
                        </i> <span lang="en">Delete</span> </button>
                </form>
                &nbsp;
                <button class="btn btn-tosca btn-sm" style="width: 100px;" data-toggle="modal"
                    data-target="#modal_edit_payment" data-dismiss="modal">
                    <i class="mdi mdi-lead-pencil">
                    </i> <span lang="en">Edit</span></button>
            </div> <!-- end-footer     -->
        </div>
    </div>
</div>

<!-- MODAL EDIT PAYMENT-->
<div class="modal fade" id="modal_edit_payment" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <div class="modal-header" style="border: none;">
                <center>
                    <h4 class="modal-title cgrey" lang="en">Edit Payment Type</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="form_edit_payment_subs" action="{{route('edit_payment_subs')}}">
                {{ csrf_field() }}
                <input type="hidden" class="form-control input-abu" id="id_subs_payment" name="id_subs_payment">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label lang="en">Account Holder Name</label>
                                <input type="text" id="edit_rekening_name" name="edit_rekening_name"
                                    class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label lang="en">Rekening Number</label>
                                <input type="text" id="edit_rekening_number" name="edit_rekening_number"
                                    class="form-control input-abu">
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
                    <button type="submit" id="btn_edit_paysubs" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Edit</span> </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>

@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {

    });




</script>

@endsection
