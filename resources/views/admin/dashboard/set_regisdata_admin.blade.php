<div class="row">
    <div class="col-md-8" style="margin-top: 0.5em;">
        <small class="clight1 s14" lang="en">Registrasion Data</small>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <button class="btn btn-tosca btn-sm" data-toggle="modal" data-target="#modal_add_question" data-dismiss="modal"
            lang="en">Add Question</button>
    </div>
</div>
<br>
<!-- tabel all susbcriber -->
<div class="row">
    <div class="col-md-12">
        <table id="tabel_list_regisdata" class="table table-hover table-striped dt-responsive nowrap"
            style="width:100%">
            <thead>
                <tr>
                    <th><b class="cgrey2" lang="en">ID Question</b></th>
                    <th><b class="cgrey2" lang="en">Question Title</b></th>
                    <th><b class="cgrey2" lang="en">Type</b></th>
                    <th><b class="cgrey2" lang="en">Date Created</b></th>
                    <th><b class="cgrey2" lang="en">Action</b></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!-- end tabel all  -->



<!-- //MODAL ADD QUESTION -->
<div class="modal fade" id="modal_add_question" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%;max-width: 750px;">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title putih" lang="en">Add New Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 280px; height: auto;">
                <form method="POST" id="form_add_dataregis" action="{{route('add_regisdata_comm')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label lang="en">Default input</label>
                                <input type="text" class="form-control input-abu" name="question_regis">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label lang="en">Input Type</label>
                                <select class="form-control input-abu" id="tipedata_regis" name="tipedata_regis">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label lang="en">Description</label>
                                <input type="text" class="form-control input-abu" name="deskripsi_regis">
                            </div>
                        </div>
                    </div>

                    <div id="input_pilihan" style="display: none; margin-top: 1em;">
                        <div class="row form-group">
                            <div class="col-md-3" style="margin-top: 1em;">
                                <label class="cgrey" lang="en">Choose Input</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control input-abu" name="pilihan_input1">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-3" style="margin-top: 1em;">
                                <label class="cgrey" lang="en">Choose Input</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control input-abu" name="pilihan_input2">
                            </div>
                        </div>
                        <div id="isi_newrow"></div>
                        <center>
                            <button type="button" class="btn btn-icon-text" id="addnewrow">
                                <i class="mdi mdi-plus-circle" style="color: #50C9C3;"></i>
                                <small lang="en">Add New Row</small> </button>
                        </center>
                    </div>
            </div>
            <div class="modal-footer putih" style="margin-bottom: 1em;">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" style="border-radius: 6px;"
                    lang="en">Cancel</button>
                <button type="submit" class="btn btn-teal btn-sm" lang="en">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- //MODAL EDIT QUESTION REGIS -->
<div class="modal fade" id="modal_edit_question" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%;max-width: 750px;">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title putih" lang="en">Edit Data Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 280px; height: auto;">
                <form method="POST" id="form_edit_dataregis" action="{{route('edit_setting_regisdata_comm')}}">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control input-abu" name="id_question" id="id_question">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label lang="en">Default input</label>
                                <input type="text" class="form-control input-abu" name="edit_question"
                                    id="edit_question">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label lang="en">Input Type</label>
                                <select class="form-control input-abu" id="edit_tipedata" name="edit_tipedata">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label lang="en">Description</label>
                                <input type="text" class="form-control input-abu" id="edit_deskripsi_regis" name="edit_deskripsi_regis">
                            </div>
                        </div>
                    </div>
                    <div id="edit_input_pilihan" style="display: none;">
                        <div id="isi_newrow_edit"></div>
                        <center>
                            <button type="button" class="btn btn-icon-text" id="addnewrow_edit">
                                <i class="mdi mdi-plus-circle" style="color: #50C9C3;"></i>
                                <small lang="en">Add New Row</small> </button>
                        </center>
                    </div>
            </div>
            <div class="modal-footer putih" style="margin-bottom: 1em;">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" style="border-radius: 6px;"
                    lang="en">Cancel</button>
                <button type="submit" class="btn btn-teal btn-sm" lang="en">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
