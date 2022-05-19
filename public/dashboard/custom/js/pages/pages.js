$(function () {
    $('.sidebar-nav-link').each(function(){
        $(this).removeClass('active');
    });

    $('#sideBarPages').addClass('active');

    $('#description').summernote({
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
        ]
    });
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
        allowImageValidateSize:true, 
        imageValidateSizeMinWidth: 1355,
        imageValidateSizeMaxWidth: 1357,
        imageValidateSizeMinHeight:667,
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