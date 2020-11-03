jQuery('.admin-custom-area-button').on('click', function (e) {
    "use strict";
    jQuery(this).next('div').toggleClass('admin-custom-area-collapse-collapsed');
});
