@extends('layout.admin-dashboard')
@section('title', 'News Management')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">News Management</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your news information<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
          <nav aria-label="breadcrumb">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle btn-tosca btn-sm" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" lang="en">Add News</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a id="btn_add_news" class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_add_news" lang="en">Manual Add News</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_scrape_news" lang="en">Scrape News</a>
            </div>
        </div>
    </nav>
    </div>
</div>
<br>

<div class="row">
    <div id="page_news_management_admin"></div>
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih" lang="en">List News</div>

            <div class="card-body">
                <!-- tabel all susbcriber -->
                <table id="tabel_news_manage" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th><b></b></th>
                            <th><b lang="en">Title</b></th>
                            <th><b lang="en">Author</b></th>
                            <th><b lang="en">Date</b></th>
                            <th><b lang="en">Publish Status</b></th>
                            <th><b lang="en">Headline Status</b></th>
                            <th><b lang="en">Action</b></th>
                        </tr>
                    </thead>
                </table>
                <!-- end tabel all  -->
            </div> <!-- //body -->
        </div>
    </div>
</div> <!-- endrow -->






<!-- MODAL ADD NEWS-->
<div class="modal fade" id="modal_add_news" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_add_news" action="{{route('add_news_management')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Add News</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <div class="news-img-upload">
                                    <div class="news-img-cont">
                                        <img class="img-fluid news_pic" id="news_picture2" src="/img/noimg.jpg"
                                            onerror="this.onerror=null;this.src='/visual/car1.png';">
                                    </div>
                                    <div class="p-image editnews">
                                        <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                            style="width: 30px; height: 30px;">
                                            <i class="mdi mdi-camera upload-button" id="btn_up_logo_komunitas2"></i>
                                        </button>
                                        <input class="file-upload file-upload-default" id="file-upload-komunitas2"
                                            type="file" name="fileup2" accept="image/*" />
                                    </div>
                                </div>
                                <small class="clight" lang="en">News Title</small>
                                <input type="text" id="add_title" name="add_title"
                                    class="form-control input-abu melengkung10px" required>
                            </div>
                            <div class="form-group">
                                <small class="clight" lang="en">News Content</small>
                                <textarea class="form-control input-abu" label="Konten" req="" id="news_add_content"
                                    name="news_add_content"></textarea>
                            </div>

                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Add News</span> </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL SCRAPE NEWS-->
<div class="modal fade" id="modal_scrape_news" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_scrape_news" action=" {{route('scrape_news')}}" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Scrape News</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">

                                <small class="clight" lang="en">News URL</small>
                                <input type="text" id="url_add" name="url" class="form-control input-abu melengkung10px"
                                    required>
                            </div>

                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> <span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Get News</span> </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>









<!-- MODAL EDIT NEWS -->
<div class="modal fade" id="modal_edit_news" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <form method="POST" id="form_edit_news_management" action="{{route('edit_news_management')}}"
            enctype="multipart/form-data">{{ csrf_field() }}
            <div class="modal-content" style="background-color: #ffffff;">
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Edit News</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> <!-- end-header -->

                <div class="modal-body"
                    style="padding-left: 5%;padding-right: 5%; min-height: 300px; overflow-y: scroll;overflow-x: hidden;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <div class="news-img-upload">
                                    <div class="news-img-cont">
                                        <img class="img-fluid news_pic" id="news_picture" src="/img/focus.png"
                                            onerror="this.onerror=null;this.src='/visual/car1.png';">
                                    </div>
                                    <div class="p-image editnews">
                                        <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                            style="width: 30px; height: 30px;">
                                            <i class="mdi mdi-camera upload-button" id="btn_up_logo_komunitas"></i>
                                        </button>
                                        <input class="file-upload file-upload-default" id="file-upload-komunitas"
                                            type="file" id="fileup" name="fileup" accept="image/*" />
                                    </div>
                                </div>
                                <small class="clight" lang="en">News Title</small>
                                <input type="text" id="edit_title" name="edit_title"
                                    class="form-control input-abu melengkung10px">
                            </div>
                            <div class="form-group">
                                <small class="clight" lang="en">News Content</small>
                                <textarea class="form-control input-abu" label="Konten" req="" id="news_edit_content"
                                    name="news_edit_content"></textarea>
                            </div>

                            <div class="form-group publish-stat">
                                <small class="clight" lang="en">Publish Status</small>
                                <input id="toggle-status" type="checkbox" data-toggle="toggle" data-on="Published"
                                    data-off="Disabled" data-onstyle="success" data-offstyle="danger" data-width="100"
                                    data-size="sm" onclick="toggleStatus()">
                            </div>

                            <div class="form-group headline-stat">
                                <small class="clight" lang="en">Headline Status</small>
                                <input id="toggle-headline" type="checkbox" data-toggle="toggle" data-on="Headline"
                                    data-off="Normal" data-onstyle="warning" data-offstyle="light" data-width="100"
                                    data-size="sm" onclick="toggleHeadline()">
                            </div>

                        </div>
                        <input type="hidden" id="id_news" name="id_news" class="form-control input-abu">
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> <span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Save</span> </button>
                </div> <!-- end-footer     -->
            </div> <!-- END-MDL CONTENT -->
        </form>
    </div>
</div>



@endsection
