@extends('admin.supportpal.layouts.main_admin')
@section('title', 'Support Pal')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Article</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="/admin/supportpal/">
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
        <div id="page_articles"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="card-title col-md">Form Elements</div>

                        <div class="col-md" style="text-align: right;">
                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#modal_search_article">
                                <span class="btn-label">
                                    <i class="fa fa-search"></i>
                                </span>
                                Search
                            </button>

                            <button id="btn_reload_artikel" class="btn btn-light btn-sm">
                                <i class="fa fa-undo-alt"></i>
                            </button>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabel_articles" class="table table-hover table-striped dt-responsive nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th class="tebal" lang="en">ID </th>
                                <th class="tebal" lang="en">Title</th>
                                <th class="tebal" lang="en">Introduction</th>
                                <th class="tebal" lang="en">Rating</th>
                                <th class="tebal" lang="en">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL DETAIL -->
<div class="modal fade" id="modal_detail_article" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modmedium" role="document">
        <div class="modal-content">

            <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                <d>
                    <h3 class="modal-title cblue" lang="en">Detail Article</h3>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight" lang="en">Category</small>
                            <p class="cgrey tebal" id="detail_kategori"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight" lang="en">Article Type</small>
                            <p class="cgrey tebal" id="detail_tipe"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight" lang="en">Keyword</small>
                            <p class="cgrey tebal" id="detail_keyword"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight" lang="en">Positive Rating</small>
                            <p class="cgrey tebal" id="detail_positifrating"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight" lang="en">Total Rating</small>
                            <p class="cgrey tebal" id="detail_totalrating"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight" lang="en">Pinned</small>
                            <p class="cgrey tebal" id="detail_pinned"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight" lang="en">Title</small>
                            <p class="cgrey tebal" id="detail_title"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight" lang="en">Status</small>
                            <div id="detail_publish"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="cblue" lang="en">Set Your Rating</small>
                            <form method="POST" action="{{route('post.admin.rating')}}">
                                {{ csrf_field() }}
                                <input type="hidden" id="id_artikel" name="id_artikel">

                                    <input type="hidden" class="form-control form-control-sm" id="user_id_admin"
                                        name="user_id" required>
                                        <button type="submit" value="0" name="score"
                                            class="btn btn-sm btn-icon btn-round btn-danger">
                                            <i class="fa fa-thumbs-down"></i>
                                        </button> &nbsp;
                                        <button type="submit" value="1" name="score"
                                            class="btn btn-sm btn-icon btn-round btn-success">
                                            <i class="fa fa-thumbs-up"></i>
                                        </button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <small class="clight" lang="en">Text</small>&nbsp; | &nbsp;
                            <small class="clight tebal" id="detail_tglbuat"></small>
                            <p class="cgrey tebal s13" id="detail_text"></p>
                        </div>
                    </div>
                </div>

            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
                    <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SEARCH  -->
<div class="modal fade" id="modal_search_article" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title cblue" lang="en">Search Article</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="keyword">Keyword</label>
                    <input type="text" class="form-control" id="keyword" name="keyword" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                    <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                </button>
                &nbsp;
                <button type="button" id="btn_search_article" class="btn btn-info btn-sm">
                    <i class="fa fa-check"></i> &nbsp;
                    <span lang="en">Find</span></button>
            </div>
        </div>
    </div>
</div>
@endsection
