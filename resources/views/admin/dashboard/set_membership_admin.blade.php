@extends('layout.admin-dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <h3 class="page-title s22 cgrey" style="font-weight: bold;">Community Setting</h3>
    </div>
    <div class="col-md-9">
        <label class="cgrey">Publish Community to Live<label>
    </div>
</div>

<div class="row" style="padding-left: 25%; padding-right: 25%; margin-top: 1em;">
    <div class="col-12">
        <h4 class="cgrey" style="font-weight: bold; margin-top: 1em;margin-bottom: 1em;"> Membership Type</h4>
        <div class="card">
            <form method="POST" id="form_setting_membership" action="{{route('setting_membership_comm')}}">
                {{ csrf_field() }}
                <div class="card-body" style="height: auto; min-height: 250px;">
                        <div class="row" style="margin-top: 2em;">
                            <div class="col-md-7">
                                <h6 class="cgrey2 judulcomsetup">
                                    Setting Membership Type</h6>
                                <small class="clight">Set membership type for your subscriber </small>
                            </div>
                            <div class="col-md-5">
                                <select class="form-control input-abu" name="membership" id="membership">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Free Membership </option>
                                    <option value="2"> Paid Membership </option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" onclick="location.href ='/admin/settings'" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Back
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_send_notif_super" class="btn btn-teal btn-sm melengkung10px">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Submit </button>
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
    });



</script>

@endsection
