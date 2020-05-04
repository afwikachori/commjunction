@extends('layout.admin-dashboard')
@section('title', 'Community Setting')
@section('content')
<div class="row">
    <div class="col-md-3">
        <h3 class="page-title s22 cgrey" style="font-weight: bold;" lang="en">Community Setting</h3>
    </div>
    <div class="col-md-5">
        <label class="cgrey" lang="en" style="margin-top: 0.5em;">Set Up Your Community<label>
    </div>
    <div class="col-md-4" style="text-align: right; margin-top: 0.5em;">
        <label class="cgrey2 s14" lang="en">Community Status</label> &nbsp; &nbsp;
        <span class="badge statuscomm melengkung6px" style="width: 80px;">Status</span>
    </div>
</div>
<br>

<div style="padding-left: 15%; padding-right: 15%;">
    <div class="divbutton">
        <button type="button" onclick="location.href ='/admin/editprofil'" class="btn btn-tosca btn-sm" style="width: 120px;"
            lang="en">Edit Info</button>
            &nbsp;
        <button id="btn_ke_commset_publish" type="button" onclick="location.href ='/admin/publish'" class="btn btn-birumuda btn-sm"
            style="width: 120px; display: none" lang="en">Publish</button>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-8">
                            <h3 class="cgrey s20" lang="en">About Community</h3>
                        </div>
                        <div class="col-md-4" style="text-align: right;">

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <small class="clight mgb-1" lang="en">Community Icon</small><br>
                                <img src="/img/default.png" class="rounded-circle img-fluid logo_komunitas"
                                    id="profil_admin_dash" onerror="this.onerror=null;this.src='/img/default.png';">
                            </div>

                        </div> <!-- end-col-md -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <small class="clight mgb-05" lang="en">Community Name</small>
                                <p class="cgrey2 judul_komunitas">-</p>
                            </div>
                            <div class="form-group">
                                <small class="clight mgb-05" lang="en">Address</small>
                                <p class="cgrey2 alamat_admin_komunitas">-</p>
                            </div>
                        </div> <!-- end col-md -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <small class="clight mgb-05" lang="en">Community Type</small>
                                <p class="cgrey2 jenis_komunitas_adminloged">-</p>
                            </div>
                            <div class="form-group">
                                <small class="clight mgb-05" lang="en">Registration Date</small>
                                <p class="cgrey2 tanggalregis_komunitas">-</p>
                            </div>
                        </div><!-- end col-md -->
                    </div> <!-- end-row -->

                    <div class="row" style="margin-top: -1%;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight mgb-05" lang="en">Community Description</small>
                                <p class="cgrey2 deskripsi_komunitas">-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end-col-12 -->
        </div>
    </div>

    <div class="row" style="margin-top: 1.5em;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="cgrey s20" lang="en"  style="margin-bottom: 1em;">Community Setting</h3>

                    <div class="tabbable-line comset">
                        <ul class="nav nav-tabs comset">
                            <li class="tab_comset active">
                                <a href="#tab_default_1" data-toggle="tab">
                                    <span lang="en">Login & Registrasion</span>
                                </a>
                            </li>
                            <li class="tab_comset">
                                <a href="#tab_default_2" data-toggle="tab">
                                    <span lang="en">Membership Type</span>
                                </a>
                            </li>
                            <li class="tab_comset">
                                <a href="#tab_default_3" data-toggle="tab">
                                    <span lang="en">Registrasion Data</span>
                                </a>
                            </li>
                            <li class="tab_comset">
                                <a href="#tab_default_4" data-toggle="tab">
                                    <span lang="en">Subscriber Payment</span>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_default_1">
                                @include('admin.dashboard.set_loginregis_admin')
                            </div>

                            <div class="tab-pane" id="tab_default_2">
                                @include('admin.dashboard.set_membership_admin')
                            </div>

                            <div class="tab-pane" id="tab_default_3">
                                @include('admin.dashboard.set_regisdata_admin')
                            </div>

                            <div class="tab-pane" id="tab_default_4">
                                @include('admin.dashboard.set_payment_admin')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
</div>

@endsection
