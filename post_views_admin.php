<?php
/*
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

/**
 * This is the File for options page for the Plugin Post_views.
 * It lets you view the Post-views for various posts together with the Author name and title of the Post
 * This may help you to Judge your various Authors and may also get the Idea of the tastes of their readers.
 */

global $wpdb;
$view = 'post';

if (isset($_GET['view'])) {
    $view = $_GET['view'];
}

$args = array(
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post_type'        => $view,
    'post_status'      => 'publish',
);
$posts = get_posts($args);

ob_start();
var_dump($posts);
$a= ob_get_clean();
error_log($a . "\n", 3, "/tmp/a.txt");

function renderView($name, $args) {
    // Initialize all the required variables
    foreach ( $args as $arg => $value ) {
        $$arg = $value;
    }

    // render the template
    require_once(dirname( __FILE__ ) . '/views/' . $name . '.php');
}

// For the re-initiation of The Views
if ( isset($_GET['done']) && $_GET['done'] == 1 && isset($_POST['change_post_id']) ) {
    $post_to_be_changed = $_POST['change_post_id'];
    $post_id = get_page_by_title( $post_to_be_changed , 'ARRAY_N', $_GET['view'] )[0];

    update_post_meta ( $post_id, 'post_views', 1);

    // Display the success message
    renderView('notice', array('post_id' => $post_to_be_changed));
}

// render the default index page
renderView(
    'admin_index',
    array(
        'view'  => $view,
        'posts' => $posts,
    )
);
