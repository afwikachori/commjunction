
// ckeditor
if ($('#editor').length) {
    CKEDITOR.replace('editor', {});
    setTimeout(function () {
        var attachment = '<input type="file" name="file" id="attachmentComment">'
        $('#cke_1_bottom').append(attachment)
    }, 1500)
}


var server_cdn = '';
var role_user = '';

$(document).ready(function () {
    init_ready();
});


function init_ready() {
    if ($("#supportpal_subscriber").length != 0){
        session_subscriber_logged();
        role_user = 'subs';
    }

    if ($("#supportpal_admin").length != 0) {
        session_admin_logged();
        role_user = 'admin';
    }

    if ($("#page_articles").length != 0) {
        tabel_list_articles();
    }

    if ($("#pageTicket").length != 0) {
        tabel_list_ticket();
    }
}


function session_admin_logged() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        url: '/admin/session_admin_logged',
        type: 'POST',
        datatype: 'JSON',
        timeout: 20000,
        success: function (result) {
            console.log(result);
            var community_name = result.user.community_name;
            var user = result.user;

            $(".foto_user").attr("src", server_cdn + cekimage_cdn(user.picture));
            $("#user_nama").html(user.full_name);
            $("#user_username").html(user.user_name);
            $("#user_email").html(user.email);

            $("#emailUser_admin").val(user.email);
            var today = new Date().toLocaleString();
            $("#datenow").html(today);
            // console.log(today);


            if (result.user.supportpal_id != undefined && result.user.supportpal_id != null) {
                $("#user_id_admin").val(user.supportpal_id);
                $("#userId_admin").val(user.supportpal_id);
                $("#user_id_komen_admin").val(user.supportpal_id);
            } else {
                swal({
                    title: "User ID Not Found",
                    text: "Please login and get your ID or back to dashboard Subscriber",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = "/admin/dashboard";
                        }
                    });
            }
        },
        error: function (result) {
            console.log("Cant Reach Session Logged Admin Community Dashboard");
        }
    });
}


function session_subscriber_logged() {
    server_cdn = $("#server_cdn").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        url: '/subscriber/session_subscriber_logged',
        type: 'POST',
        success: function (result) {
            console.log(result);

            var community_name = result.user.community_name;
            var user = result.user;

            $(".foto_user").attr("src", server_cdn + cekimage_cdn(user.picture));
            $("#user_nama").html(user.full_name);
            $("#user_username").html(user.user_name);
            $("#user_email").html(user.email);

            $("#emailUser").val(user.email);
            var today = new Date().toLocaleString();
            $("#datenow").html(today);
            console.log(today);


            if (result.user.supportpal_id != undefined && result.user.supportpal_id != null) {
                $("#user_id").val(user.supportpal_id);
                $("#userId").val(user.supportpal_id);
                $("#user_id_komen").val(user.supportpal_id);
            } else {
                swal({
                    title: "User ID Not Found",
                    text: "Please login and get your ID or back to dashboard Subscriber",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = "/subscriber/url/" + community_name;
                        }
                    });
            }

        },
        error: function (result) {
            console.log("Cant Reach Session Logged Subscriber Dashboard");
        }
    });
}


