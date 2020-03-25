@extends('layout.subscriber')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Dashboard</h3>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Subscriber</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </nav>
            </div>

<div class="row">

            <div class="col-md-3 stretch-card grid-margin">
              <div class="card sumari">
                <div class="card-body sumari">
                  <div class="row">
                    <div class="col-9">
                    <small class="clight">Total Feature</small>
                    <h4 class="cgrey-mid">6 Module</h4>
                    </div>
                    <div class="col">
                      <i class="mdi mdi-package-variant mdi-24px float-right top-ico cteal"></i>
                    </div>
               </div>
                </div>
              </div>
            </div>

            <div class="col-md-3 stretch-card grid-margin">

              <div class="card sumari">
                <div class="card-body sumari">
                  <div class="row">
                    <div class="col-9">
                    <small class="clight">Total Friends</small>
                    <h4 class="cgrey-mid">8 Person</h4>
                    </div>
                    <div class="col">
                      <i class="mdi mdi-human-handsup mdi-24px float-right top-ico cteal"></i>
                    </div>
               </div>
                </div>
              </div>
            </div>

            <div class="col-md-3 stretch-card grid-margin">
              <div class="card sumari">
                <div class="card-body sumari">
                  <div class="row">
                    <div class="col-9">
                    <small class="clight">Total Transaksi</small>
                    <h4 class="cgrey-mid">2 Transaksi</h4>
                    </div>
                    <div class="col">
                      <i class="mdi mdi-shopping mdi-24px float-right top-ico cteal"></i>
                    </div>
               </div>
                </div>
              </div>
            </div>

            <div class="col-md-3 stretch-card grid-margin">
              <div class="card sumari">
                <div class="card-body sumari">
                  <div class="row">
                    <div class="col-9">
                    <small class="clight">Total Event</small>
                    <h4 class="cgrey-mid">11 Activity</h4>
                    </div>
                    <div class="col">
                      <i class="mdi mdi-theater mdi-24px float-right top-ico cteal"></i>
                    </div>
               </div>
                </div>
              </div>
            </div>
          </div>

  <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Weekly Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">$ 15,0000</h2>
                    <h6 class="card-text">Increased by 60%</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Weekly Orders <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">45,6334</h2>
                    <h6 class="card-text">Decreased by 10%</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">95,5741</h2>
                    <h6 class="card-text">Increased by 5%</h6>
                  </div>
                </div>
              </div>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Dashboard Subscriber</h4>

    </div>
  </div>
</div>
</div>


<!-- Modal INITIAL-1-->
<div class="modal fade" id="initial1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <center>
      <img src="/visual/hore.png" id="img-initial1">
      <h3 class="cgrey" style="margin-bottom: 0.5em;">Congratulations !!!</h3>
      <p class="clight s14">Congratulations ! You’re already succesfull register and you’re already member of community . Let’s look what do you can explore !</p>

      <button type="button" id="btn-initial1" class="btn btn-primary btn-sm">Take a tour</button>
      </center>
      </div> <!-- end-modal body -->
    </div>
  </div>
</div>


<!-- Modal INITIAL-2-->
<div class="modal fade" id="initial2" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <center>
      <img src="/visual/init-fitur.png" id="img-initial2">
      <h4 class="cgrey" style="margin-bottom: 1em;">Features Overiew</h4>
     </center>

  <div class="row">
    <div class="col-6 mgku-1">
      <div class="media">
      <img src="/img/default.png" class="align-self-center mr-3 rounded-circle" style="width: 10%; height: auto;">
      <div class="media-body">
        <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
        <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</small>
      </div>
    </div>
    </div>
    <div class="col-6 mgku-1">
      <div class="media">
      <img src="/img/default.png" class="align-self-center mr-3 rounded-circle" style="width: 10%; height: auto;">
      <div class="media-body">
        <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
        <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</small>
      </div>
    </div>
    </div>
    <div class="col-6 mgku-1">
      <div class="media">
      <img src="/img/default.png" class="align-self-center mr-3 rounded-circle" style="width: 10%; height: auto;">
      <div class="media-body">
        <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
        <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</small>
      </div>
    </div>
    </div>
    <div class="col-6 mgku-1">
      <div class="media">
      <img src="/img/default.png" class="align-self-center mr-3 rounded-circle" style="width: 10%; height: auto;">
      <div class="media-body">
        <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
        <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</small>
      </div>
    </div>
    </div>
    <div class="col-6 mgku-1">
      <div class="media">
      <img src="/img/default.png" class="align-self-center mr-3 rounded-circle" style="width: 10%; height: auto;">
      <div class="media-body">
        <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
        <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</small>
      </div>
    </div>
    </div>
    <div class="col-6 mgku-1">
      <div class="media">
      <img src="/img/default.png" class="align-self-center mr-3 rounded-circle" style="width: 10%; height: auto;">
      <div class="media-body">
        <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
        <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</small>
      </div>
    </div>
    </div>
  </div>
      <center>
      <button type="button" id="btn-initial2" class="btn btn-primary btn-sm">Got it</button>
      </center>
      </div> <!-- end-modal body -->
    </div>
  </div>
</div> <!-- end-modal INITIAL2 -->



<!-- Modal INITIAL-3-->
<div class="modal fade" id="initial3" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <center>
      <img src="/visual/init3.png" id="img-initial3">
      <h3 class="cgrey" style="margin-bottom: 0.5em;">Ready For Action ?</h3>
      <p class="clight s14">Congratulations ! You’re already succesfull register and you’re already member of community . Let’s look what do you can explore !</p>

      <button type="button" id="btn-initial3" class="btn btn-primary btn-sm">Finish</button>
      </center>
      </div> <!-- end-modal body -->
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">

$(document).ready(function () {

});


$("#btn-initial1").click(function() {
  $("#initial1").modal('hide');
  $("#initial2").modal('show');
  $("#initial3").modal('hide');
});

$("#btn-initial2").click(function() {
  $("#initial1").modal('hide');
  $("#initial2").modal('hide');
  $("#initial3").modal('show');
});

$("#btn-initial3").click(function() {
  $("#initial1").modal('hide');
  $("#initial2").modal('hide');
  $("#initial3").modal('hide');
});



</script>

@endsection
