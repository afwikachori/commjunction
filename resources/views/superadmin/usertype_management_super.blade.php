@extends('layout.superadmin')

@section('title', 'User Type Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>User Type Management</h3>

    <nav aria-label="breadcrumb">
        <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-target="#modal_add_usertype">Add
            User Type</button>
    </nav>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">

            <div class="card-body">
                <table id="tabel_usertype_manage" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>ID Usertype</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->



<!-- MODAL ADD USERTYPE-->
<div class="modal fade" id="modal_add_usertype" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 100%; max-width: 450px;">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_add_usertype" action="{{route('edit_user_management')}}">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%; border:none;">
                    <h4 class="modal-title cdarkgrey">Add User Type</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">
                    <div class="form-group">
                        <small class="cgrey">User Type Name</small>
                        <input type="text" id="nama_usertipe" class="form-control input-abu">
                    </div>
                    <div class="form-group">
                        <small class="cgrey">Priviledge</small>
                        <ul class="tree">
                            <li class="has">
                                <input type="checkbox" name="domain[]" value="Agricultural Sciences">
                                <label>Agricultural Sciences &nbsp;
                                    <small class="total"> (15) </small>
                                    <i class="mdi mdi-chevron-down clight"></i>
                                </label>
                                <ul>
                                    <li class="">
                                        <input type="checkbox" name="subdomain[]"
                                            value="Agriculture, Dairy &amp; Animal Science">
                                        <label>Agriculture, Dairy &amp; Animal Science </label>
                                    </li>
                                    <li class="">
                                        <input type="checkbox" name="subdomain[]" value="Agricultural Engineering">
                                        <label>Agricultural Engineering </label>
                                    </li>
                                    <li class="">
                                        <input type="checkbox" name="subdomain[]" value="Water Resources">
                                        <label>Water Resources </label>
                                    </li>
                                    <li class="">
                                        <input type="checkbox" name="subdomain[]" value="Biodiversity Conservation">
                                        <label>Biodiversity Conservation </label>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        </div>

                    </div> <!-- end-body -->

                    <div class="modal-footer" style="border: none;">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> Cancel
                        </button>
                        &nbsp;
                        <button type="submit" class="btn btn-teal btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Edit </button>
                    </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {

        tabel_tes();
        tabel_usertype_management();
    });

    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/tabel_usertype_superadmin',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log("Cant Show");
            }
        });
    }


    function tabel_usertype_management() {
        var tabel = $('#tabel_usertype_manage').DataTable({
            responsive: true,
            ajax: {
                url: '/superadmin/tabel_usertype_superadmin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
            },
            columns: [
                { mData: 'id' },
                { mData: 'title' },
                { mData: 'description' },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_usertype_manage(\'' + data + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });

    }

    function detail_usertype_manage(idusertype) {
        alert("id usertype : " + idusertype);
        // $("#modal_detail_user").modal("show");

        // $.ajaxSetup({
        //     headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //       url: '/admin/detail_user_management',
        //       type: 'POST',
        //       datatype: 'JSON',
        //       data: {
        //       "user_id": iduser
        //       },
        //       success: function (result) {

        //       },
        //       error: function (result) {
        //         console.log("Cant Show Detail User");
        //     }
        // });
    }

    $(document).on('click', '.tree label', function (e) {
        $(this).next('ul').fadeToggle();
        e.stopPropagation();
    });

    $(document).on('change', '.tree input[type=checkbox]', function (e) {
        $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
        $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
        e.stopPropagation();
    });

    $(document).on('click', 'button', function (e) {
        switch ($(this).text()) {
            case 'Collepsed':
                $('.tree ul').fadeOut();
                break;
            case 'Expanded':
                $('.tree ul').fadeIn();
                break;
            case 'Checked All':
                $(".tree input[type='checkbox']").prop('checked', true);
                break;
            case 'Unchek All':
                $(".tree input[type='checkbox']").prop('checked', false);
                break;
            default:
        }
    });


</script>

@endsection
