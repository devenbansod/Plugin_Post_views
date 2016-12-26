<?php
/*
Plugin Name: Post_views_plugin
Plugin URI: http://www.wordpress.org/plugins/post-views-new
Description: Shows the Various Posts Veiws until now.
Version: 4.0
Author: Deven Bansod
Author URI: http://www.facebook.com/bansoddeven
License: GPL2

Post_views_plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Post_views_plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Post_views_plugin. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

define( 'POST_VIEWS_PLUGIN_URL' ,  plugin_dir_url( __FILE__ ) );
define( 'WP_SITEURL' , get_site_url() );


// Set to 0, if post/page views should not be output with each post
// Rather should be available only at the backend
define( 'DISPLAY_FRONT' , 1);


/**
 *
 * Fetches the views count value from the post's/page's metadata and outputs it
 *
 */
function post_views( $post_content ) {
    $post_id = get_the_id();

    // Gets the Meta Data for the Post.
    $post_views=get_post_meta( $post_id , 'post_views' );

    if( $post_views == NULL ) {
        // Checks if there exists some data for the post and adds if not.
        add_post_meta( $post_id , 'post_views' , 1 , TRUE );

        // Gets the newly added meta data for the post.
        $post_views = get_post_meta( $post_id , 'post_views' );
    }

    // Checks if page is specifically one post . If yes, updates the new post/page view count.
    if( is_singular() ) {
        //Increases the Count of the views
        $post_views[0] = $post_views[0] + 1;

        // Save the new view count
        update_post_meta( $post_id , 'post_views' , $post_views[0] );
    }

    if (DISPLAY_FRONT) {
        $post_views_output
            = "<a  href='"
            . WP_SITEURL . "/wp-admin/options-general.php?page=post_views' "
            . "class='entry-meta' style='text-align:center'><b>Post Views</a></b> ="
            . " " . $post_views[0];
        $final_output = $post_views_output . "<br/>" . $post_content;
    } else {
        $final_output = $post_content;
    }

    // Echoes the rest of the content of the Post/page
    return $final_output;

}

function add_options_post_views() {
    add_options_page(
        "Post Views" , "Post Views" , "manage_options" , "post_views" , "post_views_admin"
    );
}

function post_views_admin() {
    include 'post_views_admin.php';
}

add_action( 'the_content' , 'post_views' ); // Calls the plugin function.
add_action( 'admin_menu' , 'add_options_post_views'); // Adds options page

?>
