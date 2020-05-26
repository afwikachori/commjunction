@extends('layout.admin-dashboard')
@section('title', 'Subscriber Management')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Subscriber Management</h3>
    </div>
    <div class="col-md-5">
        <label class="cgrey" lang="en">Manage your Subscriber<label>
    </div>
</div>
<br>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

            <div id="page_subs_management"></div>

                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_all">
                            <a href="#tab_default_1" data-toggle="tab">
                                <span lang="en">All</span>
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_pending">
                            <a href="#tab_default_2" data-toggle="tab">
                                <span lang="en">Pending</span>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="button" id="btn-filter-subs" class="btn btn-tosca btn-sm"
                                        style="min-width: 120px; margin-bottom: 1em;" lang="en">Filter</button>
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <button type="button" id="reset_tbl_subsall"
                                        class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                            </div>



                            <!-- tabel all susbcriber -->
                            <table id="tabel_subscriber" class="table table-hover table-striped dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b lang="en">ID Subscriber</b></th>
                                        <th><b lang="en">Membership</b></th>
                                        <th><b lang="en">Subcriber Name</b></th>
                                        <th><b lang="en">Status</b></th>
                                        <th><b lang="en">Last Login</b></th>
                                        <th><b lang="en">Action</b></th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <!-- tabel all susbcriber -->
                            <table id="tabel_subs_pending" class="table table-hover table-striped dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b lang="en">ID Subscriber</b></th>
                                        <th><b lang="en">Membership</b></th>
                                        <th><b lang="en">Subcriber Name</b></th>
                                        <th><b lang="en">Status</b></th>
                                        <th><b lang="en">Created Date</b></th>
                                        <th><b lang="en">Action</b></th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- MODAL FILTER DATE -->
<div class="modal fade" id="modal_filter_date_subs" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content filtersubs" style="background-color: #ffffff;">

            <div class="modal-header" style="border: none;">
                <center>
                    <h4 class="modal-title cgrey" lang="en">Filter Data</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <nav>
                <div class="nav nav-tabs filter nav-fill" id="nav-tab" role="tablist">

                    <a class="nav-item cus-a nav-link s12 active" id="nav-datefilter-tab" data-toggle="tab"
                        href="#nav-datefilter" role="tab" aria-controls="nav-datefilter" aria-selected="true"
                        lang="en">Filter Date</a>

                    <a class="nav-item cus-a nav-link s12" id="nav-membershipfilter-tab" data-toggle="tab"
                        href="#nav-membershipfilter" role="tab" aria-controls="nav-membershipfilter"
                        aria-selected="false" lang="en">Membership</a>

                </div>
            </nav>

            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-datefilter" role="tabpanel"
                    aria-labelledby="nav-datefilter-tab">
                    <form>
                        <fieldset id="form_date_filter">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="start_date" lang="en">Start Date</label>
                                    <input type="date" id="subs_datemulai" name="subs_datemulai"
                                        class="form-control input-abu">
                                </div>

                                <div class="form-group">
                                    <label for="start_date" lang="en">End Date</label>
                                    <input type="date" id="subs_dateselesai" name="subs_dateselesai"
                                        class="form-control input-abu">
                                </div>
                            </div>

                            <div class="modal-footer" style="border: none;">
                                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                                    <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                                </button>
                                &nbsp;
                                <button type="button" id="btn_filter_date" class="btn btn-tosca btn-sm">
                                    <i class="mdi mdi-check btn-icon-prepend">
                                    </i><span lang="en">Submit</span></button>
                            </div>
                        </fieldset>
                    </form>
                </div>


                <div class="tab-pane fade" id="nav-membershipfilter" role="tabpanel"
                    aria-labelledby="nav-membershipfilter-tab">
                    <form>
                        <fieldset id="form_member_filter">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="membership_tipe" lang="en">Membership Type</label>
                                    <select class="form-control input-abu" id="membership_tipe">
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer" style="border: none; margin-top: 90px;">
                                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                                    <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                                </button>
                                &nbsp;
                                <button type="button" id="btn_filter_membership" class="btn btn-tosca btn-sm">
                                    <i class="mdi mdi-check btn-icon-prepend">
                                    </i><span lang="en">Submit</span></button>
                            </div>
                        </fieldset>
                    </form>
                </div>

            </div>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>

@endsection
