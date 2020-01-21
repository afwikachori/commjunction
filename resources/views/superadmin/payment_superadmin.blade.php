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
	<div class="col-md-7 grid-margin stretch-card">
	 <div class="card">
	 	<div class="card-body">
	 		<h4 class="card-title">Project Status</h4>
	 		<br>
            <table id="example" class="display" style="width:100%"> <thead> 
            <tr> 
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
            </tr>
            </thead> 
        </table>
	 	</div>
	 </div>
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function () {
session_logged_dashboard();
// list_req_admincomm();
});



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

</script>

@endsection