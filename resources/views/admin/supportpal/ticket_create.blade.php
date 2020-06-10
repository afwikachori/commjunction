@extends('admin.supportpal.layouts.main_admin')

@section('title', 'Support Pal')

@push('css')

@endpush

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Ticket</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="/">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>

            <li class="nav-item">
                <a href="/admin/supportpal/ticket">List</a>
            </li>


            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>

            <li class="nav-item">
                <a>Create</a>
            </li>

            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="{{route('post.ticket.createreq.admin')}}">
                    <div class="card-header">
                        <div class="card-title">Create Ticket
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{ csrf_field() }}

                            <input type="hidden" class="form-control" id="userId_admin" name="userId" readonly>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Department</label>
                                    <p class="form-control-static cblue">Commjunction</p>
                                </div>

                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" id="emailUser_admin" name="emailUser"
                                        autocomplete="off" required>
                                    <small class="form-text text-muted clight">This email is used to notify you</small>
                                </div>

                                <div class="form-group">
                                    <label for="largeInput">Subject</label>
                                    <input type="text" class="form-control form-control" id="inputSubject"
                                        name="inputSubject" placeholder="Subject Input" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">
                                        Date At
                                    </label>
                                    <p class="form-control-static cblue" id="datenow">-</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Priority</label>
                                    <select class="form-control" id="priorityId" name="priorityId" required>
                                        <option disabled>Choose</option>
                                         <option value="1">Low</option>
                                        <option value="2">Medium</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">File input</label>
                                    <input type="file" class="form-control-file" id="inputFile" name="inputFile"
                                        accept="image/x-png,image/gif,image/jpeg" onchange="encodeImage(this)"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="inputAttach" name="inputAttach"
                                        autocomplete="off">
                                </div>

                            </div>

                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="comment">Text</label>
                                    <textarea class="form-control" id="inputText" name="inputText" rows="3" autocomplete="off" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-action col-lg-12 col-md-12 kananin">
                        <a href="/admin/supportpal/ticket">
                            <button type="button" class="btn btn-light btn-round">Cancel</button>
                        </a>
                        &nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary btn-round">
                            <span class="btn-label">
                                <i class="fa fa-check"></i>
                            </span> &nbsp;
                            Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>

@endsection

@push('js')

@endpush
