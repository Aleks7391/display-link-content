jQuery(document).ready(function () {

    jQuery("#display_link_form").submit(function (e) {
        e.preventDefault();

        jQuery.ajax({
            type: "POST",
            url: myAjax.ajaxurl,
            data: { action: 'display_content', link: jQuery("#link_field").val(), },
            success: function (response) {
                let append = '<style> .skip-link {display: none;} </style>';
                jQuery("#content_field").html(response.concat(append));
            }
        });
    })
})

jQuery(window).load(function () {
    jQuery.ajax({
        type: "POST",
        url: myAjax.ajaxurl,
        data: { action: 'display_content', link: jQuery("#link_field").val(), },
        success: function (response) {
            let append = '<style> .skip-link {display: none;} </style>';
            jQuery("#content_field").html(response.concat(append));
        }
    });
});