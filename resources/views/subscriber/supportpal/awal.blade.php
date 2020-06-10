@extends('subscriber.supportpal.layouts.main_subs')

@section('title', 'Support Pal')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Support Portal</h4>
    </div>

    <br><br>
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="card card-stats card-round">
                <div class="card-body bg-menus">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <a href="/subscriber/supportpal/ticket" class="menus-link">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <h1 class="mb-1 menus-link"><b><a href="/subscriber/supportpal/ticket" class="menus-link"> Ticket </a></b>
                                </h1>
                                <small class="text-muted">Use this form to submit a support ticket to our highly trained staff.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6">
            <div class="card card-stats card-round">
                <div class="card-body bg-menus">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <a href="/subscriber/supportpal/article" class="menus-link">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fas fa-book-open"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <h1 class="mb-1 menus-link"><b><a href="/subscriber/supportpal/article" class="menus-link">Articles </a></b>
                                </h1>
                                <small class="text-muted">View the latest news and announcements that cant help you.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
