class LanguageGlobalManagement {
    init() {
        let language_choice_select = $('#post_lang_choice');
        language_choice_select.data('prev', language_choice_select.val());

        language_choice_select.on('change', (event) => {
            $('.change_to_language_text').text($(event.currentTarget).find('option:selected').text());
            $('#confirm-change-language-modal').modal('show');
        });

        $('#confirm-change-language-modal .btn-primary').on('click', (event) => {
            event.preventDefault();
            language_choice_select.val(language_choice_select.data('prev')).trigger('change');
            $('#confirm-change-language-modal').modal('hide');
        });

        $('#confirm-change-language-button').on('click', (event) => {
            event.preventDefault();
            let _self = language_choice_select;
            let flag_path = $('#language_flag_path').val();

            $.ajax({
                url: $('div[data-change-language-route]').data('change-language-route'),
                data: {
                    lang_meta_current_language: _self.val(),
                    lang_meta_content_id: $('#lang_meta_content_id').val(),
                    lang_meta_reference: $('#lang_meta_reference').val(),
                    lang_meta_created_from: $('#lang_meta_created_from').val()
                },
                type: 'POST',
                success: (data) => {
                    $('.active-language').html('<img src="' + flag_path + _self.find('option:selected').data('flag') + '.png" title="' + _self.find('option:selected').text() + '" alt="' + _self.find('option:selected').text() + '" />');
                    if (!data.error) {
                        $('.current_language_text').text(_self.find('option:selected').text());
                        let html = '';
                        $.each(data.data, (index, el) => {
                            html += '<img src="' + flag_path + el.lang_flag + '.png" title="' + el.lang_name + '" alt="' + el.lang_name + '">';
                            if (el.lang_meta_content_id) {
                                html += '<a href="' + $('#route_edit').val() + '"> ' + el.lang_name + ' <i class="fa fa-edit"></i> </a><br />';
                            } else {
                                html += '<a href="' + $('#route_create').val() + '?ref_from=' + $('#content_id').val() +'&ref_lang=' + index + '"> ' + el.lang_name + ' <i class="fa fa-plus"></i> </a><br />';
                            }
                        });

                        $('#list-others-language').html(html);
                        $('#confirm-change-language-modal').modal('hide');
                        language_choice_select.data('prev', language_choice_select.val());
                    }
                },
                error: (data) => {
                    Botble.showError(data.message);
                }
            });
        });
        
        $(document).on('click', '.change-data-language-item', (event) => {
            event.preventDefault();
            window.location.href = $(event.currentTarget).find('span[data-href]').data('href');
        });
    }
};

$(document).ready(() => {
    new LanguageGlobalManagement().init();
});