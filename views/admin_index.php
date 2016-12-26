<?php
/**
  * Post_views_plugin is free software: you can redistribute it and/or modify
  * it under the terms of the GNU General Public License as published by
  * the Free Software Foundation, either version 2 of the License, or
  * any later version.
  *
  * Post_views_plugin is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  * GNU General Public License for more details.
  *
  * You should have received a copy of the GNU General Public License
  * along with Post_views_plugin. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
  */
?>

<!-- Main Items in the Admin Page -->
<div class="wrap">
    <?php echo screen_icon(); ?>
    <h2><strong>Posts' Views</strong> Settings</h2>
    <div id = 'help' style="width:60%; margin-left:20%">
        <h3 style="text-align:center">Click on Below Buttons to See the Respective Stats</h3>
        <a  href = "<?php echo WP_SITEURL . '/wp-admin/options-general.php?page=post_views&view=post'; ?>" class = "button">
            Post Stats
        </a>
        <a  style="float:right;" href="<?php echo WP_SITEURL . '/wp-admin/options-general.php?page=post_views&view=page'; ?>" class = "button">
            Page Stats
        </a>
    </div>
    <div id = "results" style = "width : 60%; margin-left : 20%" >
    <?php if( $view == 'post' ) : ?>
            <h3 style = "text-align:center"> Current Posts' Statistics</h3>

            <table style = "border : 1; width : 90%; margin-left: 5%; text-align:center" >
                <tr><th>Post ID</th>
                    <th>Post Name</th>
                    <th>Post Author</th>
                    <th>Post Views</th>
                </tr>
                <?php renderView('postviews_table_row', array('posts' => $posts)); ?>
            </table>
        <br><br>
        <h4 style="text-align : center">Choose The Post/Page whose Views you want to Reset and Click Submit</h4>
        <form style="width : 90%, margin-left : 5%" method = "POST" action = "<?php echo WP_SITEURL . '/wp-admin/options-general.php?page=post_views&view=' . $view .'&done=1'; ?>">
            <select style="margin-left : 30%; width : 40%" name="change_post_id" id = "change">
                <?php foreach ($posts as $post_obj) : ?>
                    <option><?php echo $post_obj->post_title; ?></option>
                <?php endforeach; ?>
            </select>
            <input type = "submit" value = "Submit" class="button"/>
        </form>

    <?php elseif( $view == 'page' ) : ?>
            <h3 style = "text-align:center"> Current Pages' Statistics </h3>
            <table style = "border : 1; width : 90%; margin-left: 5%; text-align:center" >
                <tr><th>Post ID</th>
                    <th>Post Name</th>
                    <th>Post Author</th>
                    <th>Post Views</th>
                </tr>
                <?php renderView('postviews_table_row', array('posts' => $posts)); ?>
            </table>
            <br><br>
            <h4 style="text-align : center">Choose The Post/Page whose Views you want to Reset and Click Submit </h4>
            <form style="width : 90%, margin-left : 5%" method = "POST" action = "<?php echo WP_SITEURL . '/wp-admin/options-general.php?page=post_views&view=' . $view .'&done=1'; ?>">
                <select style="margin-left : 30%; width : 40%" name="change_post_id" id = "change">
                    <?php foreach ($posts as $post_obj) : ?>
                        <option><?php echo $post_obj->post_title; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type = "submit" value = "Submit" class="button"/>
            </form>
    <?php endif; ?>
    </div> <!-- Closes the results Div -->
</div> <!-- Closes the Whole Content Div -->