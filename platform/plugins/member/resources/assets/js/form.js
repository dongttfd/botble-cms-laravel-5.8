class CustomEditorManagement {

    initTinyMce(element) {
        tinymce.init({
            menubar: true,
            selector: '#' + element,
            skin: 'voyager',
            min_height: 300,
            resize: 'vertical',
            plugins: 'code autolink advlist visualchars link image media table charmap hr pagebreak nonbreaking anchor insertdatetime lists textcolor wordcount imagetools  contextmenu  visualblocks',
            extended_valid_elements: 'input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]',
            file_browser_callback: (field_name, url, type) => {
                if (type === 'image') {
                    $('#upload_file').trigger('click');
                }
            },
            toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link image table | alignleft aligncenter alignright alignjustify  | numlist bullist indent  |  visualblocks code',
            convert_urls: false,
            image_caption: true,
            image_advtab: true,
            image_title: true,
            entity_encoding: 'raw',
            content_style: '.mce-content-body {padding: 10px}',
            contextmenu: 'link image inserttable | cell row column deletetable'
        });
    }

    init(element) {
        let current = this;
        if (element.length) {
            $.each(element, (index, item) => {
                current.initTinyMce($(item).prop('id'));
            });
        }
    }
}

$(document).ready(() => {
    let $tinyMce = $('.editor-tinymce');
    if ($tinyMce.length > 0) {
        new CustomEditorManagement().init($tinyMce);
    }

    $('.nice-select-box select').niceSelect();

    $('.custom-select-image').on('click', function (event) {
        event.preventDefault();
        $(this).closest('.image-box').find('.image_input').trigger('click');
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $(input).closest('.image-box').find('.preview_image').prop('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('.image_input').on('change', function () {
        readURL(this);
    });
});