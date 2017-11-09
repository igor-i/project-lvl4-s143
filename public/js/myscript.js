// Быстрые фиьтры: "My tasks" и "Assigned to Me"
jQuery('#filter-assigned-to-me').change(function () {
    if (jQuery(this).prop("checked")) {
        jQuery('[data-filter-name = assignedto]').val(jQuery(this).val())
    } else {
        jQuery('[data-filter-name = assignedto]').val('')
    }
    jQuery('#filters-form').submit();
});

jQuery('#filter-my-tasks').change(function () {
    if (jQuery(this).prop("checked")) {
        jQuery('[data-filter-name = creator]').val(jQuery(this).val())
    } else {
        jQuery('[data-filter-name = creator]').val('')
    }
    jQuery('#filters-form').submit();
});

// Другие фильтры
jQuery('#filters [data-filter-source]').change(function () {
    jQuery(this).each(function (i) {
        var filterName = jQuery(this).data('filterName');
        var filterValue = jQuery(this).val();

        // console.log('filter-name: ' + jQuery(this).data('filterName') + ' value: ' + jQuery(this).val());

        jQuery('#filters-form > [data-filter-destination]').each(function (i) {
            if (jQuery(this).data('filterName') == filterName) {
                jQuery(this).val(filterValue);
                jQuery('#filters-form').submit();
            }
        });
    });
});
