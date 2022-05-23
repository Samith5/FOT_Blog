$(function () {
    $('.sidebar-nav-link').each(function () {
        $(this).removeClass('active');
    });

    $('#sideBarPages').addClass('active');

    $('#description, #editDescription').summernote({
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
        ]
    });

    $(document).on('click', '#editBtn', function (e) {
        $('#editModel').modal('show')
        $("#editURL").val($(this).attr('data-id'));

        $.post("/admin/dashboard/blogs/one/details", {
            url: $(this).attr('data-id'),
            _token: post_token,
        }, function (data) {
            if (data == 0) {
                toastr.error("Something went wrong. Please try again.");
            }
            else {
                data = data[0];
                $("#editTitle").val(data.title);
                $('#editDescription').summernote('code', data.description);
                editpond.addFile('/' + data.image);
                if (data.status == 1) {
                    $("#editPublished").prop('checked', true);
                }
                else {
                    $("#editPublished").prop('checked', false);
                }
            }
        });
    })
    $(document).on('click', '#removeBtn', function (e) {
        Swal.fire({
            title: 'Do you want to delete this blog?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {

            if (result.isConfirmed) {
                $.post("/admin/dashboard/blogs/delete", {
                    url: $(this).attr('data-id'),
                    _token: post_token,
                }, function (data) {
                    if (data == 0) {
                        toastr.error("Something went wrong. Please try again.");
                    }
                    else {
                        toastr.success("Blog deleted successfully");
                        blogsTable.ajax.reload();
                    }
                });
            }

        })

    })

    $(document).on('click', '.publish-link', function (e) {

        $.post("/admin/dashboard/blogs/change/status", {
            url: $(this).attr('data-id'),
            _token: post_token,
        }, function (data) {
            if (data == 0) {
                toastr.error("Something went wrong. Please try again.");
            }
            else {
                toastr.success("Blog status changed successfully");
                blogsTable.ajax.reload();
            }
        });
    })

    FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginImageValidateSize,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
    );
    FilePond.create(document.querySelector("#filepond"), {
        labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
        imagePreviewHeight: 170,
        imageCropAspectRatio: "1:1",
        imageResizeTargetWidth: 1356,
        imageResizeTargetHeight: 668,
        allowImageValidateSize: true,
        imageValidateSizeMinWidth: 1355,
        imageValidateSizeMaxWidth: 1357,
        imageValidateSizeMinHeight: 667,
        imageValidateSizeMaxHeight: 669,
        styleLoadIndicatorPosition: "center bottom",
        styleButtonRemoveItemPosition: "center bottom",
    });
    var editpond = FilePond.create(document.querySelector("#editFilepond"), {
        labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
        imagePreviewHeight: 170,
        imageCropAspectRatio: "1:1",
        imageResizeTargetWidth: 1356,
        imageResizeTargetHeight: 668,
        allowImageValidateSize: true,
        imageValidateSizeMinWidth: 1355,
        imageValidateSizeMaxWidth: 1357,
        imageValidateSizeMinHeight: 667,
        imageValidateSizeMaxHeight: 669,
        styleLoadIndicatorPosition: "center bottom",
        styleButtonRemoveItemPosition: "center bottom",
    });

    var blogsTable = $('#blogsTable').DataTable({
        processing: true,
        serverSide: true,
        "order": [[3, 'desc']],
        ajax: "/admin/dashboard/blogs/details",
        columns: [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'title',
            name: 'title'
        },
        {
            data: 'blog_image',
            name: 'blog_image',
            orderable: false,
            searchable: false,
        },
        {
            data: 'date',
            name: 'date'
        },
        {
            data: 'status',
            name: 'status',
            searchable: false,
        },
        {
            data: 'actions',
            name: 'actions',
            orderable: false,
            searchable: false
        },
        ]
    });


});
