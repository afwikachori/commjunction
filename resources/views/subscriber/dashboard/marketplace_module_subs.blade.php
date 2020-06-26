@extends('layout.subscriber')
@section('title', 'Marketplace Management')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Marketplace Module Management</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your marketplace for your community activity<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                data-target="#modal_create_item_marketplace" lang="en">Create Item Marketplace</button>
        </nav>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h1 class="clight">Module Market Place</h1>


            </div>
        </div>
    </div>
</div>


<!-- MODAL CREATE EVENT -->
<div class="modal fade" id="modal_create_item_marketplace" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_create_market" action="{{route('post.subs.market-createitem')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Create Item Marketplace</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <small class="clight" lang="en">Action</small>
                                <input type="text" id="action" name="action"
                                    placeholder="ADD/EDIT" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <small class="clight" lang="en">ID Item</small>
                                <input type="text" id="item_id" name="item_id" class="form-control input-abu">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Name of Item</small>
                                <input type="text" id="item_name" name="item_name" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">ID Category</small>
                                <input type="text" id="id_category" name="id_category" class="form-control input-abu">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Description Item</small>
                               <textarea id="item_deskripsi" name="item_deskripsi" class="form-control input-abu" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Price</small>
                                <input type="text" id="item_price" name="item_price" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Store Name</small>
                                <input type="text" id="store" name="store" class="form-control input-abu">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Tag Item</small>
                                <input type="text" id="item_tag" name="item_tag" class="form-control input-abu" value="murah,promo,jumbo,sale"
                                    placeholder="murah,promo,jumbo,sale">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight" lang="en">Photo Item</small>
                                <input type="file" id="photo_item" name="photo_item[]" accept="image/*" multiple
                                class="form-control input-abu">
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
                        </i> <span lang="en">Add Venue</span> </button>
                </div>
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



@endsection