function tabel_list_articles() {
    if(role_user != 'admin'){
        var urlink = '/subscriber/supportpal/article/article-list';
    }else{
        var urlink = '/admin/supportpal/article/article-list';
    }

    var token = $('meta[name="csrf-token"]').attr('content');
    $('#tabel_articles').dataTable().fnClearTable();
    $('#tabel_articles').dataTable().fnDestroy();
    var tabel = $('#tabel_articles').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="fas fa-angle-right"></i>',
                previous: '<i class="fas fa-angle-left">'
            }
        },
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print', {
                text: 'JSON',
                action: function (e, dt, button, config) {
                    var data = dt.buttons.exportData();

                    $.fn.dataTable.fileSave(
                        new Blob([JSON.stringify(data)]),
                        'Export.json'
                    );
                }
            }
        ],
        ajax: {
            url: urlink,
            type: 'GET',
            dataSrc: '',
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_articles tbody').empty().append(nofound);
            },
        },
        columns: [
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    return "<div class='text-wrap width-50'>" + data + "</div>";
                },
            },
            { mData: 'title' },
            {
                mData: 'excerpt',
                render: function (data, type, row, meta) {
                    return "<div class='text-wrap width-200'>" + data + "</div>";
                },
            },
            {
                mData: 'positive_rating',
                render: function (data, type, row, meta) {
                    var total_rate = row.total_rating;
                    return "<div class='text-wrap width-400'>" + data + " / " + total_rate + "</div>";
                },
            },
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    return '<button type="button" class="btn btn-icon btn-round btn-xs btn-info" onclick="detail_article(\'' + data + '\')"><i class="fa fa-info"></i></button >';
                }
            }
        ],

    });
}


function detail_article(id_artikel) {
    if (role_user != 'admin') {
        var urlink = '/subscriber/supportpal/article/article-detail';
    } else {
        var urlink = '/admin/supportpal/article/article-detail';
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: urlink,
        type: 'POST',
        datatype: 'JSON',
        data: {
            "id_article": id_artikel
        },
        success: function (result) {
            console.log(result);
            $("#id_artikel").val(result.id);
            $("#detail_kategori").html(result.categories[0].name);
            $("#detail_tipe").html(result.types[0].name);
            $("#detail_keyword").html(result.keywords);

            $("#detail_positifrating").html(result.positive_rating);
            $("#detail_totalrating").html(result.total_rating);
            $("#detail_title").html(result.title);

            if (result.published == 1) {
                var ui = '<button class="btn btn-info btn-xs" disabled="disabled">Published</button>';
            } else {
                var ui = '<button class="btn btn-default btn-xs" disabled="disabled">Unpublish</button>';
            }
            $("#detail_publish").html(ui);
            $("#detail_text").html(result.text);
            $("#detail_pinned").html(result.pinned);

            var date_at = moment.unix(result.created_at).format('DD-MM-YYYY')
            $("#detail_tglbuat").html(date_at);


            $("#modal_detail_article").modal('show');
        },
        error: function (result) {
            console.log("Cant Show Detail");
        }
    });
}

$("#btn_search_article").click(function (e) {
    if (role_user != 'admin') {
        var urlink = '/subscriber/supportpal/article/article-search';
    } else {
        var urlink = '/admin/supportpal/article/article-search';
    }
    $("#modal_search_article").modal("hide");

    $('#tabel_articles').dataTable().fnClearTable();
    $('#tabel_articles').dataTable().fnDestroy();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var tabel = $('#tabel_articles').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="fas fa-angle-right"></i>',
                previous: '<i class="fas fa-angle-left">'
            }
        },
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print', {
                text: 'JSON',
                action: function (e, dt, button, config) {
                    var data = dt.buttons.exportData();

                    $.fn.dataTable.fileSave(
                        new Blob([JSON.stringify(data)]),
                        'Export.json'
                    );
                }
            }
        ],
        ajax: {
            url: urlink,
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "keyword": $("#keyword").val(),
            },
            error: function (result) {
                var nofound = '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_articles tbody').empty().append(nofound);
            },
        },
        columns: [
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    return "<div class='text-wrap width-50'>" + data + "</div>";
                },
            },
            { mData: 'title' },
            {
                mData: 'excerpt',
                render: function (data, type, row, meta) {
                    return "<div class='text-wrap width-200'>" + data + "</div>";
                },
            },
            {
                mData: 'positive_rating',
                render: function (data, type, row, meta) {
                    var total_rate = row.total_rating;
                    return "<div class='text-wrap width-400'>" + data + " / " + total_rate + "</div>";
                },
            },
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    return '<button type="button" class="btn btn-icon btn-round btn-xs btn-info" onclick="detail_article(\'' + data + '\')"><i class="fa fa-eye"></i></button >';
                }
            }
        ],

    });
    $("#keyword").val("");
});


