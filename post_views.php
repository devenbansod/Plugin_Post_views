<?php
/*
 * Plugin Name: Post_views_2
 * Plugin URI: http://www.sdmusics.co.nr
 * Description: Shows the Various Posts Veiws until now.
 * Version: 1.0
 * Author: Deven Bansod
 * Author URI: http://www.facebook.com/bansoddeven
 * License: GPL2
 */
function Post_views($text) {
        $a=get_post_meta(get_the_id(),'Page_views');//Gets the Meta Data for the Post.
        if($a==NULL)
        {
            add_post_meta(get_the_id(),'Page_views',1,TRUE);//Checks if there exists Some data for the post and adds if not.
            $a=get_post_meta(get_the_id(),'Page_views');//Gets the newly added Meta data for the post.
            
        }
        echo "<h5 style='text-align:center'>Post Views = ".$a[0]."</h5></br>";//Prints the Post's Views till now 
        if(isset($_GET['p']))//Checks if page is specifically one post. 
        {
            $a[0]=$a[0]+1;
        update_post_meta(get_the_id(),'Page_views',$a[0]);//Increases the Count of the views
        }    
        
        echo $text;   //Echoes the rest of the Content of the Post
}
add_action('the_content','Post_views');//Calls the plugin function.
?>
