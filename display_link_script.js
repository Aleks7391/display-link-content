jQuery(document).ready(function () {

    jQuery("#display_link_form").submit(function (e) {
        e.preventDefault();
        var data = {
            'action': 'display_content',
            'link': jQuery("#link_field").val(),
        }
        jQuery.post(myAjax.ajaxurl, data, function (response) {
            let append = '<style> .skip-link {display: none;} </style>';
            jQuery("#content_field").html(response.concat(append));
        });
    })
})

jQuery(window).load(function () {
    var data = {
        'action': 'display_content',
        'link': jQuery("#link_field").val(),
    }
    jQuery.post(myAjax.ajaxurl, data, function (response) {
        jQuery("#content_field").html(response);
    });
});