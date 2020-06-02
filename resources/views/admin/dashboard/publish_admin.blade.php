@extends('layout.admin-dashboard')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-briefcase-upload"></i>
        </span>Publish Preparation</h3>

    <nav aria-label="breadcrumb">
        <a href="{{ route('setting_publish_comm') }}" type="button" id="btn_publish_now"
            class="btn btn-tosca btn-sm btn-fw">
            Publish Now</a>
    </nav>
</div> <!-- end-page header -->

<div class="row" style="padding-top:2%; padding-right:20%; padding-left:20%;">
    <div id="page_publish_commset_admin"></div>
    <div class="col-12">
        <div class="card">
            <div class="card-body" style="min-height: 420px; height: auto; margin-top: auto; margin-bottom: auto;">
                <div id="isi_list_setting">

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
