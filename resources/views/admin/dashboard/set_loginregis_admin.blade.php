@extends('layout.admin-dashboard')
@section('title', 'Community Setting')
@section('content')
<div class="row">
    <div class="col-md-3">
        <h3 class="page-title s22 cgrey" style="font-weight: bold;" lang="en">Community Setting</h3>
    </div>
    <div class="col-md-9">
        <label class="cgrey" lang="en">Publish Community to Live<label>
    </div>
</div>

<div class="row" style="padding-left: 18%; padding-right: 18%; padding-bottom: 0; margin-top: 1em;">
    <div class="col-12">
        <h4 class="cgrey" style="font-weight: bold; margin-top: 1em;margin-bottom: 1em;" lang="en">Setting Login & Registrasion</h4>
        <div class="card">
               <form method="POST" id="form_setting_loginregis" action="{{route('setting_loginresgis_comm')}}"
                enctype="multipart/form-data">{{ csrf_field() }}

                    <div class="card-body">

                        <div class="row" style="margin-bottom: 1em;">
                            <div class="col-md-7">
                                <h6 class="cgrey2 judulcomsetup" lang="en">Subscriber Login</h6>
                                <small class="clight" lang="en">Choose form type for subscriber login</small>
                            </div>
                            <div class="col-md-5">
                                <select class="form-control input-abu" name="form_tipe" id="form_tipe">
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="1" lang="en">Username & Password</option>
                                    <option value="2" lang="en">Phone Number & Password</option>
                                    <option value="3" lang="en">Email & Password</option>
                                </select>
                                 <input type="text" id="showtipeform" class="form-control input-abu"
                                 style="display: none;" disabled>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 1em;">
                            <div class="col-md-7">
                                <h6 class="cgrey2 judulcomsetup" lang="en">Headline Text</h6>
                                <small class="clight" lang="en">Headline text will be show on subscriber login portal</small>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="headline" id="headline" class="form-control input-abu">
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 1em;">
                            <div class="col-md-7">
                                <h6 class="cgrey2 judulcomsetup" lang="en">Description Text Login</h6>
                                <small class="clight" lang="en">Descripe anything and will appeare on subscriber login</small>
                            </div>
                            <div class="col-md-5">
                                <textarea class="form-control input-abu" id="description_custom"
                                    name="description_custom" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 1em;">
                            <div class="col-md-7">
                                <h6 class="cgrey2 judulcomsetup" lang="en">Image Login Portal</h6>
                                <small class="clight" lang="en">This image will be the icon for subscriber login portal</small>
                            </div>
                            <div class="col-md-5">
                                <img src="/img/kosong.png" class="img_portal rounded-circle img-fluid zoom" id="img_portal_admin"
                                style="display: none; width: 50px; height:50px;"
                                onclick="clickImage(this)"
                                data-toggle="tooltip" data-placement="right" title="Double Click to View Image"
                                onerror="this.onerror=null;this.src='/img/kosong.png';">
                                <div class="form-group" id="up_img_portal">
                                <input type="file" id="fileup" name="fileup" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image" style="border-radius: 10px 0px 0px 10px; background-color: #efefef;">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-light" type="button"
                                        style="padding: 0.5rem 1rem !important; border-radius: 0px 10px 10px 0px;">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                    </span>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 1em;">
                            <div class="col-md-7">
                                <h6 class="cgrey2 judulcomsetup" lang="en">Custom Domain</h6>
                                <small class="ctosca"><i lang="en">yourdomain</i>
                                    <b class="clight">@smartcomm.id</b></small>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="subdomain" id="subdomain" class="form-control input-abu">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border: none; text-align: right; padding: 5%; padding-top: 0;">
                        <button type="button" onclick="location.href ='/admin/settings'" class="btn btn-light btn-sm"
                            data-dismiss="modal" style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> <span lang="en">Back</span>
                        </button>
                        &nbsp;
                        <button type="submit" id="btn_commset_login" class="btn btn-teal btn-sm melengkung10px">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> <span lang="en">Submit</span> </button>
                    </div> <!-- end-footer     -->
            </form>
        </div>
    </div>
</div>



@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {
        get_result_setup_comsetting();
    });



</script>

@endsection
