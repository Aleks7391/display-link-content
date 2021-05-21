<?php
/**
 * Plugin Name: Display Link Content
 * Description: Upon providing a link, the results will be displayed in the admin menu page.
 * Author:      Aleks Ganev
 * Version:     1.0
 */

function display_link_options_page() {
    add_menu_page(
        'Display the Link\'s Content',
        'Link Display Options',
        'manage_options',
        'displaylink',
        'display_link_options_page_html'
    );
}
 
add_action( 'admin_menu', 'display_link_options_page' );
 
function display_link_options_page_html() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <input type="text" name="link_field" id="link_field" value="21">
    </div>
	<br>
	<button class="display_link">Display</button>
	<br>
	<br>
	<div id='content_field'></div>
	<?php
}

// function display_link_content() {
// 	$link_value = get_option( 'link_to_display' );
// 	if ( strpos($link_value['display_link_field'], 'https://www.amazon.com/') !== false ) {
// 		if (file_get_contents( $link_value['display_link_field'] )) {
// 			echo (file_get_contents( $link_value['display_link_field'] ));
// 		} else {
// 			echo 'Invalid Amazon Link!';
// 		}
// 	}
// }

add_action("wp_ajax_display_content", "display_content");

function display_content() {
    $link_to_display = 'test link';

	$result['type'] = "success";
	$result['link'] = $link_to_display;


    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
       $result = json_encode($result);
       echo $result;
    }
    else {
       header("Location: ".$_SERVER["HTTP_REFERER"]);
    }

    die();
}

add_action( 'init', 'my_script_enqueuer' );

function my_script_enqueuer() {
   wp_register_script( "my_voter_script", WP_PLUGIN_URL.'/display-link-content/my_voter_script.js', array('jquery') );
   wp_localize_script( 'my_voter_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

   wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'my_voter_script' );
}