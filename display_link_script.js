jQuery(document).ready(function () {

	jQuery("#display_link_form").submit(function (e) {
		e.preventDefault();

		jQuery.ajax({
			type: "POST",
			url: myAjax.ajaxurl,
			data: { action: 'ag_display_content', link: jQuery("#link_field").val(), expire_time: jQuery("#expire_time").val() },
			success: function (response) {
				jQuery("#content_field").html(response);
			}
		});
	})
})

jQuery(window).load(function () {
	jQuery.ajax({
		type: "POST",
		url: myAjax.ajaxurl,
		data: { action: 'ag_display_content', link: jQuery("#link_field").val(), expire_time: 0 },
		success: function (response) {
			jQuery("#content_field").html(response);
		}
	});
});