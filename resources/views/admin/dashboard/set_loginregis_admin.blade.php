<br>
<small class="clight1 s14" lang="en">Set up your Community Login Page & Registration Customization</small>

<div class="row" style="padding-bottom: 0; margin-top: 1em;">
    <div class="col-12">

        <div class="card">
            <form method="POST" id="form_setting_loginregis" action="{{route('setting_loginresgis_comm')}}"
                enctype="multipart/form-data">{{ csrf_field() }}

                <div class="card-body">
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Headline Text</h6>
                            <small class="clight" lang="en">Headline text will be show on subscriber login
                                portal</small>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="headline" id="headline" class="form-control input-abu">
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Description Text Login</h6>
                            <small class="clight" lang="en">Descripe anything and will appeare on subscriber
                                login</small>
                        </div>
                        <div class="col-md-5">
                            <textarea class="form-control input-abu" id="description_custom" name="description_custom"
                                rows="2"></textarea>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Image Login Portal</h6>
                            <small class="clight" lang="en">This image will be show for subscriber login
                                portal</small>
                        </div>
                        <div class="col-md-5">
                            <img src="/img/kosong.png" class="img_portal rounded-circle img-fluid zoom"
                                id="img_portal_admin" style="display: none; width: 50px; height:50px;"
                                onclick="clickImage(this)" data-toggle="tooltip" data-placement="right"
                                title="Double Click to View Image"
                                onerror="this.onerror=null;this.src='/img/kosong.png';">
                            <a id="edit_img_portal"><small class="ctosca tebal">Edit</small></a>
                            <a id="cancel_img_portal" style="display: none;"><small
                                    class="clight tebal">Cancel</small></a>

                            <div class="form-group" id="up_img_portal">
                                <input type="file" id="fileup" name="fileup" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image"
                                        style="border-radius: 10px 0px 0px 10px; background-color: #efefef;">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-light" type="button"
                                            style="padding: 0.5rem 1rem !important; border-radius: 0px 10px 10px 0px;">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Logo Login Portal</h6>
                            <small class="clight" lang="en">This logo will be the icon for subscriber login
                                portal</small>
                        </div>
                        <div class="col-md-5">
                            <img src="/img/kosong.png" class="logo_portal img-fluid zoom" id="img_logo_portal"
                                style="display: none; width: auto; height:40px;" onclick="clickImage(this)"
                                data-toggle="tooltip" data-placement="right" title="Double Click to View Image"
                                onerror="this.onerror=null;this.src='/img/kosong.png';">
                            <a id="edit_icon_portal"><small class="ctosca tebal">Edit</small></a>
                            <a id="cancel_icon_portal" style="display: none;"><small
                                    class="clight tebal">Cancel</small></a>

                            <div class="form-group" id="up_logo_portal">
                                <input type="file" id="fileup_logo" name="fileup_logo" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image"
                                        style="border-radius: 10px 0px 0px 10px; background-color: #efefef;">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-light" type="button"
                                            style="padding: 0.5rem 1rem !important; border-radius: 0px 10px 10px 0px;">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Font Headline</h6>
                            <small class="clight" lang="en">Font Headline text will be show on subscriber
                                interface</small>
                        </div>
                        <div class="col-md-5">
                            <select id="font_headline" name="font_headline" class="form-control input-abu">
                                <option value="Arial" style="font-family: Arial;">Arial</option>
                                <option value="Verdana" style="font-family: Verdana;">Verdana </option>
                                <option value="Impact" style="font-family: Impact;">Impact </option>
                                <option value="Comic Sans MS" style="font-family: Comic Sans MS;">Comic Sans MS</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Font Link</h6>
                            <small class="clight" lang="en">Font link show on link or URL</small>
                        </div>
                        <div class="col-md-5">
                            <select id="font_link" name="font_link" class="form-control input-abu">
                                <option value="Arial" style="font-family: Arial;">Arial</option>
                                <option value="Verdana" style="font-family: Verdana;">Verdana </option>
                                <option value="Impact" style="font-family: Impact;">Impact </option>
                                <option value="Comic Sans MS" style="font-family: Comic Sans MS;">Comic Sans MS</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Base Color</h6>
                            <small class="clight" lang="en">Base color will appeare in your dashbboard and subscriber
                                interface</small>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4" style="padding-right: 0px;">
                                    <span id="color_front" data-toggle="tooltip" data-placement="top"
                                        title="Click to choose color"></span>
                                    <input type='color' class='bar' id='colour' onchange="getcolour(this)">
                                </div>
                                <div class="col-md-8" style="margin-top: auto; margin-bottom: auto; text-align: left;">
                                    <p id="output-color" class="clight">#a1bcca</p>
                                </div>
                                <input type="hidden" id="color_base" name="color_base" value="#a1bcca">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Accent Color</h6>
                            <small class="clight" lang="en">Accent color will appeare in your dashbboard and subscriber
                                interface</small>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4" style="padding-right: 0px;">
                                    <span id="color_front2" data-toggle="tooltip" data-placement="top"
                                        title="Click to choose color"></span>
                                    <input type='color' class='bar' id='colour2' onchange="getcolour_accent(this)">
                                </div>
                                <div class="col-md-8" style="margin-top: auto; margin-bottom: auto; text-align: left;">
                                    <p id="output-color2" class="clight">#ade2db</p>
                                </div>
                                <input type="hidden" id="color_accent" name="color_accent" value="#ade2db">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Background Color</h6>
                            <small class="clight" lang="en">Background color will appeare behind your content</small>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4" style="padding-right: 0px;">
                                    <span id="color_front3" data-toggle="tooltip" data-placement="top"
                                        title="Click to choose color"></span>
                                    <input type='color' class='bar' id='colour3' onchange="getcolour_bgcolor(this)">
                                </div>
                                <div class="col-md-8" style="margin-top: auto; margin-bottom: auto; text-align: left;">
                                    <p id="output-color3" class="clight">#f2edf3</p>
                                </div>
                                <input type="hidden" id="color_bgcolor" name="color_bgcolor" value="#f2edf3">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Navbar Color</h6>
                            <small class="clight" lang="en">Navbar color will appeare in top your web</small>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4" style="padding-right: 0px;">
                                    <span id="color_front4" data-toggle="tooltip" data-placement="top"
                                        title="Click to choose color"></span>
                                    <input type='color' class='bar' id='colour4' onchange="getcolour_navbar(this)">
                                </div>
                                <div class="col-md-8" style="margin-top: auto; margin-bottom: auto; text-align: left;">
                                    <p id="output-color4" class="clight">#f6fbff</p>
                                </div>
                                <input type="hidden" id="color_navbar" name="color_navbar" value="#f6fbff">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Subscriber Login</h6>
                            <small class="clight" lang="en">Choose form type for subscriber login</small>
                        </div>
                        <div class="col-md-5">
                            <select class="form-control input-abu" name="form_tipe" id="form_tipe">
                                <option selected disabled lang="en">Choose</option>
                                <option value="1" lang="en">Username & Password</option>
                                <option value="2" lang="en">Phone Number & Password</option>
                                <option value="3" lang="en">Email & Password</option>
                            </select>
                            <input type="text" id="showtipeform" class="form-control input-abu" style="display: none;"
                                disabled>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Custom Domain</h6>
                            <small class="ctosca"><i lang="en">yourdomain</i>
                                <b class="clight">@smartcomm.id</b></small>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="subdomain" id="subdomain" class="form-control input-abu">
                        </div>
                        <input type="hidden" id="cek_form_subdomain" name="cek_form_subdomain">
                    </div>
                </div>
                <div class="modal-footer" style="border: none; text-align: right; padding: 5%; padding-bottom: 0px;">
                    <button type="submit" id="btn_commset_login" class="btn btn-teal btn-sm melengkung10px">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Submit</span> </button>
                </div> <!-- end-footer     -->
            </form>
        </div>
    </div>
</div>
