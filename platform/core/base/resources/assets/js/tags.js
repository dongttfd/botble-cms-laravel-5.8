class TagManagement {
    init() {
        let route = $('div[data-tag-route]').data('tag-route');
        let tags = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: route,
                filter: (list) => {
                    return $.map(list, (tag) => {
                        return {name: tag};
                    });
                }
            }
        });
        tags.initialize();

        $('#tags').tagsinput({
            typeaheadjs: {
                name: 'tags',
                displayKey: 'name',
                valueKey: 'name',
                source: tags.ttAdapter()
            }
        });
    }
}

$(document).ready(() => {
    new TagManagement().init();
});