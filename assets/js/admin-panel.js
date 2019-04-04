jQuery(function ($) {
    show_value_from_range();

    function show_value_from_range() {
        const ranges = document.querySelectorAll('.range');
        ranges.forEach(function (range) {
            $(range).change(function () {
                let $value = $(range).find('.range_field').val();
                $(range).find('.show-range').val($value);
            }).change();
        });
    }
});