jQuery(document).ready(function ($) {
    $('#pp_settings_form li.agp-agent a').on('click', function () {
        var str = $(this).attr('class');
        str = str.replace('pp-', '');
        str = str.replace('presspermit-', '');
        $('input[name="pp_tab"]').val(str);
    });

    $('a.pp-options-core-tab').on('click', function () {
        $('#pp_settings_form ul li a.pp-core').trigger('click');
    });
});