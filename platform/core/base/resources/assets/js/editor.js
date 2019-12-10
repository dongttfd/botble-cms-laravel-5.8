class EditorManagement {
    initCkEditor(element, extraConfig) {
        let config = {
            filebrowserImageBrowseUrl: RV_MEDIA_URL.base + '?media-action=select-files&method=ckeditor&type=image',
            filebrowserImageUploadUrl: RV_MEDIA_URL.media_upload_from_editor + '?method=ckeditor&type=image&_token=' + $('meta[name="csrf-token"]').attr('content'),
            filebrowserWindowWidth: '1200',
            filebrowserWindowHeight: '750',
            height: 356,
            allowedContent: true
        };
        let mergeConfig = {};
        $.extend(mergeConfig, config, extraConfig);
        CKEDITOR.replace(element, mergeConfig);
    }

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
            contextmenu: 'link image inserttable | cell row column deletetable',
            bootstrapConfig: {
                imagesPath: '/uploads',
            }
        });
    }

    initEditor(element, extraConfig, type) {
        let current = this;
        if (element.length) {
            switch (type) {
                case 'ckeditor':
                    $.each(element, (index, item) => {
                        current.initCkEditor($(item).prop('id'), extraConfig);
                    });
                    break;
                case 'tinymce':
                    $.each(element, (index, item) => {
                        current.initTinyMce($(item).prop('id'));
                    });
                    break;
            }
        }
    }

    init() {
        let $ckEditor = $('.editor-ckeditor');
        let $tinyMce = $('.editor-tinymce');
        if ($ckEditor.length > 0) {
            this.initEditor($ckEditor, {}, 'ckeditor');
        }
        if ($tinyMce.length > 0) {
            this.initEditor($tinyMce, {}, 'tinymce');
        }

        let current = this;

        $(document).on('click', '.show-hide-editor-btn', (event) => {
            event.preventDefault();
            let _self = $(event.currentTarget);
            let $result = $('#' + _self.data('result'));
            if ($result.hasClass('editor-ckeditor')) {
                if (CKEDITOR.instances[_self.data('result')] && typeof CKEDITOR.instances[_self.data('result')] !== 'undefined') {
                    CKEDITOR.instances[_self.data('result')].updateElement();
                    CKEDITOR.instances[_self.data('result')].destroy();
                    $('.editor-action-item').not('.action-show-hide-editor').hide();
                } else {
                    current.initCkEditor(_self.data('result'), {}, 'ckeditor');
                    $('.editor-action-item').not('.action-show-hide-editor').show();
                }
            } else if ($result.hasClass('editor-tinymce')) {
                tinymce.execCommand('mceToggleEditor', false, _self.data('result'));
            }
        });
    }
}

$(document).ready(() => {
    new EditorManagement().init();
});