$("#btn_reload_artikel").click(function () {
    tabel_list_articles();
});



function tabel_list_ticket() {
    if (role_user != 'admin') {
        var urlink = '/subscriber/supportpal/ticket/ticket-list';
        var link_detail = '/subscriber/supportpal/ticket/ticket-detail/';
    } else {
        var urlink = '/admin/supportpal/ticket/ticket-list';
        var link_detail = '/admin/supportpal/ticket/ticket-detail/';
    }
    var token = $('meta[name="csrf-token"]').attr('content');
    $('#tabelTicket').dataTable().fnClearTable();
    $('#tabelTicket').dataTable().fnDestroy();
    var tabel = $('#tabelTicket').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="fas fa-angle-right"></i>',
                previous: '<i class="fas fa-angle-left">'
            }
        },
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print', {
                text: 'JSON',
                action: function (e, dt, button, config) {
                    var data = dt.buttons.exportData();

                    $.fn.dataTable.fileSave(
                        new Blob([JSON.stringify(data)]),
                        'Export.json'
                    );
                }
            }
        ],
        order: [[0, 'desc']],
        ajax: {
            url: urlink,
            type: 'GET',
            dataSrc: '',
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="7" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabelTicket tbody').empty().append(nofound);
            },
        },
        columns: [
            { mData: 'id' },
            {
                mData: 'number',
                render: function (data, type, row, meta) {
                    return "<div class='text-wrap width-400'>#" + data + "</div>";
                },
            },
            { mData: 'subject' },
            { mData: 'department.name' },
            {
                mData: 'created_at',
                render: function (data, type, row, meta) {
                    var created_at = row.created_at;
                    var date_at = moment.unix(created_at).format('DD-MM-YYYY')
                    return "<div class='text-wrap width-400'>" + date_at + "</div>";
                },
            },
            {
                mData: 'status.name',
                render: function (data, type, row, meta) {
                    if (data == "Closed") {
                        return "<small class='cred'>" + data + "</small>";
                    } else {
                        return "<small class='cblue'>" + data + "</small>";
                    }
                },
            },
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    return '<a href="'+ link_detail + data + '"><button type="button" class="btn btn-icon btn-xs btn-round btn-info"><i class="fa fa-info"></i></button></a>';
                }
            }
        ],
        columnDefs:
            [
                {
                    "data": null,
                    "defaultContent": '<button type="button" class="btn btn-icon btn-round btn-xs btn-info"><i class="fa fa-info"></i></button>',
                    "targets": -1
                },

                {
                    "className": "dt-center",
                    "targets": [0, 1, 2, 3, 4, 5, 6]
                }
            ],

    });
}

// check file upload images
$(document).on('change', '.fileupload', function (e) {
    if ($(this)[0].files[0]) {
        var fileName = $(this)[0].files[0].name
        var element = $(this);
        var res = fileName.split('.');
        res = res[res.length - 1];
        res = res.toLowerCase();

        // console.log(fileName)

        $('.cekImages').text(fileName);
        $('.cekImages').show();

    } else {
        $('.cekImages').text('');
        $('.cekImages').hide();

    }
});


$('.attachments-img').on('click', function () {
    var src = $(this).attr('src')
    $('#imgPreviewModal').attr('src', src);
    $('#exampleModal').modal('show');
})

function encodeImage(element) {
    var file = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function () {
        var b64 = reader.result.replace(/^data:.+;base64,/, '');
        $('#inputAttach').val(b64);
        // console.log('RESULT', reader.result)
    }
    reader.readAsDataURL(file);
}


function cekimage_cdn(img) {
    if (img != undefined && img != null) {
        var cekone = img.slice(0, 1);
        var foto = '';
        if (cekone != "/") {
            foto = "/" + img;
        } else {
            foto = img;
        }
    } else {
        foto = '/img/fitur.png';
    }

    return foto;
}
