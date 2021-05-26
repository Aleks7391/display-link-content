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
        <h1>Display the Link's Content</h1>
        <form action="" method="POST" id="display_link_form">
        <input type="text" name="link_field" id="link_field" value="https://www.amazon.com/Digital-SLRs-Cameras-Photo/b/ref=dp_bc_5?ie=UTF8&node=3017941" style="width: 700px;">
	    <br>
	    <br>
        <input type="submit" class="display_link" value="Display">
        </form>
    </div>
	<br>
	<div id='content_field'></div>
	<?php
}

add_action("wp_ajax_display_content", "display_content");

function display_content() {
    $link = $_POST['link'];
    
    if ( $link == get_transient( 'link' ) ) {
        $contents = get_transient( 'link_contents' );

        if ( false === $contents ) {
            $contents = file_get_contents($link);
            set_transient( 'link_contents', $contents, HOUR_IN_SECONDS );
        }

        echo $contents;
    } else {
        set_transient( 'link', $link, HOUR_IN_SECONDS );
        $contents = file_get_contents($link);
        set_transient( 'link_contents', $contents, HOUR_IN_SECONDS );
    
        echo $contents;
    }
	wp_die();
}

add_action( 'init', 'my_script_enqueuer' );

function my_script_enqueuer() {
   wp_register_script( "display_link_script", WP_PLUGIN_URL.'/display-link-content/display_link_script.js', array('jquery') );
   wp_localize_script( 'display_link_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

   wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'display_link_script' );
}