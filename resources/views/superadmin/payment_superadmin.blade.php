@extends('layout.superadmin')

@section('title', 'Payment')

@section('content')
<div class="page-header">
    <h3 class="page-title">
    	<span class="page-title-icon bg-gradient-primary text-white mr-2">
    		<i class="mdi mdi-coin"></i>
        </span> Payment </h3>

    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
        	<li class="breadcrumb-item active" aria-current="page">
        		<span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
	 <div class="card">
	 	<div class="card-body">
	 		<h4 class="card-title">Project Status</h4>
	 		<br>
            <table id="example" class="table table-hover dt-responsive nowrap" style="width:100%"> <thead>
            <tr>
                <th>Nama</th>
                <th>Bank</th>
                <th>Nominal</th>
                <th>Tanggal</th>
                <th>Bukti Bayar</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
	 	</div>
	 </div>
	</div>
</div>


<!-- MODAL VERIFY -->
<div class="modal fade" id="modal_verify_admincom" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: #ffffff;">
    <div class="modal-header">
        <h5 class="modal-title">Verify Payment New Admin Community</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <form method="POST" id="form_verify_admincom" action="{{route('verify_admincom')}}" enctype="multipart/form-data">{{ csrf_field() }}
        <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="invoice_num">Invoice Number</label>
            <div class="col-sm-8">
            <input id="invoice_num" type="text" class="form-control @error('invoice_num') is-invalid @enderror" name="invoice_num" required readonly="readonly">
            <small id="pesan_invnum" class="redhide"></small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Password</label>
            <div class="col-sm-8">
            <div class="input-group">
            <input type="password" id="pass_super" class="form-control @error('pass_super') is-invalid @enderror" name="pass_super" value="{{ old('pass_super') }}" required autocomplete="pass_super">
            <div class="input-group-append">
            <button class="btn btn-sm btn-light" type="button" onclick="showpass()">
            <i class="mdi mdi-eye"></i>
            </button>
            </div>
            </div>
            <small id="pesan_paswotsuper" class="redhide"></small>
            </div>
        </div>
         <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="file">File</label>
            <div class="col-sm-8">
            <input type="file" id="fileup" name="fileup" class="file-upload-default">
                <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                <span class="input-group-append">
                <button class="file-upload-browse btn btn-light" type="button">Browse</button>
                </span>
                </div>
            <small id="pesan_fileup" class="redhide"></small>
            </div>
        </div>
      </div> <!-- end-modal body -->
      <div class="modal-footer">
        <div style="padding: 0.5em;">
        <button type="submit" id="btn_verifyreq" class="btn btn-outline-success btn-icon-text btn-sm">
        <i class="mdi mdi-check btn-icon-prepend"></i> Verify </button>
        <button type="button" class="btn btn-outline-light btn-icon-text btn-sm close" data-dismiss="modal">
        <i class="mdi mdi-close btn-icon-prepend"></i> Cancel </button>
    </div>
      </div>
  </form>
    </div>
  </div>
</div>



@endsection

@section('script')
<script type="text/javascript">
var cdn = '{{ env("CDN") }}';
$(document).ready(function () {

    // session_logged_superadmin();
tabel_req_verify(); //datables
});

function tabel_req_verify(){
    var tabel = $('#example').DataTable({
        responsive: true,
        ajax: {
            url: '/list_req_admincomm',
            type: 'POST',
            dataSrc :'',
            timeout: 30000
        },
        columns: [
            {mData: 'nama'},
            {mData: 'payment_bank_name'},
            {mData: 'nominal'},
            {mData: 'created_at'},
            {mData: 'file_customer',
            render: function ( data, type, row, meta ) {
            var pic = cdn+data;
            return '<center><img src="'+pic+'" onclick="clickImage(this)" id="imgprev'+meta.row+'" class="img-mini zoom"></center>';
              }
            },
            {mData: 'invoice_number',
            render: function ( data, type, row ) {
                // console.log("ini : " +row.invoice_number);
                return '<button type="button" class="btn btn-outline-primary btn-rounded btn-fw btn-sm" onclick="verify_reqadmin('+data+');">Verify</button>';
              }
            }
        ],

    });

}


function verify_reqadmin(invoice_num){
// $("#invoice_num").val(invoice_num);
$('input[name="invoice_num"]').val(invoice_num);
$("#modal_verify_admincom").modal('show');
$("#btn_verifyreq").attr("disabled", true);


}


function list_req_admincomm(){
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/list_req_admincomm',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);
      },
      error: function (result) {
        console.log("Cant Reach List Request Admin Community");
    }
});
}


function showpass() {
  var a = document.getElementById("pass_super");
  if (a.type == "password") {
    a.type = "text";
  } else {
    a.type = "password";
  }
}



</script>

@endsection
