<br>
<small class="clight1 s14" lang="en">Set up your Membership Model</small>
<div class="row" style="margin-top: 1em;">
    <div class="col-12">
        <div class="card">
            <form method="POST" id="form_setting_membership" action="{{route('setting_membership_comm')}}">
                {{ csrf_field() }}
                <div class="card-body" style="height: auto; min-height: 250px;">
                    <div class="row">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Setting Membership Type</h6>
                            <small class="clight" lang="en">Set membership type for your subscriber</small>
                        </div>
                        <div class="col-md-5">
                            <select class="form-control input-abu" name="membership" id="membership">
                                <option selected disabled lang="en">Choose</option>
                                <option value="1" lang="en">Free Membership</option>
                                <option value="2" lang="en">Paid Membership</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="submit" id="btn_submit_memberset" class="btn btn-teal btn-sm melengkung10px"
                        style="display: none; margin-right: 1em;">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Submit</span> </button>
                </div> <!-- end-footer     -->
            </form>
        </div>
    </div>
</div>


