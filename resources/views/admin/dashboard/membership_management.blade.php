@extends('layout.admin-dashboard')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Membership Management</h3>

              <nav aria-label="breadcrumb">
                <button type="button" id="btn-filter-date" class="btn btn-tosca btn-sm">Add Membership</button>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">


        <div class="tabbable-line">
          <ul class="nav nav-tabs ">
            <li class="tab-subs active" id="tab_all">
              <a href="#tab_default_1" data-toggle="tab">
                List Membership
              </a>
            </li>
            <li class="tab-subs" id="tab_pending">
              <a href="#tab_default_2" data-toggle="tab">
                Membership Request
              </a>
            </li>
          </ul>

  <div class="tab-content">
    <div class="tab-pane active" id="tab_default_1">
<!-- isi tab 1  -->
    </div>


    <div class="tab-pane" id="tab_default_2">
  <!-- isi tab 2 -->
    </div>
  </div> <!-- end-content -->
  </div> <!-- end-tab line -->
</div>
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