jQuery(document).ready(function () {

    jQuery(".display_link").click(function (e) {
        e.preventDefault();
        link = jQuery("#link_field").val();

        async function file_get_contents(uri, callback) {
            let res = await fetch(uri),
                ret = await res.text();
            return callback ? callback(ret) : ret; // a Promise() actually.
        }

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: { action: "display_content" },
            success: function (response) {
                if (response.type == "success") {
                    file_get_contents(link).then(ret => jQuery("#content_field").html(ret))
                }
                else {
                    alert("jQuery Error!")
                }
            },
            error: function () {
                alert("jQuery Error!")
            }
        })
    })
})