@extends('subscriber.supportpal.layouts.main_subs')

@section('title', 'Support Pal')

@push('css')

@endpush

@section('content')
    <div class="page-inner">
	    <div class="page-header">
			<h4 class="page-title">Ticket</h4>
				<ul class="breadcrumbs">
		    		<li class="nav-home">
						<a href="/subscriber/supportpal/">
			    			<i class="flaticon-home"></i>
						</a>
                    </li>

                    <li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>

                    <li class="nav-item">
					    <a>List</a>
					</li>
				</ul>
        </div>

		<div class="row">
            <div id="pageTicket"></div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								<div class="row">
									<div class="col-md-4">
										Ticket List
									</div>

									<div class="col-md-2 offset-md-6 kananin">
										<a href="/subscriber/supportpal/ticket/ticket-create">
											<button type="button" class="btn btn-sm btn-info">
												<i class="fa fa-pencil-alt"></i> &nbsp;
												Create Ticket
											</button>
										</a>
									</div>
								</div>
                            </div>
						</div>

                    <div class="card-body">
                        <table id="tabelTicket" class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="tebal" lang="en">ID</th>
                                    <th class="tebal" lang="en">Number</th>
									<th class="tebal" lang="en">Title</th>
                                    <th class="tebal" lang="en">Department</th>
                                    <th class="tebal" lang="en">Created Date</th>
									<th class="tebal" lang="en">Ticket Status</th>
                                    <th class="tebal" lang="en">Detail Ticket</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('js')

@endpush
