@extends('layout.admin-dashboard')
@section('title', 'Community Setting')
@section('content')
<div class="row">
    <div class="col-md-3">
        <h3 class="page-title s22 cgrey" style="font-weight: bold;" lang="en">Community Setting</h3>
    </div>
    <div class="col-md-5">
        <label class="cgrey" lang="en" style="margin-top: 0.5em;">Set up your community preparation<label>
    </div>
    <div class="col-md-4" style="text-align: right; margin-top: 0.5em;">
        <label class="cgrey2 s14" lang="en">Community Status</label> &nbsp; &nbsp;
        <span class="badge statuscomm bg-ijo melengkung6px" style="width: 80px;">Status</span>
    </div>
</div>
<br>

<div style="padding-left: 20%; padding-right: 20%;">
    <div class="divbutton">
        <button type="button" onclick="location.href ='/admin/editprofil'"
         class="btn btn-tosca btn-sm" style="width: 120px;" lang="en">Edit</button>
        &nbsp;
        <button type="button" onclick="location.href ='/admin/publish'"
        class="btn btn-tosca btn-sm" style="width: 120px;" lang="en">Publish</button>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="cgrey s20" lang="en">About Community</h3>
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
                                <p class="cgrey1 judul_komunitas">-</p>
                            </div>
                            <div class="form-group">
                                <small class="clight mgb-05" lang="en">Address</small>
                                <p class="cgrey1 alamat_admin_komunitas">-</p>
                            </div>
                        </div> <!-- end col-md -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <small class="clight mgb-05" lang="en">Community Type</small>
                                <p class="cgrey1 jenis_komunitas_adminloged">-</p>
                            </div>
                            <div class="form-group">
                                <small class="clight mgb-05" lang="en">Date Created</small>
                                <p class="cgrey1 tanggalregis_komunitas">-</p>
                            </div>
                        </div><!-- end col-md -->
                    </div> <!-- end-row -->

                    <div class="row" style="margin-top: -1%;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight mgb-05" lang="en">Community Description</small>
                                <p class="cgrey1 deskripsi_komunitas">-</p>
                            </div>
                        </div>
                    </div>



                    <div id="community_setting_link" style="margin-top: 2em; padding-left: 10%;">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-8"></div>
                                <h6 class="cdgrey judulcomsetup" lang="en">Login & Registrasion</h6>
                                <small class="clight" lang="en">Setting description & information</small>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 0.5em;">
                                <button type="button" onclick="location.href ='/admin/settings/loginregis'"
                                    class="btn btn-tosca btn-sm btncomset"><small lang="en">Go Setting</small></button>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="cdgrey judulcomsetup" lang="en">Membership Type</h6>
                                <small class="clight" lang="en">Setting description & information</small>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 0.5em;">
                                <button type="button" onclick="location.href ='/admin/settings/membership'"
                                    class="btn btn-tosca btn-sm btncomset"><small lang="en">Go Setting</small></button>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="cdgrey judulcomsetup" lang="en">Registrasion Data</h6>
                                <small class="clight" lang="en">Setting description & information</small>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 0.5em;">
                                <button type="button" onclick="location.href ='/admin/settings/registrasion_data'"
                                    class="btn btn-tosca btn-sm btncomset"><small lang="en">Go Setting</small></button>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="cdgrey judulcomsetup" lang="en">Subscriber Payment</h6>
                                <small class="clight" lang="en">Setting description & information</small>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 0.5em;">
                                <button type="button" onclick="location.href ='/admin/settings/payment'"
                                    class="btn btn-tosca btn-sm btncomset"><small lang="en">Go Setting</small></button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div> <!-- end-col-12 -->
        </div>
    </div>


</div>


@endsection

@section('script')
<script type="text/javascript">

    $(document).ready(function () {
        setTimeout(function () {
            ui.popup.hideLoader();
        }, 8000);
   $(".sidebar .nav .nav-item").removeClass("active");
get_result_setup_comsetting();
    });


</script>

@endsection
