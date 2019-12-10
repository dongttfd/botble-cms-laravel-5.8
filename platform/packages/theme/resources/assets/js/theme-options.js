$(document).ready(() => {
    if ($(document).find('.colorpicker-input').length > 0) {
        $(document).find('.colorpicker-input').colorpicker();
    }
    if ($(document).find('.iconpicker-input').length > 0) {
        $(document).find('.iconpicker-input').iconpicker({
            selected: true,
            hideOnSelect: true,
        });
    }
    if ($(document).find('.font-input').length > 0) {
        $(document).find('.font-input').fontselect();
    }
});