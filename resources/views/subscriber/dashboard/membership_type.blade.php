@extends('layout.subscriber')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-wallet-membership"></i>
                </span> Membership Type</h3>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Subscriber</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Membership</li>
                </ol>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Membership Type Subscriber</h4>
    
    </div>
  </div>
</div>
</div>


<!-- Modal membership-1-->
<div class="modal fade" id="mdl_membership1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <center>
      <img src="/visual/hore.png" id="img-initial1">
      <h3 class="cgrey" style="margin-bottom: 0.5em;">Community Membership</h3>
      <p class="clight s14">Berfungsi untuk melakukan setup terkait membership subscriber yang menggunakan aplikasi Community setelah membership berubah dari Free menjadi Paid</p>

      <button type="button" id="btn_membership1" class="btn btn-primary btn-sm">Next</button>
      </center>
      </div> <!-- end-modal body -->
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">

$(document).ready(function () {
 $("#mdl_membership1").modal('show');
});

$("#btn_membership1").click(function() {
  $("#mdl_membership1").modal('hide');
});

</script>



@endsection